<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Vivhogar extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load("sitio");
	}

	/**
	 * Ingreso de datos del formulario
	 * @author mayandarl
	 */
	public function index() {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		if (empty ($data["id_formulario"])) {
			redirect('/');
		}
		else {
			$data['secc'] = $this->Modmenu->obtenerSeccPagActual($data["id_formulario"], 'VIVHOGAR');
			$data['secc']['ENCABEZADO'] = $this->Mformulario->asignarFechasEtiqueta($data['secc']['ENCABEZADO'], $data["id_formulario"]);
			if (empty($data['secc']['ID_SECCION']) || empty($data['secc']['PAGINA'])) {
				redirect('control/Menu');
			}
			else {
				// Seccion Inicial - Menu especializado
				if ($data['secc']['ID_SECCION'] == '1VIVIENDA' && $data['secc']['PAGINA'] == '1') {
					$this->Modmenu->guardarAvanceFormulario($data['id_formulario'], $data['secc']['ID_SECCION'], $data['secc']['PAGINA'], 'SI');
					$arrFechasModulo = $this->Modmenu->consultarFechasxModulo($data['id_formulario'], 'VIVHOGAR');
					$data['inicio'] = $arrFechasModulo["FECHAHORA_INI"];
					$data['fin'] = $arrFechasModulo["FECHAHORA_FIN"];
					$data["view"] = "vvivhogarsm1"; 
					$this->load->view("layout", $data);
				}
				// Seccion Final - Menu especializado
				elseif ($data['secc']['ID_SECCION'] == '1VIVIENDA' && $data['secc']['PAGINA'] == '3') {
					$this->Modmenu->guardarAvanceFormulario($data['id_formulario'], $data['secc']['ID_SECCION'], $data['secc']['PAGINA'], 'SI');
					$data["view"] = "vvivhogarsm4"; 
					$this->load->view("layout", $data);
				}
				// Secciones de Vivienda
				else {
					if ($data['secc']['ID_SECCION'] == '1VIVIENDA')
						$tabla = 'ENIG_FORM_VIVIENDAS';
					elseif ($data['secc']['ID_SECCION'] == '2HOGAR')
						$tabla = 'ENIG_FORM_HOGARES';
					$data["vardep"] = $this->Mformulario->variablesDependientes($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"]);
					//pr($data['vardep']); exit;
					$data['preg']["grv"] = $this->Mformulario->listarGruposVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
					$data['preg']["var"] = $this->Mformulario->listarVariables($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"]);
					$data['preg']["opc"] = $this->Mformulario->listarOpciones($data['secc']['ID_SECCION'], $data['secc']['PAGINA'], $data["id_formulario"]);
					$arrVarPers = array("P6006S1_1", "P1648S1A1", "P1648S1A2", "P1648S2A1", "P1648S2A2", "P1648S3A1", "P1648S3A2", "P1648S4A1", "P1648S4A2", "P1648S5A1", "P1648S5A2", "P1648S6A1", "P1648S6A2");
					foreach ($data['preg']["var"] as $v)
						if (in_array($v["ID_VARIABLE"], $arrVarPers))
							$data['preg']["opc"] = array_merge($data['preg']["opc"], $this->Mformulario->listarPersonas($data["id_formulario"], $v["ID_VARIABLE"], ">=10"));
					$data['preg']["reg"] = $this->Mformulario->listarConsistencias($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
					$data['preg']["dep"] = $this->Mformulario->listarDependencias($data['secc']['ID_SECCION'], $data['secc']['PAGINA']);
					$data['resp'] = $this->Mformulario->listarValores($data['preg']["var"], $data["id_formulario"], $tabla);
					$data["view"] = "vvivhogar"; 
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
			$secc = $this->Modmenu->obtenerSeccPagAnterior($id_formulario, 'VIVHOGAR');
			//pr($secc); exit;
			$this->Modmenu->guardarAvanceFormulario($id_formulario, $secc['ID_SECCION'], $secc['PAGINA'], 'NO');
			redirect('modvivhogar/Vivhogar');
		}
	}

	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function guardar($seccion = 0, $pagina = 0) {
		$data = array();
		if (empty($seccion) || empty($pagina)) {
			echo "<b>Error guardando Formulario. Seccion, Pagina no definidas</b><br/>";
		}
		else {
			$this->load->model(array ("formulario/Mformulario", "control/Modmenu"));
			$id_formulario = $this->session->userdata("id_formulario");
			if ($seccion == '1VIVIENDA')
				$tabla = 'ENIG_FORM_VIVIENDAS';
			elseif ($seccion == '2HOGAR')
				$tabla = 'ENIG_FORM_HOGARES';
			$resultado = $this->Mformulario->actualizarFormulario($id_formulario, $_POST, $tabla);
			if ($resultado) {
				$inicio = $_POST ['_INI_' . $seccion . '_' . $pagina];
				$fin = date("Y-m-d H:i:s");
				$this->Modmenu->guardarRegistroFormulario($id_formulario, $seccion, $pagina, $inicio, $fin);
				$this->Modmenu->guardarAvanceFormulario($id_formulario, $seccion, $pagina, 'SI');
			}
			echo "<b>Formulario guardado exitosamente.</b><br/>";
		}
		// echo "</PRE>"; print_r($resultado); echo "</PRE>";
	}
}// EOC
?>