<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en productos farmaceuticos, elementos medicos y pagos relacionados con servicios medicos
 * @author oagarzond
 * @since 2016-06-20
 */
class Salud extends MX_Controller {

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
        $this->idSeccion = '';
    }
    
    public function index() {
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }
        // Se consulta el estado de la seccion, si esta finalizado se redirige al menu del modulo
        $arrParam = array(
                'mod' => $this->idModulo,
                'cap' => $this->idCapitulo);
        $data["secc"] = $this->Modgmfh->listar_secciones_avances($arrParam);        
        //pr($data["secc"]); exit;
        if (count($data["secc"]) > 0) {
            $opt = true;
            foreach ($data["secc"] as $ks => $vs) {
                if ($vs["FINALIZADO"] == "SI" && $vs["ACCION"] == "FINALIZAR") {
                    redirect(base_url($this->module));
                    return false;
                } else if ($vs["FINALIZADO"] == "NO" && $opt) {
                    $data["ID_SECCION"] = $vs["ID_SECCION"];
                    $data["PAGINA"] = $vs["PAGINA"];
                    $data["ANTERIOR"] = $vs["ANTERIOR"];
                    $data["SIGUIENTE"] = $vs["SIGUIENTE"];
                    $data["ACCION"] = $vs["ACCION"];
                    $data["DESCR_SECCION"] = $vs["DESCR_SECCION"];
                    $data["ENCABEZADO"] = $vs["ENCABEZADO"];
                    $opt = false;
                }
            }
        }
        //pr($data); exit;
        if(!empty($data["PAGINA"])) {
            switch ($data["PAGINA"]) {
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
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }
}
//EOC