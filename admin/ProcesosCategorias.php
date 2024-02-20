<?php 

//DATOS PERSONALES
if(isset($_POST['CargarCategoria'])){
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//INSERT TABLA CATEGORIAS
	$insert_jugadores = mysqli_query($conn, "INSERT INTO catergoria
							(`id_categoria`, 
							`descripcion`) 
									VALUES
							(null,
							'".$Descripcion."'
							)");
		?>
		<script> window.location.replace("Categorias.php"); </script>
		<?php								
							
}

//ASPECTOS DE VIDA
if(isset($_POST['ModificarCategoria'])){
	
	//VARIALBES
	$IdCategoria = $_POST['IdCategoria'];
	
	if(!empty($_POST['Descripcion']))	{ $Descripcion = $_POST['Descripcion']; } else { $Descripcion  	= ''; }

	//UPDATE
	$update = mysqli_query($conn, 
							"update catergoria 
								set 
							descripcion = '".$Descripcion."'
								where 
							id_categoria 		= ".$IdCategoria); 
		?>
		<script> window.location.replace("Categorias.php"); </script>
		<?php								
							
}

?>