<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en recreacion, diversion, cultura y viajes
 * @author oagarzond
 * @since 2016-06-20
 */
class Ropaaccesorios extends MX_Controller {

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
        $this->idSubModulo = 'D';
        $this->idSeccion = '';
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $this->load->model("/ropaaccesorios/Modelropaaccesorios", "Maccesorios");
    }

    public function index() {
        $dataElement["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($dataElement["id_formulario"])) {
            redirect('/');
            return false;
        }

        $initControl = $this->getControlSection();

        if(is_array($initControl) && $initControl[0]['ID_ESTADO_SEC'] < 2){

            if($initControl[0]['ID_ESTADO_SEC'] ==  0){
                $dataElement['ID_SECCION3'] = $initControl[0]['ID_SECCION3'];
                $dataElement['ID_ESTADO_SEC'] = 1;
                $this->updateControlSection($dataElement);
            }

            if($initControl[1]['ID_ESTADO_SEC'] ==  0){
                $dataElement['ID_SECCION3'] =  $initControl[1]['ID_SECCION3'];
                $dataElement['ID_ESTADO_SEC'] = 1;
                $this->updateControlSection($dataElement);
            }


            $validateControl = $this->getControlSection();

            if(is_array($validateControl)){
                foreach ($validateControl as $key => $section) {
                    if($section['ID_ESTADO_SEC'] < 2 && $section['ID_SECCION3'] != ($this->idSubModulo . '0')){
                        $data['pageSection'] = $section['PAG_SECCION3'];
                        $data['idSection'] = $section['ID_SECCION3'];
                        $data["view"]="ropaaccesorios/form1";
                        $this->load->view("layout", $data);
                        return false;
                    }
                }
            }


            
        }else{
           //  redirect('modgasmenfrehogar/');
            return false;
        }

    }

    private function getControlSection(){
        $result = $this->Modgmfh->listar_secciones_avances(
            array( "id0" => $this->idSubModulo , 
                "estado" => array(0,1,2))
            );
        return $result;
    }

    private function updateControlSection($params){
        $result = $this->Modgmfh->ejecutar_update(
            'ENIG_ADMIN_GMF_CONTROL', 
            array( "ID_ESTADO_SEC" => $params['ID_ESTADO_SEC']), 
            array( "ID_FORMULARIO" => $params['id_formulario'], 
                "ID_SECCION3" => $params['ID_SECCION3'])
            );
    }

    public function validateinitsection(){
     $params = $this->input->get(NULL, TRUE);
     $result = FALSE;

     $paramsGmf['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
     $paramsGmf['ID_VARIABLE'] = $params['ID_VARIABLE'];
     $paramsGmf['VALOR_VARIABLE'] = $params['VALOR_VARIABLE'];

      // var_dump($paramsGmf);

     $result = $this->Maccesorios->setGmfVariable($paramsGmf);

     $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
     $dataElement['ID_SECCION3'] =  $params['ID_SECCION3'];
     $dataElement['PAG_SECCION3'] = 1;
     $resultControl = $this->Maccesorios->updateGmfControl($dataElement);


     $resposeArray = array(
        'status' => $result,
        'mesage' => 'OK',
        'resultControl' => $resultControl,
        'paramsGmf' => $paramsGmf
        );
     $response = json_encode($resposeArray);
     echo $response;
 }


     public function getelements(){
        $params = $this->input->get(NULL, TRUE);
        $elements = $this->Maccesorios->getElements($params);
        $COMPRA = FALSE; $RECIBIDO_PAGO = FALSE; $REGALO = FALSE; $INTERCAMBIO = FALSE;
        $PRODUCIDO = FALSE; $NEGOCIO_PROPIO = FALSE; $OTRA = FALSE;

        foreach ($elements as $key => $value) {
           $active = FALSE;
           if(isset($value['ar2']))
                $active = TRUE;

            if(isset($value['COMPRA']) && $value['COMPRA'] == 1)
                $COMPRA = TRUE;
            
            if(isset($value['RECIBIDO_PAGO']) && $value['RECIBIDO_PAGO'] == 1)
                $RECIBIDO_PAGO = TRUE;
            
            if(isset($value['REGALO']) && $value['REGALO'] == 1)
                $REGALO = TRUE;

            if(isset($value['INTERCAMBIO']) && $value['INTERCAMBIO'] == 1)
                $INTERCAMBIO = TRUE;

            if(isset($value['PRODUCIDO']) && $value['PRODUCIDO'] == 1)
                $PRODUCIDO = TRUE;

            if(isset($value['NEGOCIO_PROPIO']) && $value['NEGOCIO_PROPIO'] == 1)
                $NEGOCIO_PROPIO = TRUE;

            if(isset($value['OTRA']) && $value['OTRA'] == 1)
                $OTRA = TRUE;

        $result[$key] = array(
            'name' => $value['ETIQUETA'],
            'id' =>  $value['ID_ARTICULO3'],
            'value' => $active,
            'ot' => array(
                'COMPRA' => $COMPRA, 
                'RECIBIDO_PAGO' => $RECIBIDO_PAGO,
                'REGALO' => $REGALO,
                'INTERCAMBIO' => $INTERCAMBIO,
                'PRODUCIDO' => $PRODUCIDO,
                'NEGOCIO_PROPIO' => $NEGOCIO_PROPIO,
                'OTRA' => $OTRA
                )
            );

        if($value['COMPRA'] == 1)
            $result[$key]['ot']['COMPRA'] = true;

    }
    $response = json_encode($result);
    print $response;
    }

    public function savesetarticulos(){
        $result = FALSE;
        $params = $this->input->get(NULL, TRUE);
        foreach ($params as $key => $value) {

            if(is_numeric($key)){
                $paramsElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
                $paramsElement['ID_ARTICULO3'] = $value;
                $result = $this->Maccesorios->setArticulos($paramsElement);
            }
        }

        $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
        $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
        $dataElement['PAG_SECCION3'] = 2;
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

        $responseArray = array(
            'result' => $result,
            'control' => $resultControl);

        $response = json_encode($responseArray);

        echo $response;
    }


    public function updatearticulos(){

        $params = $this->input->get(NULL, TRUE);
        

        $paramsElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];


        foreach ($params as $key => $value) {

            if(is_numeric($key)){
                $paramsElement['ID_ARTICULO3'] = $key;

                $jArray = json_decode($value);

                foreach ($jArray as $key => $value) {
                    if($value == true)
                        $paramsElement[$key] = 1;
                }

                    $result = $this->Maccesorios->setArticulos($paramsElement);
            }
        }

        $responseArray = array(
            'result' => $result);

        $response = json_encode($responseArray);

        echo $response;
    }



    /**
     * @author oagarzond
     * @param   Int $pagina Numero de pagina que debe mostrar
     * @since 2016-06-21
     */
    private function mostrarListaArticulos() {
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        //echo "mmm";
        //$data["view"] = $this->submodule . '/form1';
        
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));

        $this->session->set_userdata('id_seccion', $this->idSeccion);
        $data["id_formulario"] = $this->session->userdata("id_formulario");

        $data['secc'] = $this->Modgmfh->listar_secciones(array("id" => $this->idSeccion ));

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

        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
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
        die("Vista 4");
        // Aca va el codigo
        $data["js_dir"] = base_url('js/' . $this->module . '/' . $this->submodule . '/archivo.js');
        $data["view"] = $this->submodule . '/view1';
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
        if(is_array($articulos) && $cant_formas_obt == 0){
            // si selecciona niguna de las anteriores

            if(count($articulos) == 1 && $articulos[0] == "99999999") {
                $fechahoraactual = $this->Modgmfh->consultar_fecha_hora();
                $fechaactual = substr($fechahoraactual, 0, 10);
                $this->Modgmfh->ejecutar_update('ENIG_ADMIN_GMF_CONTROL', array( "ID_ESTADO_SEC" => 2, "FECHA_FIN_SEC" => $fechaactual), array( "ID_FORMULARIO" => $id_formulario, "ID_SECCION3" => $id_seccion));
            }

            $i = 0;
            
            foreach ($articulos as $key => $value) {
                $forma_obt = $this->Modgmfh->listar_articulos_seccion( array("id" => $value, "id_formulario" => $id_formulario) );

                if(count($forma_obt) == 1 && $articulos[0] != "99999999") {
                    $this->Modgmfh->ejecutar_insert('ENIG_FORM_GMF_FORMA_OBTENCION', array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value));
                    $i++;
                }
            }

            if($i > 0)
                echo "Se ha guardado la informaci&oacute;n correctamente!";
            else echo "Se ha presentado un error por favor intenter de nuevo!";
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
                /*$compra = 0;$trabajo = 0;$regalo = 0;$cambio = 0;$hogar = 0;$negocio = 0;$otra = 0;
                if(isset($value['ID_ARTICULO3']['compra']))
                    $compra = 1;
                if(isset($value['ID_ARTICULO3']['recibido_pago']))
                    $trabajo = 1;
                if(isset($value['ID_ARTICULO3']['regalo']))
                    $regalo = 1;
                if(isset($value['ID_ARTICULO3']['intercambio']))
                    $cambio = 1;
                if(isset($value['ID_ARTICULO3']['producido']))
                    $hogar = 1;
                if(isset($value['ID_ARTICULO3']['negocio_propio']))
                    $negocio = 1;
                if(isset($value['ID_ARTICULO3']['otra']))
                $otra = 0;*/

                $codigos = array_keys($_POST[$value['ID_ARTICULO3']]);
                $arrACT = array_fill_keys($codigos, 1);

                $this->Modgmfh->ejecutar_update('ENIG_FORM_GMF_FORMA_OBTENCION', $arrACT, array( "ID_FORMULARIO" => $id_formulario, "ID_ARTICULO3" => $value['ID_ARTICULO3']));
            }
            echo "Se ha guardado la informaci&oacute;n correctamente!";
        }
        else echo "<br>no se hace nada!";


    }
}
//EOC