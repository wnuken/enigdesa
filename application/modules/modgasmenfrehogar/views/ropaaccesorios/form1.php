<div ng-app="appGHogar">
<?php
// $data['pagesection'] = $pagesection;
$this->load->view('ropaaccesorios/form' . $idsection);
?>
</div>

<script src="<?php echo base_url("/js/angular/angular.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/angular/angular-local-storage.min.js"); ?>"></script>
<script src="<?php echo base_url("/js/gasmenfrehogar/ropaAccesorios/controller.js"); ?>"></script>