<?php

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author Mario A. Yandar
 * @since  2015-07-15
 */
class Mformulario extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Funcion general para obtener variables dependientes
     * @author mayandarl
     */
    public function variablesDependientes($seccion, $pagina, $id_formulario) {
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
                    $val = $this->listarValores($volis, $id_formulario, $row->VO_TABLA);
                    $depend[$row->VAR_ORIGEN] = $val[$row->VAR_ORIGEN];
                }
            }
        }
        return $depend;
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
        $i = 0;
        while ($row = $query->unbuffered_row()) {
            $data[$i]['IDGRUPO'] = $row->IDGRUPO;
            $data[$i]['ETIQUETA'] = $row->ETIQUETA;
            $data[$i]['TEXTO_AUXILIAR'] = $row->TEXTO_AUXILIAR;
            $data[$i]['AYUDA'] = $row->AYUDA;
            $data[$i]['DESCRIPCION'] = $row->DESCRIPCION;
            $data[$i]['PRI_VARIABLE'] = $row->PRI_VARIABLE;
            $data[$i]['ULT_VARIABLE'] = $row->ULT_VARIABLE;
            $i++;
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author Mario A. Yandar
     */
    public function listarVariablesxCapitulo($capitulo) {
        $sql = "SELECT V.ID_VARIABLE, V.DESCRIPCION, V.TIPO_DATO, V.LONGITUD, V.TABLA_ASOCIADA
		FROM ENIG_ADMIN_VARIABLES V, ENIG_ADMIN_SECCIONES S WHERE S.ID_SECCION=V.ID_SECCION AND 
		S.PAGINA=V.PAGINA AND S.CAPITULO='$capitulo' ORDER BY V.ID_VARIABLE";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]['ID_VARIABLE'] = $row->ID_VARIABLE;
                $data[$i]['DESCRIPCION'] = $row->DESCRIPCION;
                $data[$i]['TIPO_DATO'] = $row->TIPO_DATO;
                $data[$i]['LONGITUD'] = $row->LONGITUD;
                $data[$i]['TABLA_ASOCIADA'] = $row->TABLA_ASOCIADA;
                $i++;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author Mario A. Yandar
     */
    public function listarVariables($seccion, $pagina, $id_formulario) {
        $sql = "SELECT * FROM ENIG_ADMIN_VARIABLES WHERE ID_SECCION='" . $seccion . "' AND PAGINA='" . $pagina . "' ORDER BY ORDEN";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]['ID_VARIABLE'] = $row->ID_VARIABLE;
                $data[$i]['ETIQUETA'] = $row->ETIQUETA;
                $pregunta = $this->asignarDatosEtiqueta($row->DESCRIPCION, $row->TABLA_ASOCIADA, $id_formulario);
                $pregunta = $this->asignarFechasEtiqueta($pregunta, $id_formulario);
                $pregunta = $this->asignarSignificadosEtiqueta($pregunta, $row->ID_VARIABLE);
                $data[$i]['DESCRIPCION'] = $pregunta;
                $data[$i]['TEXTO_AUXILIAR'] = $row->TEXTO_AUXILIAR;
                $data[$i]['AYUDA'] = $row->AYUDA;
                $data[$i]['TIPO_DATO'] = $row->TIPO_DATO;
                $data[$i]['TIPO_CAMPO'] = $row->TIPO_CAMPO;
                $data[$i]['LONGITUD'] = $row->LONGITUD;
                $data[$i]['ORDEN'] = $row->ORDEN;
                $data[$i]['VR_DEFECTO'] = $row->VR_DEFECTO;
                $data[$i]['LONG_TEXTO'] = $row->LONG_TEXTO;
                $data[$i]['GRUPO'] = $row->GRUPO;
                $i++;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion general para reasignar datos en etiquetas del formulario
     * @author Mario A. Yandar
     */
    /* 	public function asignarDatosEtiquetaPersona($texto, $id_persona) {
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
      } */

    /**
     * Funcion general para reasignar datos en etiquetas del formulario
     * @author Mario A. Yandar
     */
    public function asignarDatosEtiqueta($texto, $tabla, $id_formulario) {
        preg_match('#\#(.*?)\##', $texto, $match);
        $result = $texto;
        if (is_array($match) && !empty($match)) {
            $campo = $match[0];
            $variable = $match[1];
            $sql = "SELECT ID_VARIABLE, TABLA_ASOCIADA FROM ENIG_ADMIN_VARIABLES WHERE ID_VARIABLE='$variable' AND TABLA_ASOCIADA='$tabla'";
            $query = $this->db->query($sql);
            $data = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $sql2 = "SELECT $variable FROM $tabla WHERE ID_FORMULARIO='" . $id_formulario . "'";
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
     * Funcion general para reasignar FECHAS en etiquetas del formulario
     * @author Mario A. Yandar
     */
    public function asignarFechasEtiqueta($texto, $id_formulario) {
        // Reformatea el texto de la pregunta con el contenido del formulario
        preg_match_all('#\%(.*?)\%#', $texto, $match);
        $result = $texto;
        $tabla = 'ENIG_FORM_INSCRIPCION';
        if (is_array($match[0]) && !empty($match[0])) {
            $campo = $match[0];
            $variable = $match[1];
            $sql2 = "SELECT " . implode(",", $variable) . " FROM $tabla WHERE ID_FORMULARIO='" . $id_formulario . "'";
            $query2 = $this->db->query($sql2);
            if ($query2->num_rows() > 0) {
                foreach ($query2->result() as $row2) {
                    for ($i = 0; $i < count($match[0]); $i++)
                        $result = str_replace($campo[$i], '<i>' . $row2->$variable[$i] . '</i>', $result);
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
            $sql2 = "SELECT PALABRA_CLAVE, DESCRIPCION FROM $tabla WHERE ID_VARIABLE='" . $id_variable . "'";
            $query2 = $this->db->query($sql2);
            if ($query2->num_rows() > 0) {
                foreach ($query2->result() as $row2) {
                    $signi[$row2->PALABRA_CLAVE] = $row2->DESCRIPCION;
                }
                for ($i = 0; $i < count($match[0]); $i++)
                    $result = str_replace($campo[$i], "<a href='#' data-toggle='tooltip' title='" . $signi[$variable[$i]] . "'>" . $variable[$i] . "</a>", $result);
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
    public function listarValores($variables, $id_formulario, $tabla) {
        $sql = "SELECT * FROM $tabla WHERE ID_FORMULARIO='" . $id_formulario . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                foreach ($variables as $k => $v) {
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
    public function listarOpciones($seccion, $pagina) {
        $sql = "SELECT L.ID_VARIABLE AS ID_VARIABLE, ID_VALOR, L.ETIQUETA AS ETIQUETA, DESCRIPCION_OPCION
		FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_VALORES L WHERE R.ID_VARIABLE=L.ID_VARIABLE AND 
		R.ID_SECCION='" . $seccion . "' AND R.PAGINA='" . $pagina . "' ORDER BY ORDEN_VISUAL";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $data[$i]['ID_VARIABLE'] = $row->ID_VARIABLE;
                $data[$i]['ID_VALOR'] = $row->ID_VALOR;
                $data[$i]['ETIQUETA'] = $row->ETIQUETA;
                $data[$i]['DESCRIPCION_OPCION'] = $row->DESCRIPCION_OPCION;
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
        $sql = "SELECT C.ID_VARIABLE AS ID_VARIABLE, ID_CONSISTENCIA, CONDICION, MENSAJE_ERROR, TIPO_ERROR, R.TIPO_CAMPO AS TIPO_CAMPO
		FROM ENIG_ADMIN_VARIABLES R, ENIG_ADMIN_CONSISTENCIAS C WHERE R.ID_VARIABLE=C.ID_VARIABLE AND 
		R.ID_SECCION='" . $seccion . "' AND R.PAGINA='" . $pagina . "' ORDER BY ID_CONSISTENCIA";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['CONDICION'] = $row->CONDICION;
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['MENSAJE_ERROR'] = $row->MENSAJE_ERROR;
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['TIPO_ERROR'] = $row->TIPO_ERROR;
                $data[$row->ID_VARIABLE . "__" . $row->ID_CONSISTENCIA]['TIPO_CAMPO'] = $row->TIPO_CAMPO;
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
                $data[$i]['VAR_ORIGEN'] = $row->VAR_ORIGEN;
                $data[$i]['VO_TIPOCAMPO'] = $row->VO_TIPOCAMPO;
                $data[$i]['VAR_DESTINO'] = $row->VAR_DESTINO;
                $data[$i]['VD_TIPOCAMPO'] = $row->VD_TIPOCAMPO;
                $data[$i]['DEPENDENCIA'] = $row->DEPENDENCIA;
                $i++;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para obtener lista completa de las personas asociadas a un formulario
     * @author Mario A. Yandar
     */
    public function listarPersonas($id_formulario, $id_variable, $condicion) {
        $sql = "SELECT * FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='" . $id_formulario . "' ";
        // Solo mayores de 10 an~os
        if ($condicion == ">=10") {
            $sql .= " AND P6040 >=10";
        }
        // Solo hombres > EDAD
        elseif (substr($condicion, 0, 4) == "HOMB") {
            list($op, $id) = explode('>', $condicion);
            $sql .= "  AND P6020=1 AND P6040 > $id";
        }
        // Solo mujeres > EDAD
        elseif (substr($condicion, 0, 4) == "MUJE") {
            list($op, $id) = explode('>', $condicion);
            $sql .= "  AND P6020=2 AND P6040 > $id";
        }
        // Excluir una persona
        elseif (substr($condicion, 0, 4) == "EXCL") {
            list($op, $id) = explode('=', $condicion);
            $sql .= " AND ID_PERSONA != '$id'";
        }
        // Excluir una persona y mayor 10
        elseif (substr($condicion, 0, 4) == "EX10") {
            list($op, $id) = explode('=', $condicion);
            $sql .= " AND ID_PERSONA != '$id' AND P6040 >=10";
        }
        $sql .= " ORDER BY P521A,P521C";
        $query = $this->db->query($sql);
        $data = array();
        $data[0]['ID_VARIABLE'] = $id_variable;
        $data[0]['ID_VALOR'] = '';
        $data[0]['ETIQUETA'] = '-';
        $data[0]['DESCRIPCION_OPCION'] = '';
        if ($query->num_rows() > 0) {
            $i = 1;
            foreach ($query->result() as $row) {
                $data[$i]['ID_VARIABLE'] = $id_variable;
                $data[$i]['ID_VALOR'] = $row->ID_PERSONA;
                $data[$i]['ETIQUETA'] = $row->P521A . ' ' . $row->P521B . ' ' . $row->P521C . ' ' . $row->P521D . ' (' . $row->P6040 . ')';
                $data[$i]['DESCRIPCION_OPCION'] = '';
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
        $insert = "INSERT INTO " . $tabla . "(ID_FORMULARIO) VALUES ('$uuid')";
        $query = $this->db->query($insert);
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
    public function actualizarFormulario($id, $valores, $tabla) {
        $sets = "";
        $query = true;
        foreach ($valores as $k => $v) {
            // Ajustar comilla simple en consulta
            $v = str_replace("'", "''", $v);
            // No asigna ID de la tabla ni campos del sistema (que inician con _)
            if ($k != "ID_FORMULARIO" && substr($k, 0, 1) != '_') {
                $sets .= "$k='$v',";
            }
        }
        $sets = substr($sets, 0, -1); // elimina ultima coma
        $sql = "UPDATE $tabla SET $sets WHERE ID_FORMULARIO='$id'";
        //echo $sql ."<br>";
        $query = $this->db->query($sql);
        $this->db->close();
        return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    /* 	public function actualizarFormularioPersonas($id_formulario, $id_persona, $valores) {
      $sets = "";
      $query = false;
      foreach ($valores as $k=>$v) {
      // Ajustar comilla simple en consulta
      $v = str_replace("'", "''", $v);
      // No asigna ID de la tabla ni campos del sistema (que inician con _)
      if ($k != "ID_FORMULARIO" && substr($k, 0, 1) != '_') {
      $sets .= "$k='$v',";
      }
      }
      $sets = substr($sets, 0, -1); // elimina ultima coma
      $update = "UPDATE ENIG_FORM_PERSONAS SET $sets WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
      echo $update ."<br/>";
      $query = $this->db->query($update);
      $this->db->close();
      return $query;
      } */

    /**
     * Funcion para obtener datos basicos de persona
     * @author Mario A. Yandar
     */
    public function obtenerPersona($id_formulario, $id_persona) {
        $sql = "SELECT * FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='" . $id_formulario . "' AND ID_PERSONA='" . $id_persona . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['P521A'] = $row->P521A;
                $data['P521B'] = $row->P521B;
                $data['P521C'] = $row->P521C;
                $data['P521D'] = $row->P521D;
                $data['P6040'] = $row->P6040;
            }
        }
        $this->db->close();
        return $data;
    }
    
    public function consultarDatosInscripcion($id_formulario) {
        $sql = "SELECT * FROM ENIG_FORM_INSCRIPCION WHERE ID_FORMULARIO = '$id_formulario'";
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