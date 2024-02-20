<?php

//CONEXION A SQL

include('ConexionSqlServer.php');

session_start();
if(!isset($_SESSION['usuario']))
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
  <?php include('IncludeTitle.php'); ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" type="image/png" href="img/Logo.png" sizes="16x16">
  <link rel="icon" type="image/png" href="img/Logo.png" sizes="32x32">
  <link rel="icon" type="image/png" href="img/Logo.png" sizes="64x64">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <img src="img/Logo.jpeg" style="width: 100%; height: auto;" />
  </div>
<div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Su usuario esta <span class="text-danger">desactivado.</span> </h3>

          <p>
            <a href="index.php" >VOLVER</a>.
          </p>

        </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
