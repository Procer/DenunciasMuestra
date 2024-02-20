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
            <h1>PARTIDOS</h1>
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

				include('ProcesosPartidos.php');

				?>
            <div class="card">
              <div class="card-header">
				<button type='submit' name='FormActualizar' title='CARGAR PARTIDO' class='btn btn-success' data-toggle='modal' data-target='#ModalCargarPartidos'><img src="img/Partidos.png" style="width:30px; color:#000;" /> CARGAR NUEVO PARTIDO</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center;">ACCONES</th>
                    <th style="text-align:center;">CATEGOR&Iacute;A</th>
                    <th style="text-align:center;">DIVISI&Oacute;N</th>
                    <th style="text-align:center;">CAMPEONATO</th>
                    <th style="text-align:center;">FECHA</th>
                    <th style="text-align:center;">D&Iacute;A</th>
                    <th style="text-align:center;">HORA</th>
                    <th style="text-align:center;">CANCHA</th>
                    <th style="text-align:center;">RIVAL</th>
                    <th style="text-align:center;">GF FINAL</th>
                    <th style="text-align:center;">GC FINAL</th>
                    <th style="text-align:center;">RESULTADO</th>
                    <th style="text-align:center;">GF 1° TIEMPO</th>
                    <th style="text-align:center;">GF 2° TIEMPO</th>
                    <th style="text-align:center;">GC 1° TIEMPO</th>
                    <th style="text-align:center;">GC 2° TIEMPO</th>
                    <th style="text-align:center;">GOLES JUGADORES</th>
                    <th style="text-align:center;">EXPULSADOS</th>
                    <th style="text-align:center;">ALINEACI&Oacute;N INICIAL</th>
                    <th style="text-align:center;">SUPLENTES</th>
                    <th style="text-align:center;">NO INGRESADOS</th>
                    <th style="text-align:center;">CANTIDAD SUPLENTES</th>
                  </tr>
                  </thead>
                  <tbody>
					  
												<?php
												
												$sqlSelect = "SELECT * FROM partidos";
												$result = mysqli_query($conn, $sqlSelect);
												while ($row = mysqli_fetch_array($result)) { 												
													
													echo "<tr class='odd'>";
													echo "<td><button type='button' class='btn btn-outline-warning' data-toggle='modal' data-target='#ModalModificarPartido".$row['id_partidos']."'><i class='icon fas fa-edit' data-toggle='tooltip' data-placement='top' title='EDITAR INFORMACIÓN'></i></button></td>";
													echo "<td style='text-align:center;'>".$row['descripcion']."</td>";
													echo "</tr>";
													
													?>
													
													<!-- INICIO - MODAL MODIFICAR CATEGORIA -->
														<div class="modal fade" id="ModalModificarPartido<?php echo $row['id_partidos']; ?>">
															<div class="modal-dialog">
																<div class="modal-content">
																	<form action="Partidos.php" enctype="multipart/form-data" method="POST">
																	<!-- INICIO - ENCABEZADO MODAL -->
																	<div class="modal-header">
																	<h4 class="modal-title">MODIFICAR PARTIDO</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																	</div>
																	<!-- FIN - ENCABEZADO MODAL -->
																	
																	<!-- INICIO - CUERPO MODAL -->
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">CATEGORIA</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">DIVISION</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">CAMPEONATO´</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">FECHA</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">DIA</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">HORA</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">CANCHA</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">RIVAL</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GF FINAL</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GC FINAL</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">RESULTADO</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GF 1ER TIEMPO</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GF 2DO TIEMPO</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GC 1ER TIEMPO</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GC 2DO TIEMPO</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">GOLES JUGADORES</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">EXPULSADOS</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">ALINEACI&Oacute; INICIAL</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">SUPLENTES</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">NO INGRESADOS</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">CANTIDAD SUMPLENTES</label>
																			<input type="text" name="Descripcion" class="form-control" >
																		</div>			
																	</div>
																	<!-- FIN - CUERPO MODAL -->
																	
																	<!-- INICIO - BOTONES MODAL -->
																	<div class="modal-footer justify-content-between">
																	<input type="hidden" name="IdCampeonato" class="form-control" value="<?php echo $row['id_campeonato']; ?>">																	
																	<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
																	<input name="ModificarPartodp" type="submit" value="MODIFICAR PARTIDO" class="btn btn-success">
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
                    <th style="text-align:center;">CATEGOR&Iacute;A</th>
                    <th style="text-align:center;">DIVISI&Oacute;N</th>
                    <th style="text-align:center;">CAMPEONATO</th>
                    <th style="text-align:center;">FECHA</th>
                    <th style="text-align:center;">D&Iacute;A</th>
                    <th style="text-align:center;">HORA</th>
                    <th style="text-align:center;">CANCHA</th>
                    <th style="text-align:center;">RIVAL</th>
                    <th style="text-align:center;">GF FINAL</th>
                    <th style="text-align:center;">GC FINAL</th>
                    <th style="text-align:center;">RESULTADO</th>
                    <th style="text-align:center;">GF 1° TIEMPO</th>
                    <th style="text-align:center;">GF 2° TIEMPO</th>
                    <th style="text-align:center;">GC 1° TIEMPO</th>
                    <th style="text-align:center;">GC 2° TIEMPO</th>
                    <th style="text-align:center;">GOLES JUGADORES</th>
                    <th style="text-align:center;">EXPULSADOS</th>
                    <th style="text-align:center;">ALINEACI&Oacute;N INICIAL</th>
                    <th style="text-align:center;">SUPLENTES</th>
                    <th style="text-align:center;">NO INGRESADOS</th>
                    <th style="text-align:center;">CANTIDAD SUPLENTES</th>
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
		<div class="modal fade" id="ModalCargarPartidos">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="Partidos.php" enctype="multipart/form-data" method="POST">
					<!-- INICIO - ENCABEZADO MODAL -->
					<div class="modal-header">
					<h4 class="modal-title">CARGAR PARTIDO</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<!-- FIN - ENCABEZADO MODAL -->
					
					<!-- INICIO - CUERPO MODAL -->
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">CATEGORIA</label>
							<input list="Categoriass" name="Categorias" class="form-control" placeholder="elegir categoria" ></p>
							<datalist id="Categoriass">
							<?php
							$sqlSelect = "SELECT * FROM catergoria";
							$result = mysqli_query($conn, $sqlSelect);
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='".$row['descripcion']."'>";
							}
							?>
							</datalist>
							
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">DIVISION</label>
							<input list="Division" name="IdDivision" class="form-control" placeholder="elegir division" ></p>
							<datalist id="Division">
							<?php
							$sqlSelect = "SELECT * FROM division";
							$result = mysqli_query($conn, $sqlSelect);
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='".$row['descripcion']."'>";
							}
							?>
							</datalist>							
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">CAMPEONATO</label>
							<input list="Campeonato" name="IdCampeonato" class="form-control" placeholder="elegir division" ></p>
							<datalist id="Campeonato">
							<?php
							$sqlSelect = "SELECT * FROM campeonato";
							$result = mysqli_query($conn, $sqlSelect);
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='".$row['descripcion']."'>";
							}
							?>
							</datalist>							
							
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">FECHA</label>
							<input type="date" name="Fecha" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">DIA</label>
							<input type="text" name="Dia" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">HORA</label>
							<input type="time" name="Hora" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">CANCHA</label>
							<input type="text" name="IdCancha" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">RIVAL</label>
							<input type="text" name="IdRival" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GF FINAL</label>
							<input type="number" name="GfFinal" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GC FINAL</label>
							<input type="number" name="GcFinal" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">RESULTADO</label>
							<input type="number" name="Resultado" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GF 1ER TIEMPO</label>
							<input type="number" name="GfPriTiempo" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GF 2DO TIEMPO</label>
							<input type="number" name="GfSegTiempo" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GC 1ER TIEMPO</label>
							<input type="number" name="GcPriTiempo" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GC 2DO TIEMPO</label>
							<input type="number" name="GcSegTiempo" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">GOLES JUGADORES</label>
							<input type="number" name="GolesJugadores" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">EXPULSADOS</label>
							<input type="text" name="Expulsados" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">ALINEACI&Oacute;N INICIAL</label>
							<input type="text" name="AlineacionInicial" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">SUPLENTES</label>
							<input type="text" name="Suplente" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">NO INGRESADOS</label>
							<input type="text" name="NoIngresados" class="form-control" >
						</div>			
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">CANTIDAD SUMPLENTES</label>
							<input type="number" name="CantSuplentes" class="form-control" >
						</div>			
					</div>
					<!-- FIN - CUERPO MODAL -->
					
					<!-- INICIO - BOTONES MODAL -->
					<div class="modal-footer justify-content-between">
					<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
					<input name="CargarPartido" type="submit" value="CARGAR DIVISION" class="btn btn-success">
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
