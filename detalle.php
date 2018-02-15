<?php
require_once('view/header.php');
?>

<!-- Contenido -->
<div id='wrapper-contenido' class='container-fluid'>
	<div class="container">
		<section id="contenido" class="row">
			<div class="col-12">
				<div class="row">
				<!-- Aquí mis mierdas -->
				<?php
					// Compruebo si se ha pasado un idProducto
					if ($idProducto = obtenerGet($con, 'idProducto')){
						// obtiene el producto
						if ($producto = Producto::obtenerProducto($con, $idProducto)){
							// Y muestra el detalle
							mostrarDetalleProducto($producto);
						}
						else{
							// Si no se ha podido obtener el producto informa y vuelve
							insertarMensaje(['tipo'=>'danger', 'texto'=>'No se ha podido obtener el producto']);
							volverInicio();
						}
					}
					// Si no hay id pues añade mensaje y vuelve a inicio
					else {
						insertarMensaje(['tipo'=>'danger', 'texto'=>'No se ha proporcionado un id válido']);
						volverInicio();
					}
				?>
				<!-- EOF: misMierdas -->
				</div>
			</div>
		</section>
	</div>
</div>

<?php
require_once('view/footer.php');
?>