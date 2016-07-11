<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo para Encuesta de Transporte Capitulo 1
 * @author mayandarl
 * @since  2015-07-15
 */
// oagarzond - Se debe dejar nombres de modelos diferentes en casos que se quiera llamar desde otro modulo
class Modgastoshog extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
    }
    
    /**
     * Funcion general para listar los campos del formulario para una seccion y pagina dada.
     * @author mayandarl
     * @since  Marzo 16 / 2016
     */
    public function listarValores($variables, $tabla) {
        $sql = "SELECT * FROM " . $tabla . " WHERE ID_FORMULARIO='" . $this->id_formulario . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                foreach ($variables as $k => $v) {
                    if (isset($row->$v['ID_VARIABLE'])) {
                        $data[$v['ID_VARIABLE']] = $row->$v['ID_VARIABLE'];
                    }
                }
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para la creacion de un formulario 
     * @author Mario A. Yandar
     */
    public function crearFormularioArticulo($id_formulario, $dia, $id_articulo, $datos) {
		// Uso de funcion sys_guid() de Oracle para generar ID
		$query = false;
		$insert = "INSERT INTO ENIG_FORM_GDH_ARTICULOS (ID_FORMULARIO,DIA,ID_ARTICULO) VALUES ('$id_formulario',TO_DATE('$dia','YYYY-MM-DD'),'$id_articulo')";
		$query = $this->db->query($insert);
		if ($datos != null)
			$this->actualizarFormularioArticulo($id_formulario, $dia, $id_articulo, $datos);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para la guardar los campos de un formulario.
     * @author Mario A. Yandar
     */
    public function actualizarFormularioArticulo($id_formulario, $dia, $id_articulo, $valores) {
		$sets = "";
		$query = false;
		foreach ($valores as $k => $v) {
			// Ajustar comilla simple en consulta
			$v = str_replace("'", "''", $v);
			// No asigna ID de la tabla ni campos del sistema (que inician con _)
			if ($k != $this->id && substr($k, 0, 1) != '_') {
				$sets .= "$k='$v',";
			}
		}
		$sets = substr($sets, 0, -1); // elimina ultima coma
		$update = "UPDATE ENIG_FORM_GDH_ARTICULOS SET $sets WHERE ID_FORMULARIO='$id_formulario' AND DIA=TO_DATE('$dia','YYYY-MM-DD') AND ID_ARTICULO='$id_articulo'";
		$query = $this->db->query($update);
		$this->db->close();
		return $query;
    }

    /**
     * Funcion para listar los articulos de la encuesta de gastos:
     * @author Mario A. Yandar
     */
    public function listadoArticulos($id_formulario, $dia) {
		$sql = "SELECT * FROM ENIG_FORM_GDH_ARTICULOS A WHERE ID_FORMULARIO='". $id_formulario . "' AND DIA=TO_DATE('$dia', 'YYYY-MM-DD')";
		$query = $this->db->query($sql);
		$data = array();
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row) {
				$data[$i]['ID_ARTICULO'] = $row->ID_ARTICULO;
				$data[$i]['NH_CGDU_P1_1'] = $row->NH_CGDU_P1_1;
				$data[$i]['NH_CGDU_P1_1_S1'] = $row->NH_CGDU_P1_1_S1;
				$i++;
			}
		}
		$this->db->close();
		return $data;
    }

    /**
     * Funcion para buscar articulo de hogar
     * @author Mario A. Yandar
     */
    public function buscarArticulo($id_formulario, $id_articulo) {
        $sql = "SELECT * FROM ENIG_FORM_GDH_ARTICULOS 
		WHERE ID_FORMULARIO='" . $id_formulario . "' AND ID_ARTICULO='" . $id_articulo . "'";
        $query = $this->db->query($sql);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['_ID_ARTICULO'] = $row->ID_ARTICULO;
            }
        }
        $this->db->close();
        return $data;
    }

    /**
     * Funcion para eliminar un registro de articulos
     * @author Mario A. Yandar
     */
    public function eliminarArticulo($id_formulario, $id_articulo) {
        $delete = "DELETE FROM ENIG_FORM_GDH_ARTICULOS WHERE ID_FORMULARIO='$id_formulario' AND ID_ARTICULO='$id_articulo'";
        $query = $this->db->query($delete);
        $this->db->close();
        return $query;
    }

    
}

?>