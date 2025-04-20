<?php

class Vista
{
	public static function usuarioLogin()
	{
		$contenido = 'login.html';
		include './frm/main.html';
	}
	public static function mostrarPrincipal()
	{
		include './frm/main.html';
	}
	public static function usuarioRegistro()
	{
		$contenido = 'blank.html';
		include './frm/main.html';
	}
	public static function usuarioAlta()
	{
		$contenido = 'blank.html';
		include './frm/main.html';
	}
	public static function atlasAnadir()
	{
		$contenido = './frm/menu/entrada.html';
		include './frm/main.html';
	}
	public static function atlasModificar()
	{
		$contenido = './frm/menu/modificar.html';
		include './frm/main.html';
	}
	public static function atlasMostrar()
	{
		$contenido = './frm/menu/mostrar.html';
		include './frm/main.html';
	}
	public static function atlasEliminar()
	{
		$contenido = './frm/menu/borrar.html';
		include './frm/main.html';
	}
	public static function atlasBuscar($resultado = null, $error = null)
	{
		$contenido = './frm/menu/buscar.html';
		include './frm/main.html';
	}
	}
?>