<?php

require_once 'Controllers/UsuarioController.php';
require_once 'Views/UsuarioView.php';

$controller = new UsuarioController();
$vista = new UsuarioView();

do {
    $vista->mostrarMenu();
    $opcion = $vista->solicitarEntrada("Seleccione una opción: ");
    switch ($opcion) {
        case "1":
            $controller->crearNuevoUsuario();
            break;
        case "2":
            $controller->listarUsuarios();
            break;
        case "3":
            $controller->modificarUsuario();
            break;
        case "4":
            $controller->eliminarUsuario();
            break;
        case "5":
            $vista->mostrarMensaje("\nSaliendo...\n");
            exit;
        default:
            $vista->mostrarMensaje("\nOpción inválida. Inténtelo de nuevo.\n");
    }
} while (true);
