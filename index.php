<?php
//CONEXION A SQL
include('admin/ConexionSqlServer.php');
//CARGAR DENUNCIA/RECLAMO/QUEJA
if(isset($_POST['submit'])){

	//GENERA USUARIO ALEATORIO	
	function generarCodigos($cantidad=3, $longitud=10, $incluyeNum=true){ 
		$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
		if($incluyeNum) 
			$caracteres .= "1234567890"; 
		 
		$arrPassResult=array(); 
		$index=0; 
		while($index<$cantidad){ 
			$tmp=""; 
			for($i=0;$i<$longitud;$i++){ 
				$tmp.=$caracteres[rand(0,strlen($caracteres)-1)]; 
			} 
			if(!in_array($tmp, $arrPassResult)){ 
				$arrPassResult[]=$tmp; 
				$index++; 
			} 
		} 
		return $tmp; 
	}  
	$Codigos = generarCodigos(1,5); 

	//GENERA CLAVE ALEATORIO
	$Clave = rand(1,1000000);

	//INSERT TABLA USUARIOS
	$InsertUsuarios = mysqli_query($conn, "INSERT INTO usuarios(
		usuarios,
		pass,
		TipoUsuario,
		email)
	VALUES('".$Codigos."',
		'".$Clave."',
		'USER',
		AES_ENCRYPT('".$_POST['Email']."','".$Codigos."'))");

	//CONSULTO ID USUARIO CREADO
	$IdUsuario = mysqli_query($conn, "SELECT idUsuario FROM usuarios where usuarios = '".$Codigos."'");
	$ResultIdUsuario = mysqli_fetch_assoc($IdUsuario);

	//INSERT TABLA CAJA NEGRA
	$InsertDenuncias = mysqli_query($conn, "INSERT INTO denuncias
							(`FechaHoraCreada`, 
							`RelacionEmpresa`,
							`TemaDenuncia`, 
							`NombreApellidoAcusado`, 
							`DetalleAcontecido`, 
							`Estado`, 
							`Resolucion`,  
							`IdUsuarioCreado`,
							`TipoRegistro`,
							`SectorEmpresa`) 
									VALUES
							(NOW(),
							'".$_POST['RelacionEmpresa']."',
							'".$_POST['TemaDenuncia']."',
							'".$_POST['NombreApellidoAcusado']."',
							'".$_POST['DetalleAcontecido']."',
							'CREADO',
							'',
							'".$ResultIdUsuario['idUsuario']."',
							'".$_POST['TipoRegistro']."',
							'".$_POST['SectorEmpresa']."'
							)");


	//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
	//Validamos que el archivo exista
	if($_FILES["archivo"]["name"][$key]) {
		$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
		$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
		
		$directorio = 'admin/Documentos/'.$Codigos; //Declaramos un  variable con la ruta donde guardaremos los archivos
		
		//Validamos si la ruta de destino existe, en caso de no existir la creamos
		if(!file_exists($directorio)){
			mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
		}
		
		$dir = opendir($directorio); //Abrimos el directorio de destino
		$target_path = $directorio."/".$filename; //Indicamos la ruta de destino, así como el nombre del archivo
		
		//Movemos y validamos que el archivo se haya cargado correctamente
		//El primer campo es el origen y el segundo el destino
		if(move_uploaded_file($source, $target_path)) {	
			echo "";
			}
		}
		closedir($dir); //Cerramos el directorio de destino
		if(empty($_FILES["archivo"]["name"][$key])){
			$Adjunto = '';
		} else {
			$Adjunto = $filename;
		}
	}
	
//ENVIO EMAIL
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
 
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
    $mail->Subject = 'DENUNCIA/QUEJA/RECLAMO';  // Asunto del mensaje
													$mail->Body = "<p>Hola!</p><p>Usted realizó una denuncia/queja/reclamo. <br> A continuación le dejamos los datos de acceso para poder ir conociendo la relosución del caso. <br> <strong>Usuario: ".$Codigos."</strong> <br> <strong>Clave: ".$Clave."</strong></p>";
													$mail->Body.= "<br><img src='https://nutriafonsojandres.com.ar/images/Logo.jpeg' title='onehundredleaves' alt='onehundredleaves' width='200'><br>";

 
    $mail->send();
    //echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}
	

	?>
	<script> window.location.replace("index.php?c=<?php echo $Codigos; ?>&p=<?php echo $Clave; ?>"); </script>
	<?php		

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaio Denuncias | Quejas | Reclamos</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="padding-top:20px; margin:0 auto 0;">

    <div class="main">

        <div class="container">
            <div class="signup-content" style="margin:0 auto;">
                <div class="signup-form" style="text-align:center; margin: 0 auto;">
					<img src="admin/img/Escudo.png" alt="" style="width:50%; padding-top:30px;">
					<?php

					

					?>
					<h1 style="color:#000; padding-top:30px;">El siguiente formulario es para registrar una denuncia, queja o reclamo.</h1>
					<h2 style="color:#000; padding-top:30px;">¡ES TOTALMENTE ANONIMA!</h2>
                    <form action="index.php" method="POST" class="register-form" id="register-form" enctype="multipart/form-data">
                        <div class="form-row">
						
                            <div class="form-group">
								<div class="form-radio">
									<div class="label-flex">
                                        <label for="payment"><span style="font-size:21px;">¿QUÉ DESEA HACER?</span></label>
                                         <!--<a href="#" class="form-link">Payment Detail</a>-->
                                    </div>
                                    <div class="form-radio-group">            
                                        <div class="form-radio-item">
                                            <input type="radio" name="TipoRegistro" id="Denuncia" value="Denuncia">
                                            <label for="Denuncia">Denuncia</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TipoRegistro" id="Queja" value="Queja">
                                            <label for="Queja">Queja</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TipoRegistro" id="Reclamo" value="Reclamo">
                                            <label for="Reclamo">Reclamo</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                    </div>
                                </div>
								
								<div class="form-radio">
									<div class="label-flex">
                                        <label for="payment"><span style="font-size:21px;">RELACIÓN CON LA EMPRESA</span></label>
                                         <!--<a href="#" class="form-link">Payment Detail</a>-->
                                    </div>
                                    <div class="form-radio-group">            
                                        <div class="form-radio-item">
                                            <input type="radio" name="RelacionEmpresa" id="Empleado" value="Empleado">
                                            <label for="Empleado">Empleado</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="RelacionEmpresa" id="Proveedor" value="Proveedor">
                                            <label for="Proveedor">Proveedor</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="RelacionEmpresa" id="Cliente" value="Cliente">
                                            <label for="Cliente">Cliente</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                    </div>
                                </div>

								<div class="form-radio">
									<div class="label-flex">
                                        <label for="payment"><span style="font-size:21px;">TEMA DE LA DENUNCIA</span></label>
                                         <!--<a href="#" class="form-link">Payment Detail</a>-->
                                    </div>
                                    <div class="form-radio-group">            
                                        <div class="form-radio-item">
                                            <input type="radio" name="TemaDenuncia" id="AcosoSexual" value="AcosoSexual">
                                            <label for="AcosoSexual">Acoso sexual</label>
                                            <span class="check" style="left:10px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TemaDenuncia" id="AcosoLaboral" value="AcosoLaboral">
                                            <label for="AcosoLaboral">Acoso laboral</label>
                                            <span class="check" style="left:14px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TemaDenuncia" id="Corrupcion" value="Corrupcion">
                                            <label for="Corrupcion">Corrupción</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TemaDenuncia" id="Discriminacion" value="Discriminacion">
                                            <label for="Discriminacion">Discriminación</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="TemaDenuncia" id="Maltrato" value="Maltrato">
                                            <label for="Maltrato">Maltrato</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                    </div>
                                </div>

								<div class="form-radio">
									<div class="label-flex">
                                        <label for="payment"><span style="font-size:21px;">SECTOR DE LA EMPRESA</span></label>
                                         <!--<a href="#" class="form-link">Payment Detail</a>-->
                                    </div>
                                    <div class="form-radio-group">            
                                        <div class="form-radio-item">
                                            <input type="radio" name="SectorEmpresa" id="Rrhh" value="RRHH">
                                            <label for="Rrhh">RRHH</label>
                                            <span class="check" style="left:10px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="SectorEmpresa" id="Ventas" value="Ventas">
                                            <label for="Ventas">VENTAS</label>
                                            <span class="check" style="left:14px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="SectorEmpresa" id="AtencionPublico" value="Atencion Al Publico">
                                            <label for="AtencionPublico">ATENCIÓN AL PÚBLICO</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="SectorEmpresa" id="GerenciaGeneral" value="Gerencia General">
                                            <label for="GerenciaGeneral">GERENCIA GENERAL</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="SectorEmpresa" id="Taller" value="Taller">
                                            <label for="Taller">TALLER</label>
                                            <span class="check" style="left:20px;"></span>
                                        </div>
                                    </div>
                                </div>
	                                <div class="form-input">
                                    <label for="first_name" ><span style="font-size:21px;">NOMBRE Y APELLIDO DEL ACUSADO</span></label>
                                    <input type="text" name="NombreApellidoAcusado" id="first_name" class="required" />
                                </div>
							
                                <div class="form-input">
                                    <label for="last_name" class="required"><span style="font-size:21px;">DETALLE ACONTECIDO</span></label>
                                    <textarea name="DetalleAcontecido" id="last_name" rows="10" cols="53" style="border: 1px solid #ebebeb;" placeholder="fecha, hora, lugar, descripción del incidente, testigos - si hay - y cualquier otro detalle
"></textarea>
                                </div>
								<div class="form-group row">
									<label for="inputExperience" class="col-sm-2 col-form-label"><span style="font-size:21px;">ADJUNTO</span></label>
									<div class="col-sm-10">
										<input id="archivo[]" name="archivo[]" multiple="" class="form-control" type="file" id="inputExperience">
									</div>
								</div><br>
                                <div class="form-input">
                                    <label for="first_name" ><span style="font-size:21px;">EMAIL</span><br> <small>esta información estará encriptada y nadie podrá verla. Sólo se utilizará para enviar el usuario, contraseña que se genera al completar el formulario y poder así consultar resoluciones o realizar modificaciones. También usaremos el email para avisarle de resoluciones que se hagan del caso. </small></label>
                                    <input type="text" name="Email" id="first_name" class="required" />
                                </div>

                            </div>
                            
                        </div>
<br>
                        <div class="form-submit" style="text-align:center;">
                            <input type="submit" value="CARGAR" class="submit" id="submit" name="submit" />
                            <input type="submit" value="CANCELAR" class="submit" id="reset" name="reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/nouislider/nouislider.min.js"></script>
    <script src="vendor/wnumb/wNumb.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>