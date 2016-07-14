<hr />
<div class="row">
    <div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png") ?>" /></div>
    <div class="col-sm-8">
        <h2><?= $secc[0]['DESCR_SECCION'] . "(" . $secc[0]['TEMPORALIDAD'] . ")" ?></h2>
        <h4><?//echo $persona['P521A'] ." ". $persona['P521C'] ." (". $persona['P6040'] .")"; ?></h4>
    </div>
</div>
<br />
<?php
if (!empty($secc[0]['ENCABEZADO'])):
    ?>
    <blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>
    <?php
endif;
?>

<form id="form_2" name="form_2" class="form-horizontal" role="form">
    <input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?= $id_formulario ?>" />
    <div>
        <div>
            <br />

            <div class='form-group has-feedback' id='div-variable_uso'>
                <h5 class='control-label' for='99999999'  >De los artículos y servicios previamente elegidos, responda la siguiente informaci&oacute;n:</h5>
            </div>
            <?php
            $i = 1;
            foreach ($preg['var'] as $v3):
                ?>
            </div>
        </div>			
        <div class='form-group has-feedback' id='div-<?= $v3['ID_ARTICULO3'] ?>'>
            <h5 class='control-label articulo' for='<?= $v3['ID_ARTICULO3'] ?>'>(<?= $v3['ID_ARTICULO3'] . ") " . $v3['ETIQUETA'] ?></h5>

            <div class='col-sm-8' id='RESP_<?= $v3['ID_ARTICULO3'] ?>' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>

                <table>
                    <tr>
                        <td>
                            <h5 class='control-label' for='art_<?= $v3['ID_ARTICULO3'] ?>'>¿Como lo obtuvieron?"</h5>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='compra_<?= $v3['ID_ARTICULO3'] ?>'>Compra o pago</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[compra]' value='<?= $v3['ID_ARTICULO3'] ?>_1' id='art_<?= $v3['ID_ARTICULO3'] ?>_1' class='ops_<?= $i ?>'/>
                        </td>		
                    </tr>			
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Recibido por trabajo</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[recibido_pago]' value='<?= $v3['ID_ARTICULO3'] ?>_2' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_2' class='ops_<?= $i ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Regalo o donaci&oacute;n</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[regalo]' value='<?= $v3['ID_ARTICULO3'] ?>_3' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_3' class='ops_<?= $i ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Intercambio</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[intercambio]' value='<?= $v3['ID_ARTICULO3'] ?>_4' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_4' class='ops_<?= $i ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Producido por el hogar</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[producido]' value='<?= $v3['ID_ARTICULO3'] ?>_5' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_5' class='ops_<?= $i ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Tomado de un negocio propio</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[negocio_propio]' value='<?= $v3['ID_ARTICULO3'] ?>_6' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_6' class='ops_<?= $i ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <h5 class='control-label' for='<?= $v3['ID_ARTICULO3'] ?>'>Otra forma</h5>
                        </td>
                        <td>
                            <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[otra]' value='<?= $v3['ID_ARTICULO3'] ?>_7' id='articulo_<?= $v3['ID_ARTICULO3'] ?>_7' class='ops_<?= $i ?>' />
                        </td>
                    </tr>
                </table>
                <hr>		
                <?php
                $i++;
            endforeach;
            ?>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12" id="mensaje_"></div>
</div>
<div class="row text-center">
    <button disabled  class='btn btn-success' id='env_form_2'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
</div>

<script src="<?= $js_dir ?>"></script>