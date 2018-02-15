<?php 
Class Producto extends Database{
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
	public function __construct($nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio, $idProducto=null){
		// Llamo al constructor de la base de datos
		parent::__construct();
		// Y construyo las propiedades del resto de campos de la clase Producto
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
	public static function obtenerProductos($con){
		// Preparo la sentencia sql
		$sql = 'SELECT * FROM productos';
		// Ejecuto la consulta
		$resultado = $con->query($sql);
		// Si hay filas
		if ($resultado->num_rows){
			$productos = [];
			while ($fila = $resultado->fetch_assoc()){
				// Preparo los campos
				$idProducto = $fila['idProducto'];
				$nombre = $fila['nombre'];
				$origen = $fila['origen'];
				$foto = $fila['foto'];
				$marca = $fila['marca'];
				$categoria = $fila['categoria'];
				$peso = $fila['peso'];
				$unidades = $fila['unidades'];
				$volumen = $fila['volumen'];
				$precio = $fila['precio'];
				// Genero una instancia de producto y la añado al array de productos
				$nuevoProducto = new Producto($nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio, $idProducto);
				array_push($productos, $nuevoProducto);
			}
			return $productos;
		}
		else {
			return false;
		}
	}

	public static function obtenerProducto($con, $idProducto){
		// Preparo la sentencia sql
		$sql = "SELECT * FROM productos WHERE idProducto='$idProducto'";
		// Ejecuto la consulta
		$resultado = $con->query($sql);
		if ($fila = $resultado->fetch_assoc()) {
			// Preparo los campos
			$idProducto = $fila['idProducto'];
			$nombre = $fila['nombre'];
			$origen = $fila['origen'];
			$foto = $fila['foto'];
			$marca = $fila['marca'];
			$categoria = $fila['categoria'];
			$peso = $fila['peso'];
			$unidades = $fila['unidades'];
			$volumen = $fila['volumen'];
			$precio = $fila['precio'];
			// Genero una instancia de producto
			$producto = new Producto($nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio, $idProducto);
			// Y la retorno
			return $producto;
		}
		else {
			return false;
		}
	}

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