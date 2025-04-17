<?php
// Cargamos los archivos que contienen la lógica del modelo, la vista y el controlador.
// Esto sigue el patrón MVC (Modelo-Vista-Controlador).
require_once './src/modelo.php';
require_once './src/vista.php';
require_once './src/controlador.php';

// Si se ha enviado el formulario con el botón 'mostrar',
// se llama al método VerPaises del controlador para mostrar la lista de países.
if (isset($_POST['mostrar'])) {
    Controlador::VerPaises();
}

// Si se ha enviado una acción con el botón 'atlas_eliminar',
// se recogen los valores del país y la capital desde el formulario (si existen),
// y se llama al método EliminarPais del controlador para borrarlo.
if (isset($_POST['accion']['atlas_eliminar'])) {
    $pais = $_POST['pais'] ?? '';      // Si no se ha enviado 'pais', se deja como cadena vacía.
    $capital = $_POST['capital'] ?? ''; // Lo mismo para 'capital'.
    Controlador::EliminarPais($pais, $capital);
}


?>