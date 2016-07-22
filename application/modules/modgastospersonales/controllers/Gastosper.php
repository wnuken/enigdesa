<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Gastosper extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load("sitio");
	}

	/**
	 * Ingreso de datos del formulario
	 * @author mayandarl
	 */
	public function index($id_persona) {
		$this->load->model (array ("formulario/Mformulario", "control/Modmenu", "Modgastosper"));
		$data["id_formulario"] = $this->session->userdata("id_formulario");
		$data["id_persona"] = $id_persona;
		$sessionData = array("auth" => "OK",
					 "id_formulario" => $data["id_formulario"],
					 "id_persona" => $data["id_persona"],
					 "visita" => date("Y-m-d H:i:s"));
		$this->session->set_userdata($sessionData);
		if (empty($data["id_formulario"]) || empty ($data["id_persona"])) {
			redirect('modinggasper/Personas');
		}
		else {
			$this->Modgastosper->asignar7Dias($data["id_formulario"], $data["id_persona"]);
			$dia = $this->Modgastosper->obtenerSeccDias($data["id_formulario"], $data["id_persona"]);
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
				$data['dias'][$i]['F'] = $this->Modmenu->consultarEstadoSeccionPersonas($data["id_formulario"], $data["id_persona"], $k, '1');
				$data['dias'][$i]['S'] = $k;
				$data['dias'][$i]['D'] = $this->Modgastosper->buscarDia($data["id_formulario"], $data["id_persona"], $k);
				$data['dias'][$i]['C'] = $this->Modgastosper->fecha2texto($data['dias'][$i]['D']);
				$i++;
			}
			$data['persona'] = $this->Mformulario->obtenerPersona($data["id_formulario"], $id_persona);
			$data['preg_art']["var"] = $this->Mformulario->listarVariables('GDPARTICULOS', '1', $data["id_formulario"]);
			$data['preg_art']["opc"] = $this->Mformulario->listarOpciones('GDPARTICULOS', '1', $data["id_formulario"]);
			$data['preg_art']["reg"] = $this->Mformulario->listarConsistencias('GDPARTICULOS', '1');
			$data['preg_art']["dep"] = $this->Mformulario->listarDependencias('GDPARTICULOS', '1');
			$data['preg_com']["var"] = $this->Mformulario->listarVariables('GDPCOMIDAS', '1', $data["id_formulario"]);
			$data['preg_com']["opc"] = $this->Mformulario->listarOpciones('GDPCOMIDAS', '1', $data["id_formulario"]);
			$data['preg_com']["reg"] = $this->Mformulario->listarConsistencias('GDPCOMIDAS', '1');
			$data['preg_com']["dep"] = $this->Mformulario->listarDependencias('GDPCOMIDAS', '1');
			//pr($data);
			$data["view"] = "vgdpdias";
			$this->load->view("layout", $data);
		}
	}

	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function guardar($tabla) {
		$this->load->model(array("Modgastosper", "control/Modmenu"));
		$resultado = false;
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		if ($tabla == 'ARTICULOS') {
			$dia = $_POST['_DIA_ART'];
			if ($_POST['_ACC_ARTICULOS'] == 'UPDATE')
				$resultado = $this->Modgastosper->actualizarFormularioArticulo($id_formulario, $id_persona, $dia, $_POST['_ID_ARTICULO'], $_POST);
			elseif ($_POST['_ACC_ARTICULOS'] == 'INSERT')
				$resultado = $this->Modgastosper->crearFormularioArticulo($id_formulario, $id_persona, $dia, uniqid(), $_POST);
			echo "<b>Art&iacute;culo guardado</b>";
		}
		elseif ($tabla == 'COMIDAS') {
			$dia = $_POST['_DIA_COM'];
			if ($_POST['_ACC_COMIDAS'] == 'UPDATE')
				$resultado = $this->Modgastosper->actualizarFormularioComida($id_formulario, $id_persona, $dia, $_POST['_ID_COMIDA'], $_POST);
			elseif ($_POST['_ACC_COMIDAS'] == 'INSERT')
				$resultado = $this->Modgastosper->crearFormularioComida($id_formulario, $id_persona, $dia, uniqid(), $_POST);
			echo "<b>Comida guardada</b>";
		}
		/*if ($resultado) {
			$inicio = $_POST['_INI_ARTICULOS'];
			$fin = date("Y-m-d H:i:s");
			$this->Modmenu->guardarRegistroFormulario($id_formulario, 'FAMILIA', '1', $inicio, $fin);
		}*/
	}
	
	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function findia($secc) {
		$this->load->model(array("Modgastosper", "control/Modmenu"));
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		if (!empty($secc)) {
			//echo $id_formulario ."/". $secc;
			$this->Modmenu->guardarAvanceFormularioPersonas($id_formulario, $id_persona, $secc, '1', 'SI');
		}
	}

	/**
	 * Resultado de listar todas los articulos del formulario
	 * @author Mario A. Yandar
	 */
	public function articulos ($dia) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->listadoArticulos($id_formulario, $id_persona, $dia);
		echo json_encode($data);
	}

	/**
	 * Resultado de Guardar en el formulario
	 * @author Mario A. Yandar
	 */
	public function articulo ($id_articulo) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->buscarArticulo($id_formulario, $id_persona, $id_articulo);
		echo json_encode($data);
	}

	/**
	 * Resultado de Eliminar en el formulario
	 * @author Mario A. Yandar
	 */
	public function noarticulo ($id_articulo) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->eliminarArticulo($id_formulario, $id_persona, $id_articulo);
		return true;
	}

	/**
	 * Autocompletar Articulos
	 * @author Mario A. Yandar
	 */
	public function autocart($name) {
		$this->load->model("Modgastosper");
		$data = $this->Modgastosper->autocompletarArt(strtoupper($name));
		echo json_encode($data);
	}

	/**
	 * Resultado de listar todas las comidas del formulario
	 * @author Mario A. Yandar
	 */
	public function comidas ($dia) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->listadoComidas($id_formulario, $id_persona, $dia);
		echo json_encode($data);
	}

	/**
	 * Resultado de Guardar en el formulario
	 * @author Mario A. Yandar
	 */
	public function comida ($id_comida) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->buscarComida($id_formulario, $id_persona, $id_comida);
		echo json_encode($data);
	}

	/**
	 * Resultado de Eliminar en el formulario
	 * @author Mario A. Yandar
	 */
	public function nocomida($id_comida) {
		$this->load->model("Modgastosper");
		$id_formulario = $this->session->userdata("id_formulario");
		$id_persona = $this->session->userdata("id_persona");
		$data = $this->Modgastosper->eliminarComida($id_formulario, $id_persona, $id_comida);
		return true;
	}
	
}// EOC
?>