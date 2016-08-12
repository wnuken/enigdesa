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
        $this->idFormulario = '';
        $this->load->model(array("formulario/Mformulario", "control/Modmenu", "Modgmfh"));
        $this->load->model("/ropaaccesorios/Modelropaaccesorios", "Maccesorios");
    }

    public function index() {
        $dataElement["id_formulario"] = $this->session->userdata("id_formulario");
        if (empty($dataElement["id_formulario"])) {
            redirect('/');
            return false;
        }

        $this->idFormulario = $this->session->userdata("id_formulario");
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

            $paramsInscripcion['ID_FORMULARIO'] = $this->idFormulario;
            $resultInscripcion = $this->Maccesorios->getInscripcion($paramsInscripcion);

            /* echo '<pre>';
            print_r($resultInscripcion);
            echo "</pre>";*/

            if(is_array($validateControl)){
                foreach ($validateControl as $key => $section) {

                 if($section['ID_SECCION3'] == 'D6'){
                    $this->idSubModulo = 'E';
                    $section['PAG_SECCION3'] = 1;
                }


                if($section['ID_SECCION3'] == 'D1'){
                    $data['TITULO4'] = 'De ' . $resultInscripcion['ULTIMOS3M'] . ', ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para HOMBRE?';
                    $data['TITULO5'] = 'De la siguiente lista de artículos y servicios indique aquellos que usted o algún miembro del hogar compró, adquirió o le regalaron durante los últimos tres meses de ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De las prendas de vestir para HOMBRE elegidas, responda la siguiente información:';
                }
                if($section['ID_SECCION3'] == 'D2'){
                    $data['TITULO4'] = 'De ' . $resultInscripcion['ULTIMOS3M'] . ', ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para MUJER?';
                    $data['TITULO5'] = 'De la siguiente lista de prendas de vestir para MUJER, indique aquellas que usted o algún miembro del hogar compró, adquirió o le regalaron durante ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De las prendas de vestir para MUJER elegidas, responda la siguiente información:';
                }
                if($section['ID_SECCION3'] == 'D3'){
                    $data['TITULO4'] = 'De ' . $resultInscripcion['ULTIMOS3M'] . ', ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para NIÑO?';
                    $data['TITULO5'] = 'De la siguiente lista de prendas de vestir para NIÑO, indique aquellas que usted o algún miembro del hogar compró, adquirió o le regalaron durante ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De las prendas de vestir para NIÑO elegidas, responda la siguiente información:';
                }
                if($section['ID_SECCION3'] == 'D4'){
                    $data['TITULO4'] = 'De ' . $resultInscripcion['ULTIMOS3M'] . ', ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para NIÑA?';
                    $data['TITULO5'] = 'De la siguiente lista de prendas de vestir para NIÑA, indique aquellas que usted o algún miembro del hogar compró, adquirió o le regalaron durante ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De las prendas de vestir para NIÑA elegidas, responda lo siguiente:';
                }
                if($section['ID_SECCION3'] == 'D5'){
                    $data['TITULO4'] = 'De ' . $resultInscripcion['ULTIMOS3M'] . ', ¿usted o algún miembro del hogar compró, adquirió o le regalaron prendas de vestir o calzado para BEBÉ?';
                    $data['TITULO5'] = 'De la siguiente lista de prendas de vestir para BEBÉ, indique aquellas que usted o algún miembro del hogar compró, adquirió o le regalaron durante ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De las prendas de vestir para BEBÉ elegidas, responda lo siguiente:';
                }
                if($section['ID_SECCION3'] == 'D6'){
                    $data['TITULO5'] = 'De la siguiente lista de artículos y servicios, indique aquellas que usted o algún miembro del hogar compró, adquirió o le regalaron durante ' . $resultInscripcion['ULTIMOS3M'] . ':';
                    $data['TITULO6'] = 'De la lista de artículos y servicios elegidos, responda lo siguiente:';
                }

                if($section['ID_ESTADO_SEC'] < 2 && $section['ID_SECCION3'] != ($this->idSubModulo . '0')){
                    $data['pageSection'] = $section['PAG_SECCION3'];
                    $data['idSection'] = $section['ID_SECCION3'];
                    $data['section'] = $this->idSubModulo;
                    $data['TITULO1'] = $section['TITULO1'];
                    $data['TITULO2'] = $section['TITULO2'];
                    $data['TITULO3'] = $section['TITULO3'];
                    $data['TEMPORALIDAD'] = $section['TEMPORALIDAD'];
                    $data['idVariable'] = $section['ID_VARIABLE_VP'];
                    $data['MEDIO_PAGO'] = $section['ID_VARIABLE_MEDIO_PAGO'];
                    $data['MEDIO_CUAL'] = $section['ID_VARIABLE_OTRO_PAGO'];
                    $data['EPSS'] = $section['ID_VARIABLE_VP2'];
                    $data['EPSS_CUAL'] = $section['ID_VARIABLE_LC'];
                    $data['RECIBIDO_PAGO'] = $section['ID_VARIABLE_TRABAJO'];
                    $data['REGALO'] = $section['ID_VARIABLE_REGALO'];
                    $data['INTERCAMBIO'] = $section['ID_VARIABLE_INTERCAMBIO'];
                    $data['PRODUCIDO'] = $section['ID_VARIABLE_PRODUCIDO'];
                    $data['NEGOCIO_PROPIO'] = $section['ID_VARIABLE_NEGOCIO'];
                    $data['OTRA'] = $section['ID_VARIABLE_OTRA'];
                    $data['LOGO'] = $section['LOGO'];
                    $data["view"]="sectionsDEF/form1";
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
    $params['subseccion'] = $this->idSubModulo;
    $params['ID_FORMULARIO'] = $this->idFormulario;
    $result = $this->Maccesorios->getSecciones($params);
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
   $dataElement['FECHA_INI_SEC'] = date('Y/m/d', strtotime('now'));
   $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
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
    $elementsForm = $this->Maccesorios->getElementsForm($params);
    $COMPRA = FALSE; $RECIBIDO_PAGO = FALSE; $REGALO = FALSE; $INTERCAMBIO = FALSE;
    $PRODUCIDO = FALSE; $NEGOCIO_PROPIO = FALSE; $OTRA = FALSE;
    $OT = array();

    foreach ($elements as $key => $value) {
       $result[$key] = array(
        'name' => $value['ETIQUETA'],
        'id' =>  $value['ID_ARTICULO3'],
        'value' => FALSE,
        'DEFINE_LUGAR_COMPRA' => $value['DEFINE_LUGAR_COMPRA'],
        'DEFINE_FRECU_COMPRA' => $value['DEFINE_FRECU_COMPRA'],
        'ot' => ''
        );

       foreach ($elementsForm as $key1 => $value1) {
        if($value['ID_ARTICULO3'] == $value1['ID_ARTICULO3']){
            $result[$key]['value'] = TRUE;
            $result[$key]['ot']['COMPRA'] = intval($value1['COMPRA']);
            $result[$key]['ot']['RECIBIDO_PAGO'] = intval($value1['RECIBIDO_PAGO']);
            $result[$key]['ot']['REGALO'] = intval($value1['REGALO']);
            $result[$key]['ot']['INTERCAMBIO'] = intval($value1['INTERCAMBIO']);
            $result[$key]['ot']['PRODUCIDO'] = intval($value1['PRODUCIDO']);
            $result[$key]['ot']['NEGOCIO_PROPIO'] = intval($value1['NEGOCIO_PROPIO']);
            $result[$key]['ot']['OTRA'] = intval($value1['OTRA']);
        }
    }


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
    $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
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
                if($value == 1){
                    $paramsElement[$key] = $value;
                }else{
                    $paramsElement[$key] = NULL;
                }
            }

            $result = $this->Maccesorios->setArticulos($paramsElement);
        }
    }

    $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
    $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
    $dataElement['PAG_SECCION3'] = $params['PAG_SECCION3'];
    $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
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

    $madioPago = json_decode($params['MEDIO_PAGO']);

    foreach ($madioPago as $key => $value) {
        $paramsVariable['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
        $paramsVariable['ID_VARIABLE'] = $key;
        $paramsVariable['VALOR_VARIABLE'] = $value;
        $resultVariables[$key] = $this->Maccesorios->setGmfVariable($paramsVariable);
    }

    $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
    $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
    $dataElement['PAG_SECCION3'] = 4;
    $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
    $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

    $responseArray = array(
        'result' => $result,
        'variables' => $resultVariables,
        'control' => $resultControl
        );

    $response = json_encode($responseArray);

    echo $response;


}

public function updateotros(){
    $params = $this->input->get(NULL, TRUE);

    $OTRA_PAGO = array();
    $resultVariables = array();
    $dataElement['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
    $dataElement['ID_SECCION3'] = $params['ID_SECCION3'];
    $dataElement['ID_ESTADO_SEC'] = 2;
    $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
    $resultControl = $this->Maccesorios->updateGmfControl($dataElement);

    if($params['ID_SECCION3'] == 'D6' || $params['ID_SECCION3'] == 'E2' || $params['ID_SECCION3'] == 'F3'){
        $dataElement['ID_SECCION3'] = $this->idSubModulo . '0';
        $dataElement['ID_ESTADO_SEC'] = 2;
        $dataElement['FECHA_FIN_SEC'] = date('Y/m/d', strtotime('now'));
        $resultControl = $this->Maccesorios->updateGmfControl($dataElement);
    }

    if(isset($params['OTRA_PAGO'])){
        $OTRA_PAGO = json_decode($params['OTRA_PAGO'], TRUE);
    }
    
    $dataFormas['ID_FORMULARIO'] = $params['ID_FORMULARIO'];
    
    foreach ($OTRA_PAGO as $key => $articulo3) {
        $dataFormas['ID_ARTICULO3'] = $key;
        foreach ($articulo3 as $key1 => $value) {
            $dataFormas['ID_VARIABLE'] = $key1;
            $dataFormas['VALOR_ESTIMADO'] = $value;
            if($value === FALSE){
                $dataFormas['VALOR_ESTIMADO'] = 99;
            }
            
            $resultVariables[] = $this->Maccesorios->setFormasPago($dataFormas);
        }
    }

    $responseArray = array(
        'result' => TRUE,
        'variables' => $resultVariables,
        'control' => $resultControl
        );

    $response = json_encode($responseArray);

    echo $response;


}

}
//EOC