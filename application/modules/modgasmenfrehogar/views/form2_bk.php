<hr />
<div class="row secondHead themeHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" alt="Imagen sección hogar"></div>
        <h2><?= $secc[0]['TITULO1'] ?></h2>
        <h4><?= $secc[0]['TITULO2'] ?></h4>
        <h5><?= $secc[0]['TITULO3'] ?></h5>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" align="justify">
            <div id="contenido">
                <fieldset class="">
<?php
    if (!empty($secc[0]['ENCABEZADO'])):
?>
    <blockquote><?=$secc[0]['ENCABEZADO']?></blockquote>
<?php
    endif;
?>

                    <form id="form_2" name="form_2" class="form-horizontal" role="form">
                        <input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?= $id_formulario ?>" />
                        <div class='form-group has-feedback' id='div-variable_uso'>
                            <label class='control-label' for='div-variable_uso'  >De los artículos y servicios previamente elegidos, responda la siguiente informaci&oacute;n:</label>
                        </div>
                        <br>
<?php
    $i = 1;
    foreach ($preg['var'] as $v3):
?>
                        <div class='form-group has-feedback' id='div-<?= $v3['ID_ARTICULO3'] ?>'>
                            <label class='control-label articulo' for='div-<?= $v3['ID_ARTICULO3'] ?>'><?= $v3['ID_ARTICULO3']?></label>
                            <div title="" data-original-title="" id="RESP_<?= $v3['ID_ARTICULO3'] ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                <small><?= $v3['ETIQUETA'] ?></small>
                            </div>
                            <br>
                            <label class='control-label' for='div-<?= $v3['ID_ARTICULO3'] ?>'><?= $var[0]['ID_VARIABLE']?></label>
                            <div title="" data-original-title="" id="RESP_<?= $var[0]['ID_VARIABLE']?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                <small><?= $var[0]['ETIQUETA']?></small>
                            </div>
                            <div class="example">
                                <table>
                                    <div>
                                        <tr>
                                            <td>
                                                <label class='control-label' for='art_<?= $v3['ID_ARTICULO3'] ?>_1'>Compra o pago</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[compra]' value='<?= $v3['ID_ARTICULO3'] ?>_1' id='art_<?= $v3['ID_ARTICULO3'] ?>_1' class='ops_<?= $i ?>'/>
                                            </td>		
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_2'>Recibido por trabajo</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[recibido_pago]' value='<?= $v3['ID_ARTICULO3'] ?>_2' id='art_<?= $v3['ID_ARTICULO3'] ?>_2' class='ops_<?= $i ?>'/>
                                            </td>
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_3'>Regalo o donaci&oacute;n</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[regalo]' value='<?= $v3['ID_ARTICULO3'] ?>_3' id='art_<?= $v3['ID_ARTICULO3'] ?>_3' class='ops_<?= $i ?>'/>
                                            </td>
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_4'>Intercambio</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[intercambio]' value='<?= $v3['ID_ARTICULO3'] ?>_4' id='art_<?= $v3['ID_ARTICULO3'] ?>_4' class='ops_<?= $i ?>'/>
                                            </td>
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_5'>Producido por el hogar</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[producido]' value='<?= $v3['ID_ARTICULO3'] ?>_5' id='art_<?= $v3['ID_ARTICULO3'] ?>_5' class='ops_<?= $i ?>'/>
                                            </td>
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_6'>Tomado de un negocio propio</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[negocio_propio]' value='<?= $v3['ID_ARTICULO3'] ?>_6' id='art_<?= $v3['ID_ARTICULO3'] ?>_6' class='ops_<?= $i ?>'/>
                                            </td>
                                        </tr>
                                    </div>
                                    <div>
                                        <tr>
                                            <td>
                                                <label for='art_<?= $v3['ID_ARTICULO3'] ?>_7'>Otra forma</label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[otra]' value='<?= $v3['ID_ARTICULO3'] ?>_7' id='art_<?= $v3['ID_ARTICULO3'] ?>_7' class='ops_<?= $i ?>' />
                                            </td>
                                        </tr>
                                    </div>
                                </table>
                            </div>
<?php 
    if($i < count($preg['var'])):
?>
                            <hr></hr>
<?php
    endif;
?>
                        </div>
                		
<?php
    $i++;
    endforeach;
?>
                    <div class="row">
                        <div class="col-sm-12" id="mensaje_"></div>
                    </div>
                    <div class="row text-center">
                        <button disabled class='btn btn-success' id='env_form_2'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
                    </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script src="<?= $js_dir ?>"></script>