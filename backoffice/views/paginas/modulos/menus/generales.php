<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo $ruta ?>backoffice/inicio" class="brand-link">
    <img src="<?php echo $ruta ?>backoffice/views/img/plantilla/icono.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Oficina Reservi</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">

        <?php if ($usuario["usufoto"] == "") : ?>

          <img src="<?php echo $ruta ?>backoffice/views/img/usuarios/default/default.png" class="img-circle elevation-2" alt="User Image">

        <?php else : ?>

          <img src="<?php echo $usuario["usufoto"] ?>" class="img-circle elevation-2" alt="User Image">

        <?php endif ?>

      </div>
      <div class="info">
        <a href="perfil" class="d-block"><?php echo $usuario["usudescrip"] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!--=====================================
      Botón Inicio
      ======================================-->

        <li class="nav-item">
          <a href="<?php echo $ruta ?>backoffice/inicio" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>
     
        <!--=====================================
      Botón Usuarios
      ======================================-->



        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-archive"></i>
            <p>
              Archivos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="generales/empresa" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Empresa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hinversion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Historico</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
          <i class="fas fa-chalkboard-teacher"></i>
            <p>
              Procesos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="retiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hacer retiro</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hretiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Historico</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>
              Informes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="retiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hacer retiro</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hretiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Historico</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Utilidades
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="retiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hacer retiro</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hretiro" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Historico</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="soporte" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
            <p>Soporte</p>
          </a>
        </li>

        <!--=====================================
        Botón Salir
        ======================================-->


        <li class="nav-item">
          <a href="salir" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Cerrar sesión</p>
          </a>
        </li>




      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>