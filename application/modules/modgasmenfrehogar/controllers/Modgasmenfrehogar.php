<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en recreacion, diversion, cultura y viajes
 * @author oagarzond
 * @since 2016-06-20
 */
class Modgasmenfrehogar extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load("sitio");
        $this->module = $this->uri->segment(1);
        $this->module = (!empty($this->module)) ? $this->module: 'login';
    }
    
    public function index() {
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }
        $arrParam = array(
            'mod' => 'GMFHOGAR',
            'id0' => 'SI');
        $data["sec"] = $this->Modgmfh->listar_secciones($arrParam);
        foreach ($data["sec"] as $ks => $vs) {
            $data["sec"][$ks]["BLOQ"] = 'NO';            
            $data["sec"][$ks]["ENLACE"] = base_url($this->module . '/' .  $data["sec"][$ks]["TITULO3"]);
            $data["sec"][$ks]["IMG"] = base_url_images('ico_gmf_' . $data["sec"][$ks]["LOGO"] . '.png');
            $data["sec"][$ks]["COLOR"] = $data["sec"][$ks]["TITULO1"];
            // oagarzond - Se consulta el avance para redirecionarlo en que pagina va
            $arrParam = array(
                'idForm' => $data["id_formulario"],
                'id' => $vs["ID_SECCION3"]);
            $arrSA = $this->Modgmfh->listar_secciones_avances($arrParam);
            //pr($arrSA); exit;
            if (count($arrSA) > 0) {
                // Si no existe el registro en admin control se inserta
                if(empty($arrSA[0]["FECHA_INI_SEC"])) {
                    $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                    $fechaactual = substr($fechahoraactual, 0, 10);
                    $secc = $this->Modgmfh->listar_secciones(array('cap' => $data["sec"][$ks]["CAPITULO"]));
                    foreach ($secc as $ks => $vs) {
                        $arrValAD["ID_ESTADO_SEC"] = 0;
                        $arrValAD["PAG_SECCION3"] = 0;
                        if(substr($vs["ID_SECCION3"], 1) == '0') {
                            $arrValAD["FECHA_INI_SEC"] = $fechaactual;
                        }
                        $arrWhereAD["ID_FORMULARIO"] = $data["id_formulario"];
                        $arrWhereAD["ID_SECCION3"] = $vs["ID_SECCION3"];
                        if(!$this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', $arrValAD, $arrWhereAD)) {
                            echo 'No se pudo actualizar los avances del capitulo ' . $data["sec"][$ks]["CAPITULO"] . '.<br />';
                        }
                        unset($arrValAD);
                    }
                }
                if($arrSA[0]["ID_ESTADO_SEC"] == 2) {
                    $data["sec"][$ks]["BLOQ"] = 'SI';
                    $data["sec"][$ks]["IMG"] = base_url_images('ico_gmf_off_' . $data["sec"][$ks]["LOGO"] . '.png');
                    $data["sec"][$ks]["LOGO"] .= '-off';
                }
            } else {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                $secc = $this->Modgmfh->listar_secciones(array('cap' => $data["sec"][$ks]["CAPITULO"]));
                foreach ($secc as $ks => $vs) {
                    $arrValAD["ID_FORMULARIO"] = $data["id_formulario"];
                    $arrValAD["ID_SECCION3"] = $vs["ID_SECCION3"];
                    $arrValAD["ID_ESTADO_SEC"] = 0;
                    $arrValAD["PAG_SECCION3"] = 0;
                    if (substr($vs["ID_SECCION3"], 1) == '0') {
                        $arrValAD["FECHA_INI_SEC"] = $fechaactual;
                    }
                    if (!$this->Modgmfh->ejecutar_insert('ENIG_ADMIN_GMF_CONTROL', $arrValAD)) {
                        echo 'No se pudo guardar los avances del capitulo ' . $data["sec"][$ks]["CAPITULO"] . '.<br />';
                    }
                    unset($arrValAD);
                }
            }
        }
        $data["js_dir"] = base_url('js/modgasmenfrehogar/menu.js');
        $data["view"] = 'menu';
        //pr($data); exit;
        $this->load->view("layout", $data);
    }
}
//EOC