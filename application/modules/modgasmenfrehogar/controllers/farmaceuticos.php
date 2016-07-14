<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el submodulo de gastos en recreacion, diversion, cultura y viajes
 * @author oagarzond
 * @since 2016-06-20
 */
class Farmaceuticos extends MX_Controller {

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
        $this->idSubModulo = 'F';
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





          /*  echo '<pre>';
            print_r($initControl);

            echo "</pre>";*/

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
                    if($section['PAG_SECCION3'] == 0)
                        $section['PAG_SECCION3'] = 1;
            
                    if($section['ID_ESTADO_SEC'] < 2 && $section['ID_SECCION3'] != ($this->idSubModulo . '0')){
                        $data['pageSection'] = $section['PAG_SECCION3'];
                        $data['idSection'] = $section['ID_SECCION3'];
                        $data['section'] = $this->idSubModulo;
                        $data['TITULO1'] = $section['TITULO1'];
                        $data['TITULO2'] = $section['TITULO2'];
                        $data['TITULO3'] = $section['TITULO3'];
                        $data['TEMPORALIDAD'] = $section['TEMPORALIDAD'];
                        $data['idVariable'] = $section['ID_VARIABLE_VP'];
                        $data['LOGO'] = $section['LOGO'];
                        $data["view"]="ropaaccesorios/form1";
                        $this->load->view("layout", $data);
                        return false;
                    }
                }
            }





            
        }else{
            redirect('modgasmenfrehogar/');
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
     if($params['VALOR_VARIABLE'] == 2)
        $dataElement['ID_ESTADO_SEC'] = 2;
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
            'DEFINE_LUGAR_COMPRA' => $value['DEFINE_LUGAR_COMPRA'],
            'DEFINE_FRECU_COMPRA' => $value['DEFINE_FRECU_COMPRA'],
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
            'control' => $resultControl
            );

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

        $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
        $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
        $dataElement['PAG_SECCION3'] = 3;
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

        $responseArray = array(
            'result' => $result,
            'control' => $resultControl
            );

        $response = json_encode($responseArray);

        echo $response;
    }


    public function updatecompra(){
        $params = $this->input->get(NULL, TRUE);

        $paramsElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];

        foreach ($params as $key => $value) {

            if(is_numeric($key)){
                $paramsElement['ID_ARTICULO3'] = $key;

                $jArray = json_decode($value);

                foreach ($jArray as $key => $value) {
                    if($value == true)
                        $paramsElement[$key] = $value;
                }
                    if(isset($paramsElement['VALOR_PAGADO1'])){
                        $paramsElement['VALOR_PAGADO'] = 99;
                        unset($paramsElement['VALOR_PAGADO1']);
                    }
                    
                   $result = $this->Maccesorios->setCompra($paramsElement);
            }
        }

        $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
        $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
        $dataElement['PAG_SECCION3'] = 4;
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

        $responseArray = array(
            'result' => $result,
            'control' => $resultControl
            );

        $response = json_encode($responseArray);

        echo $response;


    }

    public function updateotros(){
            $params = $this->input->get(NULL, TRUE);

        $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
        $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
        $dataElement['ID_ESTADO_SEC'] = 2;
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

        if($params['ID_SECCION3'] == 'F3'){
        $dataElement['ID_SECCION3'] = $this->idSubModulo . '0';
        $dataElement['ID_ESTADO_SEC'] = 2;
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);
    }


    }

}
//EOC