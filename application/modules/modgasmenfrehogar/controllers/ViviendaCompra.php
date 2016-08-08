<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para la secci�n COMPRA Y ADECUACI�N DE VIVIENDA, del submodulo de GASTOS EN ALQUILER, COMBUSTIBLES, MANTENIMIENTO Y SERVICIOS DE LA VIVIENDA 
 * @author 
 * @since 
 */
class ViviendaCompra extends MX_Controller {

    private $idModulo;
    private $idCapitulo;
    private $idSeccion;
    private $idSubModulo;
    
    public function __construct() {
        parent::__construct();
        $this->config->load("sitio");
        $this->module = $this->uri->segment(1);
        $this->module = (!empty($this->module)) ? $this->module: 'login';
        $this->submodule = "ViviendaCompra";
       /* $this->idModulo = 'GMFHOGAR';
        $this->idCapitulo = '';*/
        $this->idSeccion = 'C4';
        $this->idSubModulo = 'C';
    }
    
    /**
     * Método para mostrar opcion principal GASTOS EN ALQUILER, COMBUSTIBLES, MANTENIMIENTO Y SERVICIOS DE LA VIVIENDA.
     * @author dmdiazf / @author hhchavez
     * @since  05/07/2016
     */    
    public function index() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");

        $arrSA = $this->Modgmfh->listar_secciones_avances(array( "id0" => $this->idSubModulo , "estado" => array(0,1), "idForm" => $id_formulario));
        //echo count($arrSA) . " || " . $arrSA[0]['ID_ESTADO_SEC'];  
        if (count($arrSA) == 0 || (count($arrSA) > 0 && $arrSA[0]['ID_ESTADO_SEC'] == 2) ) {
            redirect(base_url($this->module));
            return false;
        }

        
        $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
        $fechaactual = substr($fechahoraactual, 0, 10);
        $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 1, "FECHA_INI_SEC" => $fechaactual, "PAG_SECCION3" => 1 ), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => 'C4'));
        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));        
        $data['var'] = $this->Modgmfh->lista_variables_param(array( "seccion" => $this->idSeccion, "pagina" => 1));

		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["view"] = 'ViviendaAcms/formCompraVivienda';
		$this->load->view("layout", $data);
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
	
	/**
     * @author 
     * @param   
     * @since 
     */
    private function mostrarFormCompraVivienda() {
        $this->load->library('../controllers/whathever');
		$this->whathever->functioname();
    }
	
	/** Guarda pagina C14.CompraAdecuaciónVivnda_Año
     * @author hhchavezv @author cemedinaa
     * @since 2016-08-01
	 * @return echo "-ok-" si guarda correctamente, si no "ERROR"
     */
    public function guardaGrillaCompraViv() {
        $id_formulario = $this->session->userdata("id_formulario");
		$this->load->model(array("ViviendaAcms/Modcompraviv","Modgmfh"));
		// Convierte en variables php lo que llega por POST
        $arrDatos = array();
		foreach($_POST as $nombre_campo => $valor){	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}

        //pr($arrDatos);		
	
		$result=$this->Modcompraviv->guardaCompraViv($_POST);	

		//pr($_POST);			
		//$result=false;// pruebas
		
		if($result){
			echo "-ok-";            
            $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
            $fechaactual = substr($fechahoraactual, 0, 10);
            $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual ), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => 'C4'));
            $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual ), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => 'C0'));
		}	
		else
			echo "ERROR";
		
    }
}
//EOC