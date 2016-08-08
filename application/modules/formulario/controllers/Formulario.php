<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador para el modulo de Vivienda y hogar
 * 
 * @author mayandarl
 * @since 2016-04-11
 */
class Formulario extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->config->load ( "sitio" );
		$this->load->library ( "danecrypt" );
		date_default_timezone_set ( 'America/Bogota' );
	}
	
	public function anterior($seccion, $pagina) {
		echo "test";
	}
	/**
	 * Ingreso de datos del formulario
	 * @author mayandarl
	 */
	public function siguiente() {
		echo "test";
	}
	
	/**
	 * Resultado de guardar el formulario
	 * @author mayandarl
	 */
	public function guardar($seccion, $pagina) {
		echo "test";
	}
	
	public function crearTabla($capitulo) {
		$this->load->model ("Mformulario");
		$vars = $this->Mformulario->listarVariablesxCapitulo($capitulo);
		$sql = 'CREATE TABLE "'. $vars[0]['TABLA_ASOCIADA']. '" ('. "\n";
		$com = 'COMMENT ON COLUMN "'. $vars[0]['TABLA_ASOCIADA'] .'"."ID_FORMULARIO" IS \'ID del formulario\';'. "\n";
		foreach ($vars as $v) {
			$sql .= '"'. $v['ID_VARIABLE'] .'"';
			if ($v['TIPO_DATO'] == "NUMERICO")
				$sql .= ' NUMBER,'. "\n";
			else
				$sql .= ' VARCHAR2('. $v['LONGITUD'].'),'. "\n";
			$com .= 'COMMENT ON COLUMN "'. $v['TABLA_ASOCIADA'] .'"."'. $v['ID_VARIABLE'] .'" IS \''. $v['DESCRIPCION'] .'\';'. "\n";
		}
		$sql .= '"ID_FORMULARIO" VARCHAR2(40));'. "\n";
		pr($sql);
		pr($com);
	}

	
}
?>