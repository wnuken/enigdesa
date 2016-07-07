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
    
	/**
     * Guarda formulario de pagina 3 - artículo o servicio COMPRADO o PAGADO
     * @access Public
     * @author hhchavezv
     */
    public function guardaForm3($datos) 
	{               
       
		foreach($datos as $nombre_campo => $valor){
	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}
			
    	
		isset($sel_medio_pago)?( ($sel_medio_pago=="" || $sel_medio_pago=="-")?$sel_medio_pago=NULL:$sel_medio_pago ): $sel_medio_pago=NULL;
		isset($txt_otro_medio_pago)? $txt_otro_medio_pago: $txt_otro_medio_pago=NULL;
		
		// Hace barrido en tabla articulos
		if($hdd_nro_articulos >0)//verifica q hayan articulos en la tabla
    	{
    		for ($i = 0; $i < $hdd_nro_articulos; $i++) 
			{
    			
    			$asignacion = "\$articulo=\$hdd_articulo_".$i.";";
   				eval($asignacion);
   				   				
   				$asignacion = "isset(\$txt_valor_".$i.")?\$pago=\$txt_valor_".$i.":\$pago=NULL;";
   				eval($asignacion);
				//Asigna 99 a pago si existe check no recuerda ( es decir esta checkeado)
				$asignacion = "isset(\$chk_no_recuerda_".$i.")?\$pago=99:\$pago=NULL;";
   				eval($asignacion);
				
				$asignacion = "isset($sel_lugar_".$i.")?( ($$sel_lugar_".$i."=='' || $$sel_lugar_".$i."=='-')?$lugar=NULL:$lugar=$sel_lugar_".$i." ): $lugar=NULL; ";
				eval($asignacion);
				/*
   				$asignacion = "isset(\$S15P163_".$i.")?\$v163=\$S15P163_".$i.":\$v163=NULL;";
   				eval($asignacion);
   				$asignacion = "isset(\$S15P164A_".$i.")?\$v164A=\$S15P164A_".$i.":\$v164A=NULL;";
   				eval($asignacion);
   				$asignacion = "isset(\$S15P164B_".$i.")?\$v164B=\$S15P164B_".$i.":\$v164B=NULL;";
   				eval($asignacion);
   				$asignacion = "isset(\$S15P164C_".$i.")?\$v164C=\$S15P164C_".$i.":\$v164C=NULL;";
   				eval($asignacion);
   				$asignacion = "isset(\$S15P164D_".$i.")?\$v164D=\$S15P164D_".$i.":\$v164D=NULL;";
   				eval($asignacion);
    			
	    		$data_viv = array('numform' => $numform,
	    	              'S15P159' => $v159,
	    				  'S15P160' => $v160,
				  		  'S15P161' => $v161,
	    				  'S15P162'=>$v162,
						  'S15P163'=>$v163,
						  'S15P164A'=>$v164A,
						  'S15P164B'=>$v164B,
						  'S15P164C'=>$v164C,
	    				  'S15P164D'=>$v164D
		    	);
		    	//print_r($data_viv);
				$this->db->insert('cna_form_seccion_15a_viviendas', $data_viv);
				if($this->db->affected_rows() > 0){
	    				$retorno = true;
	    			}
	    			else{
	    				$retorno = false;
	    			}
				*/
    		}
    	}
	}
}
//EOC