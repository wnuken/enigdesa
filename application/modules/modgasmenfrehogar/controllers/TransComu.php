<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en gastos en transporte y comunicaciones
 * @author oagarzond
 * @since 2016-06-20
 */
class TransComu extends MX_Controller {

    private $idModulo;
    private $idCapitulo;
    private $idSeccion;
    
    public function __construct() {
        parent::__construct();
        $this->config->load("sitio");
        $this->module = $this->uri->segment(1);
        $this->module = (!empty($this->module)) ? $this->module: 'login';
        $this->submodule = $this->uri->segment(2);
        $this->idModulo = 'GMFHOGAR';
        $this->idCapitulo = '';
        $this->idSeccion = 'H1';
    }
    
    public function index() {
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }
        // Se consulta el estado de la seccion, si esta finalizado se redirige al menu del modulo
        $arrParam = array('id' => $this->idSeccion);
        $arrSA = $this->Modgmfh->listar_secciones_avances($arrParam);
        if (count($arrSA) > 0) {
            if($arrSA["0"]["ID_ESTADO_SEC"] == 2) {
                redirect(base_url($this->module));
                return false;
            }
        }
        //pr($data); exit;
        if(!empty($arrSA["0"]["PAG_SECCION3"])) {
            switch ($arrSA["0"]["PAG_SECCION3"]) {
                case 1:
                    $this->mostrarListaArticulos($data);
                    break;
                case 2:
                    $this->mostrarListaObtencion($data);
                    break;
                case 3:
                    $this->mostrarGrillaCompra($data);
                    break;
                case 4:
                    $this->mostrarGrillaNoCompra($data);
                    break;
            }
            
        }
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarListaArticulos() {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarListaObtencion() {
        // Aca va el codigo
        // Se consulta la lista de forma de obtencion
        $arrFO = $this->Modgmfh->consultar_param_general('', 'FORMAS_ADQUI', '', '');
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarGrillaCompra() {
        // Aca va el codigo
        // Se consulta la lista de los lugares de compra
        $arrLC = $this->Modgmfh->consultar_param_general('', 'LUGAR_COMPRA', '', '');
        // Se consulta la lista de frecuencia de compra
        $arrFC = $this->Modgmfh->consultar_param_general('', 'FRECUENCIA_COMPRA', '', '');
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarGrillaNoCompra() {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }
}
//EOC