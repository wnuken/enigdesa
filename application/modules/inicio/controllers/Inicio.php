<?php defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Controlador para el módulo de Inicio
	 * @since  22/09/2015	   
	 * @author dmdiazf
	 */

	class Inicio extends MX_Controller {
	
		public function __construct(){		
			parent::__construct();
			$this->load->library("validarsesion");
			$this->load->library("phpqrcode");
			$this->load->library("html2pdf");
		}
	
		public function index(){
			$this->load->model("modinicio");
			$nro_form = $this->session->userdata("numform");
			$estadoForm = $this->modinicio->estadoModulo($nro_form, 4); //Verifica el estado general del formulario
			
			if ($estadoForm<12){
				$data["nombre"] = $this->session->userdata("nombre");
				$data["view"] = "inicio";
				$this->load->view("layout",$data);
			} 
			else{
				//Redireccionar a encuesta
				redirect("encuesta/msjEncuesta","location",301);
			}
		}
		
		public function codverif($code){
			$data["view"] = "codverificacion";
			$data["usuario"] = $this->session->userdata("nombre");			
			$data["qrcode"] = $this->phpqrcode->getQRImage($code); //Obtener el HTML para mostrar la imagen.
			$this->load->view("layout",$data);
		}
		
		/**
		 * Método para generar imágenes QR a partir del código que se recibe por parámetro
		 * @author dmdiazf
		 * @since  22/10/2015
		 */
		public function qrcode($code){
			$url = site_url("/inicio/generapdf"); 
			$this->phpqrcode->setCode($code);
			$this->phpqrcode->setLink($url);
			$this->phpqrcode->generateQRImage($code);
		}
		
		/**
		 * Método para descargar el PDF del certificado de cumplimiento del diligenciamiento de la encuesta
		 * @author dmdiazf
		 * @since 22/10/2015
		 */
	public function generaPDF(){	
			$this->load->model("modinicio");
			$nro_form = $this->session->userdata("numform");
			$usuario = $this->modinicio->obtenerDatosUsuario($nro_form);
			$data["nombre"] = $usuario["nombre"];
			$data["cedula"] = $usuario["cedula"];
			$fecha = date("Y-m-d");
			$arrayFecha = explode("-",$fecha);
			switch($arrayFecha[1]){
				case '01': $mes = "Enero";
						   break;
				case '02': $mes = "Febrero";
				           break;
				case '03': $mes = "Marzo";
				           break;
				case '04': $mes = "Abril";
				           break;
				case '05': $mes = "Mayo";
				           break;
				case '06': $mes = "Junio";
				           break;
				case '07': $mes = "Julio";
				           break;
				case '08': $mes = "Agosto";
				           break;
				case '09': $mes = "Septiembre";
				           break;
				case '10': $mes = "Octubre";
				           break;
				case '11': $mes = "Noviembre";
				           break;
				case '12': $mes = "Diciembre";
				           break;                                                                                                              		   	
			}
			$data["expedicion"] = $mes . " " . $arrayFecha[2] . " de " . $arrayFecha[0];
			$this->html2pdf->folder('./assets/pdfs/');
			$this->html2pdf->filename("certificado-cnpv.pdf");
			$this->html2pdf->paper('letter', 'landscape');			
			$html = $this->load->view("ecensocert",$data,true);			
			$this->html2pdf->html($html);
			$this->html2pdf->create("download");
			/*$this->load->view("ecensocert",$data);*/
		}
		
		/**
		 * Actualiza los controles del inicio del formulario de acuerdo al avance en el diligenciamiento del formulario
		 * @author dmdiazf
		 * @since  22/10/2015
		 */
		public function actualizarAvance(){
			header('Content-Type: application/json');
			$this->load->model("modinicio");
			$nro_form = $this->session->userdata("numform");
			$inscripcion = $this->config->item("inscripcion");
			$diligenciamiento = $this->config->item("diligenciamiento");
			$modulo["fec_ini"] = $inscripcion["fec_ini"];
			$modulo["fec_fin"] = $inscripcion["fec_fin"];
			$modulo["fec_inid"] = $diligenciamiento["fec_ini"]; 
			$modulo["fec_find"] = $diligenciamiento["fec_fin"];
			$modulo["fec_nac"] = $this->modinicio->obtenerFechaCumpleanos($nro_form);						
			$modulo["avance"] = $this->modinicio->avanceFormulario($nro_form);
			for ($i=0; $i<5; $i++){
				$modulo["campo".$i] = $this->modinicio->estadoModulo($nro_form, $i);
			}
			echo json_encode($modulo);			
		}
		
		/**
		 * Validación para preguntar si la pregunta C2V20_ANOS_VIV ya fue diligenciada. Se realiza esta validacion en el botón de envio de formulario
		 * ver el javascript Inicio.js
		 * @author dmdiazf
		 * @since  06/11/2015
		 */
		public function validarPreguntaVivienda(){
			header('Content-Type: application/json');
			$this->load->model("modinicio");
			$nro_form = $this->session->userdata("numform");
			$data["valida"] = $this->modinicio->validarPreguntaVivienda($nro_form);
			echo json_encode($data);
		}
		
		/**
		 * Guarda/Actualiza el valor del tiempo empleado en el diligenciamiento de cada uno de los módulos de la encuesta. (Ver crono.js)
		 * @author dmdiazf
		 * @since  22/01/2016
		 */
		public function actualizarCrono(){
			$result = false;
			$this->load->model("modinicio");
			$numform = $this->session->userdata("numform");
			$nrohog = 1;
			$visita = $this->session->userdata("visita");			
			$modulo = $this->input->post("modulo");
			$duracion = $this->input->post("duracion");
			$tiempo = $this->modinicio->obtenerTiempo($numform, $nrohog, $visita, $modulo); //Puede devolver NULL cuando es la primera vez.
			$arrayTiempo = explode(":",$tiempo);
			$arrayDuracion = explode(":",$duracion);
			if (is_null($tiempo)){				
				//Actualiza el tiempo cuando no existen datos previos.
				$result = (!$this->modinicio->actualizarCrono($numform, $nrohog, $visita, $modulo, $duracion))?false:true;
			}
			else{
				//Actualiza únicamente los datos cuando la duracion es superior a la del dato anterior
				$segsTiempo = $arrayTiempo[0] * 3600  + $arrayTiempo[1] * 60 + $arrayTiempo[2];
				$segsDuracion = $arrayDuracion[0] * 3600  + $arrayDuracion[1] * 60 + $arrayDuracion[2];
				if ($segsDuracion > $segsTiempo){
					$result = (!$this->modinicio->actualizarCrono($numform, $nrohog, $visita, $modulo, $duracion))?false:true;
				}	
			}			
			return $result;			
		}
		
		public function pruebaPDF(){
			$this->load->view("certificado");
		}
		
		
	}//EOC
