<?php
/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author Mario A. Yandar
 * @since  2015-07-15
 */

class Mingresos extends CI_Model {

    public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Funcion para obtener datos basicos de persona
	 * @author Mario A. Yandar
	 */
	public function listadoPersonasRegistro($id_formulario) {
		$sql = "SELECT ID_PERSONA,P521A,P521B,P521C,P521D,P6040,(SELECT FINALIZADO FROM ENIG_ADMIN_AVANCESPERSONAS A 
		WHERE P.ID_FORMULARIO=A.ID_FORMULARIO AND P.ID_PERSONA=A.ID_PERSONA AND ID_SECCION='03EDUCACION' AND PAGINA='3') 
		AS FIN_CARAC, (SELECT FINALIZADO FROM ENIG_ADMIN_AVANCESPERSONAS A WHERE P.ID_FORMULARIO=A.ID_FORMULARIO AND 
		P.ID_PERSONA=A.ID_PERSONA AND ID_SECCION='13NEGOMIN' AND PAGINA='1') AS FIN_INGRE, P10250S1C2  
		FROM ENIG_FORM_PERSONAS P WHERE P.ID_FORMULARIO='". $id_formulario ."' AND P6040 >= 3 ORDER BY P521A,P521C";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->ID_PERSONA]['P521A']		= $row->P521A;
				$data[$row->ID_PERSONA]['P521B']		= $row->P521B;
				$data[$row->ID_PERSONA]['P521C']		= $row->P521C;
				$data[$row->ID_PERSONA]['P521D']		= $row->P521D;
				$data[$row->ID_PERSONA]['P6040']		= $row->P6040;
				$data[$row->ID_PERSONA]['P10250S1C2']	= $row->P10250S1C2;
				$data[$row->ID_PERSONA]['FIN_CARAC']	= $row->FIN_CARAC;
				$data[$row->ID_PERSONA]['FIN_INGRE']	= $row->FIN_INGRE;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author Mario A. Yandar
	 */
    public function registrarInicioPersonas($id_persona) {
		$update = "UPDATE ENIG_FORM_PERSONAS SET INI_INGRESOS='SI' WHERE ID_PERSONA='$id_persona'";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
	}

/*	public function listarSeccionesxCapitulo($id_formulario, $id_persona, $capitulo) {
		$sql = "SELECT A.ID_SECCION AS ID_SECCION, A.PAGINA AS PAGINA, DESCR_SECCION, ANTERIOR, SIGUIENTE, ACCION
			FROM ENIG_ADMIN_SECCIONES S, ENIG_ADMIN_AVANCESPERSONAS A WHERE CAPITULO='$capitulo' 
			AND A.ID_FORMULARIO='$id_formulario' AND A.ID_PERSONA='$id_persona' AND S.ID_SECCION = A.ID_SECCION AND S.PAGINA = A.PAGINA
			ORDER BY S.ID_SECCION, S.PAGINA";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_SECCION']		= $row->ID_SECCION;
				$data[$i]['PAGINA'] 		= $row->PAGINA;
				$data[$i]['DESCR_SECCION']	= $row->DESCR_SECCION;
				$data[$i]['ANTERIOR']		= $row->ANTERIOR;
				$data[$i]['SIGUIENTE']		= $row->SIGUIENTE;
				$data[$i]['ACCION']			= $row->ACCION;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	public function listarAccionesxCapitulo($capitulo) {
		$sql = "SELECT A.ID_SECCION AS ID_SECCION, A.PAGINA AS PAGINA, ANTERIOR, SIGUIENTE, ACCION 
			FROM ENIG_ADMIN_ACCIONES A, ENIG_ADMIN_SECCIONES S WHERE A.ID_SECCION=S.ID_SECCION AND 
			A.PAGINA=S.PAGINA AND CAPITULO='". $capitulo."' ORDER BY A.ID_SECCION, A.PAGINA";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->ID_SECCION . $row->PAGINA]['ANTERIOR']	= $row->ANTERIOR;
				$data[$row->ID_SECCION . $row->PAGINA]['SIGUIENTE']	= $row->SIGUIENTE;
				$data[$row->ID_SECCION . $row->PAGINA]['ACCION']	= $row->ACCION;
			}
		}
		$this->db->close();
		return $data;
	}*/
	
	public function variablesDependientes($seccion, $pagina, $id_formulario, $id_persona) {
		$depend = array();
		$sql3 = "SELECT VAR_ORIGEN,VO.TIPO_CAMPO AS VO_TIPOCAMPO,VO.TABLA_ASOCIADA AS VO_TABLA,VO.ID_SECCION as VO_SECCION, VO.PAGINA AS VO_PAGINA, 
		VAR_DESTINO, VD.TIPO_CAMPO AS VD_TIPOCAMPO,VD.TABLA_ASOCIADA AS VD_TABLA,VD.ID_SECCION AS VD_SECCION, VD.PAGINA AS VD_PAGINA, DEPENDENCIA 
		FROM ENIG_ADMIN_DEPENDENCIAS D,ENIG_ADMIN_VARIABLES VO, ENIG_ADMIN_VARIABLES VD WHERE VO.ID_VARIABLE=VAR_ORIGEN AND VD.ID_VARIABLE=VAR_DESTINO 
		AND VD.ID_SECCION='$seccion' AND VD.PAGINA='$pagina'";
		$query3 = $this->db->query($sql3);
		if ($query3->num_rows() > 0) {
			$i = 0;
			foreach ($query3->result() as $row) {
				if ($row->VO_SECCION . $row->VO_PAGINA != $row->VD_SECCION . $row->VD_PAGINA) {
					$volis[$row->VAR_ORIGEN]['ID_VARIABLE'] = $row->VAR_ORIGEN;
					$val = $this->listarValores($volis, $id_formulario, $id_persona);
					$depend[$row->VAR_ORIGEN] = $val[$row->VAR_ORIGEN];
				}
			}
		}
		return $depend;
	}
	
	/**
	 * Funcion general para listar los campos del formulario para una seccion y pagina dada.
	 * @author Mario A. Yandar
	 */
	public function listarVariables($seccion, $pagina, $id_formulario, $id_persona) {
		$sql = "SELECT * FROM ENIG_ADMIN_VARIABLES WHERE ID_SECCION='". $seccion ."' AND PAGINA='". $pagina ."' ORDER BY ORDEN";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_VARIABLE']	= $row->ID_VARIABLE;
				$data[$i]['ETIQUETA']		= $row->ETIQUETA;
				$pregunta 					= $this->asignarDatosEtiquetaPersona($row->DESCRIPCION, $id_persona);
				$pregunta					= $this->asignarFechasEtiqueta($pregunta, $id_formulario);
				$pregunta					= $this->asignarSignificadosEtiqueta($pregunta, $row->ID_VARIABLE);
				$data[$i]['DESCRIPCION'] 	= $pregunta;
				$data[$i]['TEXTO_AUXILIAR'] = $row->TEXTO_AUXILIAR;
				$data[$i]['AYUDA'] 			= $row->AYUDA;
				$data[$i]['TIPO_DATO']		= $row->TIPO_DATO;
				$data[$i]['TIPO_CAMPO'] 	= $row->TIPO_CAMPO;
				$data[$i]['LONGITUD'] 		= $row->LONGITUD;
				$data[$i]['VR_DEFECTO'] 	= $row->VR_DEFECTO;
				$data[$i]['LONG_TEXTO'] 	= $row->LONG_TEXTO;
				$data[$i]['GRUPO'] 			= $row->GRUPO;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}
	
	/**
	 * Funcion general para reasignar datos en etiquetas del formulario
	 * @author Mario A. Yandar
	 * @since  Marzo 19 / 2016
	 */
	public function asignarDatosEtiquetaPersona($texto, $id_persona) {
		// Reformatea el texto de la pregunta con el contenido del formulario
		preg_match_all('#\#(.*?)\##', $texto, $match);
		$result = $texto;
		$tabla = 'ENIG_FORM_PERSONAS';
		if (is_array($match[0]) && !empty($match[0])) {
			$campo = $match[0];
			$variable = $match[1];
			$ids_var = implode("','", $variable);
			$sql = "SELECT ID_VARIABLE FROM ENIG_ADMIN_VARIABLES WHERE ID_VARIABLE in ('$ids_var') AND TABLA_ASOCIADA='$tabla'";
			$query = $this->db->query($sql);
			$data = array();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row->ID_VARIABLE;
				}
				$sql2 = "SELECT ". implode(",", $data) ." FROM $tabla WHERE ID_PERSONA='". $id_persona ."'";
				$query2 = $this->db->query($sql2);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
						for ($i=0; $i < count($match[0]); $i++)
							$result = str_replace($campo[$i], '<i>'. $row2->$variable[$i] .'</i>', $result);
					}
				}
			}
			$this->db->close();
		}
		return $result;
	}

	/**
	 * Funcion general para reasignar FECHAS en etiquetas del formulario
	 * @author Mario A. Yandar
	 * @since  Marzo 19 / 2016
	 */
	public function asignarFechasEtiqueta($texto, $id_formulario) {
		// Reformatea el texto de la pregunta con el contenido del formulario
		preg_match_all('#\%(.*?)\%#', $texto, $match);
		$result = $texto;
		$tabla = 'ENIG_FORM_INSCRIPCION';
		if (is_array($match[0]) && !empty($match[0])) {
			$campo = $match[0];
			$variable = $match[1];
			$sql2 = "SELECT ". implode(",", $variable) ." FROM $tabla WHERE ID_FORMULARIO='". $id_formulario ."'";
			$query2 = $this->db->query($sql2);
			if ($query2->num_rows() > 0) {
				foreach ($query2->result() as $row2) {
					for ($i=0; $i < count($match[0]); $i++)
						$result = str_replace($campo[$i], '<i>'. $row2->$variable[$i] .'</i>', $result);
				}
			}
			$this->db->close();
		}
		return $result;
	}

	/**
	 * Funcion general para reasignar datos en etiquetas del formulario
	 * @author Mario A. Yandar
	 * @since  Marzo 19 / 2016
	 */
	public function asignarSignificadosEtiqueta($texto, $id_variable) {
		// Reformatea el texto de la pregunta con el contenido del formulario
		preg_match_all('#\?(.*?)\?#', $texto, $match);
		$result = $texto;
		$tabla = 'ENIG_ADMIN_SIGNIFICADOS';
		if (is_array($match[0]) && !empty($match[0])) {
			$campo = $match[0];
			$variable = $match[1];
			$sql2 = "SELECT PALABRA_CLAVE, DESCRIPCION FROM $tabla WHERE ID_VARIABLE='". $id_variable ."'";
			$query2 = $this->db->query($sql2);
			if ($query2->num_rows() > 0) {
				foreach ($query2->result() as $row2) {
					$signi[$row2->PALABRA_CLAVE] = $row2->DESCRIPCION;
				}
				for ($i=0; $i < count($match[0]); $i++)
					$result = str_replace($campo[$i], "<a href='#' data-toggle='tooltip' title='". $signi[$variable[$i]] ."'>". $variable[$i] ."</a>", $result);
			}
			$this->db->close();
		}
		return $result;
	}

	/**
	 * Funcion general para listar los campos del formulario para una seccion y pagina dada.
	 * @author Mario A. Yandar
	 * @since  Marzo 16 / 2016
	 */
	public function listarValores($variables, $id_formulario, $id_persona) {
		$sql = "SELECT * FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='". $id_formulario."' AND ID_PERSONA='". $id_persona ."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				foreach ($variables as $k=>$v) {
					$data[$v['ID_VARIABLE']] = $row->$v['ID_VARIABLE'];
				}
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion general para listar los campos del formulario para una seccion y pagina dada.
	 * @author Mario A. Yandar
	 */
	public function listarOpciones($seccion, $pagina, $id_formulario, $id_persona) {
		$sql = "SELECT L.ID_VARIABLE AS ID_VARIABLE, ID_VALOR, L.ETIQUETA AS ETIQUETA, DESCRIPCION_OPCION
		FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_VALORES L WHERE R.ID_VARIABLE=L.ID_VARIABLE AND 
		R.ID_SECCION='". $seccion ."' AND R.PAGINA='". $pagina ."' ORDER BY ORDEN_VISUAL";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_VARIABLE']		= $row->ID_VARIABLE;
				$data[$i]['ID_VALOR'] 			= $row->ID_VALOR;
				$data[$i]['ETIQUETA']			= $this->asignarDatosEtiquetaPersona($row->ETIQUETA, $id_persona);
				$data[$i]['DESCRIPCION_OPCION']	= $row->DESCRIPCION_OPCION;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion general para listar las consistencias del formulario para una seccion y pagina dada.
	 * @author Mario A. Yandar
	 */
	public function listarConsistencias($seccion, $pagina) {
		$data = array();
		$sql = "SELECT C.ID_VARIABLE AS ID_VARIABLE, ID_CONSISTENCIA, CONDICION, MENSAJE_ERROR, TIPO_ERROR
		FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_CONSISTENCIAS C WHERE R.ID_VARIABLE=C.ID_VARIABLE AND 
		R.ID_SECCION='". $seccion ."' AND R.PAGINA='". $pagina ."' ORDER BY ID_CONSISTENCIA";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->ID_VARIABLE ."__". $row->ID_CONSISTENCIA]['CONDICION']		= $row->CONDICION;
				$data[$row->ID_VARIABLE ."__". $row->ID_CONSISTENCIA]['MENSAJE_ERROR']	= $row->MENSAJE_ERROR;
				$data[$row->ID_VARIABLE ."__". $row->ID_CONSISTENCIA]['TIPO_ERROR']		= $row->TIPO_ERROR;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion general para listar las dependencias del formulario para una seccion y pagina dada.
	 * @author Mario A. Yandar
	 */
	public function listarDependencias($seccion, $pagina) {
		$data = array();
		$sql = "SELECT VAR_ORIGEN, VO.TIPO_CAMPO AS VO_TIPOCAMPO, VAR_DESTINO, VD.TIPO_CAMPO AS VD_TIPOCAMPO, DEPENDENCIA 
		FROM ENIG_ADMIN_DEPENDENCIAS D, ENIG_ADMIN_VARIABLES VO, ENIG_ADMIN_VARIABLES VD WHERE VO.ID_VARIABLE=VAR_ORIGEN 
		AND VD.ID_VARIABLE=VAR_DESTINO AND VO.ID_SECCION='$seccion' AND VO.PAGINA='$pagina' AND VD.ID_SECCION=VO.ID_SECCION AND VD.PAGINA=VO.PAGINA";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['VAR_ORIGEN']		= $row->VAR_ORIGEN;
				$data[$i]['VO_TIPOCAMPO']	= $row->VO_TIPOCAMPO;
				$data[$i]['VAR_DESTINO']	= $row->VAR_DESTINO;
				$data[$i]['VD_TIPOCAMPO']	= $row->VD_TIPOCAMPO;
				$data[$i]['DEPENDENCIA']	= $row->DEPENDENCIA;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para la creacion de un formulario 
	 * @author Mario A. Yandar
	 * @since  Julio 09 / 2015
	 * @uuid : ID del formulario.
	 * @pre: Arrreglo con Campos prediligenciados..
	 */
    public function crearFormulario($uuid, $pre, $tabla) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$insert = "INSERT INTO ". $tabla ."(ID_FORMULARIO) VALUES ('$uuid')";
		$query = $this->db->query($insert);
		if($pre != null) {
			$this->actualizarFormulario($uuid, $pre);
		}
		$this->db->close();
		return $query;
	}

	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author Mario A. Yandar
	 */
    public function actualizarFormularioPersonas($id_formulario, $id_persona, $valores) {
		$sets = "";
		$query = true;
		foreach ($valores as $k=>$v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != "ID_FORMULARIO" && substr($k, 0, 1) != '_') {
				// 2015-08-10 - mayandarl - Campos de fecha con formato
				if ($k == 'P548')
					$sets .= "$k=TO_DATE('$v','YYYY-mm-dd'),";
				else
					$sets .= "$k='$v',";
			}
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE ENIG_FORM_PERSONAS SET $sets WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
		//echo $update ."<br/>";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
	}
	
	/**
	 * Funcion para obtener datos basicos de persona
	 * @author Mario A. Yandar
	 */
	public function obtenerPersona($id_formulario, $id_persona) {
		$sql = "SELECT * FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='". $id_formulario."' AND ID_PERSONA='". $id_persona."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['P521A']	= $row->P521A;
				$data['P521B']	= $row->P521B;
				$data['P521C']	= $row->P521C;
				$data['P521D']	= $row->P521D;
				$data['P6040']	= $row->P6040;
			}
		}
		$this->db->close();
		return $data;
	}

    /**
     * Funcion para buscar resguardos
     * @author Mario A. Yandar
     */
    public function buscaretnias($nombre) {
        $sql = "SELECT COD_RESGUARDO, NOMBRE_RESGUARDO FROM ENIG_PARAM_RESGUARDOS
		WHERE NOMBRE_RESGUARDO LIKE '" . $nombre . "%' ORDER BY NOMBRE_RESGUARDO";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0)
            foreach ($query->result() as $row)
                $data[$row->COD_RESGUARDO] = $row->NOMBRE_RESGUARDO;
        $this->db->close();
        return $data;
    }

}
?>