<?php
require_once './src/modelo.php';
require_once './src/vista.php';
require_once './src/controlador.php';

if (isset($_POST['mostrar'])) {
    Controlador::VerPaises();
}
if (isset($_POST['accion']['atlas_eliminar'])) {
    $pais = $_POST['pais'] ?? '';
    $capital = $_POST['capital'] ?? '';
    Controlador::EliminarPais($pais, $capital);
}
if (isset($_POST['accion']['aniadir'])) {
    $pais = $_POST['pais'] ?? '';
    $capital = $_POST['capital'] ?? '';
    Controlador::AniadirPais($pais, $capital);
}
if (isset($_POST['accion']['atlas_anadir'])) {
    Controlador::AniadirPais($_POST['pais'], $_POST['capital']);
}
?>