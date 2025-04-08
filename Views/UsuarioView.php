<?php

/**
 * Muestra el menú de opciones.
 */
function mostrarMenu(): void
{
    echo "\n----- Menú de Opciones -----\n";
    echo "1. Crear Usuario\n";
    echo "2. Listar Usuarios\n";
    echo "3. Salir\n";
}

/**
 * Solicita una entrada al usuario con un mensaje.
 */
function solicitarEntrada(string $mensaje): string
{
    return readline($mensaje);
}

/**
 * Solicita los datos de un usuario.
 */
function solicitarDatosUsuario(): array
{
    $campos = [
        'primer_nombre'    => 'Ingrese el primer nombre: ',
        'segundo_nombre'   => 'Ingrese el segundo nombre: ',
        'primer_apellido'  => 'Ingrese el primer apellido: ',
        'segundo_apellido' => 'Ingrese el segundo apellido: ',
        'fecha_nacimiento' => 'Ingrese la fecha de nacimiento (YYYY-MM-DD): ',
        'telefono'         => 'Ingrese el número de teléfono: ',
        'correo'           => 'Ingrese el correo electrónico: ',
        'direccion'        => 'Ingrese la dirección: ',
    ];
    $datos = [];
    foreach ($campos as $clave => $mensaje) {
        $datos[$clave] = solicitarEntrada($mensaje);
    }
    return $datos;
}

/**
 * Imprime la información de un usuario.
 */
function mostrarUsuario(array $usuario): void
{
    echo "\nID: " . $usuario['id'] . "\n";
    echo "Nombre: " . $usuario['primer_nombre'] . " " . $usuario['segundo_nombre'] . "\n";
    echo "Apellido: " . $usuario['primer_apellido'] . " " . $usuario['segundo_apellido'] . "\n";

    // Calcular la edad a partir de la fecha de nacimiento
    $fechaNacimiento = new DateTime($usuario['fecha_nacimiento']);
    $fechaActual = new DateTime();
    $edad = $fechaActual->diff($fechaNacimiento)->y;
    echo "Edad: " . $edad . " Años\n";

    echo "Teléfono: " . $usuario['telefono'] . "\n";
    echo "Correo: " . $usuario['correo'] . "\n";
    echo "Dirección: " . $usuario['direccion'] . "\n";
}

/**
 * Muestra un mensaje en pantalla.
 */
function mostrarMensaje(string $mensaje): void
{
    echo $mensaje;
}
