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
		$sql = 'DELETE FROM atlas WHERE pais = :pais AND capital = :capital;';
		$stmt = $this->bd->prepare($sql);
		$stmt->bindValue(':pais', $pais);
		$stmt->bindValue(':capital', $capital);
	
		$stmt->execute();
		return $stmt->rowCount(); // returns number of rows deleted
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
}
?>