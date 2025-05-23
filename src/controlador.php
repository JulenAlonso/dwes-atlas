<?php
class Controlador
{
	public static function usuarioLogin()
	{
		Vista::usuarioLogin();
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// Login --- ¡Funciona!
	public static function usuarioRegistro($usuario, $passwd)
	{
		$bd = new Modelo();
		$resultadoBD = $bd->usuarioRegistro($usuario, $passwd);
		$bd = null;
		if ($resultadoBD) {
			//Tenemos que guardar el usuario en la sesión
			$_SESSION['usuario'] = $usuario;
			$_SESSION['msg_exito'] = "Usuario registrado correctamente";
			// Si el usuario existe, redirigimos a la vista de atlas
			Vista::atlasMostrar();
		} else {
			// Si el usuario no existe, mostramos un mensaje de error
			$_SESSION['msg_error'] = "Usuario o contraseña incorrectos";
			Vista::usuarioLogin();
		}
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// Registro --- ¡Funciona!
	public static function usuarioAlta()
	{
		Vista::usuarioAlta();
	}
	public static function AniadirUsuario($nombre, $password)
	{
		$bd = new Modelo();
		$bd->AniadirUsuario($nombre, $password);
		$bd = null;
		$_SESSION['msg_exito'] = "Usuario creado correctamente";
		Vista::usuarioLogin();
	}

	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// AÑADIR --- ¡Funciona!
	public static function atlasAnadir()
	{
		//Verificar que la sesión está iniciada
		if (!isset($_SESSION['usuario'])) {
			$_SESSION['msg_error'] = "No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.";
			Vista::usuarioLogin();
			exit;
		}
		Vista::atlasAnadir();
	}
	public static function AniadirPais($pais, $capital)
	{
		$bd = new Modelo();
		$bd->AniadirPais($pais, $capital);
		$bd = null;
		$_SESSION['msg_exito'] = "Pais añadido";
		Vista::atlasAnadir();
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// MOSTRAR --- ¡Funciona!
	public static function atlasMostrar()
	{
		//Verificar que la sesión está iniciada
		if (!isset($_SESSION['usuario'])) {
			$_SESSION['msg_error'] = "No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.";
			Vista::usuarioLogin();
			exit;
		}

		//----Entra perfectamente----
		Vista::atlasMostrar();
	}
	public static function verPaises()
	{
		$modelo = new Modelo();
		$paises = $modelo->VerPaises();
		$modelo = null;
		$_SESSION['contenido'] = '';
		$_SESSION['contenido'] .= "<table>";
		$_SESSION['contenido'] .= "<tr><th>Pais</th><th>Capital</th></tr>";
		// Guardamos los países en la sesión para usarlos en la vista
		foreach ($paises as $pais) {
			$_SESSION['contenido'] .= "<tr><td>" . $pais['pais'] . "</td><td>" . $pais['capital'] . "</td></tr>";
		}
		$_SESSION['contenido'] .= "</table>";
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// ELIMINAR --- 
	public static function atlasEliminar()
	{
		//Verificar que la sesión está iniciada
		if (!isset($_SESSION['usuario'])) {
			$_SESSION['msg_error'] = "No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.";
			Vista::usuarioLogin();
			exit;
		}

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
	// ------------------------------------------------------------------------------------------------------------------------------
	// Modificar --- ¡No Funciona!
	public static function atlasModificar()
	{
		//Verificar que la sesión está iniciada
		if (!isset($_SESSION['usuario'])) {
			$_SESSION['msg_error'] = "No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.";
			Vista::usuarioLogin();
			exit;
		}

		Vista::atlasModificar();
	}
	// ------------------------------------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------------------------------------
	// BUSCAR --- ¡No Funciona!
	public static function atlasBuscar()
	{
		//Verificar que la sesión está iniciada
		if (!isset($_SESSION['usuario'])) {
			$_SESSION['msg_error'] = "No has iniciado sesión. Por favor, inicia sesión para acceder a esta página.";
			Vista::usuarioLogin();
			exit;
		}

		Vista::atlasBuscar();
	}
	public static function buscarPais($pais)
	{
		$bd = new Modelo();
		$resultadoBD = $bd->VerPais($pais);
		$fila = $resultadoBD[0]; // Primer país encontrado

		$bd = null;

		if ($resultadoBD) {
			$resultado = [
				'pais' => $fila['pais'],
				'capital' => $fila['capital']
			];
			Vista::atlasBuscar($resultado);
		} else {
			$error = "El país \"$pais\" no existe en la base de datos.";
			Vista::atlasBuscar(null, $error);
		}
	}

	public static function limpiarMensajes()
	{
		$_SESSION['msg_info'] = '';
		$_SESSION['msg_exito'] = '';
		$_SESSION['msg_aviso'] = '';
		$_SESSION['msg_error'] = '';
		$_SESSION['msg_valida'] = '';
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
		Controlador::limpiarMensajes();
		Controlador::usuarioRegistro($_POST['usuario'], $_POST['passwd']);
		break;
	// Registro de usuario
	case "usuario_alta":
		Controlador::limpiarMensajes();
		Controlador::AniadirUsuario($_POST['usuario'], $_POST['passwd']);
		break;
	// --------- AÑADIR
	// Alta de entrada en atlas
	case "atlas_anadir":
		Controlador::limpiarMensajes();
		Controlador::atlasAnadir();
		break;
	//Añadir: Pais y capital
	case "aniadir":
		Controlador::limpiarMensajes();
		Controlador::AniadirPais($_POST['pais'], $_POST['capital']);
		break;
	//---------------------------------
	// Modificar entrada en atlas
	case "atlas_modificar":
		Controlador::limpiarMensajes();
		Controlador::verPaises();
		// Aqui $_SESSION['contenido'] ya tiene los paises
		Controlador::atlasModificar();
		break;
	// --------- MOSTRAR
	// Mostrar contenido del atlas
	case "atlas_mostrar":
		Controlador::limpiarMensajes();
		Controlador::atlasMostrar(); // Mostrar vista
		Controlador::verPaises();   // Mostrar mensaje del modelo
		break;

	// Baja de entrada en atlas
	case "atlas_eliminar":
		Controlador::limpiarMensajes();
		Controlador::verPaises();
		Controlador::atlasEliminar();
		break;
	// Buscar entrada en atlas
	case "atlas_buscar":
		Controlador::limpiarMensajes();
		Controlador::atlasBuscar();
		break;
	case "buscar":
		Controlador::limpiarMensajes();
		if (!empty($_POST['pais'])) {
			Controlador::buscarPais($_POST['pais']);
		}
		break;
	default:
		Controlador::limpiarMensajes();
		Controlador::usuarioLogin();
}

?>