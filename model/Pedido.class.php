<?php 
Class Pedido{
	// Propiedades
	private $idPedido;
	private $fecha;
	private $dirEntrega;
	private $nTarjeta;
	private $fechaCaducidad;
	private $matriculaRepartidor;
	private $dniCliente;

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
	public function __construct($fecha, $dirEntrega, $nTarjeta, $fechaCaducidad, $matriculaRepartidor, $dniCliente, $idPedido=''){
		$this->idPedido = $idPedido;
		$this->fecha = $fecha;
		$this->dirEntrega = $dirEntrega;
		$this->nTarjeta = $nTarjeta;
		$this->fechaCaducidad = $fechaCaducidad;
		$this->matriculaRepartidor = $matriculaRepartidor;
		$this->dniCliente = $dniCliente;
	}

	// Métodos
	public function insertar($con){
		// Recupero el ultimo id de la tabla
		$result = $con->query("SELECT idPedido FROM pedidos ORDER BY idPedido DESC LIMIT 1");
		$ultimoID = null;
		while ($fila = $result->fetch_assoc()){
			$ultimoID = $fila['idPedido'];
		}
		// Y determino entonces el nuevo id que tengo que insertar
		$nuevoID = ($ultimoID!==null)?$ultimoID+1:0;
		// Preparo la sentencia sql
		$sql = "INSERT INTO pedidos (idPedido, fecha, dirEntrega, nTarjeta, fechaCaducidad, matriculaRepartidor, dniCliente) VALUES ('$nuevoID', '$this->fecha', '$this->dirEntrega', '$this->nTarjeta', '$this->fechaCaducidad', '$this->matriculaRepartidor', '$this->dniCliente')";
		// Ejecuto la consulta
		if ($con->query($sql)){
			// Asigno el nuevo id al pedido
			$this->idPedido = $nuevoID;
			return true;
		}
		else {
			return false;
		}
	}

	public function modificar($con){
		// Preparo la sentencia sql
		$sql = "UPDATE pedidos SET fecha='$this->fecha', dirEntrega='$this->dirEntrega', nTarjeta='$this->nTarjeta', fechaCaducidad='$this->fechaCaducidad', matriculaRepartidor='$this->matriculaRepartidor', dniCliente='$this->dniCliente' WHERE idPedido='$this->idPedido'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function eliminar($con){
		// Preparo la sentencia sql
		$sql = "DELETE FROM pedidos WHERE idPedido='$this->idPedido'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

}
?>