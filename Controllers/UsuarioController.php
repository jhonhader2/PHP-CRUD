<?php
require_once 'Models/Usuario.php';
require_once 'Views/UsuarioView.php';

/**
 * Función para obtener los datos de un usuario.
 */
function obtenerDatosUsuario(): array
{
    $campos = [
        'primer_nombre'    => 'primer nombre',
        'segundo_nombre'   => 'segundo nombre',
        'primer_apellido'  => 'primer apellido',
        'segundo_apellido' => 'segundo apellido',
        'fecha_nacimiento' => 'fecha de nacimiento (YYYY-MM-DD)',
        'telefono'         => 'número de teléfono',
        'correo'           => 'correo electrónico',
        'direccion'        => 'dirección',
    ];
    $datos = [];
    foreach ($campos as $clave => $mensaje) {
        $datos[$clave] = readline("Ingrese el $mensaje: ");
    }
    return $datos;
}

/**
 * Función para mostrar un mensaje al usuario.
 */
function imprimirUsuario(array $usuario): void
{
    echo "\nID: " . $usuario['id'] . "\n";
    echo "Nombre: " . $usuario['primer_nombre'] . " " . $usuario['segundo_nombre'] . "\n";
    echo "Apellido: " . $usuario['primer_apellido'] . " " . $usuario['segundo_apellido'] . "\n";
    echo "Fecha de Nacimiento: " . $usuario['fecha_nacimiento'] . "\n";
    echo "Teléfono: " . $usuario['telefono'] . "\n";
    echo "Correo: " . $usuario['correo'] . "\n";
    echo "Dirección: " . $usuario['direccion'] . "\n";
}

/**
 * Controlador para crear un nuevo usuario.
 */
function crearNuevoUsuario(): void
{
    // Se solicita la información a través de la vista
    $datos = solicitarDatosUsuario();
    $usuario = new Usuario(
        $datos['primer_nombre'],
        $datos['segundo_nombre'],
        $datos['primer_apellido'],
        $datos['segundo_apellido'],
        $datos['fecha_nacimiento'],
        $datos['telefono'],
        $datos['correo'],
        $datos['direccion']
    );

    $resultado = $usuario->crearUsuario();
    mostrarMensaje("\nID del nuevo usuario: " . $resultado . "\n");
}

/**
 * Controlador para listar los usuarios.
 */
function listarUsuarios(): void
{
    $usuario = new Usuario();
    $usuarios = $usuario->listarUsuarios();
    if (empty($usuarios)) {
        mostrarMensaje("\nNo se encontraron usuarios.\n");
        return;
    }
    foreach ($usuarios as $u) {
        mostrarUsuario($u);
    }
}

/**
 * Controlador para modificar un usuario.
 */
function modificarUsuario(): void
{
    $id = solicitarEntrada("Ingrese el ID del usuario a modificar: ");
    $usuario = new Usuario();
    $datosUsuario = $usuario->obtenerUsuario($id);

    if (empty($datosUsuario)) {
        mostrarMensaje("\nNo se encontró el usuario con ID: $id\n");
        return;
    }

    // Mostrar información actual del usuario
    mostrarUsuario($datosUsuario);

    // Solicitar nuevos datos
    $datos = obtenerDatosUsuario();
    $datos['id'] = $id; // Se incluye el ID en los datos para actualizar correctamente

    $resultado = $usuario->actualizarUsuario($datos);

    if ($resultado === true) {
        mostrarMensaje("\nUsuario actualizado con éxito.\n");
        $usuarioActualizado = $usuario->obtenerUsuario($id);
        mostrarUsuario($usuarioActualizado);
    } else {
        mostrarMensaje("\nError al actualizar usuario: " . $resultado . "\n");
    }
}

/**
 * Controlador para eliminar un usuario.
 */
function eliminarUsuario(): void
{
    $id = solicitarEntrada("Ingrese el ID del usuario a eliminar: ");
    $usuario = new Usuario();
    $resultado = $usuario->eliminarUsuario($id);

    if ($resultado === true) {
        mostrarMensaje("\nUsuario eliminado con éxito.\n");
    } else {
        mostrarMensaje("\nError al eliminar usuario: " . $resultado . "\n");
    }
}
