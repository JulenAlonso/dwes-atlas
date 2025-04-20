<?php

/* Plantilla de Modelo */

class Modelo
{
	private $bd;

	// Conexión con la base de datos
	public function __construct()
	{
		// Configuración de los parámetros de conexión (podrían estar en un fichero externo de configuración)
		$dsn = "mysql:dbname=dwes;host=127.0.0.1";
		$usuario = "root";
		$password = "";
		try {
			// Creamos la conexión a la base de datos
			$this->bd = new PDO($dsn, $usuario, $password);
			return (false);
		} catch (PDOException $e) {
			// 	Establecemos el mensaje de error según el código y descripción
			$_SESSION["error"] = "Error [" . $e->getCode() . "] al abrir la base de datos: " . $e->getMessage();
			return ($e);
		}
	}

	// Desconexión de la base de datos
	public function desconectarBD()
	{
		$this->bd = null;
	}

	// ------------------------------------------------------------------------------------------------------------------------------
	// Añadir un pais a la base de datos
	public function AniadirPais($pais, $capital)
	{
		$sql = 'INSERT INTO atlas (pais, capital) VALUES (:pais, :capital);';
		//HACER BINDAJE
		$stmt = $this->bd->prepare($sql);
		$stmt->bindValue(':pais', $pais);
		$stmt->bindValue(':capital', $capital);

		$stmt->execute();//Lanzar la sentencia al servidor de la bbdd.
	}
	//-------------------------------------------------------------------------------------------------------------------------------
	// Eliminar un pais de la base de datos
	public function EliminarPais($pais, $capital)
	{
		// Creamos una consulta SQL para eliminar un registro de la tabla 'atlas'
		// donde el país y la capital coincidan con los valores proporcionados.
		$sql = 'DELETE FROM atlas WHERE pais = :pais AND capital = :capital;';

		// Preparamos la consulta con PDO para evitar inyecciones SQL.
		$stmt = $this->bd->prepare($sql);

		// Asignamos los valores recibidos a los parámetros de la consulta.
		$stmt->bindValue(':pais', $pais);
		$stmt->bindValue(':capital', $capital);

		// Ejecutamos la consulta.
		$stmt->execute();

		// Devolvemos el número de filas que fueron eliminadas (0 si no se encontró coincidencia).
		return $stmt->rowCount();
	}

	//-------------------------------------------------------------------------------------------------------------------------------
	// Consultar todos los paises:
	public function VerPaises()
	{
		$sql = 'SELECT * FROM atlas;';
		$stmt = $this->bd->prepare($sql);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	// ------------------------------------------------------------------------------------------------------------------------------
	// Consultar un pais por su nombre:
	public function VerPais($pais)
	{
		$sql = 'SELECT * FROM atlas WHERE pais = :pais;';
		$stmt = $this->bd->prepare($sql);
		$stmt->bindValue(':pais', $pais);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// Consultar una capital por su nombre:
	public function VerCapital($capital)
	{
		$sql = 'SELECT * FROM atlas WHERE capital = :capital;';
		$stmt = $this->bd->prepare($sql);
		$stmt->bindValue(':capital', $capital);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	
}
?>