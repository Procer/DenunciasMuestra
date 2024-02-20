<?php

//CONEXION A SQL
include('ConexionSqlServer.php');


session_start();
if(!isset($_SESSION['usuario']))
{
	header("Location: index.php");
}


header('Content-Type: text/html; charset=UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
				<span class="info-box-icon"><i class="fa fa-calendar-check"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><h1>CARGAR TURNOS</h1></span>
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

								$SoloUnaVez = 0;
								$i = 0;
								$Dentro = 0;
								if(isset($_POST['MostrarFechas']) and ($_POST['Telefono'] != null)){
									$Dentro = 1;
									
									if($_POST['TipoSesion'] == 'NADA'){
										echo "<h2 style='color:red;'>DEBE ELEGIR UN TIPO DE SESIÓN.</h2><br>";
									} else {
									
									if($_POST['TipoSesion'] == 'PRIMERA CONSULTA NUTRICIONAL ANTROPOMETRICA'){
										$sqlSelect = "SELECT * FROM events where tipo_sesion = 'DISPONIBLE' and flag = 1";
									} else {
										$sqlSelect = "SELECT * FROM events where tipo_sesion = 'DISPONIBLE' and flag != 1";
									}
										$result = mysqli_query($conn, $sqlSelect);
										while ($row = mysqli_fetch_array($result)) {
											if($SoloUnaVez == 0){
												echo "<hr style='border:1px solid #4AEA8C'><table><tr><td  style='padding:0px;'><h2><strong style='color:#000;'>TURNOS DISPONIBLES</strong></h2></td></tr>";
												echo "<form action='CargarTurnos.php' method='POST'>";
												$SoloUnaVez = 1;
											}
											$i = $i + 1;
											if($i == 1){
												echo "<tr>";
											}
											
											$Direccion = $row['direccion'];
											
											$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
											$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
											 
											$DisDisponible = $dias[date('w', strtotime($row['start']))]." ".date('d', strtotime($row['start']))." de ".$meses[date('n', strtotime($row['start']))-1]. " del ".date('Y') ;   
											$Hora =  date("H:i", strtotime($row['start']));
											echo "<td style='padding:0px;'>";
											echo "		<input type='radio' id='demo-priority-normal".$row['id']."' name='FechaElegida' value='".$row['id']."'>";
											echo "		<label for='demo-priority-normal".$row['id']."'>".$DisDisponible." <strong style='color:#000;'>".$Hora." hs.</strong></label>";
											echo "</td>";
											if($i == 4){
												$i = 0;
												echo "</tr>";
											}
										}
										echo "<input type='hidden' value='".$_POST['Nombre']." ".$_POST['Nombre']."' name='NombreApellido' />";
										echo "<input type='hidden' value='".$_POST['Telefono']."' name='Telefono' />";
										echo "<input type='hidden' value='".$_POST['Email']."' name='Email' />";
										echo "<input type='hidden' value='".$_POST['Edad']."' name='Edad' />";
										echo "<input type='hidden' value='".$_POST['TipoSesion']."' name='TipoSesion' />";
										echo "<input type='hidden' value='".$_POST['Diagnostico']."' name='Diagnostico' />";
										echo "<input type='hidden' value='".$_POST['MotivoConsulta']."' name='MotivoConsulta' />";
										echo "<input type='submit' name='ReservaFecha' class='next-form btn btn-info' value='RESERVAR TURNO' /></form></table><hr style='border:1px solid #4AEA8C'></form>";
									}
									} else {
										if($Dentro == 1){
											if($_POST['Telefono'] == null){
											echo "<h2><strong style='color:red;'>ES NECESARIO CARGAR UN NÚMERO DE TELÉFONO Y UN EMAIL</strong></h2>";
										}
									}
									}
									
									if(isset($_POST['ReservaFecha'])){
											//UPDATE EN LA TABLA
											$update_cierre_caja = mysqli_query($conn, "update events set 
																						tipo_sesion = 'OCUPADO',
																						color = '#ad0b0bba',
																						nombre_apellido = '".$_POST['NombreApellido']."',
																						telefono = '".$_POST['Telefono']."',
																						email = '".$_POST['Email']."',
																						edad = ".$_POST['Edad'].",
																						tipo_sesion = '".$_POST['TipoSesion']."',
																						motivo_consulta = '".$_POST['MotivoConsulta']."',
																						diagnostico = '".$_POST['Diagnostico']."'
																						where id = ".$_POST['FechaElegida']); 
											//TOTAL LIBROS CARGADOS
											$consulta = mysqli_query($conn, "SELECT * FROM events where id = ".$_POST['FechaElegida']);
											$resultado = mysqli_fetch_assoc($consulta);
											$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
											$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
											 
											$DisDisponible = $dias[date('w', strtotime($resultado['start']))]." ".date('d', strtotime($resultado['start']))." de ".$meses[date('n')-1]. " del ".date('Y') ;   
											$Hora =  date("H:i", strtotime($resultado['start']));
											echo "<h2><strong style='color:#44a16a;'>TURNO RESERVADO PARA $DisDisponible - $Hora hs.</strong> en <strong>$Direccion</strong></h2><br>";
									
									
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
 
$mail = new PHPMailer(true);
try {
    //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'mail.nutriafonsojandres.com.ar';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'info@nutriafonsojandres.com.ar';                 // Usuario SMTP
    $mail->Password = 'June@132134';                           // Password SMTP
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
 
    $mail->setFrom('info@nutriafonsojandres.com.ar');		// Mail del remitente
    $mail->addAddress($_POST['Email']);     // Mail del destinatario
 
    $mail->isHTML(true);
    $mail->Subject = 'TURNO CON JUAN A. AFONSO';  // Asunto del mensaje
													$mail->Body = "<p>Hola!</p><p>Usted reservó un turno con el Licenciado Juan A. Afonso para el siguiente día: <strong>$DisDisponible - $Hora hs.</strong> en <strong>$Direccion</strong></p><p><strong style='color:red;'>IMPORTANTE: <BR>- Sexo femenino: para realizar el examen antropométrico tiene que llevar a su consulta calza corta o short y top deportivo. Además, no debería estar transitando su periodo menstrual, ya que podría afectar en los valores finales. <br>- Sexo masculino: para realizar el examen antropométrico tiene que llevar a su consulta un pantalón corto. </strong></p>";
													$mail->Body.= "<p>SI DESEA CANCELAR EL TURNO, SÓLO DEBE OPRIMIR EN EL SIGUIENTE ENLACE: <a href='https://nutriafonsojandres.com.ar/?CancelarTurno=".$_POST['FechaElegida']."'>CANCELAR TURNO</a></p>";
													$mail->Body.= "<br><img src='https://nutriafonsojandres.com.ar/images/Logo.jpeg' title='onehundredleaves' alt='onehundredleaves' width='200'><br>";

 
    $mail->send();
    //echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}}
								?>
								<form id="register_form" novalidate action="CargarTurnos.php" method="post">

									<fieldset>
										<h2>PASO 1: DATOS PERSONALES</h2>
										<div class="form-group">
										<input type="text" class="form-control" required name="Nombre" id="first_name" placeholder="NOMBRE (requerido)">
										</div>
										<br>
										<div class="form-group">
										<input type="text" class="form-control" required name="Apellido" id="last_name" placeholder="APELLIDO (requerido)">
										</div>
										<br>
										<div class="form-group">
										<input type="number" class="form-control" required name="Edad" id="last_name" placeholder="EDAD (requerido)">
										</div>
										<br>
										<div class="form-group">
										<input type="text" class="form-control" required name="Telefono" id="last_name" placeholder="TELEFONO (requerido)">
										</div>
										<br>
										<div class="form-group">
										<input type="text" class="form-control" required name="Email" id="last_name" placeholder="EMAIL (requerido)">
										</div>
										<br>

									</fieldset>
								<fieldset>
									<h2>PASO 2: CONSULTA MÉDICA</h2>
									<div class="form-group">
										<select name="TipoSesion" id="demo-category">
											<option value="NADA">- TIPO SESIÓN - (requerido)</option>
											<option value="PRIMERA CONSULTA NUTRICIONAL">PRIMERA CONSULTA NUTRICIONAL</option>
											<option value="SEGUNDA CONSULTA NUTRICIONAL">SEGUNDA CONSULTA NUTRICIONAL</option>
											<option value="PRIMERA CONSULTA NUTRICIONAL ANTROPOMETRICA">PRIMERA CONSULTA NUTRICIONAL ANTROPOMETRICA</option>
											<option value="ANTROPOMETRIA">ANTROPOMETRIA</option>
										</select>
									</div>
									<br>
									<div class="form-group">
										<input type="text" name="MotivoConsulta" id="demo-name" value="" placeholder="MOTIVO CONSULTA">
									</div><br>
									<span style="border-bottom:1px solid; text-align:left; font-size:32px;">DIAGNÓSTICO</span>
									<br><br>
									<div class="form-group">
										<input type="checkbox" id="1" value="NO APLICA" name="Diagnostico">
										<label for="1">NO APLICA</label>
										<input type="checkbox" id="2" value="NUTRICIÓN DEPORTIVA" name="Diagnostico">
										<label for="2">NUTRICIÓN DEPORTIVA</label>
										<input type="checkbox" id="3" value="OBESIDAD" name="Diagnostico">
										<label for="3">OBESIDAD</label>
										<input type="checkbox" id="4" value="BAJO PESO" name="Diagnostico">
										<label for="4">BAJO PESO</label>
										<input type="checkbox" id="5" value="DIABETES" name="Diagnostico">
										<label for="5">DIABETES</label>
										<input type="checkbox" id="6" value="DISLIPIDEMIA" name="Diagnostico">
										<label for="6">DISLIPIDEMIA</label>
										<input type="checkbox" id="7" value="HIPERTENSIÓN ARTERIAL" name="Diagnostico">
										<label for="7">HIPERTENSIÓN ARTERIAL</label>
										<input type="checkbox" id="8" value="TRASTORNOS GASTROINTENSTINALES" name="Diagnostico">
										<label for="8">TRASTORNOS GASTROINTENSTINALES</label>
									</div>
									<br>
									<input type="submit" name="MostrarFechas" class="submit btn btn-success" value="MOSTAR FECHAS DISPONIBLES" />
								</fieldset>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
