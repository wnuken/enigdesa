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

    public function getGmfVariable($params){
        $this->db->select('ID_FORMULARIO, VALOR_VARIABLE');
        $this->db->where('ID_VARIABLE',$params['ID_VARIABLE']);
        $this->db->limit(1);
        $query = $this->db->get('ENIG_FORM_GMF_VARIABLES');
        $result = $query->row_array();
        return $result['VALOR_VARIABLE'];
    }

    public function setGmfVariable($params){
    	$resultInsert = $this->db->insert('ENIG_FORM_GMF_VARIABLES', $params);

       if($resultInsert === TRUE){
            $result = $resultInsert;
        }else{
            $result = FALSE;
        }

        return $result;
    }

    public function updateGmfVariable($params){
        $this->db->where('ID_VARIABLE', $params['ID_VARIABLE']);
        $resultUpdate = $this->db->update('ENIG_FORM_GMF_VARIABLES', $params);

       if($resultUpdate === TRUE){
            $result = $resultUpdate;
        }else{
            $result = FALSE;
        }

        return $result;
    }


    public function updateGmfControl($params){
        $this->db->where('ID_SECCION3', $params['ID_SECCION3']);
        $resultUpdate = $this->db->update('ENIG_ADMIN_GMF_CONTROL', $params);

       if($resultUpdate === TRUE){
            $result = $resultUpdate;
        }else{
            $result = FALSE;
        }

        return $result;
    }


    public function getElements($params){
        $this->db->select('ar.ID_ARTICULO3, ar.ETIQUETA, fo.ID_ARTICULO3 AS ar2');
        $this->db->from('ENIG_PARAM_GMF_ARTICULOS ar');
        $this->db->where('ID_SECCION3',$params['ID_SECCION3']);
        $this->db->join('ENIG_FORM_GMF_FORMA_OBTENCION fo', 'ar.ID_ARTICULO3 = fo.ID_ARTICULO3', 'left');
        $this->db->order_by("ORDEN_VISUAL","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function setArticulos($params){

        $this->db->where('ID_ARTICULO3',$params['ID_ARTICULO3']); 
        $q = $this->db->get('ENIG_FORM_GMF_FORMA_OBTENCION');  
        
        if ( $q->num_rows() > 0 ){
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


}