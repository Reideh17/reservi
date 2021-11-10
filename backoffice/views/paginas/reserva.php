<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reserva</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Reserva</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
    <form method="post">
      <div class="card-header">

        <h3 class="card-title">Reserva</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>

      </div>

      <div class="card-body">
        <?php
        date_default_timezone_set("America/Bogota");
        $fecha_solictud = substr(date("c"), 0);
        $fechaInicial = substr($fecha_solictud, 0, -10);
        $fechaVencimiento = strtotime('+1 days', strtotime($fechaInicial));
        $vencimiento = date("Y-m-d", $fechaVencimiento);
        ?>

        <div class="form-group">

          <label  class="control-label">Hola,</label>

          <div>

            <input type="text" class="form-control" id="nom_user" name="nom_user" value="<?php echo $usuario["usudescrip"] ?>" readonly>
            <input type="hidden" name="user_mail" value="<?php echo $usuario["usuemail"] ?>">
            <input type="hidden" name="user_date" value="<?php echo $fecha_solictud ?>">

          </div>

        </div>


        <div class="form-group">

          <label  class="control-label">Reserva asignada para el dia </label>

          <div class="input-group">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>

            <input type="date" id="fecha_reserva"  name="fecha_reserva" class="form-control" value="<?php echo $vencimiento ?>" readonly>

          </div>

        </div>

        <div class="form-group">
        <input type="hidden" name="id_token" value="<?php echo $usuario["oid"] ?>">
        <input type="hidden" name="token" value="<?php echo $usuario["usuemailen"] ?>">

          <div class="info-box bg-success">
            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cupos libres </span>
              <span class="info-box-number">85</span>

              <div class="progress">
                <div class="progress-bar" style="width: 85%"></div>
              </div>
              <span class="progress-description">
                Cupo del dia 1070
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>

          <button type="submit" class="btn btn-block bg-gradient-info btn-lg">Reservar</button>

          <?php

						//$registro = new UserController();
					//$registro->ctrRegistroUsuario();

             $reserva = new reservaController();
             $reserva->ctrRegistroResera();

						?>

        </div>



      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        Rol estudiante
      </div>
      <!-- /.card-footer-->

      </form>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

</div>