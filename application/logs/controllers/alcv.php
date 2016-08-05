<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Alcv extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load("sitio");
    }
    
    public function index() {
        echo 'qwerty';
    }
}

//EOC