<?php

//CONEXION A SQL
include('ConexionSqlServer.php');

session_start();
if(!isset($_SESSION['IdUsuario']))
{
	header("Location: index.php");
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
    <link rel="icon" type="image/png" href="img/Escudo.png" sizes="16x16">
  <link rel="icon" type="image/png" href="img/Escudo.png" sizes="32x32">
  <link rel="icon" type="image/png" href="img/Escudo.png" sizes="64x64">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

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
          <div class="col-sm-6">
            <?php if($_SESSION['tipo_usuario'] != 'USER') { echo "<h1>MI DENUNCIA/QUEJA/RECLAMO</h1>"; }?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

				<?php 

				include('ProcesosJugadores.php');

				?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="row">
          <div class="col-md-3">
<?php

$Sql = mysqli_query($conn, "SELECT * FROM denuncias WHERE idUsuarioCreado = ".$_GET['id']);
$SqlResult = mysqli_fetch_assoc($Sql);
	
if($SqlResult['Estado'] == 'CREADO'){
	
	$TextoEstado = "<span class='btn btn-primary btn-block'><b>". $SqlResult['Estado']."</b></span>";
	$ColorEstado = "primary";
	
}
if($SqlResult['Estado'] == 'VISTO'){
	
	$TextoEstado = "<span class='btn btn-warning btn-block'><b>". $SqlResult['Estado']."</b></span>";
	$ColorEstado = "warning";
	
}
if($SqlResult['Estado'] == 'RESUELTO'){
	
	$TextoEstado = "<span class='btn btn-success btn-block'><b>". $SqlResult['Estado']."</b></span>";
	$ColorEstado = "success";
}


// Fecha de inicio
$fechaInicio = new DateTime(date("d-m-Y",strtotime($SqlResult['FechaHoraCreada'])));

// Fecha de finalización (puede ser la fecha actual)
$fechaFin = new DateTime(date("d-m-Y"));

// Calcular la diferencia entre las fechas
$diferencia = $fechaInicio->diff($fechaFin);

// Acceder a los componentes de tiempo deseados
/*echo "Diferencia de días: " . $diferencia->days . " días<br>";
echo "Diferencia de meses: " . $diferencia->m . " meses<br>";
echo "Diferencia de años: " . $diferencia->y . " años<br>";
echo "Diferencia total en días: " . $diferencia->format('%R%a') . " días<br>";*/
?>
            <!-- Profile Image -->
            <div class="card card-<?php echo $ColorEstado; ?> card-outline">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center"><?php echo $SqlResult['TipoRegistro']; ?></h3>

                <p class="text-muted text-center">A: <?php echo $SqlResult['NombreApellidoAcusado']; ?></p>
                <p class="text-muted text-center">POR: <?php echo $SqlResult['TemaDenuncia']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Cargado el día:</b> <?php echo date("d-m-Y h:m:s",strtotime($SqlResult['FechaHoraCreada'])); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Resolucion el día:</b> <?php if($SqlResult['FechaResolucion'] == null) { echo "Aún sin resolución"; } else { echo date("d-m-Y h:m:s",strtotime($SqlResult['FechaResolucion'])); } ?></a>
                  </li>
                </ul>

                <?php echo $TextoEstado; ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
           
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-<?php echo $ColorEstado; ?>">
              <div class="card-header">
                <h3 class="card-title">DETALLES</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <hr>

                <strong><i class="fas fa-circle mr-1"></i> Relaci&oacute;n con la empresa</strong>

                <p class="text-muted"><?php echo $SqlResult['RelacionEmpresa']; ?></p>
               
			   <hr>

                <strong><i class="fas fa-circle mr-1"></i> Sector de la Empresa</strong>

                <p class="text-muted"><?php echo $SqlResult['SectorEmpresa']; ?></p>

                <hr>
				
                <strong><i class="fas fa-circle mr-1"></i> Detalle acontecido</strong>

                <p class="text-muted">
                  <?php echo $SqlResult['DetalleAcontecido']; ?>
                </p>
				
				<hr>
				
                <strong><i class="fas fa-circle mr-1"></i> Resoluci&oacute;n</strong>

                <p class="text-muted">
                  <?php if($SqlResult['Resolucion'] != null) { echo $SqlResult['Resolucion']; } else { echo "A&uacute;n no hay una resoluci&oacute;n."; } ?>
                </p>

              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- INICIO - PIE -->
  <?php include('IncludeFooter.php'); ?>
  <!-- FIN - PIE	-->


<!-- INICIO - MODAL CARGAR JUGADOR -->
	<div class="modal fade" id="ModalCargarJugador">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="Jugadores.php" enctype="multipart/form-data" method="POST">
				<!-- INICIO - ENCABEZADO MODAL -->
				<div class="modal-header">
				<h4 class="modal-title"><img src="img/JugadorBN.png" style="width:30px; color:#000;" /> CARGAR UN NUEVO JUGADOR </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<!-- FIN - ENCABEZADO MODAL -->
				
				<!-- INICIO - CUERPO MODAL -->
				<div class="modal-body">
					<p class="text-danger"><strong><small>NO ES OBLIGATORIO COMPLETAR TODOS LOS CAMPOS</small></strong></p>
					<div class="form-group">
						<label for="exampleInputPassword1">NOMBRE APELLIDO</label>
						<input type="text" name="NombreApellido" class="form-control" id="exampleInputPassword1">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">NRO. SOCIO <small><em>servir&aacute; como usuario</em></small></label>
						<input type="text" name="NroSocio" class="form-control" id="exampleInputPassword1">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">DNI <small><em>servir&aacute; como contraseña</em></small></label>
						<input type="number" name="DNI" class="form-control" id="exampleInputPassword1">
					</div>					
					<div class="form-group">
						<label for="exampleInputPassword1">FECHA NACIMIENTO <small><em>calcular&aacute; la edad automáticamente</em></small></label>
						<input type="date" name="FechaNacimiento" class="form-control" id="exampleInputPassword1">
					</div>						
				</div>
				<!-- FIN - CUERPO MODAL -->
				
				<!-- INICIO - BOTONES MODAL -->
				<div class="modal-footer justify-content-between">
				<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
				<input name="CargarNuevoJugador" type="submit" value="CARGAR NUEVO JUGADOR" class="btn btn-success">
				</div>
				<!-- FIN - BOTONES MODAL -->
				</form>
			</div>
		</div>
	</div>
<!-- FIN - MODAL CARGAR JUGADOR -->		


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
	
	
  
  	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>
</html>
