<?php
include_once 'lib/database/database.php';

class Profile
{
    private $conexion;

    public $id, $nombre, $apellido, $direccion, $email, $numcel, $numcel2, $file;

    public function __construct()
    {
        $this->conexion = databaseConexion::conexion();
    }
    // Metodo para Seleccionar el nombre del Usuario
    public function selectUser($nombreUsuario)
    {
        $query = "SELECT * FROM administrador WHERE nomadmin = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $administrador = $result->fetch_assoc();
        $stmt->close();
        return $administrador;
    }
    public function update(Profile $administrador)
    {
        $update = "UPDATE administrador SET nomadmin = ?, apeadmin = ?, diradmin = ?, emaadmin = ?, teladmin = ?, teladmin2 = ? WHERE idadmin = ? ";

        try {
            $stmt = $this->conexion->prepare($update);


            $stmt->bind_param(
                "ssssssi",
                $administrador->nombre,
                $administrador->apellido,
                $administrador->direccion,
                $administrador->email,
                $administrador->numcel,
                $administrador->numcel2,
                $administrador->id
            );

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al actualizar datos: " . $e->getMessage();
            return false;
        }
    }


    public function getProveedores()
    {
        $query = "SELECT * FROM proveedor";
        $result = $this->conexion->query($query);
        $proveedores = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $proveedores[] = $row;
            }
        }

        return $proveedores;
    }
    public function getEmpleado()
    {
        $query = "SELECT * FROM colaborador";
        $result = $this->conexion->query($query);
        $empleado = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $empleado[] = $row;
            }
        }

        return $empleado;
    }
    public function buscarProveedor($filtro)
    {
<<<<<<< HEAD
        $query = "SELECT * FROM proveedor WHERE nomprov LIKE ? OR dirprov LIKE ? OR emaprov LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $filtro = "%" . $filtro . "%";
        $stmt->bind_param("sss", $filtro, $filtro, $filtro);
        $stmt->execute();
        $result = $stmt->get_result();
        $proveedores = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $proveedores[] = $row;
            }
        }

        return $proveedores;
=======
>>>>>>> 2d2d71df0604c37f5e53cbab498709ba2108c014
    }

    public function getCliente()
    {
        $query = "SELECT * FROM cliente";
        $result = $this->conexion->query($query);
        $cliente = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $cliente[] = $row;
            }
        }

        return $cliente;
    }
<<<<<<< HEAD
  
=======

>>>>>>> 2d2d71df0604c37f5e53cbab498709ba2108c014
    public function getMascota()
    {
        $query = "SELECT * FROM mascota";
        $result = $this->conexion->query($query);
        $mascota = array();

        if ($result->num_rows > 0) {
            // Recorrer los resultados y almacenarlos en el array $proveedores
            while ($row = $result->fetch_assoc()) {
                $mascota[] = $row;
            }
        }

        return $mascota;
    }
}