<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Funciones varias para el uso en todo los programas
 * @author oagarzond
 * @since  2016-03-04
**/

class Funciones {
	
	function __construct(){
		
	}
	
	/**
	 * Imprimir arreglos de una forma mas legible
	 * @author oagarzond
	 * @param mixed $objVar Arreglo o cadena para mostrar por pantalla con formato
	 */
	public function pr($objVar) {
		echo "<div align='left'>";
		if (is_array($objVar) or is_object($objVar)) {
			echo "<pre>";
			print_r($objVar);
			echo "</pre>";
		} else {
			echo str_replace("\n", "<br>", $objVar);
		}
		echo "</div><hr>";
	}
}