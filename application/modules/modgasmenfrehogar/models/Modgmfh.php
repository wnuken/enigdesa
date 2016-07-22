<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo para el modulo de gastos menos frecuentes del hogar
 * @author oagarzond
 * @since 2016-06-20
 */
// oagarzond - Se debe dejar nombres de modelos diferentes en casos que se quiera llamar desde otro modulo
class Modgmfh extends My_model {
    private $id = "ID_FORMULARIO";
    private $id_formulario;

    public function __construct() {
        parent::__construct();
        $this->id_formulario = '';
    }
    
    public function set_id_formulario($id_formulario) {
        $this->id_formulario = $id_formulario;
    }
    
    /**
     * Consulta los datos de los registros de las secciones
     * @access Public
     * @author oagarzond
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function listar_secciones($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;
        
        if (array_key_exists("id", $arrDatos)) {
            $cond .= " AND ID_SECCION3 = '" . $arrDatos["id"] . "'";
        }
        if (array_key_exists("id0", $arrDatos)) {
            $cond .= " AND ID_SECCION3 LIKE '%0%'";
        }
        if (array_key_exists("cap", $arrDatos)) {
            $cond .= " AND CAPITULO = '" . $arrDatos["cap"] . "'";
        }
        if (array_key_exists("mod", $arrDatos)) {
            $cond .= " AND MODULO = '" . $arrDatos["mod"] . "'";
        }
        if (array_key_exists("pag", $arrDatos)) {
            if (is_int($arrDatos["pag"])) {
                $cond .= " AND PAGINA = " . $arrDatos["pag"];
            } else if (is_string($arrDatos["pag"])) {
                $cond .= " AND PAGINA = '" . $arrDatos["pag"] . "'";
            } else if (is_array($arrDatos["pag"])) {
                $cond .= " AND PAGINA IN (" . implode(",", $arrDatos["pag"]) . ")";
            }
        }
        
        $sql = "SELECT * 
                FROM ENIG_ADMIN_GMF_SECCIONES 
                WHERE ID_SECCION3 IS NOT NULL " . $cond . 
                " ORDER BY ID_SECCION3";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }
    
    /**
     * Consulta los datos de los registros del avance por secciones
     * @access Public
     * @author oagarzond
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function listar_secciones_avances($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;

        if (array_key_exists("id", $arrDatos)) {
            $cond .= " AND S.ID_SECCION3 = '" . $arrDatos["id"] . "'";
        }
        else if (array_key_exists("id0", $arrDatos)) {
            $cond .= " AND S.ID_SECCION3 LIKE '" . $arrDatos["id0"] . "%'";   
        }
        if (array_key_exists("idForm", $arrDatos)) {
            $cond .= " AND A.ID_FORMULARIO = '" . $arrDatos["idForm"] . "'";
        }
        if (array_key_exists("cap", $arrDatos)) {
            $cond .= " AND S.CAPITULO = '" . $arrDatos["cap"] . "'";
        }
        if (array_key_exists("mod", $arrDatos)) {
            $cond .= " AND S.MODULO = '" . $arrDatos["mod"] . "'";
        }
        if (array_key_exists("accion", $arrDatos)) {
            $cond .= " AND S.ACCION = '" . $arrDatos["accion"] . "'";
        }
        if (array_key_exists("pag", $arrDatos)) {
            if (is_int($arrDatos["pag"])) {
                $cond .= " AND S.PAGINA = " . $arrDatos["pag"];
            } else if (is_string($arrDatos["pag"])) {
                $cond .= " AND S.PAGINA = '" . $arrDatos["pag"] . "'";
            } else if (is_array($arrDatos["pag"])) {
                $cond .= " AND S.PAGINA IN (" . implode(",", $arrDatos["pag"]) . ")";
            }
        }
        if (array_key_exists("estado", $arrDatos)) {
            if (is_int($arrDatos["estado"])) {
                $cond .= " AND A.ID_ESTADO_SEC = " . $arrDatos["estado"];
            } else if (is_string($arrDatos["estado"])) {
                $cond .= " AND A.ID_ESTADO_SEC = '" . $arrDatos["estado"] . "'";
            } else if (is_array($arrDatos["estado"])) {
                $cond .= " AND A.ID_ESTADO_SEC IN (" . implode(",", $arrDatos["estado"]) . ")";
            }
        }
        
        $sql = "SELECT S.*,  A.* 
            FROM ENIG_ADMIN_GMF_SECCIONES S 
            LEFT JOIN ENIG_ADMIN_GMF_CONTROL A ON (A.ID_SECCION3 = S.ID_SECCION3) 
            WHERE S.ID_SECCION3 IS NOT NULL " . $cond . 
            " ORDER BY S.ID_SECCION3";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }
    
    /**
     * Consulta los datos de los parametros en general
     * @access Public
     * @author oagarzond
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function consultar_param_general($id = '', $tipo = '', $valor = '', $desc = '') {
        $data = array();
        $cond = '';
        $i = 0;
        
        if (!empty($id)) {
            if (is_int($id)) {
                $cond .= " AND G.ID_PARAM = " . $id;
            } else if (is_string($id)) {
                $cond .= " AND G.ID_PARAM = '" . $id . "'";
            } else if (is_array($id)) {
                $cond .= " AND G.ID_PARAM IN (" . implode(",", $id) . ")";
            }
        }
        if (!empty($tipo)) {
            if (is_int($tipo)) {
                $cond .= " AND G.TIPO_PARAM = " . $tipo;
            } else if (is_string($tipo)) {
                $cond .= " AND G.TIPO_PARAM = '" . $tipo . "'";
            } else if (is_array($tipo)) {
                $cond .= " AND G.TIPO_PARAM IN (" . implode(",", $tipo) . ")";
            }
        }
        if (!empty($valor)) {
            if (is_int($valor)) {
                $cond .= " AND G.VALOR_PARAM = " . $valor;
            } else if (is_string($valor)) {
                $cond .= " AND G.VALOR_PARAM = '" . $valor . "'";
            } else if (is_array($valor)) {
                $cond .= " AND G.VALOR_PARAM IN (" . implode(",", $valor) . ")";
            }
        }
        if (!empty($desc)) {
            if (is_int($desc)) {
                $cond .= " AND G.DESC_PARAM = " . $desc;
            } else if (is_string($desc)) {
                $cond .= " AND G.DESC_PARAM = '" . $desc . "'";
            } else if (is_array($desc)) {
                $cond .= " AND G.DESC_PARAM IN (" . implode(",", $desc) . ")";
            }
        }
        
        $sql = "SELECT G.*  
            FROM ENIG_PARAM_GENERAL G 
            WHERE G.ID_PARAM IS NOT NULL " . $cond . 
            " ORDER BY G.ID_PARAM";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }
    
    /**
     * Consulta los datos de los registros de los articulos por seccion
     * @access Public
     * @author oagarzond
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function listar_articulos_seccion($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;
        
        if (array_key_exists("id", $arrDatos)) {
            if (is_int($arrDatos["id"])) {
                $cond .= " AND A.ID_ARTICULO3 = " . $arrDatos["id"];
            } else if (is_string($arrDatos["id"])) {
                $cond .= " AND A.ID_ARTICULO3 = '" . $arrDatos["id"] . "'";
            } else if (is_array($arrDatos["id"])) {
                $cond .= " AND A.ID_ARTICULO3 IN (" . implode(",", $arrDatos["id"]) . ")";
            }
        }
        if (array_key_exists("sec", $arrDatos)) {
            $cond .= " AND A.ID_SECCION3 = '" . $arrDatos["sec"] . "'";
        }
        if (array_key_exists("etiqueta", $arrDatos)) {
            $cond .= " AND A.ETIQUETA = '" . $arrDatos["etiqueta"] . "'";
        }
        if (array_key_exists("orden", $arrDatos)) {
            $cond .= " AND A.ORDEN_VISUAL = '" . $arrDatos["orden"] . "'";
        }
        if (array_key_exists("lugar", $arrDatos)) {
            $cond .= " AND A.DEFINE_LUGAR_COMPRA = '" . $arrDatos["lugar"] . "'";
        }
        if (array_key_exists("frecu", $arrDatos)) {
            $cond .= " AND A.DEFINE_FRECU_COMPRA = '" . $arrDatos["frecu"] . "'";
        }
        
        $sql = "SELECT A.* 
            FROM ENIG_PARAM_GMF_ARTICULOS A 
            WHERE A.ID_ARTICULO3 IS NOT NULL " . $cond . 
            " ORDER BY A.ORDEN_VISUAL";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }
    
    
    /**
     * Consulta las forma de obtencion que van en los formlarios
     * @access Public
     * @author cemedinaa
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function lista_formaObtencion($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;

        if (array_key_exists("articulo", $arrDatos)) {
            if (is_string($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 = '" . $arrDatos["articulo"] . "'";
            } else if (is_array($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 IN (" . implode(",", $arrDatos["articulo"]) . ")";
            }
        }
        if (array_key_exists("seccion", $arrDatos)) {
            if (is_string($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 = '" . $arrDatos["seccion"] . "'";
            } else if (is_array($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 IN ('" . implode("','", $arrDatos["seccion"]) . "')";
            }
        }
        if (array_key_exists("id_formulario", $arrDatos)) {
            $cond .= " AND FO.ID_FORMULARIO = '" . $arrDatos["id_formulario"] . "'";
        }
        if (array_key_exists("compra", $arrDatos)) {
            $cond .= " AND FO.COMPRA = '" . $arrDatos["compra"] . "'";
        }
        if (array_key_exists("sincompra", $arrDatos)) {
            $cond .= " AND ( FO.RECIBIDO_PAGO = '" . $arrDatos["sincompra"] . "' OR FO.REGALO = '" . $arrDatos["sincompra"] . "' OR FO.INTERCAMBIO = '" . $arrDatos["sincompra"] . "' 
                        OR FO.PRODUCIDO = '" . $arrDatos["sincompra"] . "' OR FO.NEGOCIO_PROPIO = '" . $arrDatos["sincompra"] . "' OR FO.OTRA = '" . $arrDatos["sincompra"] . "' )";
        }
    
        
        $sql = "SELECT A.*,FO.* 
            FROM ENIG_FORM_GMF_FORMA_OBTENCION FO 
            INNER JOIN ENIG_PARAM_GMF_ARTICULOS A ON FO.ID_ARTICULO3 = A.ID_ARTICULO3
            WHERE A.ID_ARTICULO3 IS NOT NULL $cond  
             ORDER BY A.ORDEN_VISUAL ASC";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }

    /**
     * Consulta los articulos comprados que van en los formlarios
     * @access Public
     * @author cemedinaa
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function lista_compra($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;

        if (array_key_exists("articulo", $arrDatos)) {
            if (is_string($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 = '" . $arrDatos["articulo"] . "'";
            } else if (is_array($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 IN (" . implode(",", $arrDatos["articulo"]) . ")";
            }
        }
        if (array_key_exists("seccion", $arrDatos)) {
            if (is_string($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 = '" . $arrDatos["seccion"] . "'";
            } else if (is_array($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 IN ('" . implode("','", $arrDatos["seccion"]) . "')";
            }
        }
        if (array_key_exists("id_formulario", $arrDatos)) {
            $cond .= " AND CO.ID_FORMULARIO = '" . $arrDatos["id_formulario"] . "'";
        }
    
        
        $sql = "SELECT A.*,CO.* 
            FROM ENIG_FORM_GMF_COMPRA CO 
            INNER JOIN ENIG_PARAM_GMF_ARTICULOS A ON CO.ID_ARTICULO3 = A.ID_ARTICULO3
            WHERE A.ID_ARTICULO3 IS NOT NULL $cond  
             ORDER BY A.ORDEN_VISUAL ASC";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }

    /**
     * Consulta los formas de adquisicion que van en los formlarios
     * @access Public
     * @author cemedinaa
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function lista_formaAdqui($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;

        if (array_key_exists("articulo", $arrDatos)) {
            if (is_string($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 = '" . $arrDatos["articulo"] . "'";
            } else if (is_array($arrDatos["articulo"])) {
                $cond .= " AND A.ID_ARTICULO3 IN (" . implode(",", $arrDatos["articulo"]) . ")";
            }
        }
        if (array_key_exists("seccion", $arrDatos)) {
            if (is_string($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 = '" . $arrDatos["seccion"] . "'";
            } else if (is_array($arrDatos["seccion"])) {
                $cond .= " AND A.ID_SECCION3 IN ('" . implode("','", $arrDatos["seccion"]) . "')";
            }
        }
        if (array_key_exists("id_formulario", $arrDatos)) {
            $cond .= " AND FA.ID_FORMULARIO = '" . $arrDatos["id_formulario"] . "'";
        }
        if (array_key_exists("variable", $arrDatos)) {
            $cond .= " AND FA.ID_VARIABLE = '" . $arrDatos["variable"] . "'";
        }
    
        
        $sql = "SELECT A.*,FA.* 
            FROM ENIG_FORM_GMF_FORMAS_ADQUI FA 
            INNER JOIN ENIG_PARAM_GMF_ARTICULOS A ON FA.ID_ARTICULO3 = A.ID_ARTICULO3
            WHERE A.ID_ARTICULO3 IS NOT NULL $cond  
             ORDER BY A.ORDEN_VISUAL ASC";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }

    /**
     * Consulta los formas de adquisicion que van en los formlarios
     * @access Public
     * @author cemedinaa
     * @param Array     $arrDatos   Arreglo asociativo con los valores para hacer la consulta
     * @return Array    $data       Registros devueltos por la consulta
     */
    public function lista_variables_param($arrDatos) {
        $data = array();
        $cond = '';
        $i = 0;

        if (array_key_exists("id", $arrDatos)) {
            if (is_string($arrDatos["id"])) {
                $cond .= " AND V.ID_VARIABLE = '" . $arrDatos["id"] . "'";
            } else if (is_array($arrDatos["articulo"])) {
                $cond .= " AND V.ID_VARIABLE IN (" . implode(",", $arrDatos["id"]) . ")";
            }
        }
        if (array_key_exists("seccion", $arrDatos)) {
            if (is_string($arrDatos["seccion"])) {
                $cond .= " AND V.ID_SECCION3 = '" . $arrDatos["seccion"] . "'";
            } else if (is_array($arrDatos["seccion"])) {
                $cond .= " AND V.ID_SECCION3 IN ('" . implode("','", $arrDatos["seccion"]) . "')";
            }
        }
        if (array_key_exists("pagina", $arrDatos)) {
            if (is_string($arrDatos["seccion"])) {
                $cond .= " AND V.PAG_SECCION3 = '" . $arrDatos["pagina"] . "'";
            } else if (is_array($arrDatos["seccion"])) {
                $cond .= " AND V.PAG_SECCION3 IN ('" . implode("','", $arrDatos["pagina"]) . "')";
            }
        }
    
        
        $sql = "SELECT V.* 
            FROM ENIG_PARAM_GMF_VARIABLES V 
            WHERE V.ID_SECCION3 IS NOT NULL $cond  
             ORDER BY V.ORDEN_VISUAL ASC";
        //pr($sql); exit;
        $query = $this->db->query($sql);
        while ($row = $query->unbuffered_row('array')) {
            $data[$i] = $row;
            $i++;
        }
        $this->db->close();
        return $data;
    }

}
//EOC