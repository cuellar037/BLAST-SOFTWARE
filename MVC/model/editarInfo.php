<?php 
include_once 'lib/database/database.php';

class info{
    private $conexion;
    public function __construct()
    {
        $this->conexion = databaseConexion::conexion();
    }
    public function proveedor($idProveedor){
        $stmt = $this->conexion->prepare("SELECT * FROM proveedor WHERE idprov = ?");
        $stmt->bind_param("i", $idProveedor);
        $stmt->execute();
        $result = $stmt->get_result();
        $proveedor = $result->fetch_assoc();
        $stmt->close();
        return $proveedor;
    }
    public function actproveedor($idProv, $nombreProv, $direccionProv, $emailProv, $telefonoProv){
        $stmt = $this->conexion->prepare("UPDATE proveedor SET nomprov = ?, dirprov = ?, emaprov = ?, telprov = ? WHERE idprov = ?");
        $stmt->bind_param("ssssi", $nombreProv, $direccionProv, $emailProv, $telefonoProv, $idProv);
    
        if ($stmt->execute()) {
            header("Location: ?b=profile&s=Inicio&p=admin");
            exit();
        } else {
            echo "Error en la actualización: " . $stmt->error;
        }
    }

    public function guardarproveedor($idProv, $nombreProv, $direccionProv, $emailProv, $telefonoProv){
        try {
            $sql = 'INSERT INTO proveedor (idprov, nomprov, dirprov, emaprov, telprov)
                    VALUES (?, ?, ?, ?, ?)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("issss", $idProv, $nombreProv, $direccionProv, $emailProv, $telefonoProv);
            $stmt->execute();
            if ($stmt->execute()) {
                header("Location: ?b=profile&s=Inicio&p=admin");
                exit();
            } else {
                echo "Error en la actualización: " . $stmt->error;
            }
            setcookie("notify", serialize(["message" => "Se ha agregado el proveedor"]), 5, "/");
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>