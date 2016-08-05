<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador para el módulo de Vivienda
 * @since  22/09/2015	   
 * @author dmdiazf
 */

class Menu extends MX_Controller {

	public function __construct(){		
		parent::__construct();
		$this->load->library("danecrypt");
		$this->load->library("email");			
	}

	/**
	 * Muestra la pagina login
	 * @author mayandarl
	 */
	public function index(){
		$this->load->model("Modmenu");
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["avanc_insc"] = $this->Modmenu->consultarAvancexModulo($data["id_formulario"], 'INSCRIPCION');
		$data["avanc_vivh"] = $this->Modmenu->consultarAvancexModulo($data["id_formulario"], 'VIVHOGAR');
		$data["avanc_igpe"] = $this->Modmenu->consultarAvancexModulo($data["id_formulario"], 'IGPERSONAL');
		$data["view"] = "menu";
		$this->load->view("layout",$data);
	}
	
	/**
	 * Registra las fechas de inicio y fin habilitadas para la encuesta
	 * @author mayandarl
	 */
	public function registra_fechas($id_formulario, $modulo) {
		$this->load->model("Modmenu");
		$inicio = date("Y-m-d H:i:s");
		switch($modulo) {
			case "VIV_HOGAR":
				$fin = date("Y-m-d H:i:s", strtotime('+5 days', $inicio));
			break;
			case "IGPERSONAL":
				$fin = date("Y-m-d H:i:s", strtotime('+2 weeks', $inicio));
			break;
		}
		$this->Modmenu->guardarFechasModulo($id_formulario, $seccion, $pagina, $inicio, $fin);
	}

	/**
	 * Registra el control de avance de la encuesta
	 * @author mayandarl
	 */
	/*public function registra_avance($id_formulario, $seccion, $pagina, $inicio, $fin) {
		$this->load->model("Modmenu");
		$this->Modmenu->guardarRegistroFormulario($id_formulario, $seccion, $pagina, $inicio, $fin);
	}*/
	

}//EOC
?>