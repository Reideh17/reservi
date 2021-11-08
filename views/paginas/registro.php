<div class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $ruta; ?>inicio"><b>Reservi</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Registro al sistema</p>

      <form method="post" name="fvalida" id="fvalida">
        <div class="input-group mb-3">
          <input type="number" class="form-control" id="numero_id" name="numero_id"  placeholder="Numero de documento">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
		<div class="input-group mb-3">
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y apellidos">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
		<div class="input-group mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Correo electronico" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" id="password1" name ="password1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Repita su contraseña" id="password2" name ="password2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" onclick="valida_envia()">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
		<?php

						$registro = new UserController();
						$registro->ctrRegistroUsuario();

						?>
      </form>    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>

