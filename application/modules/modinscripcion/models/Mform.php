<?php

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author Mario A. Yandar
 * @since  2015-07-15
 */
class Mform extends CI_Model {

    public $id = "ID_FORMULARIO";

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     * @since  Marzo 16 / 2016
     */
    public function actualizarFormulario($id_formulario, $valores, $tabla) {
        $sets = "";
        $query = true;
        foreach ($valores as $k => $v) {
            // Ajustar comilla simple en consulta
            $v = str_replace("'", "''", $v);
            // No asigna ID de la tabla ni campos del sistema (que inician con _)
            if ($k != $this->id && substr($k, 0, 1) != '_') {
                // 2015-08-10 - mayandarl - Campos de fecha con formato
                if ($k == 'P548')
                    $sets .= "$k=TO_DATE('$v','YYYY-mm-dd'),";
                else
                    $sets .= "$k='$v',";
            }
        }
        // Asigna fechas de referencia para el formulario.
        $fecinsc = date("Y-m-d H:i:s");
        $sets .= "FECHORA_INSC=TO_TIMESTAMP('" . $fecinsc . "', 'YYYY-MM-DD HH24:MI:SS'),";
        $sets .= "ULTIMOA='" . $this->fecha2texto(date("Y-m", strtotime('-11 month'))) . " y " . $this->fecha2texto(date("Y-m", strtotime('now'))) . "',";
        $sets .= "ULTIMOM='" . $this->fecha2texto(date("Y-m", strtotime('-1 month'))) . "',";
        $hoy = date("Y-m-d", strtotime('now'));
        $sets .= "ULTIMAS4SEM='" . $this->fecha2texto(date("Y-m-d", strtotime('-4 week'))) . " al " . $this->fecha2texto($hoy) . "',";
        $sets .= "ULTIMAS2SEM='" . $this->fecha2texto(date("Y-m-d", strtotime('-2 week'))) . " al " . $this->fecha2texto($hoy) . "',";
        $sets .= "ULTIMASEM='" . calcular_ult_sem(date("Y-m-d", strtotime('now'))) . "'";
        //$sets = substr($sets, 0, -1); // elimina ultima coma
        $update = "UPDATE $tabla SET $sets WHERE " . $this->id . "='$id_formulario'";
        //echo $update;
        $query = $this->db->query($update);
        $this->db->close();
        return $query;
    }

    // Funcion para obtener la ultima semana dada una fecha.
    // @author oagarzond
    private function obtenerUltimaSemana($fecha) {
        $txt_fecha = '';
        $num_dia = date("w", strtotime($fecha));
        switch ($num_dia) {
            case "0": // domingo
                $fecha_ini = date("Y-m-d", strtotime("-6 day", strtotime($fecha)));
                $fecha_fin = $fecha;
                break;
            case "1": // lunes
                $fecha_ini = date("Y-m-d", strtotime("-7 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-1 day", strtotime($fecha)));
                break;
            case "2": // martes
                $fecha_ini = date("Y-m-d", strtotime("-8 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-2 day", strtotime($fecha)));
                break;
            case "3": // miercoles
                $fecha_ini = date("Y-m-d", strtotime("-9 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-3 day", strtotime($fecha)));
                break;
            case "4": // jueves
                $fecha_ini = date("Y-m-d", strtotime("-10 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-4 day", strtotime($fecha)));
                break;
            case "5": // viernes
                $fecha_ini = date("Y-m-d", strtotime("-11 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-5 day", strtotime($fecha)));
                break;
            case "6": // sabado
                $fecha_ini = date("Y-m-d", strtotime("-12 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-6 day", strtotime($fecha)));
                break;
        }
        $txt_fecha = $this->fecha2texto($fecha_ini) . " al " . $this->fecha2texto($fecha_fin);
        return $txt_fecha;
    }

    // Funcion de conversion de fecha a texto.
    // @author oagarzond
    private function fecha2texto($fecha) {
        $fechatexto = "";
        $unixMark = strtotime($fecha);
        $mes = intval(date("m", $unixMark));
        $textosMes = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        foreach ($textosMes as $key => $value) {
            if ($key == $mes)
                $mes = $textosMes[$key];
        }
        $dia = intval(date("d", $unixMark));
        if (strlen($fecha) > 7)
            $fechatexto = date("d", $unixMark) . " de " . $mes . " de " . date("Y", $unixMark);
        else
            $fechatexto = $mes . " de " . date("Y", $unixMark);
        return $fechatexto;
    }

    /**
     * Funcion para la creacion de un formulario 
     * @author Mario A. Yandar
     */
    public function crearFormularioPersonas($id_formulario, $id_persona, $datos, $tabla) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO " . $tabla . "(" . $this->id . ",ID_PERSONA,INI_INGRESOS) VALUES ('$id_formulario','$id_persona','NO')";
		//echo $insert;
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioPersonas($id_formulario, $id_persona, $datos, $tabla);
		// mayandarl - Crea registros en ENIG_ADMIN_AVANCESPERSONAS
		// 2016-04-18 - mayandarl - Se excluyen secciones para ciertas edades:
		if (isset($datos['P6040']) && intval($datos['P6040']) >= 3) {
			$insert_ingr = "INSERT INTO ENIG_ADMIN_AVANCESPERSONAS SELECT '$id_formulario','$id_persona',ID_SECCION,PAGINA, 'NO' FROM ENIG_ADMIN_SECCIONES WHERE MODULO='IGPERSONAL'";
			// Personas entre 3 y 10 solo acceden al Capitulo Personal
			if (intval($datos['P6040']) < 10)
				$insert_ingr .= " AND CAPITULO='PERSONAL'";
			//echo $insert_ingr ."<br>";
			$query2 = $this->db->query($insert_ingr);
		}
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioPersonas($id_formulario, $id_persona, $valores, $tabla) {
		$sets = "";
		$query = false;
		foreach ($valores as $k => $v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != $this->id && substr($k, 0, 1) != '_') {
				if ($k == 'P548')
					$sets .= "$k=TO_DATE('$v','YYYY-mm-dd'),";
				else
					$sets .= "$k='$v',";
			}
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE $tabla SET $sets WHERE " . $this->id . "='$id_formulario' AND ID_PERSONA='$id_persona'";
		//echo $update ."<br>";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para listar las personas de la encuesta:
     * @author Mario A. Yandar
     */
    public function listadoPersonas($id_formulario) {
		$sql = "SELECT ID_PERSONA, P521A, P521B, P521C, P521D, P6040, P6050, V1.ETIQUETA AS VP6050, V2.ETIQUETA AS P6020, V3.ETIQUETA AS P10250S1C2
		FROM ENIG_FORM_PERSONAS P, ENIG_ADMIN_VALORES V1, ENIG_ADMIN_VALORES V2, ENIG_ADMIN_VALORES V3 WHERE V1.ID_VARIABLE='P6050' AND 
		V1.ID_VALOR=P6050 AND V2.ID_VARIABLE='P6020' AND V2.ID_VALOR=P6020 AND V3.ID_VARIABLE='P10250S1C2' AND V3.ID_VALOR=P10250S1C2 AND 
		ID_FORMULARIO='" . $id_formulario . "' ORDER BY P.P6050";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_PERSONA'] = $row->ID_PERSONA;
				$data[$i]['P521'] = $row->P521A . " " . $row->P521B . " " . $row->P521C . " " . $row->P521D; // Nombres
				$data[$i]['P6040'] = $row->P6040;  // Edad
				$data[$i]['P6020'] = $row->P6020;  // Genero
				$data[$i]['P6050'] = $row->VP6050;  // Parentesco
				$data[$i]['_P6050'] = $row->P6050;  // Parentesco
				$data[$i]['P10250S1C2'] = $row->P10250S1C2;  // Gastos?
				$i++;
			}
		}
		$this->db->close();
		return $data;
    }

    /**
     * Funcion para buscar persona
     * @author Mario A. Yandar
     */
    public function buscarpersona($id_formulario, $id_persona) {
        $sql = "SELECT P521A,P521B,P521C,P521D,P6020,P6040,TO_CHAR(P548,'YYYY-MM-DD') AS P548,P6050,P10250S1C2,ID_PERSONA 
		FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='" . $id_formulario . "' AND ID_PERSONA='" . $id_persona . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['P521A'] = $row->P521A;
                $data['P521B'] = $row->P521B;
                $data['P521C'] = $row->P521C;
                $data['P521D'] = $row->P521D;
                $data['P6020'] = $row->P6020;
                $data['P6040'] = $row->P6040;
                $data['P548']  = $row->P548;
                $data['P6050'] = $row->P6050;
                $data['P10250S1C2'] = $row->P10250S1C2;
                $data['_ID_PERSONA'] = $row->ID_PERSONA;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para eliminar un registro de personas
     * @author Mario A. Yandar
     */
    public function eliminarpersona($id_formulario, $id_persona) {
        $delete2 = "DELETE FROM ENIG_ADMIN_AVANCESPERSONAS WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
        $query = $this->db->query($delete2);
        $delete = "DELETE FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
        $query = $this->db->query($delete);
        $this->db->close();
        return $query;
    }

}
?>