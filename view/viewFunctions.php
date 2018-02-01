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

// Función que genera y muestra el formulario para añadir productos en la bbdd
function getFormInsertarProducto(){
	// Empiezo a formatear el formulario
	$salida = "<form method='post' action=''>";
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
	$salida .= "    <label class='custom-control-label'>Categoría</label>";
	$salida .= "  <div class='form-group'>";
	$salida .= "    <input name='categoria' type='radio' value='frío'>";
	$salida .= "    <label for='categoria'>Frío</label>";
	$salida .= "    <input name='categoria' type='radio' value='congelado'>";
	$salida .= "    <label for='categoria'>Congelado</label>";
	$salida .= "    <input name='categoria' type='radio' value='seco'>";
	$salida .= "    <label for='categoria'>Seco</label>";
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
	// Lo muestra
	echo $salida;
}

?>