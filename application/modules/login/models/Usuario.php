<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para la validación de ingreso de usuarios al aplicativo  (basado en proyecto e-censo)
 * @author mayandarl
 **/

class Usuario extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->library("danecrypt");
		date_default_timezone_set('America/Bogota');
	}
	
	/**
	 * Valida que el login / contraseña de un usuario sea auténtico y que se encuentre registrado en la base de datos
	 * Contraseña Sin Encriptar
	 * @author mayandarl
	 **/
	public function validarUsuario($login, $password){
		$result = false;
		$sql = "SELECT ID_FORMULARIO, NOMBRE_USUARIO, CLAVE_USUARIO
			FROM ENIG_FORM_INSCRIPCION WHERE NOMBRE_USUARIO='$login'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row){
				if (strcmp($row->CLAVE_USUARIO, $password)===0) {
					$sessionData = array("auth" => "OK",
										 "nombre_usuario" => $row->NOMBRE_USUARIO,
										 "id_formulario" => $row->ID_FORMULARIO,
										 "visita" => date("Y-m-d H:i:s"));
					$this->session->set_userdata($sessionData);
					$result = true;
				}
			}
		}
		$this->db->close();
		return $result;
	}
	
	/**
	 * Inserta el registro de la visita en la tabla de visitas
	 * @author mayandarl
	 */
	public function guardarRegistroVisita($datos) {
		$sql = "INSERT INTO ENIG_LOG_USUARIOS VALUES('";
		$sql .= $datos['id_formulario'] . "',";
		$sql .= "TO_TIMESTAMP('". $datos['visita'] ."', 'YYYY-MM-DD HH24:MI:SS'), null)";
		$query = $this->db->query($sql);
		$this->db->close();
		return true;
	}

	/**
	 * Actualiza la tabla de resultados de la entrevista con la fecha... hora... de salida
	 * @author mayandarl
	 */
	public function registroSalida($id_formulario, $visita) {
		$sql = "UPDATE ENIG_LOG_USUARIOS SET FIN_CONEXION=TO_TIMESTAMP('". date("Y-m-d H:i:s") ."','YYYY-MM-DD HH24:MI:SS')
			WHERE ID_FORMULARIO='". $id_formulario ."' AND INICIO_CONEXION=TO_TIMESTAMP('". $visita."','YYYY-MM-DD HH24:MI:SS')";
		$query = $this->db->query($sql);
		$this->db->close();
		return true;
	}

	/**
	 * Valida que el login / contraseña de un usuario sea auténtico y que se encuentre registrado en la base de datos
	 * Contraseña Encriptada
	 * @author DMDiazF	
	 * @since  13/10/2015
	 **/
	public function validarUsuarioCRYPT($login, $password) {
		/**
		 * Modificación: 
		 * Se valida una fecha de inicio de apertura del proceso y una fecha de cierre del proceso. En caso de que la fecha 
		 * de cierre del proceso ya se haya cumplido, debe redirigirse el usuario a una página de error, donde se informe 
		 * que el proceso operativo del censo ya se cerró. 
		 * @author dmdiazf
		 * @since  18/01/2016
		 */
		$result = false;		
		$sql = "SELECT U.id_usuarios, CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(P.primer_nombre, ' '),P.segundo_nombre),' '),P.primer_apellido),' '),P.segundo_apellido) AS nombre, P.cedula, U.usuario, U.clave, U.tipo_usuario, U.estado, U.fecha_creacion, U.fecha_expiracion, U.nro_encuesta_form
				FROM cnp_admin_usuarios U, cnp_preregistro P, cnpv_admin_control C
				WHERE U.nro_encuesta_form = P.nro_encuesta_form
				AND U.nro_encuesta_form = C.nro_encuesta_form				
				AND LOWER(U.usuario) = LOWER('$login')
				AND U.estado = 1
				AND C.sec_prereg >= 1";	//Se cambia de sec_prereg = 2 a sec_prereg >= 1;				
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			foreach($query->result() as $row){
				$encrypt = $this->danecrypt->encode($password);
				if (strcmp($row->CLAVE, $encrypt)===0){
					$visita = $this->obtenerNumeroVisita($row->NRO_ENCUESTA_FORM);
					//$visita=1;					
					$sessionData = array("auth" => "OK",
						                 "id" => $row->ID_USUARIOS,
						                 "nombre" => utf8_decode($row->NOMBRE),
						                 "cedula" => $row->CEDULA,		
						                 "usuario" => $row->USUARIO,
						                 "clave" => $row->CLAVE,
						                 "tipo_usuario" => $row->TIPO_USUARIO,
						                 "estado" => $row->ESTADO,
						                 "fecha_creacion" => $row->FECHA_CREACION,
						                 "fecha_expiracion" => $row->FECHA_EXPIRACION,
						                 "numform" => $row->NRO_ENCUESTA_FORM,
							             "visita" => $visita,
							             "flag_dir" => false);
					$this->session->set_userdata($sessionData);
					$result = true;
				}
			}
		}
		$this->db->close();
		return $result;
	}
	
	/**
	 * Luego de que el usuario y contraseña han sido validados, se redirecciona al usuario a cada módulo que corresponde según el rol de usuario.
	 * @author DMDiazF
	 * @since  13/10/2015
	 */
	public function redireccionarUsuario() {
		$rol = $this->session->userdata("tipo_usuario");
		switch($rol){
			case 'F': //Fuente
					  $controller = "inicio";
					  break;
			default:  //Login
					  $controller = "login";
					  break;				  
		}
		redirect($controller,"location",301);			
	}
	
	/**
	 * Función para recordar el usuario y la contraseña de acceso al aplicativo.
	 * @author DMDiazF
	 * @since  13/10/2015
	 */
	public function recordarEmail($email){
		$data = array();
		$sql = "SELECT NOMBRE_USUARIO, CLAVE_USUARIO
				FROM ENIG_FORM_INSCRIPCION
				WHERE LOWER(NOMBRE_USUARIO) = LOWER('$email')";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data["usuario"] = strtolower($row->NOMBRE_USUARIO);
				$data["password"] = $row->CLAVE_USUARIO; //$this->danecrypt->decode($row->CLAVE);
			}
		}
		$this->db->close();
		return $data;
	}
	
	
	/**
	 * Obtiene los nombres del usuario a partir del usuario (email)
	 * @author dmdiazf
	 * @since  28/10/2015	  
	 */
	public function obtenerDatosUsuario($email){
		$user = array();
		$sql = "SELECT NOMBRE1, NOMBRE2, APELLID1,APELLID2
				FROM ENIG_FORM_INSCRIPCION WHERE NOMBRE_USUARIO = '$email'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			foreach($query->result() as $row){
				$user["pnombre"] = $row->NOMBRE1; 
				$user["snombre"] = $row->NOMBRE2; 
				$user["papellido"] = $row->APELLID1; 
				$user["sapellido"] = $row->APELLID2;
			}
		}
		$this->db->close();
		return $user;
	}
	
	
	/**
	 * Obtiene el numero de la visita que está realizando el usuario.
	 * @author Daniel M. Díaz
	 * @since  28/10/2015
	 */
	private function obtenerNumeroVisita($nro_form){
		$visita = 0;
		$sql = "SELECT COUNT(*) AS total
				FROM cnpv_resultados_entrevista
				WHERE c0i1_encuesta = $nro_form";		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){			
			foreach($query->result() as $row){
				$visita = $row->TOTAL + 1;				
			}
		}
		$this->db->close();
		return $visita;
	}
	
	/**
	 * Obtiene el estado general de diligenciamiento del formulario para indicar si el formulario completo diligenciado fue completo o incompleto
	 * @author dmdiazf
	 * @since  28/10/2015
	 */
	private function obtenerEstadoVisitaFormulario($num_form){
		$estado = 2; //La encuesta está incompleta. VALOR POR DEFECTO
		$sql = "SELECT sec_prereg, sec_vivi, sec_hogar, sec_pers
				FROM cnpv_admin_control
				WHERE nro_encuesta_form = $num_form";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			if (($row->SEC_PREREG==2)&&($row->SEC_VIVI==2)&&($row->SEC_HOGAR==2)&&($row->SEC_PERS==2)){
				$estado = 1; //La encuesta está completa
			}
		}
		$this->db->close();
		return $estado;
	}
	

}//EOC
