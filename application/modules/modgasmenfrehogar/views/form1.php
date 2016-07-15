
<hr />
<div class="row secondHead themeHead">
    <div class="col-sm-2 hidden-xs"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" alt="Imagen sección hogar"></div>
    <!--<div class="col-sm-4 col-md-3 col-lg-2 col-xs-12">
        
    </div>-->
    <!--<div class="col-sm-5 ">-->
    <h2><?= $secc[0]['TITULO1'] ?></h2>
    <h4><?= $secc[0]['TITULO2'] ?></h4>
    <h5><?= $secc[0]['TITULO3'] ?></h5>
    <!--</div>-->
</div>
<!--<div class="row">
    <div class="col-sm-2"><img src="<?php echo base_url("images/form_icon-ingresospersonales.png"); ?>" /></div>
    <div class="col-sm-8">
        <h2><?= $secc[0]['TITULO1'] ?></h2>
        <h4><?= $secc[0]['TITULO2'] ?></h4>
        <h5><?= $secc[0]['TITULO3'] ?></h5>

    </div>
</div>-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" align="justify">
            <div id="contenido">
                <fieldset class="">
                    <?php
                    if (!empty($secc[0]['ENCABEZADO']))
                        //echo "<blockquote>". $secc[0]['ENCABEZADO'] ."</blockquote>\n";
                    ?>
                    <form id="form_1" name="form_1" class="form-horizontal" role="form">
                        <input type="hidden" name="ID_FORMULARIO" id="ID_FORMULARIO" value="<?= $id_formulario ?>" />
                        <!--<div>
                            <div>-->
                        <?php
                        if (isset($secc[0]['ID_VARIABLE_USO'])):
                            ?>
                            <div class='form-group has-feedback' id='div-variable_uso'>
                                <div class="example">
                                    <div>
                                        <label class='control-label' for='<?= isset($var_uso[0]['ID_VARIABLE']) ? $var_uso[0]['ID_VARIABLE'] : "" ?>'  ><?= isset($var_uso[0]['ID_VARIABLE']) ? $var_uso[0]['ID_VARIABLE'] : "" ?></label>
                                        <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                            <?= isset($var_uso[0]['ETIQUETA']) ? $var_uso[0]['ETIQUETA'] : "" ?>
                                        </div>
                                        <br>
                                        <input title="" data-original-title="" name='variable_uso' type='radio' id='variable_uso_1' value='1' data-toggle="popover" data-trigger="focus hover" data-content="">
                                        <label for="variable_uso_1"><span><span></span></span>Si&nbsp;&nbsp;</label>
                                        <input title="" data-original-title="" name='variable_uso' type='radio' id='variable_uso_2' value='2' data-toggle="popover" data-trigger="focus hover" data-content="">
                                        <label for="variable_uso_2"><span><span></span></span>No&nbsp;&nbsp;</label>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                        <br>
                        <!--    </div>
                        </div>-->
                        <div class='form-group has-feedback cont_articulo' id='div-<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>' <?= isset($secc[0]['ID_VARIABLE_USO']) ? " style='display:none;'" : "" ?>>
                            <label class="control-label" for="<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>"><?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?></label>

                            <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                <?= isset($var[0]['ETIQUETA']) ? $var[0]['ETIQUETA'] : "" ?>
                            </div>
                        </div>
                        <br>                        
                        <?php
                        foreach ($preg['var'] as $v3):
                            ?>
                            <div class='form-group has-feedback cont_articulo' id='div-<?= $v3['ID_ARTICULO3'] ?>' <?= isset($secc[0]['ID_VARIABLE_USO']) ? " style='display:none;'" : "" ?>>
                                <table>
                                    <div class="example">
                                        <tr>
                                            <td></td>
                                            <td> <label class="control-label" for="<?= $v3['ID_ARTICULO3'] ?>"><?= $v3['ID_ARTICULO3'] ?></label></td>
                                                <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                                <small></small>
                                        </div>
                                        </tr>
                                        <tr>
                                        <div>
                                            <td><input type='checkbox' name='articulos[]' value='<?= $v3['ID_ARTICULO3'] ?>' id='<?= $v3['ID_ARTICULO3'] ?>'></td>
                                            <!--<td> <label for='<?= $v3['ID_ARTICULO3'] ?>'><span></span><?= $v3['ETIQUETA'] ?></label></td>-->
                                            <td><div for='<?= $v3['ID_ARTICULO3'] ?>' title="" data-original-title="" id="RESP_<?= $v3['ID_ARTICULO3'] ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                                    <span></span><?= $v3['ETIQUETA'] ?>
                                                </div></td>
                                                <!--<div class='col-sm-8' id='RESP_<?= $v3['ID_ARTICULO3'] ?>' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
                                                </div>-->
                                        </div>
                                        </tr>
                                    </div>
                                </table>
                                <hr></hr>
                            </div>
                            <?php
                        endforeach;
                        if (!isset($secc[0]['ID_VARIABLE_USO'])):
                            ?>
                            <div class='form-group has-feedback' id='div-99999999'>
                                <table>
                                    <div class="example">
                                        <tr>
                                            <td></td>
                                            <td><label class="control-label" for="99999999">99999999</label></td>
                                        <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                            <small></small>
                                        </div>
                                        </tr>
                                        <tr>
                                        <div>
                                            <td><input type='checkbox' name='articulos[]' value='99999999' id='99999999' /></td>
                                            <!--<td><label for="99999999"><span></span>Ninguna de las anteriores</label></td>-->
                                            <td><div for='99999999' title="" data-original-title="" id="RESP_99999999" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                                    <span></span>Ninguna de las anteriores
                                                </div></td>
                                            <!--<div class='col-sm-8' id='RESP_99999999' data-toggle='popover' data-placement='top' data-trigger='hover' data-content=''>
                                            </div>-->
                                        </div>
                                        </tr>
                                    </div>
                                </table>
                            </div>

                            <?php
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-sm-12" id="mensaje_"></div>
                        </div>
                        <div class="row text-center">
                            <button disabled class='btn btn-success' id='env_form_1'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
                        </div>
                    </form>                    
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script src="<?= $js_dir ?>"></script>