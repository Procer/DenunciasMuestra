<?php

//CONEXION A SQL
include('ConexionSqlServer.php');

session_start();
if(!isset($_SESSION['jugador']))
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
            <h1>CAMPEONATOS</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">				
				<?php 

				include('ProcesosCampeonatos.php');

				?>
            <div class="card">
              <div class="card-header">
				<button type='submit' name='FormActualizar' title='CARGAR CAMPEONATOS' class='btn btn-success' data-toggle='modal' data-target='#ModalCargarCampeonatos'><img src="img/Campeonatos.png" style="width:30px; color:#000;" />CARGAR NUEVA CAMPEONATO</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center;">ACCONES</th>
                    <th style="text-align:center;">DIVISION</th>
                  </tr>
                  </thead>
                  <tbody>
					  
												<?php
												
												$sqlSelect = "SELECT * FROM campeonato";
												$result = mysqli_query($conn, $sqlSelect);
												while ($row = mysqli_fetch_array($result)) { 												
													
													echo "<tr class='odd'>";
													echo "<td><button type='button' class='btn btn-outline-warning' data-toggle='modal' data-target='#ModalModificarCampeonato".$row['id_campeonato']."'><i class='icon fas fa-edit' data-toggle='tooltip' data-placement='top' title='EDITAR INFORMACIÓN'></i></button></td>";
													echo "<td style='text-align:center;'>".$row['descripcion']."</td>";
													echo "</tr>";
													
													?>
													
													<!-- INICIO - MODAL MODIFICAR CATEGORIA -->
														<div class="modal fade" id="ModalModificarCampeonato<?php echo $row['id_campeonato']; ?>">
															<div class="modal-dialog">
																<div class="modal-content">
																	<form action="Campeonatos.php" enctype="multipart/form-data" method="POST">
																	<!-- INICIO - ENCABEZADO MODAL -->
																	<div class="modal-header">
																	<h4 class="modal-title">MODIFICAR DIVISION</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																	</div>
																	<!-- FIN - ENCABEZADO MODAL -->
																	
																	<!-- INICIO - CUERPO MODAL -->
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">DIVISION</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<!-- FIN - CUERPO MODAL -->
																	
																	<!-- INICIO - BOTONES MODAL -->
																	<div class="modal-footer justify-content-between">
																	<input type="hidden" name="IdCampeonato" class="form-control" value="<?php echo $row['id_campeonato']; ?>">																	
																	<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
																	<input name="ModificarCampeonato" type="submit" value="MODIFICAR CATEGORIA" class="btn btn-success">
																	</div>
																	<!-- FIN - BOTONES MODAL -->
																	</form>
																</div>
															</div>
														</div>
													<!-- FIN - MODAL MODIFICAR JUGADOR -->		
												<?php
												
												}
												
												?>
					               
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="text-align:center;">ACCONES</th>
                    <th style="text-align:center;">DIVISION</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
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


	<!-- INICIO - MODAL MODIFICAR CATEGORIA -->
		<div class="modal fade" id="ModalCargarCampeonatos">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="Campeonatos.php" enctype="multipart/form-data" method="POST">
					<!-- INICIO - ENCABEZADO MODAL -->
					<div class="modal-header">
					<h4 class="modal-title">CARGAR CAMPEONATO</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<!-- FIN - ENCABEZADO MODAL -->
					
					<!-- INICIO - CUERPO MODAL -->
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">CAMPEONATO</label>
							<input type="text" name="Descripcion" class="form-control">
						</div>			
					</div>
					<!-- FIN - CUERPO MODAL -->
					
					<!-- INICIO - BOTONES MODAL -->
					<div class="modal-footer justify-content-between">
					<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
					<input name="CargarCampeonato" type="submit" value="CARGAR DIVISION" class="btn btn-success">
					</div>
					<!-- FIN - BOTONES MODAL -->
					</form>
				</div>
			</div>
		</div>
	<!-- FIN - MODAL MODIFICAR JUGADOR -->	

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
