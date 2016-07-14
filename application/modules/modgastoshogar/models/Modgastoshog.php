<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author mayandarl
 * @since  2015-07-15
 */
// oagarzond - Se debe dejar nombres de modelos diferentes en casos que se quiera llamar desde otro modulo
class Modgastoshog extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
    }
    
    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author mayandarl
     * @since  Marzo 16 / 2016
     */
    public function listarValoresFrecuencias($id_formulario) {
		$sql = "SELECT * FROM ENIG_FORM_GDH_FRECUENCIA WHERE ID_FORMULARIO='". $id_formulario ."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data['NC2_CC_P2_-_'. $row->NC2_CC_P1] = $row->NC2_CC_P2;
				$data['NC2_CC_P3_S1_-_'. $row->NC2_CC_P1] = $row->NC2_CC_P3_S1;
				$data['NC2_CC_P3_S2_-_'. $row->NC2_CC_P1] = $row->NC2_CC_P3_S2;
			}
		}
		$sql = "SELECT * FROM ENIG_FORM_GDH WHERE ID_FORMULARIO='". $id_formulario ."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data['NC2_CC_P4_A1'] = $row->NC2_CC_P4_A1;
				$data['NC2_CC_P4_S1'] = $row->NC2_CC_P4_S1;
				$data['NC2_CC_P4_A2'] = $row->NC2_CC_P4_A2;
				$data['NC2_CC_P4_S2'] = $row->NC2_CC_P4_S2;
				$data['NC2_CC_P4_A3'] = $row->NC2_CC_P4_A3;
				$data['NC2_CC_P4_S3'] = $row->NC2_CC_P4_S3;
				$data['NC2_CC_P4_S4'] = $row->NC2_CC_P4_S4;
			}
		}
		$this->db->close();
		return $data;
    }
	
    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
	public function actualizarFrecuencias($id_formulario, $datos) {
		$frec = array();
		$grup = array();
		$update ='';
		foreach ($datos as $k=>$v) {
			$id = explode("_-_", $k);
			if (isset($id[0]) && isset($id[1]))
				$frec[$id[1]][$id[0]] = $v;
			elseif (substr($k,0,9) == 'NC2_CC_P4')
				$grup[$k] = $v;
		}
		foreach ($frec as $m=>$n) {
			$sets = "";
			$query = false;
			foreach ($n as $k=>$v) {
				// Ajustar comilla simple en consulta
				$v = str_replace("'", "''", $v);
				// No asigna ID de la tabla ni campos del sistema (que inician con _)
				if ($k != 'ID_FORMULARIO' && substr($k, 0, 1) != '_')
					$sets .= "$k='$v',";
			}
			$sets = substr($sets, 0, -1); // elimina ultima coma
			$update = "UPDATE ENIG_FORM_GDH_FRECUENCIA SET $sets WHERE ID_FORMULARIO='$id_formulario' AND NC2_CC_P1='$m'";
			$query = $this->db->query($update);
		}
		$sets = "";
		$query = false;
		foreach ($grup as $k=>$v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != 'ID_FORMULARIO' && substr($k, 0, 1) != '_')
				$sets .= "$k='$v',";
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE ENIG_FORM_GDH SET $sets WHERE ID_FORMULARIO='$id_formulario'";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
	}

	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author Mario A. Yandar
	 */
    public function asignar14Dias($id_formulario) {
		$dia1 = date("Y-m-d");
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia1','YYYY-MM-DD'),'01DIA1','1')");
		$dia2 = date("Y-m-d", strtotime("+1 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia2','YYYY-MM-DD'),'02DIA2','1')");
		$dia3 = date("Y-m-d", strtotime("+2 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia3','YYYY-MM-DD'),'03DIA3','1')");
		$dia4 = date("Y-m-d", strtotime("+3 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia4','YYYY-MM-DD'),'04DIA4','1')");
		$dia5 = date("Y-m-d", strtotime("+4 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia5','YYYY-MM-DD'),'05DIA5','1')");
		$dia6 = date("Y-m-d", strtotime("+5 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia6','YYYY-MM-DD'),'06DIA6','1')");
		$dia7 = date("Y-m-d", strtotime("+6 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia7','YYYY-MM-DD'),'07DIA7','1')");
		$dia8 = date("Y-m-d", strtotime("+7 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia8','YYYY-MM-DD'),'08DIA8','1')");
		$dia9 = date("Y-m-d", strtotime("+8 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia9','YYYY-MM-DD'),'09DIA9','1')");
		$dia10 = date("Y-m-d", strtotime("+9 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia10','YYYY-MM-DD'),'10DIA10','1')");
		$dia11 = date("Y-m-d", strtotime("+10 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia11','YYYY-MM-DD'),'11DIA11','1')");
		$dia12 = date("Y-m-d", strtotime("+11 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia12','YYYY-MM-DD'),'12DIA12','1')");
		$dia13 = date("Y-m-d", strtotime("+12 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia13','YYYY-MM-DD'),'13DIA13','1')");
		$dia14 = date("Y-m-d", strtotime("+13 day", strtotime($dia1)));
		$this->db->query("INSERT INTO ENIG_FORM_GDH_DIAS VALUES ('$id_formulario',TO_DATE('$dia14','YYYY-MM-DD'),'14DIA14','1')");
		$this->db->close();
		return true;
	}

    /**
     * Funcion para consultar los dias 
     * @author Mario A. Yandar
     */
    public function buscarDia($id_formulario, $seccion) {
		$sql = "SELECT TO_CHAR(DIA, 'YYYY-MM-DD') AS DIA FROM ENIG_FORM_GDH_DIAS A WHERE ID_FORMULARIO='". $id_formulario . "' AND ID_SECCION='$seccion'";
		$query = $this->db->query($sql);
		$dia = '';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row)
				$dia = $row->DIA;
		}
		$this->db->close();
		return $dia;
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
    public function crearFormularioArticulo($id_formulario, $dia, $id_articulo, $datos) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO ENIG_FORM_GDH_ARTICULOS (ID_FORMULARIO,DIA,ID_ARTICULO) VALUES ('$id_formulario',TO_DATE('$dia','YYYY-MM-DD'),'$id_articulo')";
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioArticulo($id_formulario, $dia, $id_articulo, $datos);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioArticulo($id_formulario, $dia, $id_articulo, $valores) {
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
		$update = "UPDATE ENIG_FORM_GDH_ARTICULOS SET $sets WHERE ID_FORMULARIO='$id_formulario' AND DIA=TO_DATE('$dia','YYYY-MM-DD') AND ID_ARTICULO='$id_articulo'";
		//echo $update;
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la creacion de un formulario 
     * @author Mario A. Yandar
     */
    public function crearFormularioComida($id_formulario, $dia, $id_comida, $datos) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO ENIG_FORM_GDH_COMIDASFUERA(ID_FORMULARIO,DIA,ID_COMIDA) VALUES ('$id_formulario',TO_DATE('$dia','YYYY-MM-DD'),'$id_comida')";
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioComida($id_formulario, $dia, $id_comida, $datos);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioComida($id_formulario, $dia, $id_comida, $valores) {
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
		$update = "UPDATE ENIG_FORM_GDH_COMIDASFUERA SET $sets WHERE ID_FORMULARIO='$id_formulario' AND DIA=TO_DATE('$dia','YYYY-MM-DD') AND ID_COMIDA='$id_comida'";
		//echo $update;
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }
	
	public function actualizarFormularioDia14($id_formulario) {
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
		$update = "UPDATE ENIG_FORM_GDH SET $sets WHERE ID_FORMULARIO='$id_formulario'";
		//echo $update;
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
	}

    /**
     * Funcion para listar los articulos de la encuesta de gastos:
     * @author Mario A. Yandar
     */
    public function listadoArticulos($id_formulario, $dia) {
		$sql = "SELECT ID_ARTICULO, ARTICULO AS NH_CGDU_P1_1, (SELECT P521A ||' '|| P521C FROM ENIG_FORM_PERSONAS P WHERE P.ID_PERSONA=P10250S1C2M) AS P10250S1C2M, 
		NH_CGDU_P2, (SELECT V0.ETIQUETA FROM ENIG_ADMIN_VALORES V0 WHERE V0.ID_VARIABLE='NH_CGDU_P3' AND V0.ID_VALOR=NH_CGDU_P3) AS NH_CGDU_P3, NH_CGDU_P4_S1, 
		(SELECT V1.ETIQUETA FROM ENIG_ADMIN_VALORES V1 WHERE V1.ID_VARIABLE='NH_CGDU_P4_S2' AND V1.ID_VALOR=NH_CGDU_P4_S2) AS NH_CGDU_P4_S2, 
		(SELECT V2.ETIQUETA FROM ENIG_ADMIN_VALORES V2 WHERE V2.ID_VARIABLE='NH_CGDU_P5' AND V2.ID_VALOR=NH_CGDU_P5 ) AS NH_CGDU_P5, 
		(SELECT V3.ETIQUETA FROM ENIG_ADMIN_VALORES V3 WHERE V3.ID_VARIABLE='NH_CGDU_P7B1379' AND V3.ID_VALOR=NH_CGDU_P7B1379) AS NH_CGDU_P7B1379, NH_CGDU_P8, 
		(SELECT V4.ETIQUETA FROM ENIG_ADMIN_VALORES V4 WHERE V4.ID_VARIABLE='NH_CGDU_P9' AND V4.ID_VALOR=NH_CGDU_P9) AS NH_CGDU_P9, 
		(SELECT V5.ETIQUETA FROM ENIG_ADMIN_VALORES V5 WHERE V5.ID_VARIABLE='NH_CGDU_P10' AND V5.ID_VALOR=NH_CGDU_P10) AS NH_CGDU_P10 
		FROM ENIG_FORM_GDH_ARTICULOS A, ENIG_PARAM_GDH_ARTICULOS 
		WHERE A.ID_FORMULARIO='". $id_formulario . "' AND DIA=TO_DATE('$dia', 'YYYY-MM-DD') AND CODIGO=NH_CGDU_P1_1";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_ARTICULO'] 	= $row->ID_ARTICULO;
				$data[$i]['NH_CGDU_P1_1'] 	= $row->NH_CGDU_P1_1 == null ? "":$row->NH_CGDU_P1_1;
				$data[$i]['P10250S1C2M'] 	= $row->P10250S1C2M	 == null ? "":$row->P10250S1C2M;
				$data[$i]['NH_CGDU_P2'] 	= $row->NH_CGDU_P2	 == null ? "":$row->NH_CGDU_P2;
				$data[$i]['NH_CGDU_P3'] 	= $row->NH_CGDU_P3	 == null ? "":$row->NH_CGDU_P3;
				$data[$i]['NH_CGDU_P4_S1'] = $row->NH_CGDU_P4_S1 == null ? "":$row->NH_CGDU_P4_S1;
				$data[$i]['NH_CGDU_P4_S2'] = $row->NH_CGDU_P4_S2 == null ? "":$row->NH_CGDU_P4_S2;
				$data[$i]['NH_CGDU_P5'] 	= $row->NH_CGDU_P5	 == null ? "":$row->NH_CGDU_P5;
				$data[$i]['NH_CGDU_P7B1379'] = $row->NH_CGDU_P7B1379 == null ? "":$row->NH_CGDU_P7B1379;
				$data[$i]['NH_CGDU_P8'] 	= $row->NH_CGDU_P8	 == null ? "":$row->NH_CGDU_P8;
				$data[$i]['NH_CGDU_P9'] 	= $row->NH_CGDU_P9 == null ? "":$row->NH_CGDU_P9;
				$data[$i]['NH_CGDU_P10']	= $row->NH_CGDU_P10== null ? "":$row->NH_CGDU_P10;
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
	public function buscarArticulo($id_formulario, $id_articulo) {
		$sql = "SELECT ID_ARTICULO, NH_CGDU_P1_1, NH_CGDU_P1_1_S1, P10250S1C2M, NH_CGDU_P2, NH_CGDU_P3, NH_CGDU_P3_S1,
		NH_CGDU_P4_S1, NH_CGDU_P4_S2, NH_CGDU_P5, NH_CGDU_P6, NH_CGDU_P7B1379, NH_CGDU_P8, NH_CGDU_P9, NH_CGDU_P10, ARTICULO
		FROM ENIG_FORM_GDH_ARTICULOS, ENIG_PARAM_GDH_ARTICULOS WHERE ID_FORMULARIO='" . $id_formulario . "' AND ID_ARTICULO='" . $id_articulo . "' AND CODIGO=NH_CGDU_P1_1";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['_ID_ARTICULO'] 		= $row->ID_ARTICULO;
				$data['NH_CGDU_P1_1'] 		= $row->NH_CGDU_P1_1;
				$data['_NH_CGDU_P1_1'] 		= $row->ARTICULO;
				$data['NH_CGDU_P1_1_S1'] 	= $row->NH_CGDU_P1_1_S1;
				$data['P10250S1C2M'] 		= $row->P10250S1C2M;
				$data['NH_CGDU_P2'] 		= $row->NH_CGDU_P2;
				$data['NH_CGDU_P3'] 		= $row->NH_CGDU_P3;
				$data['NH_CGDU_P3_S1'] 		= $row->NH_CGDU_P3_S1;
				$data['NH_CGDU_P4_S1'] 		= $row->NH_CGDU_P4_S1;
				$data['NH_CGDU_P4_S2'] 		= $row->NH_CGDU_P4_S2;
				$data['NH_CGDU_P5'] 		= $row->NH_CGDU_P5;
				$data['NH_CGDU_P6'] 		= $row->NH_CGDU_P6;
				$data['NH_CGDU_P7B1379'] 	= $row->NH_CGDU_P7B1379;
				$data['NH_CGDU_P8'] 		= $row->NH_CGDU_P8;
				$data['NH_CGDU_P9'] 		= $row->NH_CGDU_P9;
				$data['NH_CGDU_P10'] 		= $row->NH_CGDU_P10;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para eliminar un registro de articulos
	 * @author Mario A. Yandar
	 */
	public function eliminarArticulo($id_formulario, $id_articulo) {
		$delete = "DELETE FROM ENIG_FORM_GDH_ARTICULOS WHERE ID_FORMULARIO='$id_formulario' AND ID_ARTICULO='$id_articulo'";
		$query = $this->db->query($delete);
		$this->db->close();
		return $query;
	}

    /**
     * Funcion para buscar resguardos
     * @author Mario A. Yandar
     */
    public function autocompletarArt($nombre) {
        $sql = "SELECT CODIGO, ARTICULO, REQ_MEDIDA, REQ_LUGARCOMPRA 
		FROM ENIG_PARAM_GDH_ARTICULOS WHERE UPPER(ARTICULO) LIKE '" . $nombre . "%' ORDER BY ARTICULO";
        $query = $this->db->query($sql);
        $data = array();
		$i = 0;
        if ($query->num_rows() > 0)
            foreach ($query->result() as $row) {
                $data[$i]['cod'] = $row->CODIGO;
				$data[$i]['nom']= $row->ARTICULO;
				$data[$i]['med']= $row->REQ_MEDIDA;
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
    public function listadoComidas($id_formulario, $dia) {
		$sql = "SELECT ID_COMIDA, NH_CGDUCFH_P1, NH_CGDUCFH_P2, NH_CGDUCFH_P5,
		(SELECT V1.ETIQUETA FROM ENIG_ADMIN_VALORES V1 WHERE V1.ID_VARIABLE='NH_CGDUCFH_P1_1' AND V1.ID_VALOR=NH_CGDUCFH_P1_1) AS NH_CGDUCFH_P1_1, 
		(SELECT V2.ETIQUETA FROM ENIG_ADMIN_VALORES V2 WHERE V2.ID_VARIABLE='NH_CGDUCFH_P3' AND V2.ID_VALOR=NH_CGDUCFH_P3) AS NH_CGDUCFH_P3, 
		(SELECT V3.ETIQUETA FROM ENIG_ADMIN_VALORES V3 WHERE V3.ID_VARIABLE='NH_CGDUCFH_P4' AND V3.ID_VALOR=NH_CGDUCFH_P4) AS NH_CGDUCFH_P4, 
		(SELECT V4.ETIQUETA FROM ENIG_ADMIN_VALORES V4 WHERE V4.ID_VARIABLE='NH_CGDUCFH_P6' AND V4.ID_VALOR=NH_CGDUCFH_P6) AS NH_CGDUCFH_P6, 
		(SELECT V5.ETIQUETA FROM ENIG_ADMIN_VALORES V5 WHERE V5.ID_VARIABLE='NH_CGDUCFH_P7' AND V5.ID_VALOR=NH_CGDUCFH_P7) AS NH_CGDUCFH_P7, 
		(SELECT V6.ETIQUETA FROM ENIG_ADMIN_VALORES V6 WHERE V6.ID_VARIABLE='NH_CGDUCFH_P8' AND V6.ID_VALOR=NH_CGDUCFH_P8) AS NH_CGDUCFH_P8 
		FROM ENIG_FORM_GDH_COMIDASFUERA C WHERE C.ID_FORMULARIO='". $id_formulario ."' AND DIA=TO_DATE('$dia', 'YYYY-MM-DD')";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_COMIDA'] 		= $row->ID_COMIDA;
				$data[$i]['NH_CGDUCFH_P1'] 	= $row->NH_CGDUCFH_P1 == null ? "":$row->NH_CGDUCFH_P1;
				$data[$i]['NH_CGDUCFH_P1_1'] = $row->NH_CGDUCFH_P1_1 == null ? "":$row->NH_CGDUCFH_P1_1;
				$data[$i]['NH_CGDUCFH_P2']	= $row->NH_CGDUCFH_P2 == null ? "":$row->NH_CGDUCFH_P2;
				$data[$i]['NH_CGDUCFH_P3']	= $row->NH_CGDUCFH_P3 == null ? "":$row->NH_CGDUCFH_P3;
				$data[$i]['NH_CGDUCFH_P4'] 	= $row->NH_CGDUCFH_P4 == null ? "":$row->NH_CGDUCFH_P4;
				$data[$i]['NH_CGDUCFH_P5']	= $row->NH_CGDUCFH_P5 == null ? "":$row->NH_CGDUCFH_P5;
				$data[$i]['NH_CGDUCFH_P6'] 	= $row->NH_CGDUCFH_P6 == null ? "":$row->NH_CGDUCFH_P6;
				$data[$i]['NH_CGDUCFH_P7'] 	= $row->NH_CGDUCFH_P7 == null ? "":$row->NH_CGDUCFH_P7;
				$data[$i]['NH_CGDUCFH_P8']	= $row->NH_CGDUCFH_P8 == null ? "":$row->NH_CGDUCFH_P8;
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
	public function buscarComida($id_formulario, $id_comida) {
		$sql = "SELECT * FROM ENIG_FORM_GDH_COMIDASFUERA WHERE ID_FORMULARIO='". $id_formulario ."' AND ID_COMIDA='". $id_comida ."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['_ID_COMIDA'] 		= $row->ID_COMIDA;
				$data['NH_CGDUCFH_P1'] 		= $row->NH_CGDUCFH_P1;
				$data['NH_CGDUCFH_P1_1'] 	= $row->NH_CGDUCFH_P1_1;
				$data['NH_CGDUCFH_P2'] 		= $row->NH_CGDUCFH_P2;
				$data['NH_CGDUCFH_P3'] 		= $row->NH_CGDUCFH_P3;
				$data['NH_CGDUCFH_P3_1'] 	= $row->NH_CGDUCFH_P3_1;
				$data['NH_CGDUCFH_P4'] 		= $row->NH_CGDUCFH_P4;
				$data['NH_CGDUCFH_P5'] 		= $row->NH_CGDUCFH_P5;
				$data['NH_CGDUCFH_P6'] 		= $row->NH_CGDUCFH_P6;
				$data['NH_CGDUCFH_P7'] 		= $row->NH_CGDUCFH_P7;
				$data['NH_CGDUCFH_P8'] 		= $row->NH_CGDUCFH_P8;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para eliminar un registro de comidas
	 * @author Mario A. Yandar
	 */
	public function eliminarComida($id_formulario, $id_comida) {
		$delete = "DELETE FROM ENIG_FORM_GDH_COMIDASFUERA WHERE ID_FORMULARIO='$id_formulario' AND ID_COMIDA='$id_comida'";
		$query = $this->db->query($delete);
		$this->db->close();
		return $query;
	}
	
}

?>