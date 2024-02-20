<?php

//CONEXION A SQL
include('ConexionSqlServer.php');

session_start();
if(!isset($_SESSION['usuario']))
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
				<span class="info-box-icon"><i class="fa fa-list"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><h1>LISTADO TURNOS</h1></span>
				</div>
			</div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php

	if(isset($_POST['CancelarTurno'])){
		$Id = $_POST['Id'];
		$update_cierre_caja = mysqli_query($conn, "update events set 
			tipo_sesion = 'DISPONIBLE',
			color = '#63bf63',
			nombre_apellido = '',
			telefono = '',
			email = '',
			edad = 0,
			motivo_consulta = '',
			diagnostico = ''
			where id = ".$Id); 
	}

?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">				
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
				<table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
					<thead>
												<tr>
                    <th style="text-align:center;">ACCIONES</th>
                    <th style="text-align:center;">FECHA</th>
                    <th style="text-align:center;">ESTADO</th>
                    <th style="text-align:center;">PACIENTE</th>
                    <th style="text-align:center;">MOTIVO CONSULTA</th>
                    <th style="text-align:center;">DIAGNOSTICO</th>
                    <th style="text-align:center;">TELEFONO</th>
                    <th style="text-align:center;">EMAIL</th>
												</tr>
											</thead>
											<tbody>
					<?php
					
					$sqlSelect = "SELECT * FROM events where start >= CURDATE() order by start asc";
					$result = mysqli_query($conn, $sqlSelect);
					while ($row = mysqli_fetch_array($result)) { 
						
						if($row['tipo_sesion'] == 'PRIMERA CONSULTA NUTRICIONAL ANTROPOMETRICA'){
							$Color = "<span class='badge bg-success' style='font-size: 90%; font-weight: unset;'>".$row['tipo_sesion']."</span>";
						} else {
							$Color = $row['tipo_sesion'];
						}
						if($row['tipo_sesion'] != 'DISPONIBLE'){
							$EstadoCancelarTurno = '';
						} else {
							$EstadoCancelarTurno = 'disabled';
						}
						
						$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
						$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
											 
						$DisDisponible = $dias[date('w', strtotime($row['start']))]." ".date('d', strtotime($row['start']))." de ".$meses[date('n', strtotime($row['start']))-1]. " del ".date('Y') ;   
						$Hora =  date("H:i", strtotime($row['start']));
						
						echo "<tr class='odd'>";
						echo "<td>";
						echo "		<form action='home.php' method='POST'><button ".$EstadoCancelarTurno." type='submit' class='btn btn-block btn-danger' name='CancelarTurno' style='padding:0px;'>CANCELAR TURNO</button><input type='hidden' name='Id' value='".$row['id']."' />";
						echo "		</form>";
						echo "</td>";
						echo "<td>".$DisDisponible." ".$Hora."</td>";
						echo "<td>".$Color."</td>";
						echo "<td>".$row['nombre_apellido']."</td>";
						echo "<td>".$row['motivo_consulta']."</td>";
						echo "<td>".$row['diagnostico']."</td>";
						echo "<td>".$row['telefono']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "</tr>";
					
					}
					
					?>
											</tbody>
											<tfoot>
												<tr>
												    <th rowspan="1" colspan="1" style="text-align:center;">ACCIONES</th>
												    <th rowspan="1" colspan="1" style="text-align:center;">FECHA</th>
													<th rowspan="1" colspan="1" style="text-align:center;">ESTADO</th>
													<th rowspan="1" colspan="1" style="text-align:center;">PACIENTE</th>
													<th rowspan="1" colspan="1" style="text-align:center;">MOTIVO CONSULTA</th>
													<th rowspan="1" colspan="1" style="text-align:center;">DIAGNOSTICO</th>
													<th rowspan="1" colspan="1" style="text-align:center;">TELEFONO</th>
													<th rowspan="1" colspan="1" style="text-align:center;">EMAIL</th>

												</tr>
											</tfoot>
										</table>
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
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
      $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>
</body>
</html>
