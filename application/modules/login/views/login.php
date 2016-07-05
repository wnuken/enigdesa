<script src="<?php echo base_url("/js/login/login.js"); ?>"></script>
  <div class="row" >
    <div class="col-md-9 col-md-offset-2" align="justify">
      <div id="contenido">
        <div class="row margin-login">
          <div class="col-md-5 separator">
            <h2>Bienvenido</h2>
            <hr>
            <h4>Al piloto de la primera estrategia de recolección de información vía web para la <strong>Encuesta Nacional de Presupuesto de los Hogares.</strong></h4>
            <br>
            <div class="Graypill"><strong>Confidencialidad</strong><br>Los datos que el DANE solicita en la Encuesta Nacional de Presupuestos de los Hogares vía web son estrictamente confidenciales y en ningún caso tienen fines fiscales ni pueden utilizarse como prueba judicial.</div>
          </div>
          <div class="col-md-5 loginForm"> <br>
            <br>
            Si ya estas registrado, ingresa tus datos aquí:<br>
            <br>
			<form id="frmIngreso" name="frmIngreso" method="post" action="<?php echo site_url("/login/userAuth"); ?>" class="form-signin">
              <label for="txtUsuario">Correo electrónico:</label>
              <br>
              <div class="bullet"><input aria-required="true" id="txtUsuario" name="txtUsuario" class="form-control" placeholder="Correo electrónico" required="" autofocus type="email"></div>
              <br>
              <label for="txtPassword">Contraseña:</label>
              <div class="bullet"><input aria-required="true" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña" required="" type="password"></div>
              <br>
				<div class="g-recaptcha" data-sitekey="6LcqTg4TAAAAAN5yCK3f8wmkTpkilBE8rmTQr8gV"></div>
			<br/>
              <label style="font-weight: normal;">Al hacer click en <strong>Ingresar</strong> estas aceptando los términos y condiciones y podrás continuar
                con el proceso. <a href="#" data-toggle="modal" data-target="#termcond">Ver términos y condiciones</a></label>
              <br><br>
              <button class="btn btn-warning" type="submit" id="btnIngresar" name="btnIngresar">Ingresar</button>
              <button type="button" id="btnReminder" name="btnReminder" class="btn btn-default">¿ Olvidaste tu contraseña?</button>
            </form>
            </fieldset>
          </div>
          <div style="display: none;" id="reslogin" class="alert alert-danger" role="alert"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row"><hr> <small>La información que nos brindarás cuenta con la protección de los
    datos establecidos en la ley de reserva estadística: Los datos
    suministrados al Departamento Administrativo Nacional de Estadística 
    (DANE), en el desarrollo de censos y encuestas, no podrán darse a 
    conocer 
    al páblico ni a las entidades u organismos oficiales, ni a las 
    autoridades públicas, sino únicamente en resúmenes numéricos,
    que no hagan posible deducir de ellos información alguna de carácter 
    individual que pudiera utilizarse para fines comerciales, de tributación
    
    fiscal, de investigación judicial o cualquier otro diferente del 
    propiamente estadístico.
    LEY DE RESERVA ESTADÍSTICA (Art 5° Ley 79 de 1993).</small> </div>
