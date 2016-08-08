<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class CuidadoVivienda extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load("sitio");
    }
    
    public function index() {
        $this->load->model(array("formulario/Mformulario", "control/Modmenu"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }
        // Aca va el codigo
    }
}
//EOC