<?php 
Class LineaPedido{
	// Propiedades
	private $idPedido;
	private $nlinea;
	private $idProducto;
	private $cantidad;

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

	// Constructor
	public function __construct($idPedido, $idProducto, $cantidad, $nlinea=""){
		$this->idPedido = $idPedido;
		$this->nlinea = $nlinea;
		$this->idProducto = $idProducto;
		$this->cantidad = $cantidad;
	}

	// Métodos
	public function insertar($con){
		// Recupero el ultimo nlinea para el idPedido que se quiere insertar
		$result = $con->query("SELECT nlinea FROM lineasPedidos WHERE idPedido = $this->idPedido ORDER BY nlinea DESC LIMIT 1");
		$ultimoID = null;
		while ($fila = $result->fetch_assoc()){
			$ultimoID = $fila['nlinea'];
		}
		// Y determino entonces el nuevo id que tengo que insertar
		$nuevoID = ($ultimoID!==null)?$ultimoID+1:0;
		// Preparo la sentencia sql
		$sql = "INSERT INTO lineaspedidos (idPedido, nlinea, idProducto, cantidad) VALUES ('$this->idPedido', '$nuevoID', '$this->idProducto', '$this->cantidad')";
		// Ejecuto la consulta
		if ($con->query($sql)){
			// Asigno el nlinea
			$this->nlinea = $nuevoID;
			return true;
		}
		else {
			return false;
		}
	}

	public function modificar($con){
		// Preparo la sentencia sql
		$sql = "UPDATE lineaspedidos SET idProducto='$this->idProducto', cantidad='$this->cantidad' WHERE idPedido='$this->idPedido' AND nlinea='$this->nlinea'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function eliminar($con){
		// Preparo la sentencia sql
		$sql = "DELETE FROM lineaspedidos WHERE idPedido='$this->idPedido' AND idProducto='$this->idProducto'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}
}
?>