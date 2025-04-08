<?php
require_once 'Models/Usuario.php';
require_once 'Views/UsuarioView.php';

class UsuarioController
{
    private UsuarioView $vista;

    public function __construct()
    {
        $this->vista = new UsuarioView();
    }

    public function crearNuevoUsuario(): void
    {
        $datos = $this->vista->solicitarDatosUsuario();
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
        $this->vista->mostrarMensaje("\nID del nuevo usuario: " . $resultado . "\n");
    }

    public function listarUsuarios(): void
    {
        $usuarioTemp = new Usuario();
        $usuariosArray = $usuarioTemp->listarUsuarios();

        if (empty($usuariosArray)) {
            $this->vista->mostrarMensaje("\nNo se encontraron usuarios.\n");
            return;
        }

        foreach ($usuariosArray as $u) {
            $usuario = new Usuario(
                $u['primer_nombre'],
                $u['segundo_nombre'],
                $u['primer_apellido'],
                $u['segundo_apellido'],
                $u['fecha_nacimiento'],
                $u['telefono'],
                $u['correo'],
                $u['direccion']
            );
            $usuario->setId($u['id']);
            $this->vista->mostrarUsuario($usuario);
        }
    }

    public function modificarUsuario(): void
    {
        $id = $this->vista->solicitarEntrada("Ingrese el ID del usuario a modificar: ");
        $usuarioTemp = new Usuario();
        $datosUsuario = $usuarioTemp->obtenerUsuario($id);

        if (empty($datosUsuario)) {
            $this->vista->mostrarMensaje("\nNo se encontró el usuario con ID: $id\n");
            return;
        }

        // Convertir el array obtenido a un objeto Usuario
        $usuario = new Usuario(
            $datosUsuario['primer_nombre'],
            $datosUsuario['segundo_nombre'],
            $datosUsuario['primer_apellido'],
            $datosUsuario['segundo_apellido'],
            $datosUsuario['fecha_nacimiento'],
            $datosUsuario['telefono'],
            $datosUsuario['correo'],
            $datosUsuario['direccion']
        );
        $usuario->setId($datosUsuario['id']);

        // Mostrar la información actual del usuario
        $this->vista->mostrarUsuario($usuario);

        // Solicitar nuevos datos
        $datos = $this->vista->solicitarDatosUsuario();
        $datos['id'] = $id; // se incluye el ID en los datos para la actualización

        $resultado = $usuarioTemp->actualizarUsuario($datos);

        if ($resultado === true) {
            $this->vista->mostrarMensaje("\nUsuario actualizado con éxito.\n");
            $datosUsuarioActualizado = $usuarioTemp->obtenerUsuario($id);
            $usuarioActualizado = new Usuario(
                $datosUsuarioActualizado['primer_nombre'],
                $datosUsuarioActualizado['segundo_nombre'],
                $datosUsuarioActualizado['primer_apellido'],
                $datosUsuarioActualizado['segundo_apellido'],
                $datosUsuarioActualizado['fecha_nacimiento'],
                $datosUsuarioActualizado['telefono'],
                $datosUsuarioActualizado['correo'],
                $datosUsuarioActualizado['direccion']
            );
            $usuarioActualizado->setId($datosUsuarioActualizado['id']);
            $this->vista->mostrarUsuario($usuarioActualizado);
        } else {
            $this->vista->mostrarMensaje("\nError al actualizar usuario: " . $resultado . "\n");
        }
    }

    public function eliminarUsuario(): void
    {
        $id = $this->vista->solicitarEntrada("Ingrese el ID del usuario a eliminar: ");
        $usuario = new Usuario();
        $resultado = $usuario->eliminarUsuario($id);

        if ($resultado === true) {
            $this->vista->mostrarMensaje("\nUsuario eliminado con éxito.\n");
        } else {
            $this->vista->mostrarMensaje("\nError al eliminar usuario: " . $resultado . "\n");
        }
    }
}
