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
 
 		$arrSA = $this->Modgmfh->listar_secciones_avances($arrParam);
        if (count($arrSA) > 0) {
            if($arrSA["0"]["ID_ESTADO_SEC"] == 2) {
                redirect(base_url($this->module));
                return false;
            }
        }
		$data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));

        //pr($arrSA); 
        if(!empty($arrSA["0"]["PAG_SECCION3"])) {
		//if(1==1) {
            switch ($arrSA["0"]["PAG_SECCION3"]) {
			//switch (3) {
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
    
    /** Carga vista de p�gina 3 - - art�culo o servicio COMPRADO o PAGADO
     * @author hhchavezv
     * @param   array $data: array con parametros a enviar a vista
     * @since 2016-07-01
     */
    private function mostrarGrillaCompra($data) {
        
		$this->load->model("Modsec3");
		//Lista de articulos pagados, del m�dulo
		$data["arrArticulos"]= $this->Modsec3->listar_articulos_comprados($data['id_formulario'], $data['secc'][0]['ID_SECCION3']); 
		
		// Verifica si debe habilitar pregunta "medio de pago"
		$data["habilita_medio_pago"]=$this->Modsec3->habilitaPreguntaMedioPago($data['secc'][0]['ID_SECCION3']); 
		
		$data["arrMediosPago"]=$this->Modsec3->listar_medios_pago(); 
		
		// Se consulta la lista de los lugares de compra
        $data["arrLugarCompra"] = $this->Modgmfh->consultar_param_general('', 'LUGAR_COMPRA', '', '');
		// Se consulta la lista de frecuencia de compra
        $data["arrFrecCompra"]= $this->Modgmfh->consultar_param_general('', 'FRECUENCIA_COMPRA', '', '');
        
/******* NOTA: Personalizar ruta ****************/		
		$data["js_dir"] = base_url('js/gasmenfrehogar/viviendaAcms/viviendaAcms.js');
/***********************************************/				
        $data["view"] = 'form3';
        $this->load->view("layout", $data);
    }
	
	/** Guarda p�gina 3 - art�culo o servicio COMPRADO o PAGADO
     * @author hhchavezv
     * @since 2016-07-06
     */
    public function guardaGrillaCompra() {
        
		$this->load->model("Modsec3");
		foreach($_POST as $nombre_campo => $valor){
	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}
			
		$result=$this->Modsec3->guardaForm3($_POST);	
		if($result)		
			echo "-ok-";// retorna esta cadena a JS, para validar que se guardo correctamente
		else
			echo "ERROR";
		
		/*if($result){
			$result2=$this->Modsec3->actualizaPaginaControl($ID_FORMULARIO, $hdd_sec,4); 
			if($result2)	
				echo "-ok-";
			else
				echo "ERROR";
		}	
		else
			echo "ERROR";	
			*/
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
	
	/** Actuliza tabla control
      * @author cemedinaa
    **/
	private function actualizarEstado() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $arrSA = $this->Modgmfh->listar_secciones_avances(array( "id0" => $this->idSubModulo , "estado" => array(0,1)));
        
        $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
        $fechaactual = substr($fechahoraactual, 0, 10);
        if(sizeof($arrSA) > 1) {
            $this->idSeccion = $arrSA[1]['ID_SECCION3'];

            $formas_obt = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $id_formulario) );

            $formas_obt_sin_compra = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $id_formulario, "sincompra" => 1) );
            $formas_obt_con_compra = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $id_formulario, "compra" => 1) );
            $lista_compra = $this->Modgmfh->lista_compra( array("seccion" => $this->idSeccion, "id_formulario" => $id_formulario) );
            $formas_adqui = $this->Modgmfh->lista_formaAdqui( array("seccion" => $this->idSeccion, "id_formulario" => $id_formulario) );
            $fin = false;

            if($arrSA[0]['ID_ESTADO_SEC'] ==  0){
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 1), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $arrSA[0]['ID_SECCION3']));
                $arrSA[0]['ID_ESTADO_SEC'] = 1;
            }

         
            if($arrSA[1]['ID_ESTADO_SEC'] ==  0 && $arrSA[1]['PAG_SECCION3'] ==  0){
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 1, "PAG_SECCION3" => 1, "FECHA_INI_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['ID_ESTADO_SEC'] = 1;
                $arrSA[1]['PAG_SECCION3'] = 1;
            }
            /*else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 1 && count($formas_obt) == 1 && $formas_obt[0]['ID_ARTICULO3'] == "99999999" ) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
            }*/
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 1 && count($formas_obt) > 0 ) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "PAG_SECCION3" => 2), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['PAG_SECCION3'] = 2;
            }
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 2 && count($formas_obt_con_compra) > 0 ) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "PAG_SECCION3" => 3), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['PAG_SECCION3'] = 3;
            }
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 2 && count($formas_obt_sin_compra ) > 0 ) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "PAG_SECCION3" => 4), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['PAG_SECCION3'] = 4;
            }
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 3 && count($lista_compra) > 0 && count($formas_obt_sin_compra) > 0) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "PAG_SECCION3" => 4), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['PAG_SECCION3'] = 4;
            }
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 3 && count($lista_compra) > 0 && count($formas_obt_sin_compra) == 0) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['ID_ESTADO_SEC'] = 2;
                $fin = true;
            }
            else if($arrSA[1]['ID_ESTADO_SEC'] ==  1 && $arrSA[1]['PAG_SECCION3'] == 4 && count($formas_adqui) > 0 ) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $this->idSeccion));
                $arrSA[1]['ID_ESTADO_SEC'] = 2;
                $fin = true;
            }

            
            if($fin && sizeof($arrSA) > 2 && $arrSA[2]['ID_ESTADO_SEC'] ==  0 && $arrSA[2]['PAG_SECCION3'] ==  0) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 1, "PAG_SECCION3" => 1, "FECHA_INI_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $arrSA[2]['ID_SECCION3']));
                $arrSA[2]['ID_ESTADO_SEC'] = 1;
                $arrSA[2]['PAG_SECCION3'] = 1;
            }
            else if($fin && sizeof($arrSA) == 2) {
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual ), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $arrSA[0]['ID_SECCION3']));
                $arrSA[0]['ID_ESTADO_SEC'] = 2;
            }



        }
        //else {
        //    $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual ), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $arrSA[0]['ID_SECCION3']));
        //}

        return $arrSA;
    }
	
}
//EOC