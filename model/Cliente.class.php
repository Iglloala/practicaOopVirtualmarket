<?php 
Class Cliente{
	// Propiedades
	private $dniCliente;
	private $nombre;
	private $direccion;
	private $email;
	private $pwd;

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
	public function __construct($dniCliente, $nombre, $direccion, $email, $pwd){
		$this->dniCliente = $dniCliente;
		$this->nombre = $nombre;
		$this->direccion = $direccion;
		$this->email = $email;
		$this->pwd = $pwd;
	}

	// Métodos
	public function insertar($con){
		// Preparo la sentencia sql
		$sql = "INSERT INTO clientes (dniCliente, nombre, direccion, email, pwd) VALUES ('$this->dniCliente', '$this->nombre', '$this->direccion', '$this->email', '$this->pwd')";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function modificar($con){
		// Preparo la sentencia sql
		$sql = "UPDATE clientes SET nombre='$this->nombre', direccion='$this->direccion', email='$this->email', pwd='$this->pwd' WHERE dniCliente='$this->dniCliente'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}

	public function eliminar($con){
		// Preparo la sentencia sql
		$sql = "DELETE FROM clientes WHERE dniCliente='$this->dniCliente'";
		// Ejecuta la consulta y devuelve el resultado
		return ($con->query($sql));
	}
}
?>