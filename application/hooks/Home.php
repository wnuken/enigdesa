<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }

    public function check_login() {
        $arrModules = array("admin", "login", "registrese");
        //pr($this->ci->uri->segment(1)); exit;

        if (!in_array($this->ci->uri->segment(1), $arrModules)) {
            if ($this->ci->session->userdata('id_formulario') == FALSE) {
                redirect(base_url('login'));
            }
        } else {
            if ($this->ci->uri->segment(1) == "admin") {
                $arrControllers = array($this->ci->uri->segment(1), "index", "login", "olvido", "reminder", "salir", "userAuth", "validaSesion");
                if (strlen($this->ci->uri->segment(2)) > 0 && !in_array($this->ci->uri->segment(2), $arrControllers)) {
                    if ($this->ci->session->has_userdata('id_formulario') == FALSE) {
                        redirect(base_url('admin'));
                    }
                }
            }
            if ($this->ci->uri->segment(1) == "control") {
                $arrControllers = array($this->ci->uri->segment(1), "index", "Menu", "userAuth");
                if (strlen($this->ci->uri->segment(2)) > 0 && !in_array($this->ci->uri->segment(2), $arrControllers)) {
                    if ($this->ci->session->has_userdata('id_formulario') == FALSE) {
                        redirect(base_url('admin'));
                    }
                }
            }
        }
    }
}
//EOC