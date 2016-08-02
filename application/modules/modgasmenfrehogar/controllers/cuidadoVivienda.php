<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en articulos de limpieza y cuidado de la vivienda
 * @author oagarzond
 * @since 2016-06-20
 */
class CuidadoVivienda extends MX_Controller {
    
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
		$this->idSubModulo = 'A';
        $this->idSeccion = '';
    }
    
    /**
     * Consulta la pagina en que quedo el usuario
     * @author oagarzond
     * @since 2016-06-21
     * @return false    Si no debe mostrar algo
     */
     public function index() {
         
		$this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }
      
	/*ACTUALIZA CONTROL - FUNC CAMILO*/
		$arrSA = $this->actualizarEstado();
		$this->idSeccion = count($arrSA) > 1 ? $arrSA[1]['ID_SECCION3'] : "";
		//pr($arrSA);
		
		if (count($arrSA) == 0 || (count($arrSA) > 0 && $arrSA[0]['ID_ESTADO_SEC'] == 2) ) {
            //if($arrSA["0"]["ID_ESTADO_SEC"] == 2) {
                redirect(base_url($this->module));
                return false;
            //}
        }
	/*****/ 

		//if(1==1) {
		if(!empty($arrSA["1"]["PAG_SECCION3"])) {
			//switch (7) {
			switch ($arrSA["1"]["PAG_SECCION3"]) {
                case 1:
                    $this->mostrarListaArticulos($data);
                    break;
                case 2:
                    $this->mostrarListaObtencion($data);
                    break;
                case 3:
					$data['secc'] = $this->Modgmfh->listar_secciones(array("id" =>"A1"));
					$data["titulo_1"]=$data['secc'][0]['TITULO1'];//"de ______ del 2016";
					$data["subtitulo_2"]=$data['secc'][0]['TITULO2'];
					$data["subtitulo_3"]=$data['secc'][0]['TITULO3'];
					$data["js_dir"] = base_url('js/modgasmenfrehogar/form3.js');					
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
    /*private function mostrarListaArticulos() {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }*/
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    /*private function mostrarListaObtencion() {
        // Aca va el codigo
        // Se consulta la lista de forma de obtencion
        $arrFO = $this->Modgmfh->consultar_param_general('', 'FORMAS_ADQUI', '', '');
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
        $this->load->view("layout", $data);
    }*/

    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarListaArticulos($data) {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/form1.js');
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));

        $this->session->set_userdata('id_seccion', $this->idSeccion);
        //$data["id_formulario"] = $this->session->userdata("id_formulario");

        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));

        if($data['secc'][0]['ID_VARIABLE_USO'] != "") {
            $data['var_uso'] = $this->Modgmfh->lista_variables_param(array("id" => $data['secc'][0]['ID_VARIABLE_USO']));
        }
        $data['var'] = $this->Modgmfh->lista_variables_param(array( "seccion" => $this->idSeccion, "pagina" => 1));
        $data['preg']["var"] = $this->Modgmfh->listar_articulos_seccion( array("sec" => $this->idSeccion) );
        $data["view"]="form1";
        $this->load->view("layout", $data);
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarListaObtencion($data) {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/form2.js');
        
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $this->session->set_userdata('id_seccion', $this->idSeccion);

        $data["id_formulario"] = $this->session->userdata("id_formulario");
        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));
        
        $data['var'] = $this->Modgmfh->lista_variables_param(array( "seccion" => $this->idSeccion, "pagina" => 2));
        $data['preg']["var"] = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $data["id_formulario"]) );
        
        $data["view"]="form2";        

        $this->load->view("layout", $data);
    }
    
    
	 /** Abre página 3 -  artículo o servicio COMPRADO o PAGADO
     * @author hhchavezv
     * @param   array $data: array con parametros a enviar a vista
     * @since 2016-07-01
     */
    
	private function mostrarGrillaCompra($data) {
        
        $this->load->model("Modsec3");
        
        //Lista de articulos pagados, del m?dulo
        $data["arrArticulos"]= $this->Modsec3->listar_articulos_comprados($data['id_formulario'], $data['secc'][0]['ID_SECCION3']); 
        
		// Verifica si existe pregunta "medio de pago"
		$data["habilita_medio_pago"]= $data['secc'][0]['ID_VARIABLE_MEDIO_PAGO']; 		
		// Verifica si existe segunda forma de pago a CREDITO
		$data["habilita_credito"]= $data['secc'][0]['ID_VARIABLE_TOTAL_PAGO2']; 
		
		// Consulta rangos para pago 
		$data["rango_min"]= $data['secc'][0]['VALOR_MINIMO']; 
		$data["rango_max"]= $data['secc'][0]['VALOR_MAXIMO']; 
		
		// Se consulta la lista de medios de pago
        $data["arrMediosPago"]=$this->Modsec3->listar_medios_pago(); 
        // Se consulta la lista de los lugares de compra
        $data["arrLugarCompra"] = $this->Modgmfh->consultar_param_general('', 'LUGAR_COMPRA', '', '');
        // Se consulta la lista de frecuencia de compra
        $data["arrFrecCompra"]= $this->Modgmfh->consultar_param_general('', 'FRECUENCIA_COMPRA', '', '');
        
        $data["view"] = 'form3'; 
        $this->load->view("layout", $data);
    }
	/** Guarda página 3 - artículo o servicio COMPRADO o PAGADO
     * @author hhchavezv
     * @since 2016-07-06
	 * @return echo "-ok-" si guarda correctamente, si no "ERROR"
     */
    public function guardaGrillaCompra() {
        
		$this->load->model("Modsec3");
		// Convierte en variables php lo que llega por POST
		foreach($_POST as $nombre_campo => $valor){	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}
			
		$result=$this->Modsec3->guardaForm3($_POST);		
		if($result){
			echo "-ok-";			
		}	
		else
			echo "ERROR";
		
    }
	
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarGrillaNoCompra($data) {

        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/form4.js');

        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));

        $this->session->set_userdata('id_seccion', $this->idSeccion);
        $data["id_formulario"] = $this->session->userdata("id_formulario");

        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion));

        $data['preg']["var"] = $this->Modgmfh->lista_formaObtencion(array("seccion" => $this->idSeccion, "id_formulario" => $data["id_formulario"], "sincompra" => 1));
        $data['preg']["variables"] = $this->Modgmfh->lista_variables_param(array("seccion" => $this->idSeccion, "pagina" => "4"));

        $data["view"] = 'form4';
        $this->load->view("layout", $data);
    }
	
	/** Actualiza tabla control
     * @author cemedinaa 
     * @since 
     */
	 private function actualizarEstado() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $arrSA = $this->Modgmfh->listar_secciones_avances(array( "id0" => $this->idSubModulo , "estado" => array(0,1), "idForm" => $id_formulario));
        
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
		else if(sizeof($arrSA) == 1) {
            $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array("ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array("ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $arrSA[0]['ID_SECCION3']));
            $arrSA[0]['ID_ESTADO_SEC'] = 2;
        }
        
		$arrSA = $this->Modgmfh->listar_secciones_avances(array( "id0" => $this->idSubModulo , "estado" => array(0,1), "idForm" => $id_formulario));
        return $arrSA;
    }

    /**
     * @author cemedinaa
     * @since 2016-06-30
     */
    public function guardar_form1() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $id_seccion = $this->session->userdata("id_seccion");
        $formas_obt = $this->Modgmfh->lista_formaObtencion( array("seccion" => $id_seccion, "id_formulario" => $id_formulario) );
        $cant_formas_obt = count($formas_obt);
        
        $articulos = isset($_POST['articulos'])?$_POST['articulos']:"";

        if($cant_formas_obt == 0 && ( is_array($articulos) || (isset($_POST['variable_uso']) && $_POST['variable_uso'] == 2) ) ) {
            $i = 0;
            $var_independiente = $this->Modgmfh->lista_variables_param(array( "seccion" => $id_seccion, "pagina" => 1));
            // si selecciona niguna de las anteriores o que no ha utilizado ninguno de los productos en el último lapso de tiempo preguntado
            if(is_array($articulos) && count($articulos) == 1 && $articulos[0] == "99999999") {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                //$this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMA_OBTENCION', array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => "99999999".$id_seccion));
                //$this->Modgmfh->ejecutar_update('ENIG_FORM_GMF_VARIABLES', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_VARIABLE" => $id_seccion));
                $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_VARIABLES', array( "ID_FORMULARIO" => $id_formulario, "ID_VARIABLE" => $var_independiente[0]['ID_VARIABLE'], "VALOR_VARIABLE" => "99999999"));
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $id_seccion));
                $i = 1;
            }
            else if(!is_array($articulos) && $_POST['variable_uso'] == "2" )  {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_VARIABLES', array( "ID_FORMULARIO" => $id_formulario, "ID_VARIABLE" => $var_independiente[1]['ID_VARIABLE'], "VALOR_VARIABLE" => $_POST['variable_uso']));
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $id_seccion));
                $i = 1;
            }
            else {
                if(isset($var_independiente[1])) {
                    $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_VARIABLES', array( "ID_FORMULARIO" => $id_formulario, "ID_VARIABLE" => $var_independiente[1]['ID_VARIABLE'], "VALOR_VARIABLE" => "1"));
                }         
                foreach ($articulos as $key => $value) {
                    $forma_obt = $this->Modgmfh->listar_articulos_seccion( array("id" => $value, "id_formulario" => $id_formulario) );

                    if(count($forma_obt) == 1 && $articulos[0] != "99999999") {
                        $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMA_OBTENCION', array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value));
                        $i++;
                    }
                }
            }
            if($i > 0)
                echo "S:Se ha guardado la informaci&oacute;n correctamente!";
            else echo "E:ERROR al guardar la secci&oacute;n. Intente nuevamente o recargue la p&aacute;gina.";
        }
        else {
            echo "E:ERROR al guardar la secci&oacute;n. Intente nuevamente o recargue la p&aacute;gina.";
        }   
    }

    /**
     * @author cemedinaa
     * @since 2016-07-12
     */
    public function guardar_form2() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $id_seccion = $this->session->userdata("id_seccion");
        $formas_obt = $this->Modgmfh->lista_formaObtencion( array("seccion" => $id_seccion, "id_formulario" => $id_formulario) );
        $cant_formas_obt = count($formas_obt);

        if($cant_formas_obt > 0) {
            foreach ($formas_obt as $key => $value) {
                if(!isset($_POST[$value['ID_ARTICULO3']]['compra']) && !isset($_POST[$value['ID_ARTICULO3']]['recibido_pago']) && !isset($_POST[$value['ID_ARTICULO3']]['regalo']) && 
                   !isset($_POST[$value['ID_ARTICULO3']]['intercambio']) && !isset($_POST[$value['ID_ARTICULO3']]['producido']) && !isset($_POST[$value['ID_ARTICULO3']]['negocio_propio']) &&
                   !isset($_POST[$value['ID_ARTICULO3']]['otra']) )
                    die("W:Debe escoger por lo menos una opci&oacute;n en cada uno de los productos!");
            }

            foreach ($formas_obt as $key => $value) {                    
                $codigos = array_keys($_POST[$value['ID_ARTICULO3']]);
                $arrACT = array_fill_keys($codigos, 1);
                $cols  = array( "compra" => 0, "recibido_pago" => 0, "regalo" => 0, "intercambio" => 0, "producido" => 0, "negocio_propio" => 0, "otra" => 0);

                $arrUPD = array_merge( $cols, $arrACT);

                $this->Modgmfh->ejecutar_update('ENIG_FORM_GMF_FORMA_OBTENCION', $arrUPD, array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value['ID_ARTICULO3']));
            }
            echo "S:Se ha guardado la informaci&oacute;n correctamente!";
        }
        else {
            echo "E:ERROR al guardar la secci&oacute;n. Intente nuevamente o recargue la p&aacute;gina.";
        }   
    }

    /**
     * @author cemedinaa
     * @since 2016-07-15
     */
    public function guardar_form4() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $id_seccion = $this->session->userdata("id_seccion");
        $secc = $this->Modgmfh->listar_secciones(array("id" => $id_seccion));
        $formas_obt = $this->Modgmfh->lista_formaObtencion( array("seccion" => $id_seccion, "id_formulario" => $id_formulario, "sincompra" => 1) );
        $cant_formas_obt = count($formas_obt);

        if($cant_formas_obt > 0) {
            $variables = $this->Modgmfh->lista_variables_param(array("seccion" => $id_seccion, "pagina" => "4"));
            $i = 0;
            
            $inputs = "";
            $mensajes = "";
            // Se recorren todos los articulos de la seccion y el formulario correspondiente
            foreach ($formas_obt as $k1 => $v1) {
                $cols  = array( "RECIBIDO_PAGO", "REGALO", "INTERCAMBIO", "PRODUCIDO", "NEGOCIO_PROPIO", "OTRA");
                $rangoMayor = preg_match('/^\d+$/', $secc[0]['VALOR_MAXIMO'])?$secc[0]['VALOR_MAXIMO']:"";
                $rangoMenor = preg_match('/^\d+$/', $secc[0]['VALOR_MINIMO'])?$secc[0]['VALOR_MINIMO']:"";
                
                $j = 0;                
                // Se recorren todas las formas de obtencion para cada articulo
                foreach($cols as $v2) {
                    $val_input = isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)])?str_replace(".", "", $_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]):"";

                    // Se verifica que esten definidos los input con los nombres establecidos, si la correspondiente forma de obtencion es igual a 1
                    if( ( $v1[$v2] == 1 && !isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && !isset($_POST['chb_' . $v1['ID_ARTICULO3']][strtolower($v2)]) ) 
                        || ( $v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && isset($_POST['chb_' . $v1['ID_ARTICULO3']][strtolower($v2)]) ) ) {
                        $m = "'ERROR al guardar la secci&oacute;n. Intente nuevamente o recargue la p&aacute;gina.',";
                        if(substr_count($mensajes, $m) == 0)
                            $mensajes .= $m;
                    }
                    // Se verifica que los campos de texto que se reciben esten diligenciados, si la correspondiente forma de obtencion es igual a 1
                    else if( $v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && $_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)] == ""  ) {
                        $m = "'Algunos de los campos no han sido diligenciados',";
                        $inputs .= "'txt_" . $v1['ID_ARTICULO3'] . "_" . ($j +1) . "',";
                        if(substr_count($mensajes, $m) == 0)
                            $mensajes .= $m;
                    }
                    // Se verifica que los valores en los campos de texto sean enteros positivos, si la correspondiente forma de obtencion es igual a 1
                    else if( $v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && !preg_match('/^\d+$/', $val_input) ) {
                        $m = "'Los valores deben ser enteros positivos',";
                        $inputs .= "'txt_" . $v1['ID_ARTICULO3'] . "_" . ($j +1) . "',";
                        if(substr_count($mensajes, $m) == 0)
                            $mensajes .= $m;
                    }
                    // Se verifica que los valores en los campos de texto esten dentro del rango establecido, si la correspondiente forma de obtencion es igual a 1
                    else if($v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && $rangoMayor != "" && $rangoMenor != "" && $id_seccion != "G3" && $id_seccion != "G4" &&
                        ($val_input < $rangoMenor || $val_input > $rangoMayor ) ) {
                        $m = "'Los valores estimados no pueden ser menores a " . number_format($rangoMenor) . " o mayores a " . number_format($rangoMayor) . "',";
                        $inputs .= "'txt_" . $v1['ID_ARTICULO3'] . "_" . ($j +1) . "',";
                        if(substr_count($mensajes, $m) == 0)
                            $mensajes .= $m;
                    }
                    // Se verifica que los valores en los campos de texto esten dentro del rango establecido o sean cero (solo para secciones G3 y G4), si la correspondiente forma de obtencion es igual a 1
                    else if($v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) && $rangoMayor != "" && $rangoMenor != "" && ($id_seccion == "G3" || $id_seccion == "G4") &&
                        ($val_input < $rangoMenor || $val_input > $rangoMayor ) && $val_input <> 0 ) {
                        $m = "'Los valores estimados no pueden ser menores a " . number_format($rangoMenor) . " o mayores a " . number_format($rangoMayor) . " o diferentes a cero.',";
                        $inputs .= "'txt_" . $v1['ID_ARTICULO3'] . "_" . ($j +1) . "',";
                        if(substr_count($mensajes, $m) == 0)
                            $mensajes .= $m;
                    }

                    // Se guarda en un array los arrays de insercion cuando el campo de texto viene con un valor
                    if ( $v1[$v2] == 1 && isset($_POST['val_' . $v1['ID_ARTICULO3']][strtolower($v2)]) ){
                        $arrInsert[] = array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $v1['ID_ARTICULO3'], "ID_VARIABLE" => $variables[$j]['ID_VARIABLE'], "VALOR_ESTIMADO" => $val_input );

                    }
                    // Se guarda en un array los arrays de insercion cuando viene activo el checkbox (se marco no sabe valor estimado)
                    else if ( $v1[$v2] == 1 && isset($_POST['chb_' . $v1['ID_ARTICULO3']][strtolower($v2)]) ){
                        $arrInsert[] = array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $v1['ID_ARTICULO3'], "ID_VARIABLE" => $variables[$j]['ID_VARIABLE'], "VALOR_ESTIMADO" => 99 );
                    }
                    $j++;
                }                
                $i++;
            }

            // Si no hay errrores se guarda
            if($mensajes == "") {
                // guarda
                // Se recorre array de datos para insertar
                foreach ($arrInsert as $idx => $arrValores) {
                    $arrpk = $arrValores;                    
                    $forma_adqui = $this->Modgmfh->lista_formaAdqui(array( "id_formulario" => $arrValores['ID_FORMULARIO'], "articulo" => $arrValores['ID_ARTICULO3'], "variable" => $arrValores['ID_VARIABLE']));
                    // Si no existe ya la forma de adquisicion en la tabla del capitulo 4 se guarda
                    if(count($forma_adqui) == 0) {
                      $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMAS_ADQUI', $arrValores);
                    }
                }
                echo "[[],['Se ha guardado la informaci&oacute;n correctamente!']]";
            }
            // Se hay errores se envia respuesta con los mensajes de los errores encontrados y los ids de los input que tienen los errores
            else {
                $mensajes = substr( $mensajes, 0, strlen($mensajes) - 1);
                $inputs = substr( $inputs, 0, strlen($inputs) - 1);
                echo "[[" . $inputs . "], [" . $mensajes ."]]";
            }
        }
    }
}
//EOC