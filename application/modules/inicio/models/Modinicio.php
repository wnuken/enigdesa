<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/***
	 * Modelo para obtención de datos generales de diligenciamiento del formulario (Módulo de Inicio) 
	 * @author DMDiazF
	 * @since  21/10/2015	 
	 ***/

class MODInicio extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	/**
	 * Consulta el estado de avance del diligenciamiento de un formulario
	 * @author dmdiazf
	 * @since  21/10/2015
	 */
	public function avanceFormulario($nro_form){
		$avance = 0;
		$sql = "SELECT nro_encuesta_form, sec_prereg, sec_vivi, sec_hogar, sec_pers
				FROM cnpv_admin_control
				WHERE nro_encuesta_form = $nro_form";			
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();			
			if ($row->SEC_PREREG > 0){
				$avance += ($row->SEC_PREREG > 1)?25:0; 
				$avance += ($row->SEC_VIVI > 1)?25:0;
				$avance += ($row->SEC_HOGAR > 1)?25:0;
				$avance += ($row->SEC_PERS > 1)?25:0;
			}
		}
		$this->db->close();		
		return $avance;
	}
	
	/**
	 * Consulta el estado de diligenciamiento de uno de los módulos de la encuesta
	 * 0 - Preregistro, 1 - Vivienda, 2 - Hogares, 3 - Personas
	 * @author dmdiazf
	 * @since  22/10/2015
	 */
	public function estadoModulo($nro_form, $modulo){
		$estado = 0;
		switch($modulo){
			case 0: $campo = "sec_prereg";
					break;
			case 1: $campo = "sec_vivi";
					break;
			case 2: $campo = "sec_hogar";
					break;
			case 3: $campo = "sec_pers";
					break;
			case 4: $campo = "fk_estado";
			        break;								
		}
		$sql = "SELECT $campo
				FROM cnpv_admin_control 
				WHERE nro_encuesta_form = $nro_form";		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			$field = strtoupper($campo);
			$estado = $row->$field;
		}
		$this->db->close();
		return $estado;
	}
	
	
	/**
	 * Consulta el cedula y nombre de un usuario a partir del numero del formulario
	 * @author dmdiazf
	 * @since  23/10/2015
	 */
	public function obtenerDatosUsuario($nro_form){
		$usuario = array();
		$sql = "SELECT P.cedula, P.primer_nombre || ' ' || P.segundo_nombre || ' ' || P.primer_apellido || ' ' || P.segundo_apellido AS nombre
                FROM cnp_admin_usuarios U, cnp_preregistro P 
                WHERE U.nro_encuesta_form = P.nro_encuesta_form 
                AND U.nro_encuesta_form = $nro_form";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			$usuario["cedula"] = $row->CEDULA;
			$usuario["nombre"] = strtoupper (utf8_decode($row->NOMBRE));
		}
		$this->db->close();
		return $usuario;
	}
	
	
	/**
	 * Consulta la cedula y nombre de un usuario a partir del numero del formulario
	 * Se modifica la tabla desde la que se obtienen los datos. 
	 * En la funcion obtenerDatosUsuario se obtienen los datos desde el preregistro. En esta se obtienen los datos desde la tabla de hogar
	 */
	public function obtenerDatosUsuarioPDF($nro_form){
		$usuario = array();
		$sql = "SELECT p.c4p41_sabe_doc AS cedula, p.c4p39a_1er_nombre || ' ' || p.c4p39aa_2do_nombre || ' ' || p.c4p39b_1er_apellido || ' ' || p.c4p39bb_2do_apellido AS nombre
				FROM cnp_admin_usuarios U, cnp_preregistro_personas P
				WHERE U.nro_encuesta_form = p.nro_encuesta_form
				AND U.nro_encuesta_form = $nro_form
				AND P.jefe = 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			$usuario["cedula"] = $row->CEDULA;
			$usuario["nombre"] = strtoupper (utf8_decode($row->NOMBRE));
		}
		$this->db->close();
		return $usuario;
	}
	
	
	/**
	 * Valida que todos los modulos de la encuesta y el estado general del formulario seam válidos para dar paso al envío del formulario
	 * @author dmdiazf
	 * @since 29/10/2015
	 */
	public function validarEnvioFormulario($nro_form){
		$result = false;
		$sql = "SELECT sec_prereg, sec_vivi, sec_hogar, sec_pers, fk_estado
				FROM cnpv_admin_control
				WHERE nro_encuesta_form = $nro_form";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			if (($row->SEC_PREREG==2)&&($row->SEC_VIVI==2)&&($row->SEC_HOGAR==2)&&($row->SEC_PERS==2)){
				if ($row->FK_ESTADO==11){
					$result = true;
				}
			}			
		}
		$this->db->close();
		return $result;
	}
	
	
	/**
	 * Valida que la pregunta C2V20_ANOS_VIV del módulo de vivienda ya haya sido respondida antes de enviar el formulario
	 * @author dmdiazf
	 * @since  29/10/2015
	 */
	public function validarPreguntaVivienda($nro_form){
		$result = false;
		$sql = "SELECT c2v20_anos_viv
				FROM cnpv_vivienda
				WHERE C0I1_encuesta = $nro_form";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();			
			if (is_null($row->C2V20_ANOS_VIV)){
				$result = false;
			}
			else{
				$result = true;
			}
		}
		$this->db->close();
		return $result;
	}
	
	/**
	 * Actualizar el cronómetro. Se actualiza el tiempo que emplea el usuario diligenciando cada uno de los módulos de la encuesta
	 * @author dmdiazf
	 * @since  22/01/2016
	 */
	public function actualizarCrono($numform, $nrohog, $visita, $modulo, $duracion){		
		switch($modulo){
			case 1: $campo = "TPREREG";
					break;
			case 2: $campo = "TVIVI";
					break;
			case 3: $campo = "THOGAR";
					break;
			case 4: $campo = "TPERS";
					break;						
		}
		$data = array($campo => $duracion);
		$this->db->where("C0I1_ENCUESTA",$numform);
		$this->db->where("C3E24_NROHOG",$nrohog);
		$this->db->where("CC_NRO_VIS",$visita);
		$this->db->update("CNPV_RESULTADOS_ENTREVISTA", $data);
	}
	
	/**
	 * Obtiene el tiempo actual que se ha empleado en una operacion de actualizacion para únicamente guardar el mayor tiempo utilizado
	 * @author dmdiazf
	 * @since  10/02/2016
	 */
	public function obtenerTiempo($numform, $nrohog, $visita, $modulo){
		$tiempo = "";
		switch($modulo){
			case 1: $campo = "TPREREG";
					break;
			case 2: $campo = "TVIVI";
					break;
			case 3: $campo = "THOGAR";
					break;
			case 4: $campo = "TPERS";
					break;						
		}
		$sql = "SELECT $campo
				FROM cnpv_resultados_entrevista
				WHERE c0i1_encuesta = $numform
				AND c3e24_nrohog = $nrohog
				AND cc_nro_vis = $visita";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$tiempo = $row->$campo;
		}
		$this->db->close();
		return $tiempo;
	}
	
	/**
	 * Obtiene la fecha de cumpleaños del usuario que accede al aplicativo
	 * @author dmdiazf
	 * @since  07/03/2016
	 */
	public function obtenerFechaCumpleanos($nro_form){
		$fecha = null;
		$sql = "SELECT C4P46C_ANO_NAC || '-' || LPAD(C4P46B_MES_NAC, 2, '0') || '-' || LPAD(C4P46A_DIA_NAC, 2, '0') AS fecnac
				FROM cnpv_persona_hogar
				WHERE C0I1_ENCUESTA = $nro_form
				AND C3P24_NROHOG = 1
				AND C4P41_NRO_PER = 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$fecha = $row->FECNAC;
		}
		$this->db->close();
		return $fecha;
	}
	

}//EOC