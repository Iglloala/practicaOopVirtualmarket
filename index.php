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
					// Cargo todos los productos de la base de datos
					$productos = Producto::obtenerProductos($con);
					// Por cada producto devuelvo lo muestro
					foreach ($productos as $clave => $producto) {
						mostrarProducto($producto, autenticado());
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