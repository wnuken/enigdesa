<hr />
<div class="row">
    <p style="text-align: justify;"><span style="font-weight: bold;">BIENVENIDO</span> al módulo de <span style="font-weight: bold;">GASTOS MENOS FRECUENTES DEL HOGAR</span>, 
        en el cual se solicita información sobre las adquisiciones que realizan todos los miembros del hogar en los bienes y servicios relacionados 
        con: prendas de vestir, muebles, electrodomésticos, salud, educación, comunicaciones, servicios públicos domiciliarios, artículos para el 
        aseo personal y conservación de la vivienda, viajes, entre otros.</p>
    <p style="text-align: justify;">Este módulo se le asignó a <span style="font-weight: bold;">P521A P521B P521C P521D</span>, persona identificada por el hogar como aquella 
        con mayor conocimiento sobre los gastos menos frecuentes que realiza el hogar. Sin embargo, es importante que cada una de las personas 
        del hogar ayude en el suministro de información para el diligenciamiento de este módulo.</p>
</div>
<div class="row">
    <label>Haga clic en el botón que usted desee.</label>
</div>
<?php
if (count($sec) > 0) {
    $total = count($sec);
    foreach ($sec as $ks => $vs) {
        if ($ks == 0) {
            echo '<div class="row"><div class="col-md-3"><label>' . substr($vs["ID_SECCION3"], 0, -1) . '.</label><br /><a href="' . $vs["ENLACE"] . '">' . $vs["DESCR_SECCION"] . '</a></div>';
        } else if (($ks + 1) % 4 == 0 && ($ks + 1) == $total) {
            echo '<div class="col-md-3"><label>' . substr($vs["ID_SECCION3"], 0, -1) . '.</label><br /><a href="' . $vs["ENLACE"] . '">' . $vs["DESCR_SECCION"] . '</a></div></div>';
        } else if (($ks + 1) % 4 == 0) {
            echo '<div class="col-md-3"><label>' . substr($vs["ID_SECCION3"], 0, -1) . '.</label><br /><a href="' . $vs["ENLACE"] . '">' . $vs["DESCR_SECCION"] . '</a></div></div><div class="row">';
        } else if (($ks + 1) % 4 != 0) {
            echo '<div class="col-md-3"><label>' . substr($vs["ID_SECCION3"], 0, -1) . '.</label><br /><a href="' . $vs["ENLACE"] . '">' . $vs["DESCR_SECCION"] . '</a></div>';
        }
    }
}
?>