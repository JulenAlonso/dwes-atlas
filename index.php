<?php
require_once './src/modelo.php';
require_once './src/vista.php';
require_once './src/controlador.php';

if (isset($_POST['mostrar'])) {
    Controlador::VerPaises();
}
?>