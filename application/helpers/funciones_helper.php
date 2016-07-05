<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author oagarzond
 * @param	String	$ruta	Ruta relativa
 * @return	Ruta absoluta deseada
 */
if (!function_exists("base_dir")) {
    function base_dir($ruta = '') {
        return FCPATH . $ruta;
    }
}

/**
 * @author oagarzond
 * @param	String	$ruta	Ruta relativa
 * @return	Ruta absoluta deseada
 */
if (!function_exists("base_app")) {
    function base_app($ruta = '') {
        return APPPATH . $ruta;
    }
}

/**
 * @author oagarzond
 * @param	String	$ruta_imagen	Ruta relativa con el nombre de la imagen y su extension
 * @return	Ruta absoluta de la imagen deseada
 */
if (!function_exists("base_dir_images")) {
    function base_dir_images($ruta_imagen = '') {
        $CI = & get_instance();
        $dir_images = FCPATH . 'images/';
        if (strlen($ruta_imagen) > 0) {
            $dir_images .= $ruta_imagen;
        }
        return $dir_images;
    }
}

/**
 * @author oagarzond
 * @param	String	$ruta_imagen	Ruta relativa con el nombre de la imagen y su extension
 * @return	URL absoluta de la imagen deseada
 */
if (!function_exists("base_url_images")) {
    function base_url_images($ruta_imagen = '') {
        $CI = & get_instance();
        $url_images = $CI->config->base_url() . 'images/';
        if (strlen($ruta_imagen) > 0) {
            $url_images .= $ruta_imagen;
        }
        return $url_images;
    }

}

/**
 * @author oagarzond
 * @param	String	$ruta_archivo	Ruta relativa con el nombre del archivo y su extension
 * @return	Ruta absoluta del archivo deseado
 */
if (!function_exists("base_dir_files")) {

    function base_dir_files($ruta_archivo = '') {
        $CI = & get_instance();
        $dir_files = FCPATH . 'files/';
        if (strlen($ruta_archivo) > 0) {
            $dir_files .= $ruta_archivo;
        }
        return $dir_files;
    }

}

/**
 * @author oagarzond
 * @param	String	$ruta_archivo	Ruta relativa con el nombre del archivo y su extension
 * @return	URL absoluta del archivo deseado
 */
if (!function_exists("base_url_files")) {

    function base_url_files($ruta_archivo = '') {
        $CI = & get_instance();
        $url_files = $CI->config->base_url() . 'files/';
        if (strlen($ruta_archivo) > 0) {
            $url_files .= $ruta_archivo;
        }
        return $url_files;
    }

}

/**
 * @author oagarzond
 * @param	String	$ruta_archivo	Ruta relativa con el nombre del archivo y su extension
 * @return	Ruta absoluta del archivo deseado
 */
if (!function_exists("base_dir_tmp")) {

    function base_dir_tmp($ruta_archivo = '') {
        $CI = & get_instance();
        $dir_tmp = FCPATH . 'tmp/';
        if (strlen($ruta_archivo) > 0) {
            $dir_tmp .= $ruta_archivo;
        }
        return $dir_tmp;
    }

}

/**
 * @author oagarzond
 * @param	String	$ruta_archivo	Ruta relativa con el nombre del archivo y su extension
 * @return	URL absoluta del archivo deseado
 */
if (!function_exists("base_url_tmp")) {

    function base_url_tmp($ruta_archivo = '') {
        $CI = & get_instance();
        $url_tmp = $CI->config->base_url() . 'tmp/';
        if (strlen($ruta_archivo) > 0) {
            $url_tmp .= $ruta_archivo;
        }
        return $url_tmp;
    }

}

if (!function_exists("validarSesion")) {
    function validarSesion() {
        $CI = & get_instance();
        $CI->load->helper("url");
        $CI->load->library("session");
        if (!$CI->session->userdata("auth")) {
            redirect('/login', 'refresh');
        }
    }
}

/**
 * Cargar controlador de otro modulo con PHP normal
 * e instanciar objeto de dicho controlador
 * @author oagarzond
 * @since 2016-03-11
 */
if (!function_exists('load_controller')) {
    function load_controller($module, $controller) {
        if (!file_exists(APPPATH . 'modules/' . $module . '/controllers/' . ucfirst(strtolower($model)) . '.php')) {
            exit('Unable to locate the controller you have specified: ' . $model);
        }

        require_once(APPPATH . 'modules/' . $module . '/controllers/' . ucfirst(strtolower($controller)) . '.php');
        if (class_exists($model, FALSE)) {
            $controller = new $controller();
            //$controller->$method();
            return $controller;
        } else {
            exit('Unable to open the controller you have specified: ' . $model);
        }
    }
}

/**
 * Cargar modelo de otro modulo con PHP normal
 * e instanciar objeto de dicho modelo
 * @author oagarzond
 * @since 2016-03-11
 */
if (!function_exists('load_model')) {
    function load_model($module, $model) {
        if (!file_exists(APPPATH . 'modules/' . $module . '/models/' . ucfirst(strtolower($model)) . '.php')) {
            exit('Unable to locate the model you have specified: ' . $model);
        }

        if (!@include(APPPATH . 'modules/' . $module . '/models/' . ucfirst(strtolower($model)) . '.php')) {
            exit("Failed to require " . APPPATH . 'modules/' . $module . '/models/' . ucfirst(strtolower($model)) . '.php');
        }

        if (class_exists($model, FALSE)) {
            $model = new $model();
            return $model;
        } else {
            exit('Unable to open the model you have specified: ' . $model);
        }
    }
}

/**
 * Imprimir arreglos de una forma mas legible
 * @author oagarzond
 * @param mixed $objVar Arreglo o cadena para mostrar por pantalla con formato
 */
if (!function_exists("pr")) {
    function pr($objVar) {
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


/**
 * Convierte a mayuscula la primera letra de cada palabra de la frase
 * @author Orlando Alberto Garzon Diaz <c.ogarzon@sic.gov.co>
 * @param   String  $texto  Texto a convertir
 * @return  String  $texto
 */
if (!function_exists("mayuscula_inicial")) {
    function mayuscula_inicial($texto) {
        if (strlen($texto)) {
            $texto = strtolower($texto);
            if (substr_count($texto, "@") == 0) {
                if (substr_count($texto, ".")) {
                    $arrTexto = explode(".", $texto);
                    $texto = "";
                    foreach ($arrTexto as $indTexto => $valTexto) {
                        if (strlen($valTexto) > 0) {
                            $texto .= ucwords($valTexto) . ".";
                        }
                    }
                } else {
                    $texto = ucwords($texto);
                }
            }
        }
        return $texto;
    }
}

/**
 * Funci�n para validar si una fecha es valida.
 *
 * Esta funci�n se utiliza para validar si la fecha pasada por parametro es valida o no Ej. 2011-02-29 no es una fecha valida.
 * @author javier-sanchez
 * @param string $cadena Arreglo o cadena para mostrar por pantalla con formato.
 * @param array $arrCaracteres Arreglo o cadena para mostrar por pantalla con formato.
 * @return string Retorna la cadena formateada o escapada.
 */
if (!function_exists("es_fecha_valida")) {
    function es_fecha_valida($fecha) {
        if (strstr($fecha, "-")) {
            $data = explode("-", $fecha);
            if (strlen($data[0]) != 4)
                return false;
            return(@checkdate(intval($data[1]), intval($data[2]), intval($data[0])));
        }
        elseif (strstr($fecha, "/")) {
            $data = explode("/", $fecha);
            if (strlen($data[2]) != 4)
                return false;
            return(@checkdate(intval($data[1]), intval($data[0]), intval($data[2])));
        }
    }
}


/**
 * Esta funci�n se utiliza para darle formato a la fecha pasada por parametro, 
 * es decir si se pasa el formato YYYY-MM-DD se retorna la fecha en formato DD/MM/YYYY y viceversa.
 * @author oagarzond
 * @param	date	$fecha	Fecha
 * @return	string	Retorna la fecha formateada o vacio si la fecha no es valida
 */
if (!function_exists("formatear_fecha")) {
    function formatear_fecha($fecha) {
        if (es_fecha_valida($fecha)) {
            if (strstr($fecha, "-")) {
                $data = explode("-", $fecha);
                return $data[2] . "/" . $data[1] . "/" . $data[0];
            } elseif (strstr($fecha, "/")) {
                $data = explode("/", $fecha);
                return $data[2] . "-" . $data[1] . "-" . $data[0];
            }
        } else
            return "";
    }
}

/**
 * Retorna el texto de una fecha a partir de una fecha valida
 * @author  oagarzond
 * @param   $fecha  String  Fecha al cual se va sumar los dias, debe estar en formato YYYY-MM-DD
 * @param   $dias   Integer Numero de dias que se van a sumar
 * @return  Fecha de venc. final o vacio si no se pudo sumar
 */
if (!function_exists("obtener_texto_fecha")) {
    function obtener_texto_fecha($fecha) {
        if (es_fecha_valida($fecha)) {
            $fechatexto = "";
            $unixMark = strtotime($fecha);
            $mes = intval(date("m", $unixMark));
            $textosMes = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
            foreach ($textosMes as $key => $value) {
                if ($key == $mes)
                    $mes = $textosMes[$key];
            }
            $fechatexto = date("d", $unixMark) . " de " . $mes . " de " . date("Y", $unixMark);
            return $fechatexto;
        }
    }
}

/**
 * Funcion para agregar los ceros en el dia y/o mes de la fecha
 * @author oagarzond
 * @param	$fecha	Texto de la fecha en formato YYYY-MM-DD o DD/MM/YYYY
 * @return	Fecha completa de logitud 10 
 */
if (!function_exists("completar_fecha")) {
    function completar_fecha($fecha) {
        if (strstr($fecha, "-")) {
            $data = explode("-", $fecha);
            return str_pad($data[0], 4, "0", STR_PAD_LEFT) . "-" . str_pad($data[1], 2, "0", STR_PAD_LEFT) . "-" . str_pad($data[2], 2, "0", STR_PAD_LEFT);
        } elseif (strstr($fecha, "/")) {
            $data = explode("/", $fecha);
            return str_pad($data[0], 2, "0", STR_PAD_LEFT) . "/" . str_pad($data[1], 2, "0", STR_PAD_LEFT) . "/" . str_pad($data[2], 4, "0", STR_PAD_LEFT);
        }
    }
}


/**
 * Retorna el texto de una fecha a partir de una fecha valida
 * @author  oagarzond
 * @param   $fecha  String  Fecha al cual se va sumar los dias, debe estar en formato YYYY-MM-DD
 * @param   $dias   Integer Numero de dias que se van a sumar
 * @return  Fecha de venc. final o vacio si no se pudo sumar
 */
if (!function_exists("obtener_texto_fecha")) {
    function obtener_texto_fecha($fecha) {
        if (esFechaValida($fecha)) {
            $fechatexto = "";
            $unixMark = strtotime($fecha);
            $mes = intval(date("m", $unixMark));
            $textosMes = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
            foreach ($textosMes as $key => $value) {
                if ($key == $mes)
                    $mes = $textosMes[$key];
            }
            $fechatexto = date("d", $unixMark) . " de " . $mes . " de " . date("Y", $unixMark);
            return $fechatexto;
        }
    }
}

/**
 * Retorna el texto del mes
 * @author oagarzond
 * @param	$mes	Numero del mes que se quiere mostrar
 * @return	Nombre del mes
 */
if (!function_exists("obtener_texto_mes")) {
    function obtener_texto_mes($mes = 0) {
        $textosMes = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        foreach ($textosMes as $key => $value) {
            if ($key == $mes)
                $mes = $textosMes[$key];
        }
        return $mes;
    }
}

/**
 * Retorna el html para mostrar un campo input text
 * @author mayandarl
 * @author oagarzond
 * @param	$arr_var	Variables que componen la estructura del input
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_input_text")) {
	function mostrar_input_text($arr_var) {
		$html = "<input type='text'";
		if (count($arr_var) > 0) {
			//if($arr_var["TIPO_DATO"] == "NUMERICO")
			//	$html = "<input type='number'";
			$html .= " size='" . $arr_var['LONG_TEXTO'] . "' maxlength='" . $arr_var['LONGITUD'] . "' placeholder='" . $arr_var['ETIQUETA'] . "' " . " id='" . $arr_var['ID_VARIABLE'] . "' name='" . $arr_var['ID_VARIABLE'] . "' data-toggle='popover' data-trigger='focus hover' data-content='' />\n";
		}
		return $html;
	}
}

/**
 * Retorna el html para mostrar un campo select
 * @author mayandarl
 * @author oagarzond
 * @param	$arr_var	Variables que componen la estructura del select
 * @param	$arr_opc	Opciones que tiene el select
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_select")) {
	function mostrar_select($arr_var, $arr_opc) {
		$html = "";
		if (count($arr_var) > 0) {
			$html = "<select id='" . $arr_var['ID_VARIABLE'] . "' name='" . $arr_var['ID_VARIABLE'] . "'>\n";
			foreach ($arr_opc as $k1 => $v1) {
				$sel = "";
				if ($arr_var['ID_VARIABLE'] == $v1 ['ID_VARIABLE']) {
					if ($arr_var['VR_DEFECTO'] == $v1 ['ID_VALOR'])
						$sel = 'selected';
					$html .= "<option value='" . $v1 ['ID_VALOR'] . "' $sel>" . $v1 ['ETIQUETA'] . "</option>\n";
				}
			}
			$html .= "</select>\n";
		}
		return $html;
	}
}

/**
 * Retorna el html para mostrar varios radios
 * @author mayandarl
 * @author oagarzond
 * @param	$arr_var	Variables que componen la estructura de los radios
 * @param	$arr_opc	Opciones que tiene cada radio
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_radios")) {
	function mostrar_radios($arr_var, $arr_opc) {
		$html = "";
		if (count($arr_var) > 0) {
			foreach ($arr_opc as $k1 => $v1) {
				$sel = "";
				if ($arr_var['ID_VARIABLE'] == $v1 ['ID_VARIABLE']) {
					if ($arr_var['VR_DEFECTO'] == $v1 ['ID_VALOR'])
						$sel = 'checked';
					$html .= "<input type='radio' name='" . $v1 ['ID_VARIABLE'] . "' id='". $arr_var['ID_VARIABLE'] .".". $v1 ['ID_VALOR'] ."' value='" .
							$v1 ['ID_VALOR'] . "'" . " $sel /><label for='". $arr_var['ID_VARIABLE'] .".". $v1 ['ID_VALOR'] ."'> " . $v1 ['ETIQUETA'];
					if (!empty($v1['DESCRIPCION_OPCION']))
						$html .= "&nbsp;<a href='#' data-toggle='tooltip' title='" . $v1['DESCRIPCION_OPCION'] . "'>(?)</a>";
					$html .= "</label><br/>\n";
				}
			}
		}
		return $html;
	}
}

/**
 * Retorna el html para mostrar radios para SI / NO
 * @author mayandarl
 * @param	$arr_var	Variables que componen la estructura de los radios
 * @param	$arr_opc	Opciones que tiene cada radio
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_sino")) {
	function mostrar_sino($arr_var, $arr_opc) {
		$html = "";
		if (count($arr_var) > 0) {
			foreach ($arr_opc as $k1 => $v1) {
				$sel = "";
				$hdn = "";
				if ($arr_var['ID_VARIABLE'] == $v1 ['ID_VARIABLE']) {
					if ($arr_var['VR_DEFECTO'] == $v1 ['ID_VALOR'])
						$sel = 'checked';
					if (empty($v1['ID_VALOR']))
						$hdn = 'style="display:none"';
					$html .= "<input type='radio' name='". $v1['ID_VARIABLE'] ."' id='". $arr_var['ID_VARIABLE'] .".". $v1['ID_VALOR'] ."' value='".
							$v1 ['ID_VALOR'] . "'" . " $sel $hdn /> ";
					if (empty($hdn))
						$html .= "<label for='". $arr_var['ID_VARIABLE'] .".". $v1 ['ID_VALOR'] ."'> ". $v1 ['ETIQUETA'];
					if (!empty($v1['DESCRIPCION_OPCION']))
						$html .= "&nbsp;<a href='#' data-toggle='tooltip' title='" . $v1['DESCRIPCION_OPCION'] . "'>(?)</a>";
					if (empty($hdn))
						$html .= "</label>";
					$html .= "&nbsp;&nbsp;\n";
				}
			}
		}
		return $html;
	}
}

/**
 * Retorna el html para mostrar casilla con opciones No sabe, No informa.
 * @author mayandarl
 * @param	$arr_var	Variables que componen la estructura de los radios
 * @param	$arr_opc	Opciones que tiene cada radio
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_numnosabe")) {
	function mostrar_numnosabe($arr_var) {
		//$html  = "<input type='radio' name='_". $arr_var['ID_VARIABLE'] ."' onClick=\"$('#". $arr_var['ID_VARIABLE'] ."').removeAttr('disabled')\" value='0'/> ";
		$html = "<input type='text' id='". $arr_var['ID_VARIABLE'] ."' name='". $arr_var['ID_VARIABLE'] ."' ";
		$html .= " size='". $arr_var['LONG_TEXTO'] ."' maxlength='". $arr_var['LONGITUD'] ."' placeholder='". $arr_var['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='98')".
		"document.getElementById('". $arr_var['ID_VARIABLE'] .".98').checked=false; if(\$(this).val()!='99') document.getElementById('". $arr_var['ID_VARIABLE'] .".99').checked=false;\" />&nbsp;&nbsp;\n";
		$html .= "<input type='radio' id='". $arr_var['ID_VARIABLE'] .".98' name='_". $arr_var['ID_VARIABLE'] ."' onClick=\"$('#". $arr_var['ID_VARIABLE'] ."').val('98');$('#". $arr_var['ID_VARIABLE'] ."').focus();\"/> No sabe &nbsp;&nbsp;\n";
		$html .= "<input type='radio' id='". $arr_var['ID_VARIABLE'] .".99' name='_". $arr_var['ID_VARIABLE'] ."' onClick=\"$('#". $arr_var['ID_VARIABLE'] ."').val('99');$('#". $arr_var['ID_VARIABLE'] ."').focus();\"/> No informa\n";
        return $html;
	}
}

/**
 * Retorna el html para mostrar casilla con opciones No informa.
 * @author mayandarl
 * @param	$arr_var	Variables que componen la estructura de los radios
 * @param	$arr_opc	Opciones que tiene cada radio
 * @return	$html		Texto en html
 */
if (!function_exists("mostrar_numnoinfo")) {
	function mostrar_numnoinfo($arr_var) {
		$html = "<input type='text' id='". $arr_var['ID_VARIABLE'] ."' name='". $arr_var['ID_VARIABLE'] ."' ";
		$html .= " size='". $arr_var['LONG_TEXTO'] ."' maxlength='". $arr_var['LONGITUD'] ."' placeholder='". $arr_var['ETIQUETA'] ."' onBlur=\"if(\$(this).val()!='99')".
			"document.getElementById('". $arr_var['ID_VARIABLE'] .".99').checked=false;\" />&nbsp;&nbsp;\n";
		$html .= "<input type='radio' id='". $arr_var['ID_VARIABLE'] .".99' name='_". $arr_var['ID_VARIABLE'] ."' onClick=\"$('#". $arr_var['ID_VARIABLE'] ."').val('99');$('#". $arr_var['ID_VARIABLE'] ."').focus();\" /> No informa\n";
        return $html;
	}
}


/**
 * Retorna el texto de la ultima semana de la fecha parametrizada
 * @author oagarzond
 * @param	$fecha		Fecha en la que se va a calcular el dia y la semana en que estaba
 * @return	$txt_fecha	Texto de la semana que precede inmediatamente a la fecha
 */
if (!function_exists("calcular_ult_sem")) {
    function calcular_ult_sem($fecha) {
        $txt_fecha = '';
        $num_dia = date("w", strtotime($fecha));
        switch ($num_dia) {
            case "0": // domingo
                $fecha_ini = date("Y-m-d", strtotime("-6 day", strtotime($fecha)));
                $fecha_fin = $fecha;
                break;
            case "1": // lunes
                $fecha_ini = date("Y-m-d", strtotime("-7 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-1 day", strtotime($fecha)));
                break;
            case "2": // martes
                $fecha_ini = date("Y-m-d", strtotime("-8 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-2 day", strtotime($fecha)));
                break;
            case "3": // miercoles
                $fecha_ini = date("Y-m-d", strtotime("-9 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-3 day", strtotime($fecha)));
                break;
            case "4": // jueves
                $fecha_ini = date("Y-m-d", strtotime("-10 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-4 day", strtotime($fecha)));
                break;
            case "5": // viernes
                $fecha_ini = date("Y-m-d", strtotime("-11 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-5 day", strtotime($fecha)));
                break;
            case "6": // sabado
                $fecha_ini = date("Y-m-d", strtotime("-12 day", strtotime($fecha)));
                $fecha_fin = date("Y-m-d", strtotime("-6 day", strtotime($fecha)));
                break;
        }
        $txt_fecha = obtener_texto_fecha($fecha_ini) . " al " . obtener_texto_fecha($fecha_fin);
        return $txt_fecha;
    }
}

if (!function_exists("mostrar_jquery_var")) {
    function mostrar_jquery_var($arr_var) {
        // 2016-03-31 - mayandarl - Asignacion de tipos de datos
        $js = '';
        foreach ($arr_var as $k => $v) {
            //$js .= "\t$('#" . $v ['ID_VARIABLE'] . "').popover();\n";
            if ($v ['TIPO_DATO'] == 'NUMERICO')
                $js .= "\t$('#" . $v ['ID_VARIABLE'] . "').numerico();\n";
            if ($v ['TIPO_CAMPO'] == 'MAYUSC')
                $js .= "\t$('#" . $v ['ID_VARIABLE'] . "').mayusculas();\n";
            if ($v ['TIPO_CAMPO'] == 'MONEDA')
                $js .= "\t$('#" . $v ['ID_VARIABLE'] . "').numerico().moneda();\n";
        }
        return $js;
    }
}

if (!function_exists("mostrar_jquery_val")) {
    function mostrar_jquery_val($arr_val) {
        // 2016-03-31 - mayandarl - Asignacion de valores iniciales
        $js = '';
        foreach ($arr_val as $k => $v) {
            $js .= "\tasignarValor('$k', '$v');\n";
        }
        return $js;
    }
}

if (!function_exists("mostrar_jquery_reg")) {
    function mostrar_jquery_reg($arr_reg, $pag = 0) {
        // 2016-03-31 - mayandarl - Incluye las reglas de validacion
        $js = '';
        foreach ($arr_reg as $k => $v) {
            $f = explode("__", $k);
            if ($f [1] == '1')
                $js .= "\t\$('#" . $f [0] . "').consistencia('" . $f [0] . "', regla_cap" . $pag . ");\n";
        }
        return $js;
    }
}

/**
 * Retorna el texto de los textos separados por comas, excepto el ultimo texto que se separa con una y
 * @author oagarzond
 * @param	$arr_val	Valores que se van a contatenar
 * @return	$str_val	Texto con los valores concatenados
 */
if (!function_exists("mostrar_texto_comas")) {
    function mostrar_texto_comas($arr_val) {
		$str_val = '';
		$total = count($arr_val);
		if ($total == 1)
			$str_val = $arr_val[0];
		else if ($total > 1) {
			foreach ($arr_val as $k => $v) {
				if ($k == 0) {
					$str_val = $arr_val[$k];
				} else if ($k <= ($total - 2)) {
					$str_val .= ", " . $arr_val[$k];
				} else if ($k == ($total - 1)) {
					$str_val .= " y " . $arr_val[$k];
				}
			}
		}
		return $str_val;
	}
}


/**
 * Retorna el texto de una fecha a partir de una fecha valida
 * @author  oagarzond
 * @param   String  $fecha          Fecha al cual se va a trasnformar en texto
 * @return  String  $fecha_texto    Texto de la fecha
 */
if (!function_exists("obtener_texto_fecha")) {

    function obtener_texto_fecha($fecha) {
        if (esFechaValida($fecha)) {
            $fechatexto = "";
            $unixMark = strtotime($fecha);
            $mes = intval(date("m", $unixMark));
            $textosMes = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
            foreach ($textosMes as $key => $value) {
                if ($key == $mes)
                    $mes = $textosMes[$key];
            }
            $fecha_texto = date("d", $unixMark) . " de " . $mes . " de " . date("Y", $unixMark);
            return $fecha_texto;
        }
    }

}

/**
 * Convierte a mayuscula la primera letra de cada palabra de la frase 
 * @author oagarzond
 * @param   String  $texto  Texto a convertir   
 * @return  String  $texto
 */
if (!function_exists("mayuscula_inicial")) {

    function mayuscula_inicial($texto) {
        if (strlen($texto)) {
            $texto = strtolower($texto);
            if (substr_count($texto, "@") == 0) {
                if (substr_count($texto, ".")) {
                    $arrTexto = explode(".", $texto);
                    $texto = "";
                    foreach ($arrTexto as $indTexto => $valTexto) {
                        if (strlen($valTexto) > 0) {
                            $texto .= ucwords($valTexto) . ".";
                        }
                    }
                } else {
                    $texto = ucwords($texto);
                }
            }
        }
        return $texto;
    }

}


//EOC