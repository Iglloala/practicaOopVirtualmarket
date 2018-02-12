<?php 
// Función para obtener datos pasados por post y que se filtren antes de manejarlos
function obtenerPost($con, $nombre){
	if (isset($_POST["$nombre"]) && $_POST["$nombre"] != ""){
		$dato = $con->real_escape_string($_POST["$nombre"]);
		return $dato;
	}
	else {
		return false;
	}
}

// Función para obtener datos pasados por GET y que se filtren antes de manejarlos
function obtenerGET($con, $nombre){
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

function autenticar($con){
	// Compruebo si se han pasado las credenciales
	if (obtenerPost($con, "dni") && obtenerPost($con, "password")){
		$dni = obtenerPost($con, "dni");
		$password = obtenerPost($con, "password");
		// Preparo una consulta para obtener el nombre de usuario que haya en la bbdd si el dni y la password almacenadas coinciden con las proporcionadas
		$consulta = "SELECT nombre FROM  clientes WHERE dniCliente='$dni' AND pwd='$password'";
		// Compruebo que se retorna una respuesta
		if ($respuesta = mysqli_query($con, $consulta)){
			// Compruebo que devuelve alguna fila
			if ($fila = mysqli_fetch_assoc($respuesta)) {
				// Compruebo que la fila tiene el campo que busco
				if ($nombre = $fila['nombre']){
					// Sólo en este caso establezco la variable de sesión que me asegura que el usuario esté correctamente autenticado además de las cookies necesarias para el control del carrito
					$_SESSION['usuario'] = $nombre;
					$_SESSION['dni'] = $dni;
					// Inserto el mensaje de confirmación
					insertarMensaje(['tipo'=>'success', 'texto'=>"Usuario autenticado correctamente"]);
					// Vuelvo a la página de inicio
					volverInicio();
				}
			}
			else { 
					insertarMensaje(['tipo'=>'danger', 'texto'=>'Las credenciales introducidas no son válidas']);
					volverInicio();
				}
		}
		else {
			insertarMensaje(['tipo'=>'danger', 'texto'=>'No se ha podido obtener una respuesta de la bbdd']);
			volverInicio();
		}
	}
	else {
		insertarMensaje(['tipo'=>'danger', 'texto'=>'No se han proporcionado credenciales de acceso']);
		volverInicio();
	}
}

// Función que devuleve true o false según se esté autenticado o no
function autenticado() {
	if (isset($_SESSION['usuario'])){
		return true;
	}
	else {
		return false;
	}
}

// Función que devuelve true o false según el usuario autenticado sea el admin o no
function isAdmin() {
	if (isset($_SESSION['usuario'])){
		switch ($_SESSION['dni']){
			case '48404267P':
				$admin = true;
				break;
			default:
				$admin = false;
		}
		return $admin;
	}
}

// Función que autoriza o no el acceso a una página dependiendo de si se es o no admin
function autorizarAcceso(){
	if (!isAdmin()){
		insertarMensaje(['tipo'=>'danger', 'texto'=>'No estás autorizado a visitar esta página.']);
		volverInicio();
	}
}

// funcion para volver a la página ppal
function volverInicio(){
	$url = "index.php";
	header("Location: $url");
	die();
}

?>