<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para el manejo de LOGS del formulario, control de AVANCE y control de fechas
 * @author mayandarl
 **/

class Modmenu extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->library("danecrypt");
	}
	
	public function actualizaAvanceRama($modulo, $secc_org, $pag_org, $secc_dst, $pag_dst) {
		$sql = "SELECT ID_SECCION, PAGINA FROM ENIG_ADMIN_SECCIONES WHERE MODULO='$modulo' ORDER BY ID_SECCION, PAGINA";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$activo = false;
			$i = 0;
			foreach ($query->result() as $row) {
				if ($row->ID_SECCION == $secc_org && $row->PAGINA == $pag_org) 
					$activo = true;
				elseif ($row->ID_SECCION == $secc_dst && $row->PAGINA == $pag_dst) 
					$activo = false;
				if ($activo) {
					$data[$i]['SECCION'] = $row->ID_SECCION;
					$data[$i]['PAGINA'] = $row->PAGINA;
					$i++;
				}
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * LOGFORM::Inserta el registro de la visita en la tabla de visitas
	 * @author mayandarl
	 */
	public function guardarRegistroFormulario($id_formulario, $seccion, $pagina, $inicio, $fin) {
		$sql = "INSERT INTO ENIG_LOG_FORMULARIOS VALUES('";
		$sql .= $id_formulario ."','". $seccion ."','". $pagina ."',"; 
		$sql .= "TO_TIMESTAMP('". $inicio ."', 'YYYY-MM-DD HH24:MI:SS'), TO_TIMESTAMP('". $fin ."', 'YYYY-MM-DD HH24:MI:SS'), null)";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}

	/**
	 * AVANCE::Actualiza el estado de avance del formulario
	 * @author mayandarl
	 */
	public function guardarAvanceFormulario($id_formulario, $seccion, $pagina, $finalizado) {
		$sql = "UPDATE ENIG_ADMIN_AVANCES SET FINALIZADO='$finalizado' ";
		$sql .= " WHERE ID_FORMULARIO='". $id_formulario ."' AND ID_SECCION='". $seccion ."' AND PAGINA='". $pagina ."'";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}

	/**
	 * AVANCE::Actualiza el estado de avance del formulario de personas
	 * @author mayandarl
	 */
	public function guardarAvanceFormularioPersonas($id_formulario, $id_persona, $seccion, $pagina, $finalizado) {
		$sql = "UPDATE ENIG_ADMIN_AVANCESPERSONAS SET FINALIZADO='$finalizado' ";
		$sql .= " WHERE ID_FORMULARIO='". $id_formulario ."' AND ID_PERSONA='". $id_persona."' AND ID_SECCION='". $seccion ."' AND PAGINA='". $pagina ."'";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}

	/**
	 * AVANCE::Consulta el porcentaje de avance de un modulo segun el formulario
	 * @author mayandarl
	 */
	public function consultarAvancexModulo($id_formulario, $modulo) {
		$sql = "SELECT SUM(S.PESO_PORCENTUAL) AS AVANCE FROM ENIG_ADMIN_SECCIONES S, 
			ENIG_ADMIN_AVANCES A WHERE S.ID_SECCION=A.ID_SECCION AND S.PAGINA=A.PAGINA AND 
			A.FINALIZADO='SI' AND A.ID_FORMULARIO='$id_formulario' AND S.MODULO='$modulo' GROUP BY S.MODULO";
		$query = $this->db->query($sql);
		$avance = '0';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$avance	= $row->AVANCE;
			}
		}
		$this->db->close();
		return $avance;
	}

	/**
	 * AVANCE::Consulta el porcentaje de avance de un modulo segun el formulario
	 * @author mayandarl
	 */
	public function consultarEstadoSeccion($id_formulario = 0, $seccion = 0, $pagina = 0) {
		$cmd = $final = '';
		if(!empty($id_formulario))
			$cmd .= " AND ID_FORMULARIO = '$id_formulario'";
		if(!empty($seccion))
			$cmd .= " AND ID_SECCION = '". $seccion ."'";
		if(!empty($id_formulario))
			$cmd .= " AND PAGINA = '". $pagina ."'";
		$sql = "SELECT FINALIZADO FROM ENIG_ADMIN_AVANCES WHERE ID_FORMULARIO IS NOT NULL " . $cmd;
		//pr($sql); exit; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$final = $row->FINALIZADO;
			}
		}
		$this->db->close();
		return $final;
	}

	/**
	 * AVANCE::Consulta el porcentaje de avance de un modulo segun el formulario
	 * @author mayandarl
	 */
	public function consultarEstadoSeccionPersonas($id_formulario, $id_persona, $seccion, $pagina) {
		$cmd = $final = '';
		if(!empty($id_formulario))
			$cmd .= " AND ID_FORMULARIO ='$id_formulario'";
		if(!empty($id_persona))
			$cmd .= " AND ID_PERSONA ='$id_persona'";
		if(!empty($seccion))
			$cmd .= " AND ID_SECCION = '". $seccion ."'";
		if(!empty($id_formulario))
			$cmd .= " AND PAGINA = '". $pagina ."'";
		$sql = "SELECT FINALIZADO FROM ENIG_ADMIN_AVANCESPERSONAS WHERE ID_FORMULARIO IS NOT NULL ". $cmd ." ORDER BY ID_SECCION, PAGINA";
		//pr($sql); exit; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$final = $row->FINALIZADO;
			}
		}
		$this->db->close();
		return $final;
	}

	/**
	 * AVANCE::Consulta las secciones y avances del formulario de Personas
	 * @author mayandarl
	 */
	public function listarSeccionesAvancesPersonas($id_formulario, $id_persona, $capitulo) {
		$sql = "SELECT A.ID_SECCION AS ID_SECCION, A.PAGINA AS PAGINA, FINALIZADO, ENCABEZADO, S.ACCION AS ACCION, 
		S.ANTERIOR AS ANTERIOR, S.SIGUIENTE AS SIGUIENTE, S.DESCR_SECCION AS DESCR_SECCION FROM ENIG_ADMIN_AVANCESPERSONAS A, 
		ENIG_ADMIN_SECCIONES S WHERE ID_FORMULARIO ='$id_formulario' AND ID_PERSONA ='$id_persona' AND S.ID_SECCION=A.ID_SECCION 
		AND S.PAGINA=A.PAGINA AND S.CAPITULO='$capitulo' ORDER BY ID_SECCION, PAGINA";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_SECCION'] 	= $row->ID_SECCION;
				$data[$i]['PAGINA'] 		= $row->PAGINA;
				$data[$i]['FINALIZADO'] 	= $row->FINALIZADO;
				$data[$i]['ACCION'] 		= $row->ACCION;
				$data[$i]['ANTERIOR'] 		= $row->ANTERIOR;
				$data[$i]['SIGUIENTE'] 		= $row->SIGUIENTE;
				$data[$i]['DESCR_SECCION'] 	= $row->DESCR_SECCION;
				$data[$i]['ENCABEZADO'] 	= $row->ENCABEZADO;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}

	
	/**
	 * AVANCE::Consulta las secciones y avances del formulario de Personas
	 * @author mayandarl
	 */
	public function obtenerSeccPagActualPersonas($id_formulario, $id_persona, $capitulo) {
		$avances = $this->listarSeccionesAvancesPersonas($id_formulario, $id_persona, $capitulo);
		//pr($avances); exit;
		$data['ID_SECCION'] = null;
		$data['PAGINA'] = null;
		$data['ANTERIOR'] = '';
		$data['SIGUIENTE'] = '';
		$data['ACCION'] = '';
		$data['DESCR_SECCION'] = '';
		$data['ENCABEZADO'] = '';
		$opt = true;
		foreach ($avances as $k=>$v) {
			if ($v['FINALIZADO'] == 'NO' && $opt) {
				$data['ID_SECCION'] 	= $v['ID_SECCION'];
				$data['PAGINA'] 		= $v['PAGINA'];
				$data['ANTERIOR'] 		= $v['ANTERIOR'];
				$data['SIGUIENTE'] 		= $v['SIGUIENTE'];
				$data['ACCION'] 		= $v['ACCION'];
				$data['DESCR_SECCION'] 	= $v['DESCR_SECCION'];
				$data['ENCABEZADO'] 	= $v['ENCABEZADO'];
				$opt = false;
			}
		}
		//$data['ANT_SECCION'] = '';
		//$data['ANT_PAGINA'] = '';
		return $data;
	}

	/**
	 	 * AVANCE::Consulta la seccion anterior del formulario de Personas
	 * @author mayandarl
	 */
	public function obtenerSeccPagAnteriorPersonas($id_formulario, $id_persona, $capitulo) {
		$avances = array_reverse($this->listarSeccionesAvancesPersonas($id_formulario, $id_persona, $capitulo));
		//pr($avances); exit;
		$data['ID_SECCION'] = null;
		$data['PAGINA'] = null;
		$data['ANTERIOR'] = '';
		$data['SIGUIENTE'] = '';
		$data['ACCION'] = '';
		$data['DESCR_SECCION'] = '';
		$data['ENCABEZADO'] = '';
		$opt = true;
		foreach ($avances as $k=>$v) {
			if ($v['FINALIZADO'] == 'SI' && $opt) {
				$data['ID_SECCION'] 	= $v['ID_SECCION'];
				$data['PAGINA'] 		= $v['PAGINA'];
				$data['ANTERIOR'] 		= $v['ANTERIOR'];
				$data['SIGUIENTE'] 		= $v['SIGUIENTE'];
				$data['ACCION'] 		= $v['ACCION'];
				$data['DESCR_SECCION'] 	= $v['DESCR_SECCION'];
				$data['ENCABEZADO'] 	= $v['ENCABEZADO'];
				$opt = false;
			}
		}
		//$data['ANT_SECCION'] = '';
		//$data['ANT_PAGINA'] = '';
		return $data;
	}
	
	/**
	 * AVANCE::Consulta las secciones y avances del formulario para un capitulo dado.
	 * @author mayandarl
	 */
	public function listarSeccionesModulo($id_formulario, $modulo) {
		$sql = "SELECT A.ID_SECCION AS ID_SECCION, A.PAGINA AS PAGINA, FINALIZADO, ACCION, ANTERIOR, SIGUIENTE, ENCABEZADO, 
		DESCR_SECCION FROM ENIG_ADMIN_SECCIONES S, ENIG_ADMIN_AVANCES A WHERE ID_FORMULARIO ='$id_formulario' AND 
		S.MODULO='$modulo' AND S.ID_SECCION=A.ID_SECCION AND S.PAGINA=A.PAGINA ORDER BY ID_SECCION, PAGINA";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_SECCION'] 	= $row->ID_SECCION;
				$data[$i]['PAGINA'] 		= $row->PAGINA;
				$data[$i]['FINALIZADO'] 	= $row->FINALIZADO;
				$data[$i]['ACCION'] 		= $row->ACCION;
				$data[$i]['ANTERIOR'] 		= $row->ANTERIOR;
				$data[$i]['SIGUIENTE'] 		= $row->SIGUIENTE;
				$data[$i]['DESCR_SECCION'] 	= $row->DESCR_SECCION;
				$data[$i]['ENCABEZADO'] 	= $row->ENCABEZADO;
				$i++;
			}
		}
		$this->db->close();
		return $data;
	}
	
	/**
	 * AVANCE::Consulta las secciones y avances del formulario
	 * @author mayandarl
	 */
	public function obtenerSeccPagActual($id_formulario, $modulo) {
		$avances = $this->listarSeccionesModulo($id_formulario, $modulo);
		//pr($avances);
		$data['ID_SECCION'] = null;
		$data['PAGINA'] = null;
		$data['ANTERIOR'] = '';
		$data['SIGUIENTE'] = '';
		$data['ACCION'] = '';
		$data['DESCR_SECCION'] = '';
		$opt = true;
		foreach ($avances as $k=>$v) {
			if ($v['FINALIZADO'] == 'NO' && $opt) {
				$data['ID_SECCION'] 	= $v['ID_SECCION'];
				$data['PAGINA'] 		= $v['PAGINA'];
				$data['ANTERIOR'] 		= $v['ANTERIOR'];
				$data['SIGUIENTE'] 		= $v['SIGUIENTE'];
				$data['ACCION'] 		= $v['ACCION'];
				$data['DESCR_SECCION'] 	= $v['DESCR_SECCION'];
				$data['ENCABEZADO'] 	= $v['ENCABEZADO'];
				$opt = false;
			}
		}
		//$data['ANT_SECCION'] = '';
		//$data['ANT_PAGINA'] = '';
		return $data;
	}
	
	/**
	 * AVANCE::Consulta la seccion anterior del formulario 
	 * @author mayandarl
	 */
	public function obtenerSeccPagAnterior($id_formulario, $modulo) {
		$avances = array_reverse($this->listarSeccionesModulo($id_formulario, $modulo));
		//pr($avances);
		$data['ID_SECCION'] = null;
		$data['PAGINA'] = null;
		$data['ANTERIOR'] = '';
		$data['SIGUIENTE'] = '';
		$data['ACCION'] = '';
		$data['DESCR_SECCION'] = '';
		$opt = true;
		foreach ($avances as $k=>$v) {
			if ($v['FINALIZADO'] == 'SI' && $opt) {
				$data['ID_SECCION'] 	= $v['ID_SECCION'];
				$data['PAGINA'] 		= $v['PAGINA'];
				$data['ANTERIOR'] 		= $v['ANTERIOR'];
				$data['SIGUIENTE'] 		= $v['SIGUIENTE'];
				$data['ACCION'] 		= $v['ACCION'];
				$data['DESCR_SECCION'] 	= $v['DESCR_SECCION'];
				$data['ENCABEZADO'] 	= $v['ENCABEZADO'];
				$opt = false;
			}
		}
		return $data;
	}

	/**
	 * CONTROLFECHAS::Consulta las fechas de vigencia para un formulario
	 * @author mayandarl
	 */
	public function consultarFechasxModulo($id_formulario, $modulo) {
		$cmd = $final = '';
		if(!empty($id_formulario))
			$cmd .= " AND ID_FORMULARIO = '$id_formulario'";
		if(!empty($modulo))
			$cmd .= " AND MODULO = '". $modulo ."'";
		$sql = "SELECT TO_CHAR(FECHAHORA_INI,'YYYY-MM-DD HH24:MI:SS') AS FECHAHORA_INI, 
				TO_CHAR(FECHAHORA_FIN,'YYYY-MM-DD HH24:MI:SS') AS FECHAHORA_FIN 
				FROM ENIG_ADMIN_CONTROLFECHAS 
				WHERE 
				ID_FORMULARIO IS NOT NULL " . $cmd;
		//pr($sql); exit;
		$query = $this->db->query($sql);
		$datos = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$datos['FECHAHORA_INI'] = $row->FECHAHORA_INI;
				$datos['FECHAHORA_FIN'] = $row->FECHAHORA_FIN;
			}
		}
		$this->db->close();
		return $datos;
	}
	
	/**
	 * CONTROLFECHAS::Actualiza el Control de fechas para un formulario
	 * @author mayandarl
	 */
	public function guardarFechasModulo($id_formulario, $modulo, $inicio, $fin) {
		$result = false;
		$sql = "SELECT ID_FORMULARIO FROM ENIG_ADMIN_CONTROLFECHAS WHERE ID_FORMULARIO='$id_formulario' AND MODULO='$modulo'";
		$query = $this->db->query($sql);
		$existe = true;
		if ($query->num_rows() > 0)
		foreach ($query->result() as $row)
			$existe = false;
		if ($existe) {
			$sql2 = "INSERT INTO ENIG_ADMIN_CONTROLFECHAS VALUES ('". $id_formulario ."', '". $modulo ."',
				TO_TIMESTAMP('". $inicio ."', 'YYYY-MM-DD HH24:MI:SS'),
				TO_TIMESTAMP('". $fin ."', 'YYYY-MM-DD HH24:MI:SS'))";
			$result = $this->db->query($sql2);
		}
		$this->db->close();
		return $result;
	}

	/**
	 * Funcion para obtener las fechas de cierre de periodos
	 * @author Mario A. Yandar
	 */
	public function obtenerFechas($id_formulario) { 
		$sql = "SELECT ULTIMOA, ULTIMOM, ULTIMAS4SEM, ULTIMAS2SEM, ULTIMASEM FROM ENIG_FORM_INSCRIPCION WHERE ID_FORMULARIO='". $id_formulario."'";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data['ULTIMOA'] 		= $row->ULTIMOA;
				$data['ULTIMOM'] 		= $row->ULTIMOM;
				$data['ULTIMAS4SEM']	= $row->ULTIMAS4SEM;
				$data['ULTIMAS2SEM']	= $row->ULTIMAS2SEM;
				$data['ULTIMASEM']		= $row->ULTIMASEM;
			}
		}
		$this->db->close();
		return $data;
	}
	
}//EOC