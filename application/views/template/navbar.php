  <div class="topview1 row">
    <div class="col-sm-6 col-md-5 hidden-xs" id="dane-logo"> 
      <!--<img href="http://www.dane.gov.co" src="img/logo_dane.png" class="img-responsive" alt="Logo Dane">--> 
      <img href="http://www.dane.gov.co" src="<?php echo base_url("/images/logo_dane.png"); ?>" onerror="this.onerror=null; this.src='<?php echo base_url("/images/logo_dane.png"); ?>'" class="img-responsive" alt="Logo Dane"> </div>
    <div class="col-xs-12 visible-xs"> <img src="<?php echo base_url("/images/logo_dane_mobile.png"); ?>" class="img-responsive" alt="Logo Dane"> </div>
<!--    <div class="text-right col-md-4 hidden" id="titulo">
      <h4>Encuesta Nacional de Presupuesto de los Hogares</h4>
    </div>-->
    <div class="col-sm-4 col-md-3 pull-right">
<!--      <div class="row hidden hidden-xs" id="fecha">
        <div class="row col-sm-10 col-md-9"> <small>Martes, 18 de noviembre de 2.014</small> </div>
        <div class="row col-sm-4 col-md-5 pull-right" id="idioma"> <small><a class="btn-link" href="#">English</a></small> </div>
        <div class="clearfix"></div>
      </div>
      <div class="row hidden input-group">
        <input class="form-control" type="text">
        <span class="input-group-addon glyphicon glyphicon-search" aria-hidden="true"></span> </div>
      <div class="clearfix"></div>-->
      <div class="redes hidden-xs">
        <div class="col-md-11">
		  <a href="<?php echo site_url("/login/salir"); ?>" title="salir"><div class="go"></div></a>
		  <a href="<?php echo site_url("/control/Menu"); ?>" title="inicio"><div class="hm"></div></a>
		</div>
      </div>
    </div>
  </div>

  <nav class="topview2 container-fluid navbar navbar-default navbar-fixed-top hidden">
    <div class="row container-fluid">
      <div class="navbar-header col-xs-2 col-md-1"> <a class="navbar-brand" href="http://www.dane.gov.co" target="_blank"> <img src="<?php echo base_url("/images/dane_icon.png"); ?>"> </a> </div>
      <div class="row col-xs-10 col-sm-10 col-md-11" id="bar">
        <div class="col-md-12 pull-left">
          <div class="row">
            <div id="tituloMini" class="col-md-7 text-center hidden-xs">
              <h4>Encuesta Nacional de Presupuestos de los Hogares</h4>
            </div>
            <div class="col-md-5 .col-md-offset-1 redes "> 
			  <a href="<?php echo site_url("/login/salir"); ?>" title="salir"><div class="go"></div></a>
			  <a href="<?php echo site_url("/control/Menu"); ?>" title="inicio"><div class="hm"></div></a>
			</div>
          </div>
        </div>
        <div class="row hidden col-sm-8 col-md-4" id="search">
          <div class="input-group" id="busqueda">
            <input class="form-control" type="text">
            <span class="input-group-addon glyphicon glyphicon-search" aria-hidden="true"></span> </div>
        </div>
      </div>
    </div>
  </nav>

<!--
<nav class="navbar navbar-default navbar-fixed-top" style="z-index: 20000">
<div class="container-fluid">
	<div class="row">
	<div class="navbar-header col-xs-12 col-sm-12 col-md-7 col-md-offset-1 col-lg-7 col-md-offset-1">
	  <img src="<?php echo base_url("images/logo-enig.png"); ?>">
	</div>
<?php 
if (!isset($nomenu)){ ?>
	<div class="tituloForm col-xs-12 col-sm-12 col-md-4 col-lg-4">
	<ul class="nav navbar-nav">
		<li class="active"><a href="<?php echo site_url("/control/Menu"); ?>">Inicio</a></li>
		<li><a href="<?php echo site_url("/login/salir"); ?>">Salir</a></li>            	
	</ul>
	</div>
<?php 
} 
?>
	</div>
	<div class="clearfix"></div>
</div>
</nav>
-->