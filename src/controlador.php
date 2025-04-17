<?php
session_start();

class Controlador
{

	public static function usuarioLogin()
	{
		Vista::usuarioLogin();
	}
	public static function usuarioRegistro($usuario, $passwd)
	{
		// Aqui debemos validar al usuario, si esta bien: pasa / si esta mal: no hacemos nada
		// $pass = Modelo::getPasswd($usuario);
		$pass = $passwd;
		if ($passwd == $pass) {
			$_SESSION['registrado'] = true;
			Vista::usuarioRegistro();
		} else if ($pass == '') {
			//El usuario no existe.
			Vista::usuarioLogin();
		} else {
			$_SESSION['msg_error'] = 'La contaseña es incorrecta';
			//La passwd es incorrecta
			Vista::usuarioLogin();
			unset($_SESSION['msg_error']);
		}
	}
	public static function usuarioAlta()
	{
		Vista::usuarioAlta();
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// AÑADIR --- ¡Funciona!
	public static function atlasAnadir()
	{
		Vista::atlasAnadir();
	}
	public static function AniadirPais($pais, $capital)
	{
		$bd = new Modelo();
		$bd->AniadirPais($pais, $capital);
		$bd = null;
		// echo "Pais añadido";
		Vista::atlasAnadir();
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// MOSTRAR --- ¡Funciona!
	public static function atlasMostrar()
	{
		//----Entra perfectamente----
		Vista::atlasMostrar();
	}
	public static function verPaises()
	{
		$modelo = new Modelo();
		$paises = $modelo->VerPaises();
		$modelo = null;
		echo "<table>";
		echo "<tr><th>Pais</th><th>Capital</th></tr>";
		foreach ($paises as $pais) {
			echo "<tr><td>" . $pais['pais'] . "</td><td>" . $pais['capital'] . "</td></tr>";
		}
		echo "</table>";
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// ELIMINAR --- 
	public static function atlasEliminar()
	{
		Vista::atlasEliminar();
	}

	public static function EliminarPais($pais, $capital)
	{
		$bd = new Modelo();
		$deleted = $bd->EliminarPais($pais, $capital);
		$bd = null;

		// Comprobamos si se ha eliminado algún país
		// y mostramos un mensaje según el resultado.
		// Si se ha eliminado, $deleted será mayor que 0.
		// Si no se ha encontrado ningún país con esos datos, $deleted será 0.
		// Si se ha enviado la acción de eliminar, mostramos el mensaje correspondiente.

		if (isset($_POST['accion']['atlas_eliminar'])) {
			if ($deleted > 0) {
				echo "País eliminado correctamente.";
			} else {
				echo "No se encontró ningún país con esos datos.";
			}
		}
	}


	// ------------------------------------------------------------------------------------------------------------------------------

	public static function atlasModificar()
	{
		Vista::atlasModificar();
	}



	public static function atlasBuscar()
	{
		Vista::atlasBuscar();
	}
}
// Inicializamos la variable de acción para evitar errores si no existe
if (!isset($_POST['accion']))
	$opcion[0] = '';
else
	$opcion = array_keys($_POST['accion']);

// En $opcion[0] está almacenada la acción elegida por el usuario,
// por ejemplo "usuario_registro" o "usuario_alta"
switch ($opcion[0]) {
	// Acceso de usuario
	case "usuario_registro":
		Controlador::usuarioRegistro($_POST['usuario'], $_POST['passwd']);
		break;
	// Registro de usuario
	case "usuario_alta":
		Controlador::usuarioAlta();
		break;

	// --------- AÑADIR
	// Alta de entrada en atlas
	case "atlas_anadir":
		Controlador::atlasAnadir();
		break;
	//Añadir: Pais y capital
	case "aniadir":
		Controlador::AniadirPais($_POST['pais'], $_POST['capital']);
		break;
	//---------------------------------

	// Modificar entrada en atlas
	case "atlas_modificar":
		Controlador::atlasModificar();
		break;

	// --------- MOSTRAR
	// Mostrar contenido del atlas
	case "atlas_mostrar":
		Controlador::atlasMostrar(); // Mostrar vista
		Controlador::verPaises();   // Mostrar mensaje del modelo
		break;

	// Baja de entrada en atlas
	case "atlas_eliminar":
		Controlador::atlasEliminar();
		break;
	// Buscar entrada en atlas
	case "atlas_buscar":
		Controlador::atlasBuscar();
		break;
	default:
		Controlador::usuarioLogin();
}

?>