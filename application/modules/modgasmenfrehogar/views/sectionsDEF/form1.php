<style>
	 input[type=checkbox].form-control {
		width: 20px;
		height: 20px;
		top: -4px;
	}
</style>
<div ng-app="appGHogar">
<?php
if(!isset($idFormulario))
	$idFormulario = '';
// $data['pagesection'] = $pagesection;
 $this->load->view('sectionsDEF/form' . $section);
?>
</div>
<script src="<?php echo base_url("/js/modgasmenfrehogar/jquery.numeric.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-animate.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-aria.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-messages.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-material.min.js"); ?>"></script>

<script src="<?php echo base_url("/js/modgasmenfrehogar/sectionsDEF/controller.js"); ?>"></script>