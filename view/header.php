<?php
	session_start();
	require_once('/controller/controllerFunctions.php');
	require_once('/view/viewFunctions.php');
	require_once('/model/Database.class.php');
	require_once('/model/Cliente.class.php');
	require_once('/model/LineaPedido.class.php');
	require_once('/model/Pedido.class.php');
	require_once('/model/Producto.class.php');
	require_once('/model/Ticket.class.php');
	$database = new Database();
	$con = $database->conectar();
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
		<div id="wrapper-mensajes" class="container">
			<div id="fila-mensajes" class="row">
				<div class="col-12">
					<?php 
						if (isset($_SESSION['colaMensajes']) && count($_SESSION['colaMensajes'])>0){
							mostrarMensajes($_SESSION['colaMensajes']);
							unset($_SESSION['colaMensajes']);
						}
					?>
				</div>
			</div>
		</div>