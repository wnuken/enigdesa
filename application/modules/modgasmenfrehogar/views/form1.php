<style type="text/css">
/***estilos radio botones y chekbox**************/

input[type=checkbox]:not(old), input[type=radio ]:not(old) {
    width : 2em;
    margin : 0;
    padding : 0;
    font-size : 1em;
    opacity : 0;
}
input[type=checkbox]:not(old) + label, input[type=radio ]:not(old) + label {
    display : inline-block;
    margin-left : -2em;
    line-height : 1.5em;
    font-weight: normal;
}
input[type=checkbox]:not(old) + label > span, input[type=radio ]:not(old) + label > span {
    display : inline-block;
    width : 1.5em;
    height : 1.5em;
    margin : 0.25em 0.25em 0.25em 0.25em;
    border : 0.0625em solid rgb(192,192,192);
    border-radius : 0.25em;
    background : rgb(224,224,224);
    background-image : -moz-linear-gradient(rgb(240,240,240), rgb(224,224,224));
    background-image : -ms-linear-gradient(rgb(240,240,240), rgb(224,224,224));
    background-image : -o-linear-gradient(rgb(240,240,240), rgb(224,224,224));
    background-image : -webkit-linear-gradient(rgb(240,240,240), rgb(224,224,224));
    background-image : linear-gradient(rgb(240,240,240), rgb(224,224,224));
    vertical-align : bottom;
    margin-right: 10px;
}
input[type=checkbox]:not(old):checked + label > span, input[type=radio ]:not(old):checked + label > span {
    background-image : -moz-linear-gradient(rgb(224,224,224), rgb(240,240,240));
    background-image : -ms-linear-gradient(rgb(224,224,224), rgb(240,240,240));
    background-image : -o-linear-gradient(rgb(224,224,224), rgb(240,240,240));
    background-image : -webkit-linear-gradient(rgb(224,224,224), rgb(240,240,240));
    background-image : linear-gradient(rgb(224,224,224), rgb(240,240,240));
    margin-right: 10px;
}
input[type=checkbox]:not(old):checked + label > span:before {
content: '✓';
display: block;
width: 1.4em;
color: rgba(85,85,85,1.00);
font-size: 1em;
line-height: 1em;
text-align: center;
text-shadow: 0 0 0.0714em rgb(85,85,85);
font-weight: bold;
padding: 2px;
}
input[type=radio]:not(old):checked + label > span > span {
    display : block;
    width : 1em;
    height : 1em;
    margin : 0.2em;
    border : 0.0625em solid rgb(85,85,85);
    border-radius : 0.25em;
    background : rgba(85,85,85,1.00);
    background-image : -moz-linear-gradient(rgb(85,85,85), rgb(136,136,136));
    background-image : -ms-linear-gradient(rgb(85,85,85), rgb(136,136,136));
    background-image : -o-linear-gradient(rgb(85,85,85), rgb(136,136,136));
    background-image : -webkit-linear-gradient(rgb(85,85,85), rgb(136,136,136));
    background-image : linear-gradient(rgb(85,85,85), rgb(136,136,136));
}
</style>
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

                                    <div class="example">
                                        <div style="position:relative;left:35px">
                                            <label class="control-label" for="<?= $v3['ID_ARTICULO3'] ?>"><?= $v3['ID_ARTICULO3'] ?></label>
                                                <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                                    <small></small>
                                                </div>
                                        </div>
                                        <div>
                                            <input type='checkbox' name='articulos[]' value='<?= $v3['ID_ARTICULO3'] ?>' id='<?= $v3['ID_ARTICULO3'] ?>'>
                                            <label for="<?= $v3['ID_ARTICULO3'] ?>"><span><span></span></span><?= $v3['ETIQUETA'] ?></label>
                                        </div>
                                    </div>
                                <hr></hr>
                            </div>
                            <?php
                        endforeach;
                        if (!isset($secc[0]['ID_VARIABLE_USO'])):
                            ?>
                            <div class='form-group has-feedback' id='div-99999999'>

                                    <div class="example">
                                        <div style="position:relative;left:35px">
                                            <label class="control-label" for="99999999">99999999</label><!--/td-->
                                            <div title="" data-original-title="" id="RESP_<?= isset($var[0]['ID_VARIABLE']) ? $var[0]['ID_VARIABLE'] : "" ?>" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="">
                                                <small></small>
                                            </div>
                                        </div>
                                        <div>
                                            <input type='checkbox' name='articulos[]' value='99999999' id='99999999' />
                                            <label for="99999999"><span><span></span></span>Ninguna de las anteriores</label>
                                        </div>
                                    </div>
                            </div>

                            <?php
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-sm-12" id="mensaje_"></div>
                        </div>
                        <div class="row text-center">
                            <button class='btn btn-success' id='env_form_1'>Guardar y Continuar <span class='glyphicon glyphicon-chevron-right' aria-hidden='true' title='Continuar'></span></button>
                        </div>
                    </form>                    
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script src="<?= $js_dir ?>"></script>