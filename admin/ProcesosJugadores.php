<?php 

if(isset($_POST['CargarResolucion'])){
	
	//VARIABLES
	$IdDenuncias = $_POST['IdDenuncias'];
	$FechaHoraActual = date("Y-m-d H:i:s");
	
		//UPDATE TABLA PACIENTES
	$update_usuarios = mysqli_query($conn, 
							"update denuncias
								set 
							FechaResolucion = '".$FechaHoraActual."',
							Resolucion = '".$_POST['Resolucion']."',
							Estado = 'RESUELTO'
								where 
							IdDenuncias = ".$IdDenuncias);

	
		?>
		<script> window.location.replace("Admin.php"); </script>
		<?php								
							
}

if(isset($_GET['IdDenuncia'])){
	
	//VARIABLES
	$IdDenuncias = $_GET['IdDenuncia'];
	$FechaHoraActual = date("Y-m-d H:i:s");
	
	$update_usuarios = mysqli_query($conn, 
							"update denuncias
								set 
							FechaVisto = '".$FechaHoraActual."',
							Estado = 'VISTO'
								where 
							IdDenuncias = ".$IdDenuncias);


	
									
							
}

?>