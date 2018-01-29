<?php
Class Database {
	// Propiedades
	private $host;
	private $username;
	private $userpwd;
	private $dbname;
	private $dbport;
	private $con;

	// Constructor
	public function __construct(){
		$this->host = 'localhost';
		$this->username = 'root';
		$this->userpwd = 'root';
		$this->dbname = 'virtualmarket';
		$this->dbport = '3306';
	}
	// Método destructor
	public function __destruct(){
		$this->disconnect();
	}

	// Métodos
	public function connect(){
		// Si la propiedad no tiene valor tira a conectar
		if (!$this->con){
			// Conecta
			$this->con = new mysqli($this->host, $this->username, $this->userpwd, $this->dbname, $this->dbport);
			// Selecciona la bbdd (en verdad ya está seleccionada)
			$this->con->select_db($this->dbname);
			// Establece la codificación de caracteres
			$this->con->set_charset('utf8');
		}
		// Vuelve a comprobar la propiedad:
		// Si no está lista informa y falla
		if (!$this->con){
			echo "Imposible obtener una conexión con la bbdd";
		}
		// Si ya la tiene la devuelve
		else {
			return $this->con;
		}
	}
}
?>