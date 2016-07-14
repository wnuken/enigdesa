<div ng-app="appGHogar">
<?php
if(!isset($idFormulario))
	$idFormulario = '';


// $data['pagesection'] = $pagesection;
 $this->load->view('ropaaccesorios/form' . $section);
?>
</div>

<script src="<?php echo base_url("/js/angular/angular.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-local-storage.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/modgasmenfrehogar/ropaAccesorios/controller.js"); ?>"></script>