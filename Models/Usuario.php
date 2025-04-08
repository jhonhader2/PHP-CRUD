<?php

require_once 'Database/database.php';

class Usuario
{
    private PDO $conn;

    private int $id;
    private string $primer_nombre;
    private string $segundo_nombre;
    private string $primer_apellido;
    private string $segundo_apellido;
    private string $fecha_nacimiento;
    private string $telefono;
    private string $correo;
    private string $direccion;

    public function __construct($primer_nombre = '', $segundo_nombre = '', $primer_apellido = '', $segundo_apellido = '', $fecha_nacimiento = '', $telefono = '', $correo = '', $direccion = '')
    {
        $this->primer_nombre      = $primer_nombre;
        $this->segundo_nombre     = $segundo_nombre;
        $this->primer_apellido    = $primer_apellido;
        $this->segundo_apellido   = $segundo_apellido;
        $this->fecha_nacimiento   = $fecha_nacimiento;
        $this->telefono           = $telefono;
        $this->correo             = $correo;
        $this->direccion          = $direccion;

        // Conexión a la base de datos
        $this->conn = (new Database())->getConnection();
    }

    public function listarUsuarios()
    {
        // Lógica para obtener todos los usuarios
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function obtenerUsuario($id)
    {
        // Lógica para obtener un usuario por ID y retornar los datos
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearUsuario()
    {
        // Lógica para insertar usuario
        $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono, correo, direccion) VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :telefono, :correo, :direccion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':primer_nombre', $this->primer_nombre);
        $stmt->bindParam(':segundo_nombre', $this->segundo_nombre);
        $stmt->bindParam(':primer_apellido', $this->primer_apellido);
        $stmt->bindParam(':segundo_apellido', $this->segundo_apellido);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':direccion', $this->direccion);

        try {
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function actualizarUsuario(array $datos)
    {
        // Se actualizan las propiedades del objeto
        $this->id               = $datos['id'];
        $this->primer_nombre    = $datos['primer_nombre'];
        $this->segundo_nombre   = $datos['segundo_nombre'];
        $this->primer_apellido  = $datos['primer_apellido'];
        $this->segundo_apellido = $datos['segundo_apellido'];
        $this->fecha_nacimiento = $datos['fecha_nacimiento'];
        $this->telefono         = $datos['telefono'];
        $this->correo           = $datos['correo'];
        $this->direccion        = $datos['direccion'];

        // Lógica para actualizar el usuario en la base de datos
        $sql = "UPDATE usuarios SET 
                    primer_nombre    = :primer_nombre, 
                    segundo_nombre   = :segundo_nombre, 
                    primer_apellido  = :primer_apellido, 
                    segundo_apellido = :segundo_apellido, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    telefono         = :telefono, 
                    correo           = :correo, 
                    direccion        = :direccion 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':primer_nombre', $this->primer_nombre);
        $stmt->bindParam(':segundo_nombre', $this->segundo_nombre);
        $stmt->bindParam(':primer_apellido', $this->primer_apellido);
        $stmt->bindParam(':segundo_apellido', $this->segundo_apellido);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':direccion', $this->direccion);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminarUsuario($id)
    {
        // Lógica para eliminar un usuario
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
