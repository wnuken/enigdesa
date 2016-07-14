<div class="row secondHead">
    <div class="col-md-2 hidden-xs" style="text-align: right;">
        <img src="<?=base_url_images('icoMenosFrecMini.png') ?>" alt="Imagen sección Vivienda" height="80" width="90" /></div>
    <div class="col-md-10">
        <h2>Gastos menos frecuentes del hogar</h2>
        <br />
    </div>
</div>
<div class="row" style="padding-top: 10px;">
    <blockquote>
        <span style="font-weight: bold;">BIENVENIDO</span> al módulo de <span style="font-weight: bold;">GASTOS MENOS FRECUENTES DEL HOGAR</span>, 
        en el cual se solicita información sobre las adquisiciones que realizan todos los miembros del hogar en los bienes y servicios relacionados 
        con: prendas de vestir, muebles, electrodomésticos, salud, educación, comunicaciones, servicios públicos domiciliarios, artículos para el 
        aseo personal y conservación de la vivienda, viajes, entre otros.</blockquote>
    <p style="text-align: justify;">Este módulo se le asignó a <span style="font-weight: bold;">P521A P521B P521C P521D</span>, persona identificada 
        por el hogar como aquella con mayor conocimiento sobre los gastos menos frecuentes que realiza el hogar. Sin embargo, es importante que cada 
        una de las personas del hogar ayude en el suministro de información para el diligenciamiento de este módulo.</p>
    <br />
</div>
<div class="row text-center">
    <h7>Haga clic en el botón que usted desee.</h7>
    <br /><br />
</div>
<?php
if (count($sec) > 0) {
    $total = count($sec);
    $html = '';
    foreach ($sec as $ks => $vs) {
        if ($ks == 0) {
            $htmlClass = ($vs["BLOQ"] == 'SI') ? 'col-md-3 menuC3off': 'col-md-3 menuC3';
            $html .= '<div class="row"><div class="' . $htmlClass . '" id="' . $vs["TITULO3"] . '"><img id="img-' . $vs["LOGO"] . '" class="opacity" width="119" height="117" alt="" src="' . $vs["IMG"] . '" /><br />';
            if($vs["BLOQ"] == 'SI') {
                $html .= '<label>' . $vs["TITULO2"] . '</label>';
            } else {
                $html .= '<a href="' . $vs["ENLACE"] . '">' . $vs["TITULO2"] . '</a>';
            }
            $html .= '</div>';
        } else if (($ks + 1) % 4 == 0 && ($ks + 1) == $total) {
            $htmlClass = ($vs["BLOQ"] == 'SI') ? 'col-md-3 menuC3off': 'col-md-3 menuC3';
            $html .= '<div class="' . $htmlClass . '" id="' . $vs["TITULO3"] . '"><img id="img-' . $vs["LOGO"] . '" class="opacity" width="119" height="117" alt="" src="' . $vs["IMG"] . '" /><br />';
            if($vs["BLOQ"] == 'SI') {
                $html .= '<label>' . $vs["TITULO2"] . '</label>';
            } else {
                $html .= '<a href="' . $vs["ENLACE"] . '">' . $vs["TITULO2"] . '</a>';
            }
            $html .= '</div></div>';
        } else if (($ks + 1) % 4 == 0) {
            $htmlClass = ($vs["BLOQ"] == 'SI') ? 'col-md-3 menuC3off': 'col-md-3 menuC3';
            $html .= '<div class="' . $htmlClass . '" id="' . $vs["TITULO3"] . '"><img id="img-' . $vs["LOGO"] . '" class="opacity" width="119" height="117" alt="" src="' . $vs["IMG"] . '" /><br />';
            if($vs["BLOQ"] == 'SI') {
                $html .= '<label>' . $vs["TITULO2"] . '</label>';
            } else {
                $html .= '<a href="' . $vs["ENLACE"] . '">' . $vs["TITULO2"] . '</a>';
            }
            $html .= '</div></div><div class="row">';
        } else if (($ks + 1) % 4 != 0) {
            $htmlClass = ($vs["BLOQ"] == 'SI') ? 'col-md-3 menuC3off': 'col-md-3 menuC3';
            $html .= '<div class="' . $htmlClass . '" id="' . $vs["TITULO3"] . '"><img id="img-' . $vs["LOGO"] . '" class="opacity" width="119" height="117" alt="" src="' . $vs["IMG"] . '" /><br />';
            if($vs["BLOQ"] == 'SI') {
                $html .= '<label>' . $vs["TITULO2"] . '</label>';
            } else {
                $html .= '<a href="' . $vs["ENLACE"] . '">' . $vs["TITULO2"] . '</a>';
            }
            $html .= '</div>';
        }
    }
    echo $html;
}
?>
<script src="<?= $js_dir ?>"></script>