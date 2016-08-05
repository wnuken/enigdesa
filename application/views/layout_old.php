<!doctype html>
<!--[if lt IE 7]> 
<html class="no-js ie6 oldie" lang="es_co" version="HTML+RDFa 1.1"> <![endif]-->
<!--[if IE 7]>    
<html class="no-js ie7 oldie" lang="es_co" version="HTML+RDFa 1.1"> <![endif]-->
<!--[if IE 8]>    
<html class="no-js ie8 oldie" lang="es_co" version="HTML+RDFa 1.1"> <![endif]-->
<!--[if IE 9]>    
<html class="no-js ie9" lang="es_co" version="HTML+RDFa 1.1"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="es_co" version="HTML+RDFa 1.1" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo $this->config->item("title"); ?></title>
	<link href="<?php echo base_url_images("favicon.ico"); ?>" rel="shortcut icon" type="image/vnd.microsoft.icon">
	<link href="<?php echo base_url("/css/bootstrap/bootstrap.min.css"); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url("/css/bootstrap/sticky-footer-navbar.css"); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url("css/jqueryui/jquery-ui.css"); ?>" rel="stylesheet"/>  
	<link href="<?php echo base_url("js/jquery.qtip.custom/jquery.qtip.css"); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url("/css/jqgrid/ui.jqgrid-bootstrap.css"); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url("/css/style.css"); ?>" rel="stylesheet"/>
	<!-- 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="<?php //echo base_url("/css/font-awesome.css"); ?>" rel="stylesheet"/>
	<link href="<?php //echo base_url("/css/font-awesome.min.css"); ?>" rel="stylesheet"/>
	-->
	<link href="<?php echo base_url("/css/barDane.css"); ?>" rel="stylesheet"/>
	<script src="<?php echo base_url("/js/bootstrap/jquery-1.11.3.min.js"); ?>" rel="stylesheet"></script>
	<script src="https://www.google.com/recaptcha/api.js?hl=es"></script>           
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->    
	<!-- JavaScript Functions -->
	<script src="<?php echo base_url("/js/bootstrap/bootstrap.min.js"); ?>" rel="stylesheet"></script>
	<script src="<?php echo base_url("/js/jquery.qtip.custom/jquery.qtip.js"); ?>"></script>    
	<script src="<?php echo base_url("/js/jqueryui/jquery-ui.min.js"); ?>"></script>
	<script src="<?php echo base_url("/js/jquery.qtip.custom/jquery.qtip.js"); ?>"></script>
	<script src="<?php echo base_url("/js/jqgrid/i18n/grid.locale-es.js"); ?>" type="text/ecmascript"></script>
	<script src="<?php echo base_url("/js/jqgrid/jquery.jqGrid.js"); ?>" type="text/ecmascript"></script>	
	<script src="<?php echo base_url("/js/jquery.validator/jquery.validate.min.js"); ?>"></script>
	<script src="<?php echo base_url("/js/bootstrap/ie-emulation-modes-warning.js"); ?>" rel="stylesheet"></script>
	<script src="<?php echo base_url("/js/bootstrap/ie10-viewport-bug-workaround.js"); ?>" rel="stylesheet"></script>
	<script src="<?php echo base_url("/js/danevalidator.js"); ?>"></script>
	<script src="<?php echo base_url("/js/formulario.js"); ?>"></script>
	<!-- incluir el cronometro para el contador de la sesion -->
	<script src="<?php echo base_url("/js/crono.js"); ?>" rel="stylesheet"></script>    
  </head>
  <body>
<?php 
	if (isset($header) && $header!="") {
		$this->load->view($header); 
	} 
	else {
		$this->load->view("/template/navbar");
	}	 
?>
	<div class="container" id="contenido">
<?php 
	if (isset($view) && $view!=""){ 
		//if ($view!="login" && $view!="persona" && $view!="reminder" && $view!="registrese" && $view!="registreseterminos" && $view!="tutorial") {
		//	echo '<h3>Bienvenido: '.utf8_encode(ucwords(strtolower($this->session->userdata("nombre")))) .'</h3>';
		//}
		$this->load->view($view);
	}
?>
	</div>
	<br/>
<?php 
	//if ( $view!="persona" ) // Para q no repita el footer en personas, dada la forma de llamar el modulo por ajax
	$this->load->view("/template/footer");
?>
  </body>
</html>