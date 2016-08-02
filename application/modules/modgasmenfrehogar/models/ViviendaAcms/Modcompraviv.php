<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para la pagina C14.CompraAdecuaciónVivnda_Año del Modulo C. GASTOS EN ALQUILER, COMBUSTIBLES, MANTENIMIENTO Y SERVICIOS DE LA VIVIENDA
 * @author hhchavezv
 * @since 2016-08-01
 */

class Modcompraviv extends My_model {

    public function __construct() {
        parent::__construct();
    }
   
    
	/**
     * Guarda formulario de pagina C14.CompraAdecuaciónVivnda_Año
     * @access Public
     * @author hhchavezv
     */
    public function guardaCompraViv($datos) 
	{               
       $result=false;
		foreach($datos as $nombre_campo => $valor){
	    	
	  			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
	   			eval($asignacion);
			}
		
//		pr($datos);exit;
		// Hace barrido en tabla articulos
		
    		// Inicia transaccion
			$this->db->trans_start();
   			   				   			
			$asignacion = "!isset(\$p10305)? \$p10305=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10305s1)? \$p10305s1=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp10305s1)?\$p10305s1=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10306s1)? \$p10306s1=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10306s1a1)? \$p10306s1a1=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp10306s1a1)?\$p10306s1a1=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10306s2)? \$p10306s2=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10306s2a1)? \$p10306s2a1=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp10306s2a1)?\$p10306s2a1=99:'';";
   			eval($asignacion);
						
			$asignacion = "!isset(\$p10307)? \$p10307=NULL:'';";
   			eval($asignacion);
			
			/****si se cambia  radio p10309 por varios checks*****/
			$asignacion = "!isset(\$p10309s1)? \$p10309s1=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10309s2)? \$p10309s2=NULL:'';";
   			eval($asignacion);
			   			
			$asignacion = "isset(\$p10309s2a1)?( (\$p10309s2a1=='' || \$p10309s2a1=='-')?\$p10309s2a1=NULL:\$p10309s2a1=\$p10309s2a1 ): \$p10309s2a1=NULL; ";
			eval($asignacion);
			
			$asignacion = "!isset(\$p10309s3)? \$p10309s3=NULL:'';";
   			eval($asignacion);
			$asignacion = "isset(\$p10309s3a1)?( (\$p10309s3a1=='' || \$p10309s3a1=='-')?\$p10309s3a1=NULL:\$p10309s3a1=\$p10309s3a1 ): \$p10309s3a1=NULL; ";
   			eval($asignacion);
			$asignacion = "!isset(\$p10309s4)? \$p10309s4=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p10309s5)? \$p10309s5=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p10309s6)? \$p10309s6=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p10309s5a1)? \$p10309s5a1=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p5161s1c14)? \$p5161s1c14=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s1a1c14)? \$p5161s1a1c14=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s1a3c14)? \$p5161s1a3c14=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp5161s1a3c14)?\$p5161s1a3c14=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s1a2c14)? \$p5161s1a2c14=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s1a4c14)? \$p5161s1a4c14=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp5161s1a4c14)?\$p5161s1a4c14=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s2c14)? \$p5161s2c14=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p5161s2a1c14)? \$p5161s2a1c14=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s2a3c14)? \$p5161s2a3c14=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp5161s2a3c14)?\$p5161s2a3c14=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s2a2c14)? \$p5161s2a2c14=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p5161s2a4c14)? \$p5161s2a4c14=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp5161s2a4c14)?\$p5161s2a4c14=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p10312)? \$p10312=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$P10312S1)? \$P10312S1=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp10312s1)?\$P10312S1=99:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p8697s1)? \$p8697s1=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s2)? \$p8697s2=NULL:'';";
   			eval($asignacion);
			$asignacion = "isset(\$p8697s2a1)?( (\$p8697s2a1=='' || \$p8697s2a1=='-')?\$p8697s2a1=NULL:\$p8697s2a1=\$p8697s2a1 ): \$p8697s2a1=NULL; ";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s3)? \$p8697s3=NULL:'';";
   			eval($asignacion);
			$asignacion = "isset(\$p8697s3a1)?( (\$p8697s3a1=='' || \$p8697s3a1=='-')?\$p8697s3a1=NULL:\$p8697s3a1=\$p8697s3a1 ): \$p8697s3a1=NULL; ";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s4)? \$p8697s4=NULL:'';";
   			eval($asignacion);
			
			
			//--- dudas en pregunta P8697S4 , P8697S4A1 y dependientes
			$asignacion = "!isset(\$P8697S4A1)? \$P8697S4A1=NULL:'';";
   			eval($asignacion);
			//Asigna 99 a pago si existe radio ( es decir esta checkeado)
			$asignacion = "isset(\$radp8697s4a5)?\$P8697S4A1=99:'';";
   			eval($asignacion);
			// p8697s4a4 en vista, corresponde a P8697S4A1 ???
			//---
			
			$asignacion = "!isset(\$p8697S4A2)? \$p8697S4A2=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s4a3)? \$p8697s4a3=NULL:'';";
   			eval($asignacion);
			
			$asignacion = "!isset(\$p8697s5)? \$p8697s5=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s6)? \$p8697s6=NULL:'';";
   			eval($asignacion);
			$asignacion = "!isset(\$p8697s6a1)? \$p8697s6a1=NULL:'';";
   			eval($asignacion);			
			/*****************************************************/
			
			$sql="INSERT INTO ENIG_FORM_GMF_COMPRA_VIV 
			VALUES ('$ID_FORMULARIO', '$p10305','$p10305s1','$p10306s1','$p10306s1a1','$p10306s2','$p10306s2a1','$p10307','$p10309s1',
			'$p10309s2','$p10309s2a1','$p10309s3','$p10309s3a1','$p10309s4','$p10309s5','$p10309s6','$p10309s5a1',
			'$p5161s1c14','$p5161s1a1c14','$p5161s1a3c14','$p5161s1a2c14','$p5161s1a4c14','$p5161s2c14','$p5161s2a1c14','$p5161s2a3c14',
			'$p5161s2a2c14','$p5161s2a4c14','$p10312','$p10312s1','$p8697s1','$p8697s2','$p8697s2a1','$p8697s3','$p8697s3a1',
			'$p8697s4','$P8697S4A1',    '$p8697S4A2','$p8697s4a3','$p8697s5','$p8697s6','$p8697s6a1') ";
			
			/*Pruebas
			1- todo en si, con cantidades y un 99 - OK
			2 - todo en no -
			1- todo en si, con cantidades en 99- 
			*/
			
			/*
			INSERT INTO ENIG_FORM_GMF_COMPRA_VIV (ID_FORMULARIO,P10305,P10305S1,P10306S1,P10306S1A1,P10306S2,P10306S2A1,P10307, 
			,P10309S1 ,P10309S2 ,P10309S2A1  ,P10309S3 ,P10309S3A1  ,P10309S4 ,P10309S5 ,P10309S6 ,P10309S5A1  ,P5161S1C14  ,P5161S1A1C14 ,P5161S1A3C14 ,P5161S1A2C14
			,P5161S2C14 ,P5161S2A1C14 ,P5161S2A3C14 ,P5161S2A2C14 ,P5161S2A4C14 ,P10312  ,P10312S1 ,P8697S1  ,P8697S2  ,P8697S2A1  ,P8697S3  ,P8697S3A1  ,P8697S4 
				,P8697S4A1 
				,P8697S4A2 
				,P8697S4A3 
				,P8697S5 
				,P8697S6 
				,P8697S6A1
			*/
			
			
			$query = $this->db->query($sql);
			if (!$query){
					echo "ERROR: al guardar un artículo";
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
			
		
		return $result;
	}

	
	/**
     * Quita separador de miles de un entero
     * @access Public
     * @author hhchavezv
	 * @param  
	 * @return 
     */
    public function quitarPuntoMiles($numero) 
	{               
		$cifra=str_replace(".","",$numero);
		
		return $cifra;
	}
	

}
//EOC