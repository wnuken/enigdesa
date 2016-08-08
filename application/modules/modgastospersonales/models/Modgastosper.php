<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author mayandarl
 * @since  2015-07-15
 */
// oagarzond - Se debe dejar nombres de modelos diferentes en casos que se quiera llamar desde otro modulo
class Modgastosper extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
    }
    
	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author Mario A. Yandar
	 */
    public function asignar7Dias($id_formulario, $id_persona) {
		$select = "SELECT ID_SECCION FROM ENIG_ADMIN_AVANCESPERSONAS WHERE ID_SECCION='01GDP1' AND ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
		$query = $this->db->query($select);
		if ($query->num_rows() == 0) {
			$sql = "INSERT INTO ENIG_ADMIN_AVANCESPERSONAS SELECT ID_FORMULARIO, ID_PERSONA, ID_SECCION, PAGINA, 'NO' FROM ENIG_FORM_PERSONAS, ".
				"ENIG_ADMIN_SECCIONES WHERE MODULO IN ('GDPERSONAS') AND ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona'";
			$this->db->query($sql);
			$dia1 = date("Y-m-d");
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia1','YYYY-MM-DD'),'01GDP1','1')");
			$dia2 = date("Y-m-d", strtotime("+1 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia2','YYYY-MM-DD'),'02GDP2','1')");
			$dia3 = date("Y-m-d", strtotime("+2 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia3','YYYY-MM-DD'),'03GDP3','1')");
			$dia4 = date("Y-m-d", strtotime("+3 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia4','YYYY-MM-DD'),'04GDP4','1')");
			$dia5 = date("Y-m-d", strtotime("+4 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia5','YYYY-MM-DD'),'05GDP5','1')");
			$dia6 = date("Y-m-d", strtotime("+5 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia6','YYYY-MM-DD'),'06GDP6','1')");
			$dia7 = date("Y-m-d", strtotime("+6 day", strtotime($dia1)));
			$this->db->query("INSERT INTO ENIG_FORM_GDP_DIAS VALUES ('$id_formulario','$id_persona',TO_DATE('$dia7','YYYY-MM-DD'),'07GDP7','1')");
		}
		$this->db->close();
		return true;
	}

    /**
     * Funcion para consultar los dias de un formulario
     * @author Mario A. Yandar
     */
    public function buscarDia($id_formulario, $id_persona, $seccion) {
		$sql = "SELECT TO_CHAR(DIA, 'YYYY-MM-DD') AS DIA FROM ENIG_FORM_GDP_DIAS A WHERE ID_FORMULARIO='". $id_formulario .
			"' AND ID_PERSONA='". $id_persona ."'AND ID_SECCION='$seccion'";
		$query = $this->db->query($sql);
		$dia = '';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row)
				$dia = $row->DIA;
		}
		$this->db->close();
		return $dia;
    }
	
    /**
     * Funcion para obtener todos las secciones y dias de un formulario
     * @author Mario A. Yandar
     */
	public function obtenerSeccDias($id_formulario, $id_persona) {
		$data = array();
		$sql = "SELECT ID_SECCION, TO_CHAR(DIA, 'YYYY-MM-DD') AS DIA FROM ENIG_FORM_GDP_DIAS WHERE ID_FORMULARIO='". $id_formulario .
			"' AND ID_PERSONA='". $id_persona ."' ORDER BY ID_SECCION";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row)
				$data[$row->ID_SECCION] = $row->DIA;
		}
		$this->db->close();
		return $data;
	}
	
	// Funcion de conversion de fecha a texto.
	// @author oagarzond
	public function fecha2texto($fecha) {
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
    public function crearFormularioArticulo($id_formulario, $id_persona, $dia, $id_articulo, $datos) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO ENIG_FORM_GDP_ARTICULOS (ID_FORMULARIO,ID_PERSONA,DIA,ID_ARTICULO) VALUES ('$id_formulario','$id_persona',TO_DATE('$dia','YYYY-MM-DD'),'$id_articulo')";
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioArticulo($id_formulario, $id_persona, $dia, $id_articulo, $datos);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioArticulo($id_formulario, $id_persona, $dia, $id_articulo, $valores) {
		$sets = "";
		$query = false;
		foreach ($valores as $k => $v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != 'ID_FORMULARIO' && substr($k, 0, 1) != '_')
				$sets .= "$k='$v',";
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE ENIG_FORM_GDP_ARTICULOS SET $sets WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona' AND DIA=TO_DATE('$dia','YYYY-MM-DD') AND ID_ARTICULO='$id_articulo'";
		//echo $update;
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la creacion de un formulario 
     * @author Mario A. Yandar
     */
    public function crearFormularioComida($id_formulario, $id_persona, $dia, $id_comida, $datos) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO ENIG_FORM_GDP_COMIDASFUERA(ID_FORMULARIO,ID_PERSONA,DIA,ID_COMIDA) VALUES ('$id_formulario','$id_persona',TO_DATE('$dia','YYYY-MM-DD'),'$id_comida')";
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioComida($id_formulario, $id_persona, $dia, $id_comida, $datos);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioComida($id_formulario, $id_persona, $dia, $id_comida, $valores) {
		$sets = "";
		$query = false;
		foreach ($valores as $k => $v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != 'ID_FORMULARIO' && substr($k, 0, 1) != '_')
				$sets .= "$k='$v',";
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE ENIG_FORM_GDP_COMIDASFUERA SET $sets WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona' AND DIA=TO_DATE('$dia','YYYY-MM-DD') AND ID_COMIDA='$id_comida'";
		//echo $update;
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }
	
    /**
     * Funcion para listar los articulos de la encuesta de gastos:
     * @author Mario A. Yandar
     */
    public function listadoArticulos($id_formulario, $id_persona, $dia) {
		$sql = "SELECT ID_ARTICULO, ARTICULO AS NC4_CC_P1_1, NC4_CC_P2, NC4_CC_P5, 
		(SELECT V0.ETIQUETA FROM ENIG_ADMIN_VALORES V0 WHERE V0.ID_VARIABLE='NC4_CC_P3' AND V0.ID_VALOR=NC4_CC_P3) AS NC4_CC_P3, 
		(SELECT V1.ETIQUETA FROM ENIG_ADMIN_VALORES V1 WHERE V1.ID_VARIABLE='NC4_CC_P4' AND V1.ID_VALOR=NC4_CC_P4) AS NC4_CC_P4, 
		(SELECT V2.ETIQUETA FROM ENIG_ADMIN_VALORES V2 WHERE V2.ID_VARIABLE='NC4_CC_P6' AND V2.ID_VALOR=NC4_CC_P6) AS NC4_CC_P6
		FROM ENIG_FORM_GDP_ARTICULOS A, ENIG_PARAM_GDP_ARTICULOS WHERE A.ID_FORMULARIO='". 
		$id_formulario ."' AND ID_PERSONA='". $id_persona ."' AND DIA=TO_DATE('$dia', 'YYYY-MM-DD') AND CODIGO=NC4_CC_P1_1";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_ARTICULO'] 	= $row->ID_ARTICULO;
				$data[$i]['NC4_CC_P1_1'] 	= $row->NC4_CC_P1_1 == null ? "":$row->NC4_CC_P1_1;
				$data[$i]['NC4_CC_P2'] 		= $row->NC4_CC_P2	 == null ? "":$row->NC4_CC_P2;
				$data[$i]['NC4_CC_P3'] 		= $row->NC4_CC_P3 == null ? "":$row->NC4_CC_P3;
				$data[$i]['NC4_CC_P4'] 		= $row->NC4_CC_P4 == null ? "":$row->NC4_CC_P4;
				$data[$i]['NC4_CC_P5'] 		= $row->NC4_CC_P5	 == null ? "":$row->NC4_CC_P5;
				$data[$i]['NC4_CC_P6'] 		= $row->NC4_CC_P6 == null ? "":$row->NC4_CC_P6;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para buscar articulo de hogar
	 * @author Mario A. Yandar
	 */
	public function buscarArticulo($id_formulario, $id_persona, $id_articulo) {
		$sql = "SELECT ID_ARTICULO, NC4_CC_P1_1, NC4_CC_P1_1_S1, NC4_CC_P2, NC4_CC_P3, NC4_CC_P3_S1,
		NC4_CC_P4, NC4_CC_P5, NC4_CC_P6, ARTICULO FROM ENIG_FORM_GDP_ARTICULOS, ENIG_PARAM_GDP_ARTICULOS 
		WHERE ID_FORMULARIO='" . $id_formulario . "' AND ID_ARTICULO='". $id_articulo ."' AND ID_PERSONA='". 
		$id_persona ."' AND CODIGO=NC4_CC_P1_1";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['_ID_ARTICULO'] 		= $row->ID_ARTICULO;
				$data['NC4_CC_P1_1'] 		= $row->NC4_CC_P1_1;
				$data['_NC4_CC_P1_1'] 		= $row->ARTICULO;
				$data['NC4_CC_P1_1_S1'] 	= $row->NC4_CC_P1_1_S1;
				$data['NC4_CC_P2'] 			= $row->NC4_CC_P2;
				$data['NC4_CC_P3'] 			= $row->NC4_CC_P3;
				$data['NC4_CC_P3_S1'] 		= $row->NC4_CC_P3_S1;
				$data['NC4_CC_P4'] 			= $row->NC4_CC_P4;
				$data['NC4_CC_P5'] 			= $row->NC4_CC_P5;
				$data['NC4_CC_P6'] 			= $row->NC4_CC_P6;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para eliminar un registro de articulos
	 * @author Mario A. Yandar
	 */
	public function eliminarArticulo($id_formulario, $id_persona, $id_articulo) {
		$delete = "DELETE FROM ENIG_FORM_GDP_ARTICULOS WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona' AND ID_ARTICULO='$id_articulo'";
		$query = $this->db->query($delete);
		$this->db->close();
		return $query;
	}

    /**
     * Funcion para buscar resguardos
     * @author Mario A. Yandar
     */
    public function autocompletarArt($nombre) {
        $sql = "SELECT CODIGO, ARTICULO, REQ_LUGARCOMPRA 
		FROM ENIG_PARAM_GDP_ARTICULOS WHERE UPPER(ARTICULO) LIKE '" . $nombre . "%' ORDER BY ARTICULO";
        $query = $this->db->query($sql);
        $data = array();
		$i = 0;
        if ($query->num_rows() > 0)
            foreach ($query->result() as $row) {
                $data[$i]['cod'] = $row->CODIGO;
				$data[$i]['nom']= $row->ARTICULO;
				$data[$i]['lug']= $row->REQ_LUGARCOMPRA;
				$i++;
			}
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para listar las comidas de la encuesta de gastos:
     * @author Mario A. Yandar
     */
    public function listadoComidas($id_formulario, $id_persona, $dia) {
		$sql = "SELECT ID_COMIDA, NH_CGPUCFH_P1, NH_CGPUCFH_P2, NH_CGPUCFH_P5, 
		(SELECT V1.ETIQUETA FROM ENIG_ADMIN_VALORES V1 WHERE V1.ID_VARIABLE='NH_CGPUCFH_P1_1' AND V1.ID_VALOR=NH_CGPUCFH_P1_1) AS NH_CGPUCFH_P1_1, 
		(SELECT V2.ETIQUETA FROM ENIG_ADMIN_VALORES V2 WHERE V2.ID_VARIABLE='NH_CGPUCFH_P3' AND V2.ID_VALOR=NH_CGPUCFH_P3) AS NH_CGPUCFH_P3, 
		(SELECT V3.ETIQUETA FROM ENIG_ADMIN_VALORES V3 WHERE V3.ID_VARIABLE='NH_CGPUCFH_P4' AND V3.ID_VALOR=NH_CGPUCFH_P4) AS NH_CGPUCFH_P4, 
		(SELECT V4.ETIQUETA FROM ENIG_ADMIN_VALORES V4 WHERE V4.ID_VARIABLE='NH_CGPUCFH_P6' AND V4.ID_VALOR=NH_CGPUCFH_P6) AS NH_CGPUCFH_P6, 
		(SELECT V6.ETIQUETA FROM ENIG_ADMIN_VALORES V6 WHERE V6.ID_VARIABLE='NH_CGPUCFH_P8' AND V6.ID_VALOR=NH_CGPUCFH_P8) AS NH_CGPUCFH_P8 
		FROM ENIG_FORM_GDP_COMIDASFUERA C WHERE C.ID_FORMULARIO='". $id_formulario ."' AND ID_PERSONA='$id_persona' AND DIA=TO_DATE('$dia', 'YYYY-MM-DD')";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_COMIDA'] 		= $row->ID_COMIDA;
				$data[$i]['NH_CGPUCFH_P1'] 	= $row->NH_CGPUCFH_P1 == null ? "":$row->NH_CGPUCFH_P1;
				$data[$i]['NH_CGPUCFH_P1_1']= $row->NH_CGPUCFH_P1_1 == null ? "":$row->NH_CGPUCFH_P1_1;
				$data[$i]['NH_CGPUCFH_P2']	= $row->NH_CGPUCFH_P2 == null ? "":$row->NH_CGPUCFH_P2;
				$data[$i]['NH_CGPUCFH_P3']	= $row->NH_CGPUCFH_P3 == null ? "":$row->NH_CGPUCFH_P3;
				$data[$i]['NH_CGPUCFH_P4'] 	= $row->NH_CGPUCFH_P4 == null ? "":$row->NH_CGPUCFH_P4;
				$data[$i]['NH_CGPUCFH_P5']	= $row->NH_CGPUCFH_P5 == null ? "":$row->NH_CGPUCFH_P5;
				$data[$i]['NH_CGPUCFH_P6'] 	= $row->NH_CGPUCFH_P6 == null ? "":$row->NH_CGPUCFH_P6;
				$data[$i]['NH_CGPUCFH_P8'] 	= $row->NH_CGPUCFH_P8 == null ? "":$row->NH_CGPUCFH_P8;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para buscar comida fuera del hogar
	 * @author Mario A. Yandar
	 */
	public function buscarComida($id_formulario, $id_persona, $id_comida) {
		$sql = "SELECT * FROM ENIG_FORM_GDP_COMIDASFUERA WHERE ID_FORMULARIO='". $id_formulario ."' AND ID_PERSONA='$id_persona' AND ID_COMIDA='". $id_comida ."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['_ID_COMIDA'] 		= $row->ID_COMIDA;
				$data['NH_CGPUCFH_P1'] 		= $row->NH_CGPUCFH_P1;
				$data['NH_CGPUCFH_P1_1'] 	= $row->NH_CGPUCFH_P1_1;
				$data['NH_CGPUCFH_P2'] 		= $row->NH_CGPUCFH_P2;
				$data['NH_CGPUCFH_P3'] 		= $row->NH_CGPUCFH_P3;
				$data['NH_CGPUCFH_P3_1'] 	= $row->NH_CGPUCFH_P3_1;
				$data['NH_CGPUCFH_P4'] 		= $row->NH_CGPUCFH_P4;
				$data['NH_CGPUCFH_P5'] 		= $row->NH_CGPUCFH_P5;
				$data['NH_CGPUCFH_P6'] 		= $row->NH_CGPUCFH_P6;
				$data['NH_CGPUCFH_P8'] 		= $row->NH_CGPUCFH_P8;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para eliminar un registro de comidas
	 * @author Mario A. Yandar
	 */
	public function eliminarComida($id_formulario, $id_persona, $id_comida) {
		$delete = "DELETE FROM ENIG_FORM_GDP_COMIDASFUERA WHERE ID_FORMULARIO='$id_formulario' AND ID_PERSONA='$id_persona' AND ID_COMIDA='$id_comida'";
		$query = $this->db->query($delete);
		$this->db->close();
		return $query;
	}

}

?>