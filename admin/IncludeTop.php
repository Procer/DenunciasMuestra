  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
	<h3 style="padding-top: 7px;"> <?php if($_SESSION['tipo_usuario'] == 'USER'){ echo "MI DENUNCIA/QUEJA/RECLAMO"; } else { echo "PANEL ADMINISTRATIVO"; } ?> </h3>
   </nav>