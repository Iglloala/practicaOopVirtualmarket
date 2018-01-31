<?php 
Class Producto{
	// Propiedades
	private $idProducto;
	private $nombre;
	private $origen;
	private $foto;
	private $marca;
	private $categoria;
	private $peso;
	private $unidades;
	private $volumen;
	private $precio;

	// Método mágico __get
	public function __get($propiedad){
		if (property_exists($this, $propiedad)){
			return $this->$propiedad;
		}
		else {
			return false;
		}
	}
	
	// Método mágico __set
	public function __set($propiedad, $valor){
		$this->$propiedad = $valor;
	}

	// Contructor
	public function __construct($nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio, $idProducto=""){
		$this->idProducto = $idProducto;
		$this->nombre = $nombre;
		$this->origen = $origen;
		$this->foto = $foto;
		$this->marca = $marca;
		$this->categoria = $categoria;
		$this->peso = $peso;
		$this->unidades = $unidades;
		$this->volumen = $volumen;
		$this->precio = $precio;
	}

	// Métodos
	public function insertar($con){
		// Recupero el ultimo id de la tabla
		$result = $con->query("SELECT idProducto FROM productos ORDER BY idProducto DESC LIMIT 1");
		$ultimoID = null;
		while ($fila = $result->fetch_assoc()){
			$ultimoID = $fila['idProducto'];
		}
		// Y determino entonces el nuevo id que tengo que insertar
		$nuevoID = ($ultimoID!==null)?$ultimoID+1:0;
		// preparo la sentencia sql
		$sql = "INSERT INTO productos (idProducto, nombre, origen, foto, marca, categoria, peso, unidades, volumen, precio) VALUES ('$nuevoID', '$this->nombre', '$this->origen', '$this->foto', '$this->marca', '$this->categoria', '$this->peso', '$this->unidades', '$this->volumen', '$this->precio')";
		// Ejecuto la consulta
		if ($con->query($sql)){
			// Recojo el valor del id que habrá asignado la bbdd
			$this->idProducto = $nuevoID;
			return true;
		}
		else {
			return false;
		}
	}

	public function modificar($con){
		// Preparo la sentencia sql
		$sql = "UPDATE productos SET nombre='$this->nombre', origen='$this->origen', foto='$this->foto', marca='$this->marca', categoria='$this->categoria', peso='$this->peso', unidades='$this->unidades', volumen='$this->volumen', precio='$this->precio' WHERE idProducto='$this->idProducto'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function eliminar($con){
		// Prepara la sentencia sql
		$sql = "DELETE FROM productos WHERE idProducto='$this->idProducto'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}
}
?>