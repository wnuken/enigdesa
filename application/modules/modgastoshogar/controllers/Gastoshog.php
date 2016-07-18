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
			//$data['secc']['ENCABEZADO'] = $this->Mformulario->asignarFechasEtiqueta($data['secc']['ENCABEZADO'], $data["id_formulario"]);
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
					$dia = $this->Modgastoshog->obtenerSeccDias($data["id_formulario"]);
					$hoy = date("Y-m-d");
					$i = 0;
					foreach ($dia as $k=>$v) {
						if ($v == $hoy)
							$data['dias'][$i]['E'] = "HOY";
						// Habilita el dia de ayer
						elseif ($v == date("Y-m-d", strtotime("-1 day", strtotime($hoy))))
							$data['dias'][$i]['E'] = "ON";
						// Habilita el dia de anteayer
						elseif ($v == date("Y-m-d", strtotime("-2 day", strtotime($hoy))))
							$data['dias'][$i]['E'] = "ON";
						else 
							$data['dias'][$i]['E'] = "OFF";
						$data['dias'][$i]['F'] = $this->Modmenu->consultarEstadoSeccion($data["id_formulario"], $k, '1');
						$data['dias'][$i]['S'] = $k;
						$i++;
					}
					//pr($data);
					$data["view"] = "vgdhmenu";
					$this->load->view("layout", $data);
				}
			}
		}
	}
	
	public function cargaDia($id_persona, $id_dia) {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu", "Modgastoshog"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["id_persona"] = $id_persona;
		$data["seccion"] = $id_dia;
		$data['dia'] = $this->Modgastoshog->buscarDia($data["id_formulario"], $id_dia);
		$data['fecha'] = $this->Modgastoshog->fecha2texto($data['dia']);
		$data['persona'] = $this->Mformulario->obtenerPersona($data["id_formulario"], $id_persona);
		$data['preg_art']["var"] = $this->Mformulario->listarVariables('GDHARTICULOS', '1', $data["id_formulario"]);
		$data['preg_art']["opc"] = $this->Mformulario->listarOpciones('GDHARTICULOS', '1', $data["id_formulario"]);
		$arrVarPers = array("P10250S1C2M");
		foreach ($data['preg_art']["var"] as $v) {
			if (in_array($v["ID_VARIABLE"], $arrVarPers)) {
				$personas = $this->Mformulario->listarPersonas($data["id_formulario"], $v["ID_VARIABLE"], "");
				$n = count($personas) + 1;
				$personas[$n]['ID_VARIABLE'] 		= 'P10250S1C2M';
				$personas[$n]['ID_VALOR'] 			= '00';
				$personas[$n]['ETIQUETA']			= 'A una persona de otro hogar';
				$personas[$n]['DESCRIPCION_OPCION']	= '';
				$data['preg_art']["opc"] = array_merge($data['preg_art']["opc"], $personas);
			}
		}
		$data['preg_art']["reg"] = $this->Mformulario->listarConsistencias('GDHARTICULOS', '1');
		$data['preg_art']["dep"] = $this->Mformulario->listarDependencias('GDHARTICULOS', '1');
		$data['preg_com']["var"] = $this->Mformulario->listarVariables('GDHCOMIDAS', '1', $data["id_formulario"]);
		$data['preg_com']["opc"] = $this->Mformulario->listarOpciones('GDHCOMIDAS', '1', $data["id_formulario"]);
		$data['preg_com']["reg"] = $this->Mformulario->listarConsistencias('GDHCOMIDAS', '1');
		$data['preg_com']["dep"] = $this->Mformulario->listarDependencias('GDHCOMIDAS', '1');
		if ($id_dia == '14DIA14') {
			$data['preg_d14']["var"] = $this->Mformulario->listarVariables('14DIA14', '1', $data["id_formulario"]);
			$data['preg_d14']["opc"] = $this->Mformulario->listarOpciones('14DIA14', '1', $data["id_formulario"]);
			$data['preg_d14']["reg"] = $this->Mformulario->listarConsistencias('14DIA14', '1');
			$data['preg_d14']["dep"] = $this->Mformulario->listarDependencias('14DIA14', '1');
		}
		$data["view"] = "vgdiarioshogar";
		$this->load->view("vgdiarioshogar", $data);
	}
	
/*	public function anterior() {
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
	}*/

	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function guardar($tabla, $dia) {
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
			if ($_POST['_ACC_ARTICULOS'] == 'UPDATE')
				$resultado = $this->Modgastoshog->actualizarFormularioArticulo($id_formulario, $dia, $_POST['_ID_ARTICULO'], $_POST);
			elseif ($_POST['_ACC_ARTICULOS'] == 'INSERT')
				$resultado = $this->Modgastoshog->crearFormularioArticulo($id_formulario, $dia, uniqid(), $_POST);
		}
		elseif ($tabla == 'COMIDAS') {
			if ($_POST['_ACC_COMIDAS'] == 'UPDATE')
				$resultado = $this->Modgastoshog->actualizarFormularioComida($id_formulario, $dia, $_POST['_ID_COMIDA'], $_POST);
			elseif ($_POST['_ACC_COMIDAS'] == 'INSERT')
				$resultado = $this->Modgastoshog->crearFormularioComida($id_formulario, $dia, uniqid(), $_POST);
		}
		elseif ($tabla == '14DIA14') {
			$resultado = $this->Modgastoshog->actualizarFormularioDia14($id_formulario, $_POST);
			$this->findia('14DIA14');
		}
		/*if ($resultado) {
			$inicio = $_POST['_INI_ARTICULOS'];
			$fin = date("Y-m-d H:i:s");
			$this->Modmenu->guardarRegistroFormulario($id_formulario, 'FAMILIA', '1', $inicio, $fin);
		}*/
		echo "<b>Formulario guardado exitosamente.</b>";
	}
	
	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function findia($secc) {
		$this->load->model(array("Modgastoshog", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		if (!empty($secc)) {
			//echo $id_formulario ."/". $secc;
			$this->Modmenu->guardarAvanceFormulario($id_formulario, $secc, '1', 'SI');
		}
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

	/**
	 * Autocompletar Articulos
	 * @author Mario A. Yandar
	 */
	public function autocart($name) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->autocompletarArt(strtoupper($name));
		echo json_encode($data);
	}

	/**
	 * Resultado de listar todas las comidas del formulario
	 * @author Mario A. Yandar
	 */
	public function comidas ($id_formulario, $dia) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->listadoComidas($id_formulario, $dia);
		echo json_encode($data);
	}

	/**
	 * Resultado de Guardar en el formulario
	 * @author Mario A. Yandar
	 */
	public function comida ($id_formulario, $id_comida) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->buscarComida($id_formulario, $id_comida);
		echo json_encode($data);
	}

	/**
	 * Resultado de Eliminar en el formulario
	 * @author Mario A. Yandar
	 */
	public function nocomida($id_formulario, $id_comida) {
		$this->load->model("Modgastoshog");
		$data = $this->Modgastoshog->eliminarComida($id_formulario, $id_comida);
		return true;
	}
	
}// EOC
?>