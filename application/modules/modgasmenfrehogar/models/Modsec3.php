<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para la sección 3 - artículo o servicio COMPRADO o PAGADO
 * @author hhchavezv
 * @since 2016-07-05
 */

class Modsec3 extends My_model {

    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * Consulta los articulos en los que en la sección 2 respondieron opción "Compra o pago"
     * @access Public
     * @author hhchavezv
     * @param  $id_form: id del formulario
	 * @param  $submod: submódulo que está diligenciando (ej: C1 )
     * @return Array    $data:Registros devueltos por la consulta
     */
    public function listar_articulos_comprados($id_form, $submod) {
               
        if (!empty($id_form) && !empty($submod)  ) {
            
			$sql = "SELECT  F.ID_ARTICULO3, P.ETIQUETA , P.DEFINE_LUGAR_COMPRA, P.DEFINE_FRECU_COMPRA
					FROM  ENIG_FORM_GMF_FORMA_OBTENCION F
					JOIN  ENIG_PARAM_GMF_ARTICULOS P ON P.ID_ARTICULO3 = F.ID_ARTICULO3
					WHERE F.ID_FORMULARIO='$id_form'
					AND P.ID_SECCION3='$submod'
					AND F.COMPRA=1
					ORDER BY P.ORDEN_VISUAL";        
        
		$i=0;
		$data=array();
        $query = $this->db->query($sql);
        if ($query->num_rows()>0){    			
    			foreach($query->result() as $row){
    				$data[$i]["ID_ARTICULO3"] = $row->ID_ARTICULO3;
					$data[$i]["ETIQUETA"] = $row->ETIQUETA;
					$data[$i]["DEFINE_LUGAR_COMPRA"] = $row->DEFINE_LUGAR_COMPRA;
					$data[$i]["DEFINE_FRECU_COMPRA"] = $row->DEFINE_FRECU_COMPRA;
    				$i++;		
    			}		
    		}
		
        $this->db->close();
        return $data;
		}
    }
	/**
     * Consulta los tipos de medios de pago
     * @access Public
     * @author hhchavezv
     * @return Array    $data:Registros devueltos por la consulta
     */
    public function listar_medios_pago() {               
       
		$data[1]["id"]= "1";
		$data[1]["nombre"]= "Tarjeta d&eacute;bito";
		$data[2]["id"]= "2";
		$data[2]["nombre"]= "Tarjeta cr&eacute;dito";
		$data[3]["id"]= "3";
		$data[3]["nombre"]= "Efectivo";
		$data[4]["id"]= "4";
		$data[4]["nombre"]= "Bonos";
		$data[5]["id"]= "5";
		$data[5]["nombre"]= "Cheques";
		$data[6]["id"]= "6";
		$data[6]["nombre"]= "Otro";
		return $data;
	}
    
    
    
}
//EOC