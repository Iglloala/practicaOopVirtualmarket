<?php 
Class ticket{
	// Propiedades
	private $cod;
	private $fecha;
	private $total;

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
	public function __construct($fecha, $total, $cod=""){
		$this->cod = $cod;
		$this->fecha = $fecha;
		$this->total = $total;
	}

	// Métodos
	public function insertar($con){
		// Recupero el ultimo id de la tabla
		$result = $con->query("SELECT cod FROM tickets ORDER BY cod DESC LIMIT 1");
		$ultimoID = null;
		while ($fila = $result->fetch_assoc()){
			$ultimoID = $fila['cod'];
		}
		// Y determino entonces el nuevo id que tengo que insertar
		$nuevoID = ($ultimoID!==null)?$ultimoID+1:0;
		// Preparo la sentencia sql
		$sql = "INSERT INTO tickets (cod, fecha, total) VALUES ('$nuevoID', '$this->fecha', '$this->total')";
		// Ejecuto la consulta
		if ($con->query($sql)){
			// Asigno el nuevoID al objeto
			$this->cod = $nuevoID;
			return true;
		}
		else {
			return false;
		}
	}

	public function modificar($con){
		// Preparo la sentencia sql
		$sql = "UPDATE tickets SET fecha='$this->fecha', total='$this->total' WHERE cod='$this->cod'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function eliminar($con){
		// Preparo la sentencia sql
		$sql = "DELETE FROM tickets WHERE cod='$this->cod'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}
}
?>