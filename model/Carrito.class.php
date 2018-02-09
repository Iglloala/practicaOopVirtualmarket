<?php
class Carrito {
	// PROPIEDADES
	private $items = [];

	// CONSTRUCTOR
	public function __construct(){
		// Comprueba si existe la cookie
		if ($_COOKIE['lineasCarrito']){
			// Y si tiene lineas
			if(count(json_decode($_COOKIE['lineasCarrito']))>0){
				// Las carga en el objeto
				$this->items = json_decode($_COOKIE['lineasCarrito']);
			}
		}
		// Si no existe la establece
		else {
			setcookie('lineasCarrito');
		}
	}

	// MÉTODOS
	public function aniadirProducto($producto, $cantidad){
		// Haz cosas
	}

	public function eliminarProducto($producto){
		// Haz cosas
	}
}
?>