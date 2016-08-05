<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modulo de registro de conexionex
 * @since  2016-03
 * @author mayandarl
 */

class Login extends MX_Controller {

	public function __construct(){		
		parent::__construct();
		$this->load->library("danecrypt");
		$this->load->library("email");
	}

	/**
	 * Muestra la pagina login
	 * @author mayandarl
	 */
	public function index(){
		$this->load->model("usuario");
		$data["header"] = "/template/navbar2";
		$data["view"] = "login";
		$this->load->view("layout",$data);
	}
	
	/**
	 * Validacion y autenticacion de usuarios
	 * @author mayandarl
	 */		
	public function userAuth() {
		header("Content-Type: application/json; charset=utf-8");
		$data = array();
		$this->load->model("usuario");
		$login = str_replace(array("<",">","[","]","^","'"),"",$this->input->post("txtUsuario"));
		$password = str_replace(array("<",">","[","]","^","'"),"",$this->input->post("txtPassword"));
		if ($this->usuario->validarUsuario($login, $password)) {
			$datosRegistro = array (
				"id_formulario" => $this->session->userdata("id_formulario"),
				"visita" => $this->session->userdata("visita"));
			$this->usuario->guardarRegistroVisita($datosRegistro);
			$data["result"] = true;
			$data["url"] = base_url() . "control/Menu";
			$data["message"] = "";
		}
		else {
			$data["result"] = true;
			$data["url"] = base_url();
			$data["message"] = "<strong>Usuario o contraseña No validos</strong>";
		}
		echo json_encode($data);
	}

	/**
	 * Cierra la sesion y sale del aplicativo
	 * @author mayandarl
	 */
	public function salir(){
		$this->load->model("usuario");
		$id_formulario = $this->session->userdata("id_formulario");
		$visita = $this->session->userdata("visita");
		$this->usuario->registroSalida($id_formulario, $visita);
		$this->session->sess_destroy();
		redirect("/","location",301);
	}

	/**
	 * Muestra formulario para recordatorio de contraseña
	 * @author dmdiazf
	 * @since 10/11/2015
	 */
	public function reminder(){
		$data["header"] = "/template/navbar2";
		$data["view"] = "reminder";
		$this->load->view("layout",$data);
	}
	
	/**
	 * Envio de correos para recordatorio de contraseña
	 * @author dmdiazf
	 * @since  10/11/2015
	 */
	public function olvido(){
		$this->load->model("usuario");			
		$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");			
		$arrayDias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
		$email = $this->input->post("txtReminder");
		$usuario = $this->usuario->recordarEmail($email);
		$inscripcion = $this->config->item("inscripcion");
		if (count($usuario) > 0){
			$config = array(
				"protocol" => "smtp",
				"smtp_host" => "192.168.1.98",
				"smtp_port" => 25,
				"smtp_crypto" => "tls",
				"smtp_user" => "aplicaciones@dane.gov.co",
				"smtp_pass" => "Ou67UtapW3v",
				"mailtype" => "html",
				"charset" => "utf-8",
				"newline" => "\r\n"
			);
			$this->email->initialize($config);
			$data["usuario"] = $usuario["usuario"];
			$data["password"] = $usuario["password"];
			$data["fecha"] = $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
			$data["user"] = $this->usuario->obtenerDatosUsuario($email);
			$this->email->from("dane@dane.gov.co", "Departamento Administrativo Nacional de Estadistica - DANE");
			$this->email->to($email);
			$this->email->subject("Recordatorio de Contraseña / Encuesta Nacional de Presupuestos de los Hogares - DANE");
			$html = $this->load->view("mailrec",$data,true);
			$this->email->message($html);
			//var_dump($this->email->print_debugger());
			if ($this->email->send()){					
				$data["header"] = "/template/navbar2";
				//$data["reg"] = (!$this->usuario->validaCierreFechas($inscripcion["fec_ini"], $inscripcion["fec_fin"]))?false:true;
				$data["view"] = "login";
				$data["enviado"] = true;
				$data["mensaje"] = "<strong>Mensaje Enviado.</strong> Su contrase&ntilde;a ha sido enviada a la direcci&oacute;n de correo indicada.";
				$this->load->view("layout",$data);
			}
		}
		else{
			$data["header"] = "/template/navbar2";
			//$data["reg"] = (!$this->usuario->validaCierreFechas($inscripcion["fec_ini"], $inscripcion["fec_fin"]))?false:true;
			$data["view"] = "login";
			$data["enviado"] = false;
			$data["mensaje"] = "<strong>No se ha podido enviar el mensaje.</strong> La direcci&oacute;n de correo electr&oacute;nico indicada no existe en nuestra base de datos.";
			$this->load->view("layout",$data);					
		}
	}
	
	/*** ELIMINAR ESTE METODO ***/
	public function test(){
		$password = "ABC123";
		$test = $this->danecrypt->encode($password);
		
		/*$password = "gQcyNw8t5OCPDWfHHpvjqkvJZEyy4aE-cmvbNM7XuVQ";
		$test = $this->danecrypt->decode($password);
		*/
		var_dump($test);
	}
			
}//EOC
