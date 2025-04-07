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
	public static function atlasAnadir()
	{
		Vista::atlasAnadir();
	}
	public static function atlasModificar()
	{
		Vista::atlasModificar();
	}
	public static function atlasMostrar()
	{

		$error = Modelo::conectarBD();
		if (!$error) {
			$resultado = Modelo::getAtlas();
			if (gettype($resultado) == "object") {
				$error = true;
			}
		}
		if ($error) {
			$_SESSION["debug"] = 'Se ha producido un error (' . $error . '): ' . $error->getCode();
			// La operación ha finalizado con error y podemos realizar alguna acción
		} else {
			// La operación se ha efectuado con éxito y podemos realizar alguna acción
			return ($resultado);
		}
		Modelo::desconectarBD();
		Vista::atlasMostrar();
	}
	public static function atlasEliminar()
	{
		Vista::atlasEliminar();
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
		Controlador::usuarioRegistro($_POST['usuario'],$_POST['passwd']);
		break;
	// Registro de usuario
	case "usuario_alta":
		Controlador::usuarioAlta();
		break;
	// Alta de entrada en atlas
	case "atlas_anadir":
		Controlador::atlasAnadir();
		break;
	// Modificar entrada en atlas
	case "atlas_modificar":
		Controlador::atlasModificar();
		break;
	// Mostrar contenido del atlas
	case "atlas_mostrar":
		Controlador::atlasMostrar();
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