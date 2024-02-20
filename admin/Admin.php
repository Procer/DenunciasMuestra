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
            <h1>DENUNCIAS/QUEJAS/RECLAMOS</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  
	  
	  <div class="row">
			<div class="col-12 col-sm-6 col-md-4">
				<div class="info-box mb-3">
					<span class="info-box-icon"><img src="img/Denuncia.png" /></span>
					<div class="info-box-content">
					<?php 
					
						$SqlDenuncia = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Denuncia'");
						$SqlResultDenuncia = mysqli_fetch_assoc($SqlDenuncia);

						$SqlDenunciaSinR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Denuncia' AND Estado = 'CREADO' OR Estado = 'VISTO' ");
						$SqlResultDenunciaSinR = mysqli_fetch_assoc($SqlDenunciaSinR);

						$SqlDenunciaConR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Denuncia' AND Estado = 'RESUELTO'");
						$SqlResultDenunciaConR = mysqli_fetch_assoc($SqlDenunciaConR);
					
					?>
						<span class="info-box-text">DENUNCIAS | <strong>Total: <?php echo $SqlResultDenuncia['Cantidad']; ?></strong></span>						
						<span class="text-success">Resueltas: <?php echo $SqlResultDenunciaConR['Cantidad']; ?></span> <span class="text-danger">Sin resolver: <?php echo $SqlResultDenunciaSinR['Cantidad']; ?></span>
					</div>
				</div>
			</div>


			<div class="clearfix hidden-md-up"></div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="info-box mb-3">
					<span class="info-box-icon"><img src="img/Queja.png" /></span>
					<div class="info-box-content">
					<?php 
					
						$SqlDenuncia = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Queja'");
						$SqlResultDenuncia = mysqli_fetch_assoc($SqlDenuncia);

						$SqlDenunciaSinR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Queja' AND Estado = 'CREADO'  OR Estado = 'VISTO'");
						$SqlResultDenunciaSinR = mysqli_fetch_assoc($SqlDenunciaSinR);

						$SqlDenunciaConR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Queja' AND Estado = 'RESUELTO'");
						$SqlResultDenunciaConR = mysqli_fetch_assoc($SqlDenunciaConR);
					
					?>
						<span class="info-box-text">QUEJAS | <strong>Total: <?php echo $SqlResultDenuncia['Cantidad']; ?></strong></span>						
						<span class="text-success">Resueltas: <?php echo $SqlResultDenunciaConR['Cantidad']; ?></span><span class="text-danger">Sin resolver: <?php echo $SqlResultDenunciaSinR['Cantidad']; ?></span>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-md-4">
				<div class="info-box mb-3">
					<span class="info-box-icon"><img src="img/Reclamo.png" /></span>
					<div class="info-box-content">
					<?php 
					
						$SqlDenuncia = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Reclamo'");
						$SqlResultDenuncia = mysqli_fetch_assoc($SqlDenuncia);

						$SqlDenunciaSinR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Reclamo' AND Estado = 'CREADO' OR Estado = 'VISTO' ");
						$SqlResultDenunciaSinR = mysqli_fetch_assoc($SqlDenunciaSinR);

						$SqlDenunciaConR = mysqli_query($conn, "SELECT COUNT(*) Cantidad FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' AND TipoRegistro = 'Reclamo' AND Estado = 'RESUELTO'");
						$SqlResultDenunciaConR = mysqli_fetch_assoc($SqlDenunciaConR);
					
					?>
						<span class="info-box-text">RECLAMOS | <strong>Total: <?php echo $SqlResultDenuncia['Cantidad']; ?></strong></span>						
						<span class="text-success">Resueltas: <?php echo $SqlResultDenunciaConR['Cantidad']; ?></span><span class="text-danger">Sin resolver: <?php echo $SqlResultDenunciaSinR['Cantidad']; ?></span>
					</div>

				</div>
			</div>

		</div>
	  
	  
	  
        <div class="row">
          <div class="col-12">				
				<?php 

				include('ProcesosJugadores.php');

				?>
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align:center; vertical-align:middle;">ACCONES</th>
                    <th style="text-align:center; vertical-align:middle;">ESTADO</th>
                    <th style="text-align:center; vertical-align:middle;">FECHA CREADA</th>
                    <th style="text-align:center; vertical-align:middle;">FECHA VISTO</th>
                    <th style="text-align:center; vertical-align:middle;">FECHA RESOLUCI&Oacute;N</th>
                    <th style="text-align:center; vertical-align:middle;">RELACION EMPRESA</th>
                    <th style="text-align:center; vertical-align:middle;">TIPO</th>
                    <th style="text-align:center; vertical-align:middle;">SECTOR</th>
                    <th style="text-align:center; vertical-align:middle;">TEMA DENUNCIA</th>
                    <th style="text-align:center; vertical-align:middle;">ACUSADO</th>
                    <th style="text-align:center; vertical-align:middle;">DETALEL ACONTECIDO</th>
                    <th style="text-align:center; vertical-align:middle;">RESOLUCI&Oacute;N</th>
                    <th style="text-align:center; vertical-align:middle;">ADJUNTOS</th>
					
                  </tr>
                  </thead>
                  <tbody>
					  
												<?php
												
												$sqlSelect = "SELECT * FROM denuncias WHERE SectorEmpresa <> '".$_SESSION['Sector']."' ORDER BY FechaHoraCreada DESC";

												$result = mysqli_query($conn, $sqlSelect);
												while ($row = mysqli_fetch_array($result)) { 

													if($row['Estado'] == 'CREADO'){
														
														$TextoEstado = "<span class='badge badge-primary'>". $row['Estado']."</b></span>";
														$ColorEstado = "primary";
														
													}
													if($row['Estado'] == 'VISTO'){
														
														$TextoEstado = "<span class='badge badge-warning'>". $row['Estado']."</b></span>";
														$ColorEstado = "warning";
														
													}
													if($row['Estado'] == 'RESUELTO'){
														
														$TextoEstado = "<span class='badge badge-success'>". $row['Estado']."</b></span>";
														$ColorEstado = "success";
													}
													
													if($row['FechaResolucion'] == null) { 
															$FechaResolucion = "Sin resolución"; 
														} else { 
															$FechaResolucion = date("d-m-Y h:m:s",strtotime($row['FechaResolucion'])); 
														}
													if($row['FechaVisto'] == null) { 
															$FechaVisto = "Sin ver"; 
														} else { 
															$FechaVisto = date("d-m-Y h:m:s",strtotime($row['FechaVisto'])); 
														}
													
													echo "<tr class='odd'>";
													echo "<td style='text-align:center; vertical-align:middle;'>";
													echo "	<input type='hidden' name='IdJugadores' value='".$row['IdDenuncias']."' />";
													echo "	<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#ModalCargarResolucion".$row['IdDenuncias']."'><i class='icon fas fa-edit' data-toggle='tooltip' data-placement='top' title='CARGAR RESOLUCI&Oacute;N'></i></button>";
													if($row['Estado'] == 'CREADO'){
														echo "	<a href='Admin.php?IdDenuncia=".$row['IdDenuncias']."' name='MarcarVisto' class='btn btn-outline-warning' ><i class='icon fas fa-eye' data-toggle='tooltip' data-placement='top' title='MARCAR COMO VISTO'></i></a>";
													}
													echo "</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$TextoEstado."</td>";
													echo "<td style='text-align:center; width:106px;'>".date("d-m-Y h:m:s",strtotime($row['FechaHoraCreada']))."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle; width:106px;'>".$FechaVisto."</td>";											
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle; width:106px;'>".$FechaResolucion."</td>";											
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['RelacionEmpresa']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['TipoRegistro']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['SectorEmpresa']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['TemaDenuncia']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['NombreApellidoAcusado']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['DetalleAcontecido']."</td>";
													echo "<td style='text-align:center; font-size: 84% Important!; vertical-align:middle;'>".$row['Resolucion']."</td>";
													echo "<td style='text-align:center;'>";
												
												$Sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE IdUsuario = ".$row['IdUsuarioCreado']);
												$SqlResult = mysqli_fetch_assoc($Sql);

												$directorio = "Documentos/".$SqlResult['usuarios'];
        $ficheros = scandir($directorio);
 
        foreach ($ficheros as $key => $fichero) {
            if ($fichero != "." && $fichero != "..") {
 
                $rutaCompleta = $directorio . '/' . $fichero;
 
                if (is_file($rutaCompleta)) {
                ?>
                    <li>
                        <a target="_blank" href="<?php echo $directorio."/".$fichero; ?>">
                        <?php echo $fichero; ?>
                    </li>
                <?php
                } else {
                ?>
                    <li>
                        <a target="_blank" href="<?php echo $directorio."/".$fichero; ?>">
                        <?php echo $fichero; ?>
                    </li>
                <?php
                }
            }
        }													
																	echo "</td>";											
																	echo "</tr>";
													
													?>
													
													<!-- INICIO - MODAL MODIFICAR JUGADOR -->
														<div class="modal fade" id="ModalCargarResolucion<?php echo $row['IdDenuncias']; ?>">
															<div class="modal-dialog">
																<div class="modal-content">
																	<form action="Admin.php" enctype="multipart/form-data" method="POST">
																	<!-- INICIO - ENCABEZADO MODAL -->
																	<div class="modal-header">
																	<h4 class="modal-title">CARGAR RESOLUCI&Oacute;N</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																	</div>
																	<!-- FIN - ENCABEZADO MODAL -->
																	
																	<!-- INICIO - CUERPO MODAL -->
																	<div class="modal-body">
																		<div class="form-group">
																			<label for="exampleInputPassword1">DESCRIPCI&Oacute;N DE LA RESOLUCI&Oacute;N</label>
																			<textarea name="Resolucion" required id="last_name" rows="10" cols="53" style="border: 1px solid #ebebeb;" ></textarea>
																		</div>					
																	</div>
																	<!-- FIN - CUERPO MODAL -->
																	
																	<!-- INICIO - BOTONES MODAL -->
																	<div class="modal-footer justify-content-between">
																	<input type="hidden" name="IdDenuncias" class="form-control" value="<?php echo $row['IdDenuncias']; ?>">																	
																	<button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar sin guardar</button> 
																	<input name="CargarResolucion" type="submit" value="CARGR RESOLUCI&Oacute;N" class="btn btn-success">
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
