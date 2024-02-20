<?php 

//DATOS PERSONALES
if(isset($_POST['CargarDivision'])){
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//INSERT TABLA
	$insert_jugadores = mysqli_query($conn, "INSERT INTO division
							(`id_division`, 
							`descripcion`) 
									VALUES
							(null,
							'".$Descripcion."'
							)");
							
		?>
		<script> window.location.replace("Divisiones.php"); </script>
		<?php								
							
}

//ASPECTOS DE VIDA
if(isset($_POST['ModificarDivision'])){
	
	//VARIALBES
	$IdDivision = $_POST['IdDivision'];
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//UPDATE
	$update = mysqli_query($conn, 
							"update division 
								set 
							descripcion = '".$Descripcion."'
								where 
							id_division 		= ".$IdDivision); 
		?>
		<script> window.location.replace("Divisiones.php"); </script>
		<?php								
							
}

?>