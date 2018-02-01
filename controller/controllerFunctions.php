<?php 
// Función para obtener datos pasados por post y que se filtren antes de manejarlos
function obtenerPost($nombre){
	if (isset($_POST["$nombre"]) && $_POST["$nombre"] != ""){
		return $con->real_escape_string($_POST["$nombre"]);
	}
	else {
		return false;
	}
}

// Función para obtener datos pasados por GET y que se filtren antes de manejarlos
function obtenerGET($nombre){
	if (isset($_GET["$nombre"]) && $_GET["$nombre"] != ""){
		return $con->real_escape_string($_GET["$nombre"]);
	}
	else {
		return false;
	}
}

// Función que inserta mensajes en la $colaMensajes para luego mostrarlos en la vista
// $mensaje será un array asociativo [$tipo=>'info|success|error', $texto=>"lo que sea"]
function insertarMensaje($mensaje){
	if (!isset($_SESSION['colaMensajes'])){
		$_SESSION['colaMensajes'] = [];
	}
	array_push($_SESSION['colaMensajes'], $mensaje);
}

?>