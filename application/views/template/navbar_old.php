<nav class="navbar navbar-default navbar-fixed-top" style="z-index: 20000">
<div class="container-fluid">
	<div class="row">
	<div class="navbar-header col-xs-12 col-sm-12 col-md-7 col-md-offset-1 col-lg-7 col-md-offset-1">
	  <img src="<?php echo base_url("images/logo-enig.png"); ?>">
	</div>
	<!--<div class="tituloForm col-xs-12 col-sm-12 col-md-4 col-lg-4">
	<h2>&nbsp;&nbsp;Bienvenido</h2>
	</div>-->
<?php 
if (!isset($nomenu)){ ?>
	<div class="tituloForm col-xs-12 col-sm-12 col-md-4 col-lg-4">
	<ul class="nav navbar-nav">
		<li class="active"><a href="<?php echo site_url("/control/Menu"); ?>">Inicio</a></li>
		<!-- 
		<li><a href="#about">About</a></li> 
		<li><a href="#contact">Contact</a></li> 
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li class="dropdown-header">Nav header</li>
				<li><a href="#">Separated link</a></li>
				<li><a href="#">One more separated link</a></li>
			</ul>
		</li>
		-->
		<li><a href="<?php echo site_url("/login/salir"); ?>">Salir</a></li>            	
	</ul>
	</div><!--/.nav-collapse -->
<?php 
} 
?>
	</div>
	<div class="clearfix"></div>
</div>
</nav>