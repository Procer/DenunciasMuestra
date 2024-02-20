<?php

//CONEXION A SQL

include('ConexionSqlServer.php');

session_start();
if(!isset($_SESSION['usuario']))
{
	header("Location: index.php");
}


if($_SESSION['TipoUsuario'] == 'Pacie') {
	header('Location: lockscreen.php?id='.$_SESSION['id_usuario']);
}


header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- INICIO - TITULO EN EL NAVEGADOR -->
  <?php include('IncludeTitle.php'); ?>
  <!-- FIN - TITULO EN EL NAVEGADOR -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="icon" type="image/png" href="img/Logo.png" sizes="16x16">
  <link rel="icon" type="image/png" href="img/Logo.png" sizes="32x32">
  <link rel="icon" type="image/png" href="img/Logo.png" sizes="64x64">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- INICIO Preloader -->
  <?php include('IncludePreloader.php'); ?>
  <!-- FIN Preloader -->

  <!-- INICIO - Navbar - RAYITAS QUE CONTRAEN MENU IZQUIERDO -->
  <?php include('IncludeTop.php'); ?>
  <!-- FIN - Navbar - RAYITAS QUE CONTRAEN MENU IZQUIERDO -->

  <!-- INICIO - Main Sidebar Container MENU LEFT -->
  <?php include('IncludeMenuLeft.php'); ?>
  <!-- FIN - Main Sidebar Container MENU LEFT -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
			<div class="info-box mb-3 bg-warning" style="background-color: #4aea8c85 !important; color:#267AA0 !important;">
				<span class="info-box-icon"><i class="fa fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><h1>CREAR PACIENTES</h1></span>
				</div>
			</div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">		
          <div class="col-12">				
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
			  <?php 
			  
  				if(isset($_POST['CrearPaciente'])){
					
					//SELECT MISMO DNI
					$SqlDni = mysqli_query($conn, "SELECT * FROM usuarios where pass = '".$_POST['DNI']."'");
					$SqlDniResult = mysqli_fetch_assoc($SqlDni);
					
					if(!empty($SqlDniResult['pass'])){
						echo "<div class='alert alert-danger alert-dismissible'>";
						echo "	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
						echo "	<h5><i class='icon fas fa-ban'></i> PACIENTE NO CREADO!</h5>";
						echo "	Ya existe un paciente con el DNI <strong>".$SqlDniResult['pass']."</strong>. Su nombre y apellido es:	<strong>".$SqlDniResult['usuario']."</strong>";
						echo "</div>";
					} else {
					
						//INSERT USUARIOS
						$InsertUsuarios = mysqli_query($conn, "INSERT INTO usuarios 
								(id_usuario, usuario, pass, estado, dni, tipo_usuario) 
										VALUES
								(null,'".$_POST['NombreApellido']."',".$_POST['DNI'].",'Activo','".$_POST['Email']."', 'Pacie')");

						//SELECT PARA OBTENER ID
						$Sql = mysqli_query($conn, "SELECT id_usuario FROM usuarios where pass = '".$_POST['DNI']."'");
						$SqlResult = mysqli_fetch_assoc($Sql);

						//INSERT PACIENTES
						$InsertPacientes = mysqli_query($conn, "INSERT INTO pacientes 
								(id_paciente, nombre_apellido, id_usuario, email) 
										VALUES
								(null,'".$_POST['NombreApellido']."',".$SqlResult['id_usuario'].",'".$_POST['Email']."')");
					
						echo "<div class='alert alert-success alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								<h5><i class='icon fas fa-check'></i> EXCELENTE!</h5>
								Al siguiente paciente <strong>".$_POST['NombreApellido']."</strong> se le cre&oacute; el usuario. <br>
								<a href='Paciente.php?id=".$SqlResult['id_usuario']."' >COMENCEMOS A VER SU PERFIL</a>
							 </div>";
											
					}
				}

				if(isset($_GET['Nuevo'])){
					echo "<div class='alert alert-danger alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							<h5><i class='icon fas fa-ban'></i> Alert!</h5>
							El siguiente paciente <strong>".$_GET['Nombre']."</strong> es nuevo, primero debe crear el usuario para poder comemzar a cargar datos del paciente.
						 </div>";
				}
							
				?>


			  <hr>
			  <form action='CrearUsuarios.php' method='POST'>
				<label for="2">NOMBRE Y APELLIDO</label><br>
				<input type="text" class="form-control" value="<?php if(isset($_GET['Nuevo'])){ echo $_GET['Nombre']; } ?>" required name="NombreApellido"><br>
				<label for="2">DNI</label><br>
				<input type="number" class="form-control" required name="DNI"><br>
				<label for="2">EMAIL</label><br>
				<input type="text" class="form-control" value="<?php if(isset($_GET['Nuevo'])){ echo $_GET['Email']; } ?>"  required name="Email"><br>
				<input type="submit" class="form-control btn btn-block btn-info" name="CrearPaciente" value="CREAR">
			  </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- INICIO - PIE -->
  <?php include('IncludeFooter.php'); ?>
  <!-- FIN - PIE	-->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
      $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>
</body>
</html>
