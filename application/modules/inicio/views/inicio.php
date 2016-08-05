<script src="<?php echo base_url("/js/inicio/inicio.js"); ?>" rel="stylesheet"></script>
<script src="<?php echo base_url("/js/jqueryui/jquery-ui.min.js"); ?>" rel="stylesheet"></script>

<div class="page-header">
	<h1>e-censo</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<p>A continuaci&oacute;n, encontrar&aacute; las secciones en los cuales est&aacute; dividido el cuestionario. Es necesario que diligencie todas las preguntas de cada secci&oacute;n para poder avanzar. Recuerde que puede guardar y retomar el diligenciamiento en las fechas asignadas.</p>
	</div>
	<div class="hidden-lg hidden-md hidden-sm">&nbsp;</div>	
</div>
<br/>
<div class="row">
	<div class="col-lg-3 col-md-6">
    	<div id="panelRegistro" class="panel panel-disabled" style="cursor: pointer">
        	<div class="panel-heading">
            	<div class="row">
                	<div class="col-xs-3">                    	
                    	<img src="<?php echo base_url("/images/registro.png"); ?>"/>
                    </div>
                    <div class="col-xs-9 text-right">
                    	<div class="huge">Inscripci&oacute;n</div>
                        <div>Inscripci&oacute;n</div>
                    </div>
                </div>
            </div>
            <a href="#">
            	<div class="panel-footer">
                	<span class="pull-left">Inscripci&oacute;n</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"><img id="imgmod0" src="<?php echo base_url("/images/blank.png"); ?>"  height="30" width="30"/></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div>Contiene informaci&oacute;n b&aacute;sica de identificaci&oacute;n y ubicaci&oacute;n.</div>
        <div class="hidden-lg hidden-md hidden-sm">&nbsp;</div>        
    </div>
    <div class="col-lg-3 col-md-6">
    	<div id="panelVivienda" class="panel panel-disabled" style="cursor: pointer">
        	<div class="panel-heading">
            	<div class="row">
                	<div class="col-xs-3">                    	
                    	<img src="<?php echo base_url("/images/vivienda.png"); ?>"/>
                    </div>
                    <div class="col-xs-9 text-right">
                    	<div class="huge">Vivienda</div>
                        <div>Vivienda</div>
                    </div>
                </div>
            </div>
            <a href="#">
            	<div class="panel-footer">
            		<span class="pull-left">Vivienda</span>
                	<span class="pull-right"><i class="fa fa-arrow-circle-right"><img id="imgmod1" src="<?php echo base_url("/images/blank.png"); ?>"  height="30" width="30"/></i></span>
                	<div class="clearfix"></div>
            	</div>
            </a>
        </div>
        <div>En esta secci&oacute;n encontrar&aacute; preguntas sobre las caracter&iacute;sticas de la vivienda en la cual usted reside.</div>
        <div class="hidden-lg hidden-md hidden-sm">&nbsp;</div>        
    </div>
    <div class="col-lg-3 col-md-6">
    	<div id="panelHogar" class="panel panel-disabled" style="cursor: pointer">
        	<div class="panel-heading">
            	<div class="row">
                	<div class="col-xs-3">
                    	<img src="<?php echo base_url("/images/hogar.png"); ?>"/>
                    </div>
                    <div class="col-xs-9 text-right">
                    	<div class="huge">Hogar</div>
                        <div>Hogar</div>
                    </div>
                </div>
            </div>
            <a href="#">
            	<div class="panel-footer">
                	<span class="pull-left">Hogar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"><img id="imgmod2" src="<?php echo base_url("/images/blank.png"); ?>"  height="30" width="30"/></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div>Aqu&iacute; responder&aacute; preguntas sobre la conformaci&oacute;n de su hogar y sus caracter&iacute;sticas econ&oacute;micas, demogr&aacute;ficas y sociales.</div>
        <div class="hidden-lg hidden-md hidden-sm">&nbsp;</div>   
    </div>
    <div class="col-lg-3 col-md-6">
    	<div id="panelPersonas" class="panel panel-disabled" style="cursor: pointer">
        	<div class="panel-heading">
            	<div class="row">
                	<div class="col-xs-3">
                    	<img src="<?php echo base_url("/images/personas.png"); ?>"/>
                    </div>
                    <div class="col-xs-9 text-right">
                    	<div class="huge">Personas</div>
                        <div>Personas</div>
                    </div>
                </div>
            </div>
            <a href="#">
            	<div class="panel-footer">
                	<span class="pull-left">Personas</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"><img id="imgmod3" src="<?php echo base_url("/images/blank.png"); ?>"  height="30" width="30"/></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        <div>Finalmente, brindar&aacute; informaci&oacute;n de las caracter&iacute;sticas espaciales, socioecon&oacute;micas y demogr&aacute;ficas</div>
        <div class="hidden-lg hidden-md hidden-sm">&nbsp;</div>
    </div>
</div>
<br/><br/><br/>
<div class="row">
	<div id="barfinal" class="col-md-12">
		<div class="progress">
			<!-- <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">10% Complete</span></div>-->
			<div id="progressbar" class="progress-bar active" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">10% Complete</span></div>
		</div>
	</div>
</div>
<br/><br/>
<!-- Modal para el mensaje de cumpleaños -->
<div id="myModal">
	<h4>Hola, <?php echo $nombre; ?>.</h4>
	<h5>El Departamento Administrativo Nacional de Estad&iacute;stica - DANE te desea un Feliz Cumplea&ntilde;os.</h5>
</div>
          