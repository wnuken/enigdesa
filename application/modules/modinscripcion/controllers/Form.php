	﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para Encuesta de Transporte Capitulo 1
 * @author Mario A. Yandar
 * @since  2015-07-15
 */

class Form extends MX_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->config->load("sitio");
		$this->load->library("danecrypt");
		date_default_timezone_set('America/Bogota');
	}
	
	/**
	 * Ingreso de datos del formulario
	 * @author Mario A. Yandar
	 * @since  Junio 09 / 2015
	 */
	public function index() {
		$this->load->model(array("formulario/Mformulario", "Mform", "control/Modmenu"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		if (empty($data["id_formulario"])) {
			redirect('/');
		}
		else {
			if ($this->Modmenu->consultarEstadoSeccion($data["id_formulario"], 'DATPERSONAL', '1') == 'NO') {
				$data["tab1"] = 'active';
				$data["tab2"] = '';
			}
			else {
				$data["tab1"] = '';
				$data["tab2"] = 'active';
			}
			$data["datpersonal_ini"] = date("Y-m-d H:i:s");
			$data["datpersonal_var"] = $this->Mformulario->listarVariables('DATPERSONAL', '1', $data["id_formulario"]);
			$data["datpersonal_opc"] = $this->Mformulario->listarOpciones('DATPERSONAL', '1');
			$data["datpersonal_val"] = $this->Mformulario->listarValores($data["datpersonal_var"], $data["id_formulario"], 'ENIG_FORM_INSCRIPCION');
			$data["datpersonal_reg"] = $this->Mformulario->listarConsistencias('DATPERSONAL', '1');
			$data["familia_var"] = $this->Mformulario->listarVariables('FAMILIA', '1', $data["id_formulario"]);
			$data["familia_opc"] = $this->Mformulario->listarOpciones('FAMILIA', '1');
			$data["familia_val"] = $this->Mformulario->listarValores($data["familia_var"], $data["id_formulario"], 'ENIG_FORM_PERSONAS');
			$data["familia_reg"] = $this->Mformulario->listarConsistencias('FAMILIA', '1');
			$data["familia_personas"] = $this->Mform->listadoPersonas($data["id_formulario"]);
			//pr($data["familia_personas"]); exit;
			$numpers[0]['ID_VARIABLE'] = 'P6008_1';
			$data["familia_numpers"] = $this->Mformulario->listarValores($numpers, $data["id_formulario"], 'ENIG_FORM_INSCRIPCION');
			$data["view"] = "vform";
			$this->load->view("layout", $data);
		}
	}

	/**
	 * Resultado de Guardar el formulario
	 * @author Mario A. Yandar
	 * @since  Julio 21 / 2015
	 */
	public function guardar($seccion, $pagina) {
		$data = array();
		$this->load->model(array("Mform", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		$resultado = false;
		if ($seccion == 'DATPERSONAL') {
			$resultado = $this->Mform->actualizarFormulario($id_formulario, $_POST, 'ENIG_FORM_INSCRIPCION');
			if ($resultado) {
				$inicio = $_POST['_INI_DATPERSONAL_1'];
				$fin = date("Y-m-d H:i:s");
				$this->Modmenu->guardarRegistroFormulario($id_formulario, 'DATPERSONAL', '1', $inicio, $fin);
				$this->Modmenu->guardarAvanceFormulario($id_formulario, 'DATPERSONAL', '1', 'SI');
			}
		}
		elseif ($seccion == 'FAMILIA') {
			if ($_POST['_ACC_FAMILIA_1'] == 'UPDATE') {
				$id_persona = $_POST['_ID_PERSONA'];
				$resultado = $this->Mform->actualizarFormularioPersonas($id_formulario, $id_persona, $_POST, 'ENIG_FORM_PERSONAS');
			}
			elseif ($_POST['_ACC_FAMILIA_1'] == 'INSERT') {
				$id_persona = uniqid();
				$resultado = $this->Mform->crearFormularioPersonas($id_formulario, $id_persona, $_POST, 'ENIG_FORM_PERSONAS');
				if ($resultado) {
					$inicio = $_POST['_INI_FAMILIA_1'];
					$fin = date("Y-m-d H:i:s");
					$this->Modmenu->guardarRegistroFormulario($id_formulario, 'FAMILIA', '1', $inicio, $fin);
				}
			}
		}
		echo "<b>Formulario guardado exitosamente.</b>";
	}
	
	/**
	 * Finalizacion de la seccion
	 * @author Mario A. Yandar
	 */
	public function finfamilia() {
		$this->load->model(array("control/Modmenu", "Mform"));
		$id_formulario = $this->session->userdata("id_formulario");
		$numper['P6008_1'] = count($this->Mform->listadoPersonas($id_formulario));
		$this->Mform->actualizarFormulario($id_formulario, $numper, 'ENIG_FORM_INSCRIPCION');
		$this->Modmenu->guardarAvanceFormulario($id_formulario, 'FAMILIA', '1', 'SI');
		redirect('control/Menu');
	}
	
	/**
	 * Resultado de listar todas las personas del formulario
	 * @author Mario A. Yandar
	 */
	public function personas ($id_formulario) {
		$this->load->model("Mform");
		$data = $this->Mform->listadoPersonas($id_formulario);
		echo json_encode($data);
	}

	/**
	 * Resultado de Guardar en el formulario
	 * @author Mario A. Yandar
	 */
	public function persona ($id_formulario, $id_persona) {
		$this->load->model("Mform");
		$data = $this->Mform->buscarpersona($id_formulario, $id_persona);
		echo json_encode($data);
	}

	/**
	 * Resultado de Eliminar en el formulario
	 * @author Mario A. Yandar
	 */
	public function nopersona ($id_formulario, $id_persona) {
		$this->load->model("Mform");
		$data = $this->Mform->eliminarpersona($id_formulario, $id_persona);
		return true;
	}

}
?>
