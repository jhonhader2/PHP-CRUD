<?php

class UsuarioView
{
    public function mostrarMenu(): void
    {
        echo "\n----- Menú de Opciones -----\n";
        echo "1. Crear Usuario\n";
        echo "2. Listar Usuarios\n";
        echo "3. Modificar Usuario\n";
        echo "4. Eliminar Usuario\n";
        echo "5. Salir\n";
    }

    public function solicitarEntrada(string $mensaje): string
    {
        return readline($mensaje);
    }

    public function solicitarDatosUsuario(): array
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
            $datos[$clave] = $this->solicitarEntrada($mensaje);
        }
        return $datos;
    }

    public function mostrarUsuario(Usuario $usuario): void
    {
        echo "\nID: " . $usuario->getId() . "\n";
        echo "Nombre: " . $usuario->getPrimerNombre() . " " . $usuario->getSegundoNombre() . "\n";
        echo "Apellido: " . $usuario->getPrimerApellido() . " " . $usuario->getSegundoApellido() . "\n";
        echo "Edad: " . $usuario->getEdad() . " Años\n";
        echo "Teléfono: " . $usuario->getTelefono() . "\n";
        echo "Correo: " . $usuario->getCorreo() . "\n";
        echo "Dirección: " . $usuario->getDireccion() . "\n";
    }

    public function mostrarMensaje(string $mensaje): void
    {
        echo $mensaje;
    }
}
