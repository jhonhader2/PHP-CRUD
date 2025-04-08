<?php

require_once 'Models/Usuario.php';
require_once 'Controllers/UsuarioController.php';
require_once 'Views/UsuarioView.php';

do {
    mostrarMenu();
    $opcion = solicitarEntrada("Seleccione una opción: ");
    switch ($opcion) {
        case "1":
            crearNuevoUsuario();
            break;
        case "2":
            listarUsuarios();
            break;
        case "3":
            modificarUsuario();
            break;
        case "4":
            eliminarUsuario();
            break;
        case "5":
            mostrarMensaje("\nSaliendo...\n");
            exit;
        default:
            mostrarMensaje("\nOpción inválida. Inténtelo de nuevo.\n");
    }
} while (true);
