<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Gastoshog extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load("sitio");
	}

	/**
	 * Ingreso de datos del formulario
	 * @author mayandarl
	 */
	public function index($id_persona) {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu", "Modgastoshog"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["id_persona"] = $id_persona;
		if (empty ($data["id_formulario"])) {
			redirect('/');
		}
		else {
			$data['secc'] = $this->Modmenu->obtenerSeccPagActual($data["id_formulario"], 'GDHOGAR');
			$data['secc']['ENCABEZADO'] = $this->Mformulario->asignarFechasEtiqueta($data['secc']['ENCABEZADO'], $data["id_formulario"]);
			if (empty($data['secc']['ID_SECCION']) || empty($data['secc']['PAGINA'])) {
				redirect('modinggasper/Personas');
			}
			else {
				// Seccion Inicial - Frecuencias
				if ($data['secc']['ID_SECCION'] == '00FRECUENCIAS' && $data['secc']['PAGINA'] == '1') {
					$data['preg']["grv"] = $this->Mformulario->listarGruposVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
					$data['preg']["var"] = $this->Mformulario->listarVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"]);
					$data['preg']["opc"] = $this->Mformulario->listarOpciones($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"]);
					$data['preg']["dep"] = $this->Mformulario->listarDependencias($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
					$data['resp'] = $this->Modgastoshog->listarValoresFrecuencias($data["id_formulario"]);
					$data["view"] = "vgdhfrecuencias";
					$this->load->view("layout", $data);
				}
				// Secciones de Gastos diarios del hogar
				else {
					$data['dia'] = $this->Modgastoshog->buscarDia($data["id_formulario"], $data['secc']['ID_SECCION']);
					$data['preg_art']["var"] = $this->Mformulario->listarVariables('GDHARTICULOS', '1', $data["id_formulario"]);
					$data['preg_art']["opc"] = $this->Mformulario->listarOpciones('GDHARTICULOS', '1', $data["id_formulario"]);
					/*$arrVarPers = array("P6006S1_1", "P1648S1A1", "P1648S1A2", "P1648S2A1", "P1648S2A2", "P1648S3A1", "P1648S3A2", "P1648S4A1", "P1648S4A2", "P1648S5A1", "P1648S5A2", "P1648S6A1", "P1648S6A2");
					foreach ($data['preg']["var"] as $v)
						if (in_array($v["ID_VARIABLE"], $arrVarPers))
							$data['preg']["opc"] = array_merge($data['preg']["opc"], $this->Mformulario->listarPersonas($data["id_formulario"], $v["ID_VARIABLE"], ">=10"));
					*/
					$data['preg_art']["reg"] = $this->Mformulario->listarConsistencias('GDHARTICULOS', '1');
					$data['preg_art']["dep"] = $this->Mformulario->listarDependencias('GDHARTICULOS', '1');
					$data['resp_art'] = $this->Mformulario->listarValores($data['preg_art']["var"], $data["id_formulario"], 'ENIG_FORM_GDH_ARTICULOS');
					$data["view"] = "vgdiarioshogar"; 
					$this->load->view ( "layout", $data );
				}
			}
		}
	}
	
	public function anterior() {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		if (empty ($id_formulario)) {
			redirect('/');
		}
		else {
			$secc = $this->Modmenu->obtenerSeccPagAnterior($id_formulario, 'GDHOGAR');
			//pr($secc); exit;
			$this->Modmenu->guardarAvanceFormulario($id_formulario, $secc['ID_SECCION'], $secc['PAGINA'], 'NO');
			redirect('modvivhogar/Vivhogar');
		}
	}

	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function guardar($tabla) {
		$this->load->model(array("Modgastoshog", "control/Modmenu"));
		$resultado = false;
		$id_formulario = $this->session->userdata("id_formulario");
		if ($tabla == '00FRECUENCIAS_1') {
			$resultado = $this->Modgastoshog->actualizarFrecuencias($id_formulario, $_POST);
			if ($resultado) {
				$this->Modmenu->guardarAvanceFormulario($id_formulario, '00FRECUENCIAS', '1', 'SI');
				$this->Modgastoshog->asignar14Dias($id_formulario);
			}
		}
		elseif ($tabla == 'ARTICULOS') {
			if ($_POST['_ACC_ARTICULOS'] == 'UPDATE') {
				$resultado = $this->Modgastoshog->actualizarFormularioArticulo($id_formulario, $_POST['_DIA'], $_POST['_ID_ARTICULO'], $_POST);
			}
			elseif ($_POST['_ACC_ARTICULOS'] == 'INSERT') {
				$resultado = $this->Modgastoshog->crearFormularioArticulo($id_formulario, $_POST['_DIA'], uniqid(), $_POST);
				/*if ($resultado) {
					$inicio = $_POST['_INI_ARTICULOS'];
					$fin = date("Y-m-d H:i:s");
					$this->Modmenu->guardarRegistroFormulario($id_formulario, 'FAMILIA', '1', $inicio, $fin);
				}*/
			}
		}
		echo "<b>Formulario guardado exitosamente.</b>";
	}

	/**
	 * Resultado de listar todas los articulos del formulario
	 * @author Mario A. Yandar
	 */
	public function articulos ($id_formulario, $dia) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->listadoArticulos($id_formulario, $dia);
		echo json_encode($data);
	}

	/**
	 * Resultado de Guardar en el formulario
	 * @author Mario A. Yandar
	 */
	public function articulo ($id_formulario, $id_articulo) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->buscarArticulo($id_formulario, $id_articulo);
		echo json_encode($data);
	}

	/**
	 * Resultado de Eliminar en el formulario
	 * @author Mario A. Yandar
	 */
	public function noarticulo ($id_formulario, $id_articulo) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->eliminarArticulo($id_formulario, $id_articulo);
		return true;
	}

	
}// EOC
?>