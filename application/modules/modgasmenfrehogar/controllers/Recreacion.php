<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en recreacion, diversion, cultura y viajes
 * @author oagarzond
 * @since 2016-06-20
 */
class Recreacion extends MX_Controller {

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
        $this->idSubModulo = 'J';
        $this->idSeccion = '';
    }

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
    
    public function index() {
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $data["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($data["id_formulario"])) {
            redirect('/');
            return false;
        }

        
        $arrSA = $this->actualizarEstado();
        
        
        // Se consulta el estado de la seccion, si esta finalizado se redirige al menu del modulo
       // $arrParam = array('id' => $this->idSeccion);
        //$arrSA = $this->Modgmfh->listar_secciones_avances($arrParam);
        if (count($arrSA) == 0) {
            //if($arrSA["0"]["ID_ESTADO_SEC"] == 2) {
                redirect(base_url($this->module));
                return false;
            //}
        }
        
        //die("<BR><BR>seccion:".$this->idSeccion." - pagina:".$arrSA["1"]["PAG_SECCION3"]);
        //var_dump($arrSA);
        //echo "mmm".$arrSA["0"]["PAG_SECCION3"];
        //Esto va temporalmente aquí, mientras resuelven lo de la tabla control
        //$this->mostrarListaArticulos($data);
        //pr($data); exit;
        if(!empty($arrSA["1"]["PAG_SECCION3"])) {
        	//echo "nnn";
            switch ($arrSA["1"]["PAG_SECCION3"]) {
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
        //$data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/recreacion.js');

        $data["js_dir"] = base_url('js/gasmenfrehogar/' . $this->submodule . '/recreacion.js');
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));

        $this->session->set_userdata('id_seccion', $this->idSeccion);
        $data["id_formulario"] = $this->session->userdata("id_formulario");

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
    private function mostrarListaObtencion() {
        // Aca va el codigo
        // Se consulta la lista de forma de obtencion
        //$arrFO = $this->Modgmfh->consultar_param_general('', 'FORMAS_ADQUI', '', '');
        //$data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        //$data["view"] = $this->submodule . '/view1';
        //$this->load->view("layout", $data);

        //$data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["js_dir"] = base_url('js/gasmenfrehogar/' . $this->submodule . '/recreacion.js');
        //echo "mmm";
        //$data["view"] = $this->submodule . '/form1';
        
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $this->session->set_userdata('id_seccion', $this->idSeccion);

        $data["id_formulario"] = $this->session->userdata("id_formulario");
        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));
        
        $data['preg']["var"] = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $data["id_formulario"]) );
        
        $data["view"]="form2";
        

        $this->load->view("layout", $data);
    }
    
    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarGrillaCompra() {
        die("Vista 3");
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

        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));

        $this->session->set_userdata('id_seccion', $this->idSeccion);
        $data["id_formulario"] = $this->session->userdata("id_formulario");

        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));

        $data['preg']["var"] = $this->Modgmfh->lista_formaObtencion( array("seccion" => $this->idSeccion, "id_formulario" => $data["id_formulario"]) );
        $data['preg']["variables"] = $this->Modgmfh->lista_variables_param(array("seccion" => $this->idSeccion, "pagina" => "4"));

        //$data["view"] = $this->submodule . '/form4';
        $data["view"] = 'form4';
        $this->load->view("layout", $data);
    }

    /**
     * @author cemedinaa
     * @since 2016-06-30
     */
    public function guardar() {
        $this->load->model(array("Modgmfh"));
        $id_formulario = $this->session->userdata("id_formulario");
        $id_seccion = $this->session->userdata("id_seccion");
        $formas_obt = $this->Modgmfh->lista_formaObtencion( array("seccion" => $id_seccion, "id_formulario" => $id_formulario) );
        $cant_formas_obt = count($formas_obt);
        
        $articulos = isset($_POST['articulos'])?$_POST['articulos']:"";

        //guarda capitulo 1
        if($cant_formas_obt == 0 && ( is_array($articulos) || (isset($_POST['variable_uso']) && $_POST['variable_uso'] == 2) ) ){
            $i = 0;
            // si selecciona niguna de las anteriores o que no ha utilizado ninguno de los productos en el último lapso de tiempo preguntado
            if(is_array($articulos) && count($articulos) == 1 && $articulos[0] == "99999999") {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMA_OBTENCION', array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => "99999999".$id_seccion));
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $id_seccion));
                $i = 1;
            }
            else if(!is_array($articulos) && $_POST['variable_uso'] == "2" )  {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $id_seccion));
                $i = 1;
            }
            else {                
                foreach ($articulos as $key => $value) {
                    $forma_obt = $this->Modgmfh->listar_articulos_seccion( array("id" => $value, "id_formulario" => $id_formulario) );

                    if(count($forma_obt) == 1 && $articulos[0] != "99999999") {
                        $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMA_OBTENCION', array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value));
                        $i++;
                    }
                    else echo "<br><br>no existe articulos=".$articulos[$i];
                }
            }
            if($i > 0)
                echo "Se ha guardado la informaci&oacute;n correctamente!";
            else echo "Se ha presentado un error por favor intentar de nuevo!";
        }

        //guarda capitulo 2
        else if($cant_formas_obt > 0) {
            foreach ($formas_obt as $key => $value) {
                //if(!array_key_exists($value['ID_ARTICULO3'], $_POST))
                if(!isset($_POST[$value['ID_ARTICULO3']]['compra']) && !isset($_POST[$value['ID_ARTICULO3']]['recibido_pago']) && !isset($_POST[$value['ID_ARTICULO3']]['regalo']) && 
                   !isset($_POST[$value['ID_ARTICULO3']]['intercambio']) && !isset($_POST[$value['ID_ARTICULO3']]['producido']) && !isset($_POST[$value['ID_ARTICULO3']]['negocio_propio']) &&
                   !isset($_POST[$value['ID_ARTICULO3']]['otra']) )
                    die("Debe escoger por lo menos una opci&oacute;n en cada uno de los productos!");
            }
            //var_dump($formas_obt);

            foreach ($formas_obt as $key => $value) {                    
                $codigos = array_keys($_POST[$value['ID_ARTICULO3']]);
                $arrACT = array_fill_keys($codigos, 1);
                $cols  = array( "compra" => 0, "recibido_pago" => 0, "regalo" => 0, "intercambio" => 0, "producido" => 0, "negocio_propio" => 0, "otra" => 0);

                $arrUPD = array_merge( $cols, $arrACT);

                $this->Modgmfh->ejecutar_update('ENIG_FORM_GMF_FORMA_OBTENCION', $arrUPD, array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value['ID_ARTICULO3']));
            }
            echo "Se ha guardado la informaci&oacute;n correctamente!";
        }
        else {
            echo "<br>no se hace nada!";
        }   
    }


}
//EOC