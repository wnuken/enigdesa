<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en alquiler, combustibles, mantenimiento y servicios de la vivienda
 * @author oagarzond
 * @since 2016-06-20
 */
class ViviendaAcms extends MX_Controller {

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
        $this->idSeccion = 'C1';
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
 
 /* OK - se quita temporal mientras modifican Modgmfh
		$arrSA = $this->Modgmfh->listar_secciones_avances($arrParam);
        if (count($arrSA) > 0) {
            if($arrSA["0"]["ID_ESTADO_SEC"] == 2) {
                redirect(base_url($this->module));
                return false;
            }
        }*/
		$data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));

        //pr($data['secc']); 
        //if(!empty($arrSA["0"]["PAG_SECCION3"])) {
		if(1==1) {
            //switch ($arrSA["0"]["PAG_SECCION3"]) {
			switch (3) {
                case 1:
                    $this->mostrarListaArticulos($data);
                    break;
                case 2:
                    $this->mostrarListaObtencion($data);
                    break;
                case 3:
					$data["subtitulo"]="ALQUILER DE VIVIENDA, COMBUSTIBLES Y CONEXI&Oacute;N DE SERVICIOS PARA LA VIVIENDA "; 
                    $this->mostrarGrillaCompra($data);
                    break;
                case 4:
                    $this->mostrarGrillaNoCompra($data);
                    break;
				case 6:
                    $this->mostrarFormCompraVivienda();
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
    private function mostrarGrillaCompra($data) {
        
		$this->load->model("Modsec3");
		//Lista de articulos pagados, del módulo
		$data["arrArticulos"]= $this->Modsec3->listar_articulos_comprados($data['id_formulario'], $data['secc'][0]['ID_SECCION3']); 
		
		$data["medio_pago"]["requiere"]=1;
		$data["medio_pago"]["nom_var"]="P438C11";
		$data["medio_pago"]["nom_otro"]="P438S1C11";
		$data["arrMediosPago"]=$this->Modsec3->listar_medios_pago(); 
		
		// Se consulta la lista de los lugares de compra
        $data["arrLugarCompra"] = $this->Modgmfh->consultar_param_general('', 'LUGAR_COMPRA', '', '');
		// Se consulta la lista de frecuencia de compra
        $data["arrFrecCompra"]= $this->Modgmfh->consultar_param_general('', 'FRECUENCIA_COMPRA', '', '');
        
		
		$data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        //$data["view"] = $this->submodule . '/form3';
		$data["view"] = 'form3';
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
	
	/**
     * @author 
     * @param   
     * @since 
     */
    private function mostrarFormCompraVivienda() {
        //Llamar metodo de otro controlador
		require_once("ViviendaCompra.php");
		$controller = new ViviendaCompra();
		$controller->index();
    }
}
//EOC