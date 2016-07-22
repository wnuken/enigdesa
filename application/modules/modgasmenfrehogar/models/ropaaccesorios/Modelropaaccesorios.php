<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para el modulo de gastos menos frecuentes del hogar
 * @author besanabriap
 * @since 2016-07-08
 */

class Modelropaaccesorios extends My_model {
    private $id = "ID_FORMULARIO";
    private $id_formulario;

    public function __construct() {
        parent::__construct();
    }

    public function setGmfVariable($params){
        $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
        $this->db->where('ID_VARIABLE',$params['ID_VARIABLE']); 
        $q = $this->db->get('ENIG_FORM_GMF_VARIABLES');  
        
        if ( $q->num_rows() > 0 ){
            $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
            $this->db->where('ID_VARIABLE',$params['ID_VARIABLE']); 
            $resultInsert = $this->db->update('ENIG_FORM_GMF_VARIABLES',$params);
        }else{
            $resultInsert = $this->db->insert('ENIG_FORM_GMF_VARIABLES', $params);
        }
        
        if($resultInsert === TRUE){
            $result = $resultInsert;
        }else{
            $result = FALSE;
        }

        return $result;
    }


    public function getSecciones($params){
        $keyword = $params['subseccion'];
        $this->db->select('*');
        $this->db->from('ENIG_ADMIN_GMF_CONTROL CRT');
        $this->db->where('CRT.ID_FORMULARIO', $params['ID_FORMULARIO']);
        $this->db->where("CRT.ID_SECCION3 LIKE '%$keyword%'");
        $this->db->join('ENIG_ADMIN_GMF_SECCIONES SEC', 'CRT.ID_SECCION3 = SEC.ID_SECCION3', 'left');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    public function updateGmfControl($params){
        $this->db->where('ID_FORMULARIO', $params['ID_FORMULARIO']);
        $this->db->where('ID_SECCION3', $params['ID_SECCION3']);
        if(isset($params['FECHA_INI_SEC'])){
            $dateIni = $params['FECHA_INI_SEC'];
            unset($params['FECHA_INI_SEC']);
            $this->db->set('FECHA_INI_SEC',"to_date('$dateIni','yyyy/mm/dd')",false);
        }
        if(isset($params['FECHA_FIN_SEC'])){
            $dateEnd = $params['FECHA_FIN_SEC'];
            unset($params['FECHA_FIN_SEC']);
            $this->db->set('FECHA_FIN_SEC',"to_date('$dateEnd','yyyy/mm/dd')",false);
        }       
        $resultUpdate = $this->db->update('ENIG_ADMIN_GMF_CONTROL', $params);

       if($resultUpdate === TRUE){
            $result = $resultUpdate;
        }else{
            $result = FALSE;
        }

        return $result;
    }

    public function getElements($params){
        $this->db->select('ART.ID_ARTICULO3, ART.ETIQUETA, ART.DEFINE_LUGAR_COMPRA, ART.DEFINE_FRECU_COMPRA');
        $this->db->from('ENIG_PARAM_GMF_ARTICULOS ART');
        $this->db->where('ART.ID_SECCION3',$params['ID_SECCION3']);
        // $this->db->join('ENIG_FORM_GMF_FORMA_OBTENCION OBT', 'ART.ID_ARTICULO3 = OBT.ID_ARTICULO3', 'left');
        $this->db->order_by("ORDEN_VISUAL","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getElementsForm($params){
        $this->db->select('OBT.ID_FORMULARIO, OBT.ID_ARTICULO3, OBT.COMPRA, OBT.RECIBIDO_PAGO, OBT.REGALO, OBT.INTERCAMBIO, OBT.PRODUCIDO, OBT.NEGOCIO_PROPIO, OBT.OTRA');
        $this->db->from('ENIG_PARAM_GMF_ARTICULOS ART');
        $this->db->where('ART.ID_SECCION3',$params['ID_SECCION3']);
        $this->db->where('OBT.ID_FORMULARIO',$params['ID_FORMULARIO']);
        $this->db->join('ENIG_FORM_GMF_FORMA_OBTENCION OBT', 'ART.ID_ARTICULO3 = OBT.ID_ARTICULO3', 'left');
        $this->db->order_by("ORDEN_VISUAL","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function setArticulos($params){
        $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
        $this->db->where('ID_ARTICULO3',$params['ID_ARTICULO3']); 
        $q = $this->db->get('ENIG_FORM_GMF_FORMA_OBTENCION');  
        
        if ( $q->num_rows() > 0 ){
            $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
            $this->db->where('ID_ARTICULO3',$params['ID_ARTICULO3']); 
            $resultInsert = $this->db->update('ENIG_FORM_GMF_FORMA_OBTENCION',$params);
        }else{
            $resultInsert = $this->db->insert('ENIG_FORM_GMF_FORMA_OBTENCION', $params);
        }
        
        if($resultInsert === TRUE){
            $result = $resultInsert;
        }else{
            $result = FALSE;
        }

        return $result;
    }


    public function setCompra($params){
        $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
        $this->db->where('ID_ARTICULO3',$params['ID_ARTICULO3']); 
        $q = $this->db->get('ENIG_FORM_GMF_COMPRA');  
        
        if ( $q->num_rows() > 0 ){
            $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
            $this->db->where('ID_ARTICULO3',$params['ID_ARTICULO3']); 
            $resultInsert = $this->db->update('ENIG_FORM_GMF_COMPRA',$params);
        }else{
            $resultInsert = $this->db->insert('ENIG_FORM_GMF_COMPRA', $params);
        }
        
        if($resultInsert === TRUE){
            $result = $resultInsert;
        }else{
            $result = FALSE;
        }

        return $result;
    }

    public function getVariableValue($params){
        $this->db->select('ID_VARIABLE, VALOR_VARIABLE');
        $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
        $this->db->where('ID_VARIABLE',$params['ID_VARIABLE']);
        $this->db->limit(1);
        $query = $this->db->get('ENIG_FORM_GMF_VARIABLES');
        $result = $query->row_array();
        return $result;

    }

    public function setSeccionC($params){
        $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
        $q = $this->db->get('ENIG_FORM_GMF_SERVICIOS');
        
        if ( $q->num_rows() > 0 ){
            $this->db->where('ID_FORMULARIO',$params['ID_FORMULARIO']);
            $resultInsert = $this->db->update('ENIG_FORM_GMF_SERVICIOS',$params);
        }else{
            $resultInsert = $this->db->insert('ENIG_FORM_GMF_SERVICIOS', $params);
        }
        
        if($resultInsert === TRUE){
            $result = $resultInsert;
        }else{
            $result = FALSE;
        }

        return $result;
    }


    


}