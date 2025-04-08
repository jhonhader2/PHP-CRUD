<?php

require_once 'Usuario.php';

$primer_nombre      = readline("Ingrese el primer nombre: ");
$segundo_nombre     = readline("Ingrese el segundo nombre: ");
$primer_apellido    = readline("Ingrese el primer apellido: ");
$segundo_apellido   = readline("Ingrese el segundo apellido: ");
$fecha_nacimiento   = readline("Ingrese la fecha de nacimiento (YYYY-MM-DD): ");
$telefono           = readline("Ingrese el número de teléfono: ");
$correo             = readline("Ingrese el correo electrónico: ");
$direccion          = readline("Ingrese la dirección: ");

// Instanciar con los valores
$usuario = new Usuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $fecha_nacimiento, $telefono, $correo, $direccion);

$resultado = $usuario->crearUsuario();

$usuarios = $usuario->listarUsuarios();

foreach ($usuarios as $usuario) {
    echo "ID: " . $usuario['id'] . "\n";
    echo "Nombre: " . $usuario['primer_nombre'] . " " . $usuario['segundo_nombre'] . "\n";
    echo "Apellido: " . $usuario['primer_apellido'] . " " . $usuario['segundo_apellido'] . "\n";
    echo "Fecha de Nacimiento: " . $usuario['fecha_nacimiento'] . "\n";
    echo "Teléfono: " . $usuario['telefono'] . "\n";
    echo "Correo: " . $usuario['correo'] . "\n";
    echo "Dirección: " . $usuario['direccion'] . "\n\n";
}
