<?php
require_once('view/header.php');
// Si no es admin vuelve p'atrás
autorizarAcceso();
?>

<!-- Contenido -->
<div id='wrapper-contenido' class='container-fluid'>
	<div class="container">
		<section id="contenido" class="row">
			<div class="col-12">
				<h1>Insertar producto</h1>
				<?php 
				// Si no se han pasado datos del formulario muestra el formulario
				if (!obtenerPOST($con, 'btEnviar')){
					getFormInsertarProducto();
				}
				// Si ha recibido datos trata de procesarlos
				else {
					// Preparo los datos
					// - nombre
					$nombre = obtenerPOST($con, "nombre");
					// - origen
					$origen = obtenerPOST($con, "origen");
					// - foto
					// - - comprueba que se haya subido
					if (is_uploaded_file($_FILES['foto']['tmp_name'])){
						//echo $_FILES['foto']['error']; // debug
						// - - Comprueba si el directorio destino existe
						if (is_dir("../img")){
							// - - Se recupera el nombre de la imagen
							$nombreFoto = $_FILES['foto']['name'];
							// - - Se genera un nombre único
							$nombreUnicoFoto = time().$nombreFoto;
							// - - Se genera la ruta definitiva
							$rutaDefinitiva = "../img/" . $nombreUnicoFoto;
							
							// Y ya pues la tratamos de mover a su sitio
							if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDefinitiva)){
								// Aquí ya se supone que la foto se ha almacenado bien
								echo "";
							}
							else {
								insertarMensaje(['tipo'=>"danger", 'texto'=>"No se ha podido guardar la foto en su directorio de destino"]);
							}
						}
						else {
							insertarMensaje(['tipo'=>"danger", 'texto'=>"El directorio de destino para la subida de archivos no existe"]);
						}
					}
					else {
						insertarMensaje(['tipo'=>"danger", 'texto'=>"Ha ocurrido un error al tratar de subir la foto"]);
					}
				// - marca
				$marca = obtenerPOST($con, "marca");
				// - categoria
				$categoria = obtenerPost($con, "categoria");
				// - peso
				$peso = obtenerPost($con, "peso");
				// - unidades
				$unidades = obtenerPost($con, "unidades");
				// - volumen
				$volumen = obtenerPost($con, "volumen");
				// - precio
				$precio = obtenerPost($con, "precio");
				
				// Ahora con los datos ya recopilados trato de instanciar un objeto Producto
				$nuevoProducto = new Producto($nombre, $origen, $rutaDefinitiva, $marca, $categoria, $peso, $unidades, $volumen, $precio);
				// Lo inserto
				if ($nuevoProducto->insertar($con)){
					insertarMensaje(['tipo'=>"success", 'texto'=>"El nuevo producto ha sido almacenado en la bbdd"]);
				}
				else {
					insertarMensaje(['tipo'=>"danger", 'texto'=>"Ha ocurrido un error al tratar de almacenar el producto en la bbdd"]);
				}
				// muestro los mensajes que se hayan podido producir
				mostrarMensajes($_SESSION['colaMensajes']);
				// y los elimina de la cola
				unset($_SESSION['colaMensajes']);
				}
				?>
			</div>
		</section>
	</div>
</div>

<?php
require_once('view/footer.php');
?>		