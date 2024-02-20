<?php 

//DATOS PERSONALES
if(isset($_POST['CargarRival'])){
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//INSERT TABLA
	$insert_jugadores = mysqli_query($conn, "INSERT INTO rival
							(`id_Rival`, 
							`descripcion`) 
									VALUES
							(null,
							'".$Descripcion."'
							)");
							
		?>
		<script> window.location.replace("Rivales.php"); </script>
		<?php								
							
}

//ASPECTOS DE VIDA
if(isset($_POST['ModificarRival'])){
	
	//VARIALBES
	$IdRival = $_POST['IdRival'];
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//UPDATE
	$update = mysqli_query($conn, 
							"update rival 
								set 
							descripcion = '".$Descripcion."'
								where 
							id_Rival 		= ".$IdRival); 
		?>
		<script> window.location.replace("Rivales.php"); </script>
		<?php								
							
}

?>