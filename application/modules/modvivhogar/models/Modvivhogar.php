<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author mayandarl
 * @since  2015-07-15
 */
// oagarzond - Se debe dejar nombres de modelos diferentes en casos que se quiera llamar desde otro modulo
class Modvivhogar extends CI_Model {

    private $id = "ID_FORMULARIO";
    private $id_formulario;

    public function __construct() {
        parent::__construct();
        $this->id_formulario = '';
    }
    
    public function set_id_formulario($id_formulario) {
        $this->id_formulario = $id_formulario;
    }
    
    public function listarSeccionesxCapitulo($capitulo) {
        $sql = "SELECT * FROM ENIG_ADMIN_SECCIONES WHERE CAPITULO = '" . $capitulo . "' ORDER BY ID_SECCION, PAGINA";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]['ID_SECCION'] = $row->ID_SECCION;
                $data[$i]['PAGINA'] = $row->PAGINA;
                $data[$i]['DESCR_SECCION'] = $row->DESCR_SECCION;
                $i++;
            }
        }
        //pr($data); exit;
        $this->db->close();
        return $data;
    }

    /**
     * Funcion general para listar los grupos de variables del formulario para una seccion y pagina dada.
	 * Uhmm - Admite un solo grupo por seccion y pagina...
     * @author mayandarl
     */
	public function listarGruposVariables($seccion, $pagina) {
		$sql = "SELECT IDGRUPO, G.ETIQUETA AS ETIQUETA, G.TEXTO_AUXILIAR AS TEXTO_AUXILIAR, 
		G.AYUDA AS AYUDA, G.DESCRIPCION AS DESCRIPCION, PRI_VARIABLE, ULT_VARIABLE 
		FROM ENIG_ADMIN_VARGRUPO G, ENIG_ADMIN_VARIABLES V WHERE PRI_VARIABLE=V.ID_VARIABLE 
		AND V.ID_SECCION='$seccion' AND V.PAGINA='$pagina'";
		$data = array();
		$query = $this->db->query($sql);
		while ($row = $query->unbuffered_row()) {
			$data['IDGRUPO'] 		= $row->IDGRUPO;
			$data['ETIQUETA'] 		= $row->ETIQUETA;
			$data['TEXTO_AUXILIAR']	= $row->TEXTO_AUXILIAR;
			$data['AYUDA'] 			= $row->AYUDA;
			$data['DESCRIPCION'] 	= $row->DESCRIPCION;
			$data['PRI_VARIABLE']	= $row->PRI_VARIABLE;
			$data['ULT_VARIABLE']	= $row->ULT_VARIABLE;
		}
		$this->db->close();
		return $data;
	}
	
    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author mayandarl
     * @since  Marzo 16 / 2016
     */
    public function listarVariables($seccion, $pagina) {
		$data = array();
		$i = 0;
		$sql = "SELECT * FROM ENIG_ADMIN_VARIABLES WHERE ID_SECCION = '" . $seccion . "' AND PAGINA = '" . $pagina . "' ORDER BY ORDEN";
		//pr($sql); exit;
		$query = $this->db->query($sql);
		while ($row = $query->unbuffered_row()) {
			$data[$i]['ID_VARIABLE'] = $row->ID_VARIABLE;
			$data[$i]['ETIQUETA'] = $this->asignarDatosEtiqueta($row->ETIQUETA, $row->TABLA_ASOCIADA, $this->id_formulario);
			$data[$i]['DESCRIPCION'] = $this->asignarDatosEtiqueta($row->DESCRIPCION, $row->TABLA_ASOCIADA, $this->id_formulario);
			/* $pregunta 					= $this->asignarDatosEtiquetaPersona($row->DESCRIPCION, $id_persona);
			  $pregunta					= $this->asignarFechasEtiqueta($pregunta, $this->id_formulario);
			  $pregunta					= $this->asignarSignificadosEtiqueta($pregunta);
			  $data[$i]['DESCRIPCION'] 	= $pregunta; */
			$data[$i]['TEXTO_AUXILIAR'] = $row->TEXTO_AUXILIAR;
			$data[$i]['AYUDA'] = $row->AYUDA;
			$data[$i]['TIPO_DATO'] = $row->TIPO_DATO;
			$data[$i]['TIPO_CAMPO'] = $row->TIPO_CAMPO;
			$data[$i]['LONGITUD'] = $row->LONGITUD;
			$data[$i]['VR_DEFECTO'] = $row->VR_DEFECTO;
			$data[$i]['LONG_TEXTO'] = $row->LONG_TEXTO;
			$data[$i]['GRUPO'] = $row->GRUPO;
			$i++;
		}
		//pr($data); exit;
		$this->db->close();
		return $data;
    }

    /**
     * Funcion general para reasignar datos en etiquetas del formulario
     * @author mayandarl
     * @since  Marzo 19 / 2016
     */
    public function asignarDatosEtiqueta($texto, $tabla) {
        preg_match('#\#(.*?)\##', $texto, $match);
        $result = $texto;
        if (is_array($match) && !empty($match)) {
            $campo = $match[0];
            $variable = $match[1];
            $sql = "SELECT ID_VARIABLE, TABLA_ASOCIADA FROM ENIG_ADMIN_VARIABLES WHERE ID_VARIABLE='$variable' AND TABLA_ASOCIADA='$tabla'";
            //pr($sql); exit;
            $query = $this->db->query($sql);
            $data = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $sql2 = "SELECT $variable FROM $tabla WHERE ID_FORMULARIO='" . $this->id_formulario . "'";
                    $query2 = $this->db->query($sql2);
                    if ($query2->num_rows() > 0) {
                        foreach ($query2->result() as $row2)
                            $result = str_replace($campo, '<i>' . $row2->$variable . '</i>', $texto);
                    }
                }
            }
            $this->db->close();
        }
        return $result;
    }

    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author mayandarl
     * @since  Marzo 16 / 2016
     */
    public function listarValores($variables, $tabla) {
        $sql = "SELECT * FROM " . $tabla . " WHERE ID_FORMULARIO='" . $this->id_formulario . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                foreach ($variables as $k => $v) {
                    if (isset($row->$v['ID_VARIABLE'])) {
                        $data[$v['ID_VARIABLE']] = $row->$v['ID_VARIABLE'];
                    }
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
    public function listarOpciones($seccion, $pagina) {
        $sql = "SELECT L.ID_VARIABLE AS ID_VARIABLE, ID_VALOR, L.ETIQUETA AS ETIQUETA, DESCRIPCION_OPCION
			FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_VALORES L 
			WHERE R.ID_VARIABLE=L.ID_VARIABLE 
			AND R.ID_SECCION = '" . $seccion . "' AND R.PAGINA = '" . $pagina .
                "' ORDER BY L.ID_VARIABLE, L.ORDEN_VISUAL";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        $data = array();
        $i = 0;
        while ($row = $query->unbuffered_row()) {
            $data[$i]['ID_VARIABLE'] = $row->ID_VARIABLE;
            $data[$i]['ID_VALOR'] = $row->ID_VALOR;
            $data[$i]['ETIQUETA'] = $row->ETIQUETA;
            $data[$i]['DESCRIPCION_OPCION'] = $row->DESCRIPCION_OPCION;
            $i++;
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author Mario A. Yandar
     */
    public function listarConsistencias($seccion, $pagina) {
        $data = array();
        $sql = "SELECT C.ID_VARIABLE AS ID_VARIABLE, ID_CONSISTENCIA, CONDICION, MENSAJE_ERROR, TIPO_ERROR
		FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_CONSISTENCIAS C WHERE R.ID_VARIABLE=C.ID_VARIABLE AND
		R.ID_SECCION='" . $seccion . "' AND R.PAGINA='" . $pagina . "' ORDER BY ID_CONSISTENCIA";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['CONDICION'] = $row->CONDICION;
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['MENSAJE_ERROR'] = $row->MENSAJE_ERROR;
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['TIPO_ERROR'] = $row->TIPO_ERROR;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para listar las personas de la encuesta:
     * @author mayandarl
	 * @author oagarzond
	 * @param   Array   $arrDatos Arreglo asociativo con los valores para hacer la consulta
     * @return  Array   Registros devueltos por la consulta
     */
    public function listadoPersonas($arrDatos) {
        $cond = '';
		if (array_key_exists("P191", $arrDatos)) {
            $cond .= " AND P191 = " . $arrDatos["P191"];
        }
		if (array_key_exists("P191S1__MI", $arrDatos)) {
            $cond .= " AND P191S1 >= " . $arrDatos["P191S1__MI"];
        }
		if (array_key_exists("P191S1__LI", $arrDatos)) {
            $cond .= " AND P191S1 <= " . $arrDatos["P191S1__LI"];
        }
		
        $sql = "SELECT ID_PERSONA, P521A, P521B, P521C, P521D, P191S1, V1.ETIQUETA AS P191, V2.ETIQUETA AS P6020, V3.ETIQUETA AS P1650, V4.ETIQUETA AS P6080
		FROM ENIG_FORM_PERSONAS, ENIG_ADMIN_VALORES V1, ENIG_ADMIN_VALORES V2, ENIG_ADMIN_VALORES V3, ENIG_ADMIN_VALORES V4
		WHERE V1.ID_VARIABLE = 'P191' AND V1.ID_VALOR = P191 AND V2.ID_VARIABLE = 'P6020' AND V2.ID_VALOR = P6020 AND V3.ID_VARIABLE = 'P1650' AND V3.ID_VALOR = P1650
		AND V4.ID_VARIABLE = 'P6080' AND V4.ID_VALOR = P6080 AND ID_FORMULARIO = '" . $this->id_formulario . "'" . $cond . 
                " ORDER BY P6050";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]['ID_PERSONA'] = $row->ID_PERSONA;
                $data[$i]['P521'] = $row->P521A; // Nombres
				$data[$i]['P521'] .= (strlen($row->P521B) > 0) ? " " . $row->P521B: "";
				$data[$i]['P521'] .= (strlen($row->P521C) > 0) ? " " . $row->P521C: "";
				$data[$i]['P521'] .= (strlen($row->P521D) > 0) ? " " . $row->P521D: "";				
                $data[$i]['P191S1'] = $row->P191S1;  // Edad
                $data[$i]['P191'] = $row->P191;  // Ingresos?
                $data[$i]['P1650'] = $row->P1650;  // Estado civil
                $data[$i]['P6080'] = $row->P6080;  // Etnia
                $data[$i]['P6020'] = $row->P6020;  // Genero
                $i++;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para la creacion de un formulario 
     * @author mayandarl
     * @since  Julio 09 / 2015
     * @uuid : ID del formulario.
     * @pre: Arrreglo con Campos prediligenciados..
     */
    public function crearFormulario($uuid, $pre, $tabla) {
        // Uso de funcion sys_guid() de Oracle para generar ID
        $sql = "INSERT INTO " . $tabla . "(" . $this->id . ") VALUES ('$uuid')";
        $query = $this->db->query($sql);
        if ($pre != null) {
            $this->actualizarFormulario($uuid, $pre);
        }
        $this->db->close();
        return $query;
    }

	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author mayandarl
	 */
	public function actualizarFormulario($valores, $tabla) {
		$sets = "";
		$query = false;
		foreach ($valores as $k => $v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != $this->id && substr($k, 0, 1) != '_') {
				$sets .= "$k='$v',";
			}
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$sql = "UPDATE $tabla SET $sets WHERE " . $this->id . "='". $this->id_formulario ."'";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
    
    public function consultarDatosInscripcion() {
        $sql = "SELECT * FROM ENIG_FORM_INSCRIPCION WHERE ID_FORMULARIO = '$this->id_formulario'";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        $data = array();
        while ($row = $query->unbuffered_row("array")) {
            $data = $row;
        }
        $this->db->close();
        return $data;
    }
}

?>