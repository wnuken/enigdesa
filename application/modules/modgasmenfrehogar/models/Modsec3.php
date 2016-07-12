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
     * @author hhchavezv
	 * @param   array $datos:datos a guardar en BD
	 * @return bool : true si guarda y realiza commit a transaccion
     */
    public function guardaForm3($datos) 
	{               
       $result=false;
		foreach($datos as $nombre_campo => $valor){
	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}
		
		// Hace barrido en tabla articulos
		if($hdd_nro_articulos >0)//verifica q hayan articulos en la tabla
    	{
    		// Inicia transaccion
			$this->db->trans_start();
			

			for ($i = 0; $i < $hdd_nro_articulos; $i++) 
			{
    			
    			$asignacion = "\$articulo=\$hdd_articulo_".$i.";";
   				eval($asignacion);
   				   				
   				$asignacion = "isset(\$txt_valor_".$i.")?\$pago=\$txt_valor_".$i.":\$pago=NULL;";
   				eval($asignacion);
				//Asigna 99 a pago si existe check no recuerda ( es decir esta checkeado)
				$asignacion = "isset(\$chk_no_recuerda_".$i.")?\$pago=99:'';";
   				eval($asignacion);
				
				$asignacion = "isset(\$sel_lugar_".$i.")?( (\$sel_lugar_".$i."=='' || \$sel_lugar_".$i."=='-')?\$lugar=NULL:\$lugar=\$sel_lugar_".$i." ): \$lugar=NULL; ";
				eval($asignacion);
				$asignacion = "isset(\$sel_frec_".$i.")?( (\$sel_frec_".$i."=='' || \$sel_frec_".$i."=='-')?\$frec=NULL:\$frec=\$sel_frec_".$i." ): \$frec=NULL; ";
				eval($asignacion);
				
				/*$arrValores["ID_FORMULARIO"]=$ID_FORMULARIO;
				$arrValores["ID_ARTICULO3"]=$articulo;
				$arrValores["VALOR_PAGADO"]=$pago;
				$arrValores["LUGAR_COMPRA"]=$lugar;
				$arrValores["FRECUENCIA_COMPRA"]=$frec;
				$res=$this->ejecutar_insert("ENIG_FORM_GMF_COMPRA", $arrValores) ;
				if($res!=1)
					echo "ERROR: al guardar un artículo";
				*/	
				$sql="INSERT INTO ENIG_FORM_GMF_COMPRA (ID_FORMULARIO,ID_ARTICULO3,VALOR_PAGADO,LUGAR_COMPRA,FRECUENCIA_COMPRA) 
				VALUES ('$ID_FORMULARIO', '$articulo', '$pago', '$lugar', '$frec') ";
				
				$query = $this->db->query($sql);
				if (!$query){
						echo "ERROR: al guardar un artículo";
					}	
    		}

			//Trae nemotecnia de variables a guardar
			$sql_vars = "SELECT ID_VARIABLE_TOTAL_PAGO1, ID_VARIABLE_MEDIO_PAGO, ID_VARIABLE_OTRO_PAGO
						FROM ENIG_ADMIN_GMF_SECCIONES 
						WHERE ID_SECCION3='$hdd_sec' ";        
			$query_vars = $this->db->query($sql_vars);
			
			// TOTAL PAGADO
			if ( isset($txt_total) )
			{        
				$nom_var="";
				if ($query_vars->num_rows()>0){
						$row=$query_vars->row();
						$nom_var=$row->ID_VARIABLE_TOTAL_PAGO1;
					
					$sql2="INSERT INTO ENIG_FORM_GMF_VARIABLES (ID_FORMULARIO,ID_VARIABLE,VALOR_VARIABLE) 
					VALUES ('$ID_FORMULARIO', '$nom_var', '$txt_total') ";
					$query = $this->db->query($sql2);
					if (!$query){
						echo "ERROR: al guardar una variable";
					}	
					
				}else
				{
					echo "ERROR: No existe la variable";
				}
			}
			//MEDIO DE PAGO
			if ( isset($sel_medio_pago) && ($sel_medio_pago!="" && $sel_medio_pago!="-"))
			{	        
				$nom_var="";
				if ($query_vars->num_rows()>0){
						$row=$query_vars->row();
						$nom_var=$row->ID_VARIABLE_MEDIO_PAGO;
					
					/*
					//Inserta valor 	
					$arrVal1["ID_FORMULARIO"]=$ID_FORMULARIO;
					$arrVal1["ID_VARIABLE"]=$nom_var;
					$arrVal1["VALOR_VARIABLE"]=$sel_medio_pago;	
					
					$res=$this->ejecutar_insert("ENIG_FORM_GMF_VARIABLES", $arrVal1) ;
					if($res!=1)
					echo "ERROR: al guardar una variable";
					*/
					$sql2="INSERT INTO ENIG_FORM_GMF_VARIABLES (ID_FORMULARIO,ID_VARIABLE,VALOR_VARIABLE) 
					VALUES ('$ID_FORMULARIO', '$nom_var', '$sel_medio_pago') ";
					$query = $this->db->query($sql2);
					if (!$query){
						echo "ERROR: al guardar una variable";
					}	
					
				}else
				{
					echo "ERROR: No existe la variable";
				}
			}
			
			//CUAL OTRO MEDIO DE PAGO
			if ( isset($txt_otro_medio_pago) )
			{	        
				$nom_var="";
				if ($query_vars->num_rows()>0){
						$row=$query_vars->row();
						$nom_var=$row->ID_VARIABLE_OTRO_PAGO;
					
					/*
					//Inserta valor 	
					$arrVal2["ID_FORMULARIO"]=$ID_FORMULARIO;
					$arrVal2["ID_VARIABLE"]=$nom_var;
					$arrVal2["VALOR_VARIABLE"]=$txt_otro_medio_pago;	
					
					$res=$this->ejecutar_insert("ENIG_FORM_GMF_VARIABLES", $arrVal2) ;
					if($res!=1)
					echo "ERROR: al guardar una variable";
					*/
					$sql2="INSERT INTO ENIG_FORM_GMF_VARIABLES (ID_FORMULARIO,ID_VARIABLE,VALOR_VARIABLE) 
					VALUES ('$ID_FORMULARIO', '$nom_var', '$txt_otro_medio_pago') ";
					$query = $this->db->query($sql2);
					if (!$query){
						echo "ERROR: al guardar una variable";
					}
				}else
				{
					echo "ERROR: No existe la variable";
				}
			}
							
			// Fin de transaccion
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				echo "ERROR al guardar. Intente nuevamente o actualice la p&aacute;gina.";
				$result=false;
			}
			else
			{
				$result=true;
			}
			
		}//if
		return $result;
	}
	
	/**
     * Actualiza la página en tabla de control
     * @access Public
     * @author hhchavezv
	 * @param  $id_form: id del formulario
	 * @param  $id_seccion: submódulo que está diligenciando (ej: C1 )
	 * @param  $pagina: número de página siguiente para diligenciar
     * @return Bool =1 dependiendo de si se realizo correctamente la operación o no
     */
    public function actualizaPaginaControl($id_form, $id_seccion,$pagina) 
	{               
		$arrValores["PAG_SECCION3"]=$pagina;
		
		$arrWhere["ID_FORMULARIO"]=$id_form;
		$arrWhere["ID_SECCION3"]=$id_seccion;
		
		$res=$this->ejecutar_update("ENIG_ADMIN_GMF_CONTROL", $arrValores, $arrWhere);
		if(!$res)
			echo "ERROR al actualizar página en Control.";	
		return $res;
	}
	
	/**
     * consulta si la sección tiene la variable de medio de pago
     * @access Public
     * @author hhchavezv
	 * @param  $id_seccion: submódulo que está diligenciando (ej: C1 )
	 * @return Bool =true dependiendo de si se realizo correctamente la operación o no
     */
    public function habilitaPreguntaMedioPago($id_seccion) 
	{               
		$sql = "SELECT ID_VARIABLE_MEDIO_PAGO
				FROM ENIG_ADMIN_GMF_SECCIONES 
				WHERE ID_SECCION3='$id_seccion' ";        
		$existe=false;
		$query = $this->db->query($sql);
		if ($query->num_rows()>0){
			$row=$query->row();
			$nom_var=$row->ID_VARIABLE_MEDIO_PAGO;
			//echo "nom=".$nom_var;
			if( $nom_var === NULL )
				$existe=false;
			else
				$existe=true;
		}
		return $existe;
	}	
}
//EOC