<?php
require_once('view/header.php');
?>

<!-- Contenido -->
<div class='container-fluid'>
	<div class="container">
		<section id="contenido" class="row">
			<div class="col-12">
				<h1>Insertar producto</h1>
				<?php 
				if (!obtenerPOST('btEnviar')){
					getFormInsertarProducto();
				}
				?>
			</div>
		</section>
	</div>
</div>

<?php
require_once('view/footer.php');
?>		