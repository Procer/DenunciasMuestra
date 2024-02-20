<?php 
session_start();
//CONEXION A SQL
include('ConexionSqlServer.php');

if(isset($_POST['enviar'])){
	
	$usuario = $_POST["usuario"];
	
	//CONSULTO USUARIO
	$QueryUsuarioPass = mysqli_query($conn, "select * from usuarios where usuarios = '".$usuario."'");
echo "select * from usuarios where usuarios = '".$usuario."'";
	$UsuarioPass = mysqli_fetch_assoc($QueryUsuarioPass);

	$_SESSION['IdUsuario'] = $UsuarioPass['IdUsuario'];
	$_SESSION['tipo_usuario'] = $UsuarioPass['TipoUsuario'];
	
	if($UsuarioPass['pass'] == $_POST['clave'] and $UsuarioPass['usuarios'] == $_POST['usuario']){
			if($UsuarioPass['TipoUsuario'] == 'ADMIN'){
				header('Location: Admin.php');
				$_SESSION['Sector'] = $UsuarioPass['sector'];
			} else {
				header('Location: Usuarios.php?id='.$UsuarioPass['IdUsuario']);
			}
		}	
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Denuncias/quejas/reclamos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" type="image/png" href="img/Escudo.png" sizes="16x16">
  <link rel="icon" type="image/png" href="img/Escudo.png" sizes="32x32">
  <link rel="icon" type="image/png" href="img/Escudo.png" sizes="64x64">
</head>
<body class="hold-transition login-page" style="background-image: url(img/Fondo1.jpg); background-position: center;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="img/Escudo.png" style="width: 50%; height: auto;" />
	  <h3>SISTEMA DENUNCIAS<br>QUEJAS - RECLAMOS</h3>
    </div>
    <div class="card-body">
      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name='usuario' class="form-control" placeholder="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="clave" class="form-control" placeholder="clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<div class="row">
          <div class="col-12">
            <button type="submit" name='enviar' class="btn btn-primary btn-block">INGRESAR</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

