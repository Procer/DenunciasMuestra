<?php 

//DATOS PERSONALES
if(isset($_POST['CargarCampeonato'])){
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//INSERT TABLA
	$insert_jugadores = mysqli_query($conn, "INSERT INTO campeonato
							(`id_campeonato`, 
							`descripcion`) 
									VALUES
							(null,
							'".$Descripcion."'
							)");
							
		?>
		<script> window.location.replace("Campeonatos.php"); </script>
		<?php								
							
}

//ASPECTOS DE VIDA
if(isset($_POST['ModificarCampeonato'])){
	
	//VARIALBES
	$IdCampeonato = $_POST['IdCampeonato'];
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//UPDATE
	$update = mysqli_query($conn, 
							"update campeonato 
								set 
							descripcion = '".$Descripcion."'
								where 
							id_campeonato 		= ".$IdCampeonato); 
		?>
		<script> window.location.replace("Campeonatos.php"); </script>
		<?php								
							
}

?>