<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Personas extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->config->load ( "sitio" );
		$this->load->library ( "danecrypt" );
		date_default_timezone_set ( 'America/Bogota' );
	}
	
	/**
	 * Ingreso al menu de personas
	 * @author mayandarl
	 */
	public function index() {
		$this->load->model (array ("Mingresos", "control/Modmenu"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		if (empty ( $data ["id_formulario"] )) {
			redirect('/');
		} else {
			$data['personas'] = $this->Mingresos->listadoPersonasRegistro($data["id_formulario"]);
			$data["view"] = "vmenu";
			$this->load->view ( "layout", $data );
		}
	}
	
	public function generales($id_persona) {
		$this->registrar($id_persona);
		$data = $this->formulario('PERSONAL');
		// Adiciona la lista de personas del hogar.
		$data['preg']["opc"] = array_merge($data['preg']["opc"], $this->Mformulario->listarPersonas($data["id_formulario"], 'P6081S1', "HOMB>". $data['persona']['P6040']));
		$data['preg']["opc"] = array_merge($data['preg']["opc"], $this->Mformulario->listarPersonas($data["id_formulario"], 'P6083S1', "MUJE>". $data['persona']['P6040']));
		$data['preg']["opc"] = array_merge($data['preg']["opc"], $this->Mformulario->listarPersonas($data["id_formulario"], 'P6071S1', "EX10=". $id_persona));
		$data["view"] = "vpersonas"; 
		$this->load->view("layout", $data);
	}
	
	public function antgenerales() {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		if (empty($id_formulario) || empty ($id_persona)) {
			redirect('/');
		}
		else {
			$secc = $this->Modmenu->obtenerSeccPagAnteriorPersonas($id_formulario, $id_persona, 'PERSONAL');
			//pr($secc); exit;
			$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $secc['ID_SECCION'], $secc['PAGINA'], 'NO');
			redirect('modinggasper/Personas/generales/'. $id_persona);
		}
	}

	public function ingresos($id_persona) {
		$this->registrar($id_persona);
		// Verificar Avance de Personas
		$data = $this->formulario('INGRESOS');
		$data["view"] = "vingresos";
		$this->load->view("layout", $data);
	}

	public function antingresos() {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		if (empty($id_formulario) || empty ($id_persona)) {
			redirect('/');
		}
		else {
			$secc = $this->Modmenu->obtenerSeccPagAnteriorPersonas($id_formulario, $id_persona, 'INGRESOS');
			//pr($secc); exit;
			$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $secc['ID_SECCION'], $secc['PAGINA'], 'NO');
			redirect('modinggasper/Personas/ingresos/'. $id_persona);
		}
	}

	public function gastos($id_persona) {
		$this->formulario('GASTOS');
	}

	public function registrar($id_persona) {
		$this->load->model (array ("Mingresos"));
		$sessionData = array("auth" => "OK",
					 "id_formulario" => $this->session->userdata("id_formulario"),
					 "id_persona" => $id_persona,
					 "visita" => date("Y-m-d H:i:s"));
		$this->session->set_userdata($sessionData);
		$this->Mingresos->registrarInicioPersonas($id_persona);
		//redirect('/modinggasper/Personas/siguiente');
	}
	
	/**
	 * Ingreso de datos del formulario
	 * @author mayandarl
	 */
	private function formulario($capitulo) {
		$this->load->model (array ("Mingresos", "control/Modmenu", "formulario/Mformulario"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["id_persona"] = $this->session->userdata("id_persona");
		if (empty($data["id_formulario"]) || empty ($data["id_persona"])) {
			redirect('/');
		}
		else {
			$data['secc'] = $this->Modmenu->obtenerSeccPagActualPersonas($data["id_formulario"], $data["id_persona"], $capitulo);
			//pr($data); exit;
			$data['secc']['ENCABEZADO'] = $this->Mformulario->asignarFechasEtiqueta($data['secc']['ENCABEZADO'], $data["id_formulario"]);
			$data['persona'] = $this->Mingresos->obtenerPersona($data["id_formulario"], $data["id_persona"]);
			//$data['lspers'] = $this->Mingresos->listarPersonas($data["id_formulario"]);
			$data['fechas'] = $this->Modmenu->obtenerFechas($data["id_formulario"]);
			if (empty($data['secc']['ID_SECCION']) || empty($data['secc']['PAGINA'])) {
				redirect('/modinggasper/Personas');
			}
			else {
				$data["vardep"] = $this->Mingresos->variablesDependientes($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"], $data["id_persona"]);
				$data['preg']["grv"] = $this->Mformulario->listarGruposVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
				$data['preg']["var"] = $this->Mingresos->listarVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"], $data["id_persona"]);
				$data['preg']["opc"] = $this->Mingresos->listarOpciones($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"], $data["id_persona"]);
				$data['preg']["reg"] = $this->Mformulario->listarConsistencias($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
				$data['preg']["dep"] = $this->Mformulario->listarDependencias($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
				$data['resp'] = $this->Mingresos->listarValores($data['preg']["var"], $data["id_formulario"], $data['id_persona']);
			}
		}
		//pr($data); exit;
		return $data;
	}
	
	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 * @since 2015-07-21
	 */
	public function guardar($seccion, $pagina) {
		$data = array ();
		$this->load->model ( array ("Mingresos", "control/Modmenu") );
		$id_formulario = $this->session->userdata ("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$resultado = $this->Mingresos->actualizarFormularioPersonas($id_formulario, $id_persona, $_POST);
		if ($resultado) {
			$inicio = $_POST['_INI_' . $seccion . '_' . $pagina];
			$fin = date ("Y-m-d H:i:s");
			$this->Modmenu->guardarRegistroFormulario($id_formulario, $seccion, $pagina, $inicio, $fin);
			$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $seccion, $pagina, 'SI');
			// Construcciones de ramales...
			// Negocios agropecuarios...
			if (isset($_POST['P8000']) && ($_POST['P8000']=='4' || $_POST['P8000']=='5' || $_POST['P8000']=='6')) {
				$data = $this->Modmenu->actualizaAvanceRama('IGPERSONAL', '10NEGOCOM', '2', '13NEGOMIN','2');
				foreach ($data as $k=>$v)
					$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $v['SECCION'], $v['PAGINA'], 'SI');
			}
			// Negocios de Comercio - Mineria
			if (isset($_POST['P8000']) && $_POST['P8000'] == '7') {
				$data = $this->Modmenu->actualizaAvanceRama('IGPERSONAL', '10NEGOCOM', '2', '13NEGOMIN','1');
				foreach ($data as $k=>$v)
					$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $v['SECCION'], $v['PAGINA'], 'SI');
			}
		}
		// Analizar resultado y remitir a la siguiente Pagina.
		echo "<b>Formulario guardado exitosamente.</b>";
		// echo "</PRE>"; print_r($resultado); echo "</PRE>";
	}

	/**
	 * Buscar etnias
	 * @author Mario A. Yandar
	 */
	public function buscaretnias ($name) {
		$this->load->model("Mingresos");
		$data = $this->Mingresos->buscaretnias(strtoupper($name));
		echo json_encode($data);
	}

}
?>