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
     * Consulta los datos de los registros de los articulos por seccion
     * @access Public
     * @author 
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function listar_articulos_comprados($id_form, $sec) {
               
        if (!empty($id_form) && !empty($sec)  ) {
            
		echo	$sql = 'SELECT f.id_articulo3 FROM  ENIG_FORM_GMF_FORMA_OBTENCION F
					JOIN  ENIG_PARAM_GMF_ARTICULOS P ON P.id_articulo3 = F.id_articulo3
					WHERE F.id_formulario=$id_form
					AND P.id_seccion3="$sec"
					AND F.compra=1';        
        
		$i=0;
		$data=array();
        $query = $this->db->query($sql);
        if ($query->num_rows()>0){    			
    			foreach($query->result() as $row){
    				$data[$i]["id_articulo3"] = $row->id_articulo3;
    				$i++;		
    			}		
    		}
		
        $this->db->close();
        return $data;
		}
    }
    
    
    
}
//EOC