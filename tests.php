<?php
require_once('header.php');
?>

<!-- Contenido -->
<div class='container-fluid'>
	<div class="container">
		<section id="contenido" class="row">
			<div class="col-12">
				<h1>Tests</h1>

				<!-- Probando Cliente -->
				<?php
					$salida = "</p>\n";
					// inserción
					$miCliente = new Cliente("17182931P", "Javier Coronas", "C/Ramblas de glorieta, 23", "jcoronas@gmail.com", "t3c4g03lp3ch0");
					$salida .= ($miCliente->insertar($con))?"Cliente insertado\n":"Error al insertar el cliente: $con->error\n";
					// modificación
					$miCliente->nombre = "Javier Coronas Aguilar";
					$salida .= ($miCliente->modificar($con))?"Cliente modificado\n":"Error al modificar el cliente: $con->error\n";
					// borrado
					$salida .= ($miCliente->eliminar($con)?"Cliente eliminado\n":"Error al eliminar el cliente: $con->error\n");
					$salida .= "</p>\n";
					print($salida);
				?>
				<!-- Probando Pedido -->
				<?php
					$salida = "</p>\n";
					// inserción
					$miPedido = new Pedido('2018-01-30', 'C/Matapuerkos, 99', '123123123', '2099-05-23', 'EU421632GW', '99999999Z');
					$salida .= ($miPedido->insertar($con))?"Pedido insertado\n":"Error al insertar el pedido: $con->error\n";
					// modificación
					$miPedido->dirEntrega = "C/Falsa, 123";
					$salida .= ($miPedido->modificar($con))?"Pedido modificado\n":"Error al modificar el pedido: $con->error\n";
					// borrado
					$salida .= ($miPedido->eliminar($con))?"Pedido eliminado\n":"Error al eliminar el pedido: $con->error\n";
					$salida .= "</p>\n";
					print($salida);
				?>
				<!-- Probando LineaPedido -->
				<?php
					$salida = "</p>\n";
					// inserción
					$miLineaPedido = new LineaPedido(2, 9, 99);
					$salida .= ($miLineaPedido->insertar($con))?"LineaPedido insertada\n":"Error al insertar LineaPedido: $con->error\n";
					// modificación
					$miLineaPedido->cantidad = 69;
					$salida .= ($miLineaPedido->modificar($con))?"LineaPedido modificada\n":"Error al modificar la LineaPedido: $con->error\n";
					// borrado
					$salida .= ($miLineaPedido->eliminar($con))?"LineaPedido eliminada\n":"Error al eliminar LineaPedido: $con->error";
					$salida .= "</p>\n";
					print($salida);
				?>
				<!-- Probando Producto -->
				<?php
					$salida = "</p>\n";
					// inserción
					$miProducto = new Producto('Pollas en vinagre', 'Murcia', 'pollasenvinagre.jpg', 'El tato', 'seco', '500', '99', '15', '4.5');
					$salida .= ($id=$miProducto->insertar($con))?"Producto insertado\n":"Error al insertar Producto: $con->error\n";
					// modificación
					$miProducto->peso = 666;
					$salida .= ($miProducto->modificar($con))?"Producto modificado\n":"Error al modificar el producto: $con->error\n";
					// borrado
					$salida .= ($miProducto->eliminar($con))?"Producto eliminado\n":"Error al eliminar el producto: $con->error\n";
					$salida .= "</p>\n";
					print($salida);
				?>
				<!-- Probando Ticket -->
				<?php
					$salida = "</p>\n";
					// inserción
					$miTicket = new Ticket('2018-01-30', '4.5');
					$salida .= ($miTicket->insertar($con)?"Ticket insertado\n":"Error al insertar el ticket: $con->error\n");
					// modificación
					$miTicket->total = 999;
					$salida .= ($miTicket->modificar($con))?"Ticket modificado\n":"Error al modificar ticket: $con->error\n";
					// borrado
					$salida .= ($miTicket->eliminar($con))?"Ticket eliminado\n":"Error al eliminar el ticket: $con->error\n";
					$salida .= "</p>\n";
					print($salida);
				?>
			</div>
		</section>
	</div>
</div>

<?php
require_once('footer.php');
?>		