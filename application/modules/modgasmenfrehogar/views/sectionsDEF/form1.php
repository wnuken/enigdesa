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
<script src="<?php echo base_url("/js/angular/angular-local-storage.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/modgasmenfrehogar/sectionsDEF/controller.js"); ?>"></script>