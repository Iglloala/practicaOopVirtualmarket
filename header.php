<?php
	require_once('model/database.php');
	$database = new Database;
	$database->connect();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Práctica OOP Virtualmarket</title>
	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="lib/bootstrap.css">
	<!-- jquery-ui -->
	<link rel="stylesheet" href="lib/jquery-ui.css">
	<!-- Mis estilos -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="wrapper-ppal">
		<!-- Cabecera -->
		<div id="wrapper-cabecera" class="container-fluid bg-dark text-light">
			<header class="container">
				<div class="row">
					<div class="col-12">
						<h1>VirtualMarket</h1>
					</div>
				</div>
			</header>
		</div>