<?php 
// Función que muestra los mensajes que haya pendientes
function mostrarMensajes($colaMensajes){
	$salida = '';
	foreach ($colaMensajes as $clave => $valor) {
		$tipo = $valor['tipo'];
		$texto = $valor['texto'];
		$clase = "";
		switch ($tipo) {
			case 'info':
				$clase = "alert-info";
				break;
			case 'success':
				$clase = "alert-success";
				break;
			case 'danger':
				$clase = "alert-danger";
				break;
			default:
				$clase = "alert-primary";
				break;
		}
		$salida .= "<div class='alert $clase' role='alert'>$texto</div>";
	};
echo $salida;
}

// Me creo una función para mostrar el menú de navegación
function mostrarMenuNavegacion(){
	// Determina cuál es la página activa
	$pagActiva = $_SERVER['PHP_SELF'];
	$pagActiva = explode('/', $pagActiva);
	$pagActiva = $pagActiva[2];
	switch ($pagActiva) {
		case 'index.php':
			$pagActiva = 'Inicio';
			break;
		case 'tests.php':
			$pagActiva = 'Tests';
			break;
		default:
			$pagActiva = 'Inicio';
	}
	// Empieza a formatear la salida
	$salida = '';
	$salida .= "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>\n";
	$salida .= "  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#contenido-navegacion' aria-controls='contenido-navegacion' aria-expanded='false' aria-label='Desplegar menú'>\n";
	$salida .= "    <span class='navbar-toggler-icon'></span>\n";
	$salida .= "  </button>\n";
	$salida .= "  <div class='collapse navbar-collapse' id='contenido-navegacion'>\n";
	$salida .= "    <ul class='navbar-nav mr-auto'>\n";
	// Inicio
	$clase = ($pagActiva == 'Inicio')?'active':'';
	$salida .= "      <li class='nav-item $clase'>\n";
	$salida .= "        <a class='nav-link' href='index.php'>Inicio<span class='sr-only'>(current)</span></a>\n";
	$salida .= "      </li>";
	// Tests
	$clase = ($pagActiva == 'Tests')?'active':'';
	$salida .= "      <li class='nav-item $clase'>\n";
	$salida .= "        <a class='nav-link' href='tests.php'>Tests<span class='sr-only'>(current)</span></a>\n";
	$salida .= "      </li>";
	// Cierre
	$salida .= "    </ul>";
	$salida .= "  </div>";
	// Y muestra el resultado
	echo $salida;

}

// Creo una función para mostrar el formulario de login
function mostrarFormularioLogin(){
	// Preparo la salida
	$salida = "";
	$salida .= "<form id='formularioLogin' method='POST' action='' class='form-inline'>";
	// DNI
	$salida .= "  <label class='sr-only' for='dni'>DNI:</label>";
	$salida .= "  <input type='text' class='form-control mb-2 mr-sm-2' id='dni' placeholder='dni' name='dni'>";
	// PASSWORD
	$salida .= "  <label class='sr-only' for='password'>Password:</label>";
	$salida .= "  <input type='password' class='form-control mb-2 mr-sm-2' id='password' placeholder='password' name='password'>";
	// SUBMIT
	$salida .= "  <button type='submit' class='btn btn-primary mb-2' name='btLogin'>Login</button>";
	$salida .= "</form>";
	// Y lo muestro
	echo $salida;
}

// Función para mostrar el carrito de la compra
function mostrarIconoCarrito($nProductos=0){
	// Prepara la salida
	$salida = "<div id='icono-carrito'>";
	$numLineas = count(json_decode($_COOKIE['lineasCarrito'], true));
	$salida .= "<a href='vercarrito.php'><i class='fa fa-shopping-cart'></i>($numLineas)</a>";
	$salida .= "</div>";
	echo $salida;
}

// Función que genera y muestra el formulario para añadir productos en la bbdd
function getFormInsertarProducto(){
	// Empiezo a formatear el formulario
	$salida = "<form method='post' enctype='multipart/form-data'>";
	// - nombre
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='nombre'>Nombre:</label>";
	$salida .= "    <input class='form-control' name='nombre' type='text'>";
	$salida .= "  </div>";
	// - origen
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='origen'>Origen:</label>";
	$salida .= "    <input class='form-control' name='origen' type='text'>";
	$salida .= "  </div>";
	// - foto
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='foto'>Foto:</label>";
	$salida .= "    <input class='form-control' name='foto' type='file'>";
	$salida .= "  </div>";
	// - marca
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='marca'>Marca:</label>";
	$salida .= "    <input class='form-control' name='marca' type='text'>";
	$salida .= "  </div>";
	// - categoría
	$salida .= "    <label>Categoría</label>";
	$salida .= "  <div class='form-group'>";
	$salida .= "    <input id='radioFrio' name='categoria' type='radio' value='frío'>";
	$salida .= "    <label for='radioFrio'>Frío</label>";
	$salida .= "    <input id='radioCongelado' name='categoria' type='radio' value='congelado'>";
	$salida .= "    <label for='radioCongelado'>Congelado</label>";
	$salida .= "    <input id='radioSeco' name='categoria' type='radio' value='seco'>";
	$salida .= "    <label for='radioSeco'>Seco</label>";
	$salida .= "  </div>";
	// - peso
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='peso'>Peso:</label>";
	$salida .= "    <input class='form-control' name='peso' type='number'>";
	$salida .= "  </div>";
	// - unidades
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='unidades'>Unidades:</label>";
	$salida .= "    <input class='form-control' name='unidades' type='number'>";
	$salida .= "  </div>";
	// - volumen
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='volumen'>Volumen:</label>";
	$salida .= "    <input class='form-control' name='volumen' type='number'>";
	$salida .= "  </div>";
	// - precio
	$salida .= "  <div class='form-group'>";
	$salida .= "    <label for='precio'>Precio:</label>";
	$salida .= "    <input class='form-control' name='precio' type='number'>";
	$salida .= "  </div>";
	// - submit
	$salida .= "  <div class='form-group'>";
	$salida .= "    <input id='btEnviar' name='btEnviar' type='submit'>";
	$salida .= "  </div>";
	// Lo muestra
	echo $salida;
}

?>