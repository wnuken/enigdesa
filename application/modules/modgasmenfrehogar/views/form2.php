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
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_1'>Compra o pago</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[compra]' value='<?= $v3['ID_ARTICULO3'] ?>_1' id='art_<?= $v3['ID_ARTICULO3'] ?>_1' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_1'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_2'>Recibido por trabajo</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[recibido_pago]' value='<?= $v3['ID_ARTICULO3'] ?>_2' id='art_<?= $v3['ID_ARTICULO3'] ?>_2' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_2'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_3'>Regalo o donaci&oacute;n</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[regalo]' value='<?= $v3['ID_ARTICULO3'] ?>_3' id='art_<?= $v3['ID_ARTICULO3'] ?>_3' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_3'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_4'>Intercambio</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[intercambio]' value='<?= $v3['ID_ARTICULO3'] ?>_4' id='art_<?= $v3['ID_ARTICULO3'] ?>_4' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_4'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_5'>Producido por el hogar</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[producido]' value='<?= $v3['ID_ARTICULO3'] ?>_5' id='art_<?= $v3['ID_ARTICULO3'] ?>_5' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_5'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_6'>Tomado de un negocio propio</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[negocio_propio]' value='<?= $v3['ID_ARTICULO3'] ?>_6' id='art_<?= $v3['ID_ARTICULO3'] ?>_6' class='ops_<?= $i ?>'/>
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_6'><span><span></span></span></label>
                                </div>
                                <div>
                                    <label style="width:200px" for='art_<?= $v3['ID_ARTICULO3'] ?>_7'>Otra forma</label>
                                    <input type='checkbox' name='<?= $v3['ID_ARTICULO3'] ?>[otra]' value='<?= $v3['ID_ARTICULO3'] ?>_7' id='art_<?= $v3['ID_ARTICULO3'] ?>_7' class='ops_<?= $i ?>' />
                                    <label for='art_<?= $v3['ID_ARTICULO3'] ?>_7'><span><span></span></span></label>
                                </div>
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