<?php
/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author Mario A. Yandar
 * @since  2015-07-15
 */

class Mpersonas extends CI_Model {

    public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Funcion para obtener datos basicos de persona
	 * @author Mario A. Yandar
	 */
	public function listarPersonas($id_formulario) {
		$sql = "SELECT ID_PERSONA,P521A,P521B,P521C,P521D,INI_INGRESOS 
		FROM ENIG_FORM_PERSONAS WHERE ID_FORMULARIO='". $id_formulario ."' ORDER BY P521A,P521C";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->ID_PERSONA]['P521A']		= $row->P521A;
				$data[$row->ID_PERSONA]['P521B']		= $row->P521B;
				$data[$row->ID_PERSONA]['P521C']		= $row->P521C;
				$data[$row->ID_PERSONA]['P521D']		= $row->P521D;
				$data[$row->ID_PERSONA]['INI_INGRESOS']	= $row->INI_INGRESOS;
			}
		}
		$this->db->close();
		return $data;
	}

	/**
	 * Funcion para la guardar los campos de un formulario.
	 * @author Mario A. Yandar
	 */
    public function registrarInicioPersonas($id_persona) {
		$update = "UPDATE ENIG_FORM_PERSONAS SET INI_INGRESOS='SI' WHERE ID_PERSONA='$id_persona'";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
	}

}
?>