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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Encuesta Nacional de Presupuesto de los Hogares</title>
<link href="<?php echo base_url("images/favicon2.png"); ?>" rel="shortcut icon" type="image/vnd.microsoft.icon">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url("css/bootstrap/bootstrap.min.css"); ?>">
<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo base_url("css/bootstrap/bootstrap-theme.min.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("css/bootstrap/custom.css"); ?>">
<link href="<?php echo base_url("css/jqueryui/jquery-ui.css"); ?>" rel="stylesheet"/>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url("/js/bootstrap/jquery-1.11.3.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/bootstrap/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/jqueryui/jquery-ui.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/bootstrap/jquery.number.js"); ?>"></script>
<script src="<?php echo base_url("/js/jquery.validator/jquery.validate.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/bootstrap/ie-emulation-modes-warning.js"); ?>" ></script>
<script src="<?php echo base_url("/js/bootstrap/ie10-viewport-bug-workaround.js"); ?>"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=es"></script>
<script src="<?php echo base_url("/js/danevalidator.js"); ?>"></script>
<script src="<?php echo base_url("/js/formulario.js"); ?>"></script>
<!--<script src="ENPH_files/login.js"></script>-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>
<body>

<div class="container-fluid">
<?php 
	if (isset($header) && $header!="") {
		$this->load->view($header);
	}
	else {
		$this->load->view("/template/navbar");
	}
?>
  <!-- Barra de colores -->
  <div class="hidden-xs" id="colorbar">
	<div class="hidden-xs" id="color_container">
	  <div id="areaa">
	    <div id="area1" class="color4"></div>
	    <div id="area2" class="color2"></div>
	  </div>
	  <div id="area3" class="color5"></div>
	  <div id="area4" class="color2"></div>
	  <div id="areab">
	    <div id="area5" class="color3"></div>
	    <div id="area6" class="color4"></div>
	    <div id="area7" class="color2"></div>
	  </div>
	  <div id="areac">
	    <div id="area8" class="color4"></div>
	    <div id="area9" class="color1"></div>
	  </div>
	  <div id="area10" class="color2"></div>
	  <div id="area11" class="color5"></div>
	  <div id="aread">
	    <div id="area12" class="color3"></div>
	    <div id="area13" class="color6"></div>
	  </div>
	  <div id="area14" class="color4"></div>
	  <div id="areae">
	    <div id="area15" class="color1"></div>
	    <div id="area16" class="color3"></div>
	  </div>
	  <div id="areaf">
	    <div id="area17" class="color3"></div>
	    <div id="area18" class="color2"></div>
	    <div id="area19" class="color5"></div>
	  </div>
	  <div id="areag">
	    <div id="area20" class="color6"></div>
	    <div id="area21" class="color3"></div>
	  </div>
	  <div id="area22" class="color1"></div>
	</div>
  </div>
  <div class="clearfix"></div>
  <div class="container"> 
  </div>
</div>

<div class="container" id="contenido">
<?php 
	if (isset($view) && $view!="") { 
		$this->load->view($view);
	}
?>
</div>
<br/>
<?php 
	$this->load->view("/template/footer");
?>
<!-- write script to toggle class on scroll --> 
<script type="text/javascript">
$(window).scroll(function() {
	if ($(this).scrollTop() > 80) {
		$('.topview1').addClass("hidden");
		$('.topview2').removeClass("hidden");
	}
	else {
		$('.topview1').removeClass("hidden");
		$('.topview2').addClass("hidden");
	}
});
</script> 
</body>
</html>