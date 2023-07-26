<?php 
include_once "model/editarinfo.php";

class editarinfoController{
    private $object;
    private $prod;
    public function __construct()
    {
        $this->object = new info();
       
    }
    public function EditarInfoProv(){

        if (isset($_GET["idprod"])) {
            $idProveedor = $_GET["idprod"];
            $proveedor = $this->object->proveedor($idProveedor);
            require_once "view/profile/admin/proveedor/editar.php";
        } else {
            echo "Error: ID de proveedor no encontrado.";
            exit();
        }
    }

    public function GuardarInfoProv(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idProv = $_POST["ctIdProv"];
            $nombreProv = $_POST["ctNomProv"];
            $direccionProv = $_POST["ctDirProv"];
            $emailProv = $_POST["ctEmaProv"];
            $telefonoProv = $_POST["ctTelProv"];

            $this->object->actproveedor($idProv, $nombreProv, $direccionProv, $emailProv, $telefonoProv);
            setNotify("success", "Se ha guardado el producto  correctamente");
            redirect("?b=profile&s=Inicio&p=admin");
        }

    }
    public function GuardarProveedor(){
        require_once "view/profile/admin/proveedor/agregar.php";
        if((isset($_POST["btnEditar"]))){
        $nombreProv = $_POST['ctNomProv'];
        $direccionProv = $_POST['ctDirProv'];
        $emailProv = $_POST['ctEmaProv'];
        $telefonoProv = $_POST['ctTelProv'];
        
        if($this->object->GuardarProveedor($nombreProv, $direccionProv, $emailProv, $telefonoProv)){
            redirect("?b=profile&s=Inicio&p=admin")->success("Se ha guardado correctamente " . $nombreProv . " correctamente")->send();
           
        }else{
            setcookie("notify", serialize(["status" => "error", "message" => "Error al agregar proveedor"]), time() + 5, "/");
            header('location: ?b=profile&s=Agregar');
        }
    }
}

    //Colaborador 

    public function EditarInfoEmp(){

        if (isset($_GET["idcola"])) {
            $idColaborador = $_GET["idcola"];
            $colaborador = $this->object->empleado($idColaborador);
            require_once "view/profile/admin/empleados/editar.php";
        } else {
            echo "Error: ID de colaborador no encontrado.";
            exit();
        }
    }
    public function GuardarInfoEmp(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {


            $idCol = $_POST["idcol"];
            $nombreCol = $_POST["nomcol"];
            $direccionCol = $_POST["dircol"];
            $emailCol = $_POST["emacol"];
            $telefonoCol = $_POST["telcol"];
            $rolCol = $_POST["rolcol"];

            $this->object->actualizaempleado($idCol, $nombreCol, $direccionCol, $emailCol, $telefonoCol, $rolCol);
            
        }
    }

    public function eliminar()
    {
        $prod = new info();
        $prod->idcol = $_REQUEST["idcol"];
        $prod->eliminar($prod);

        redirect("?b=profile&s=Inicio&p=admin")->success("Se ha eliminado el colaborador " . $_REQUEST["nomcol"] . " correctamente")->send();
    }

    public function GuardarColaborador(){
        require_once "view/profile/admin/empleados/agregar.php";

        if (isset($_POST["btnEditar"])) {
            $dniCol = $_POST['ctDniCol'];
            $nombreCol = $_POST['ctNomCol'];
            $emailCol = $_POST['ctEmaCol'];
            $passwordCol = $_POST['ctPassCol'];
            $direccionCol = $_POST['ctDirEmp'];
            $telefonoCol = $_POST['ctTelCol'];
            $rolCol = $_POST['ctRolCol'];
          
            
            if($this->object->GuardarColaborador($dniCol, $nombreCol, $emailCol, $passwordCol, $direccionCol,  $telefonoCol, $rolCol)){
                redirect("?b=profile&s=Inicio&p=admin")->success("Se ha guardado correctamente " . $nombreCol . " correctamente")->send();
            }else{
                redirect("?b=profile&s=Agregar")->error("Error al agregar proveedor")->send();

            }
        }
    }


    ///// clientes

    public function editarInfoCli(){
        
        if (isset($_GET["idcli"])) {
            $idCliente = $_GET["idcli"];
            $cliente = $this->object->cliente($idCliente);
            require_once "view/profile/admin/clientes/editar.php";
        } else {
            echo "Error: ID de cliente no encontrado.";
            exit();
        }
    }
    public function GuardarInfoCli(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $idCli = $_POST["idcli"];
            $nombreCli = $_POST["nomcli"];
            $emailCli = $_POST["emacli"];
            $userCli = $_POST["usercli"];
            $direccionCli = $_POST["dircli"];
            $tzonecli = $_POST["tzonecli"];
            $telefonoCli = $_POST["telcli"];
            $telefonoaltCli = $_POST["telaltcli"];

            $this->object->actualizacliente($idCli, $nombreCli, $emailCli,  $userCli, $direccionCli, $tzonecli, $telefonoCli, $telefonoaltCli);
            
            setNotify("success", "Se ha actualizado los datos del cleinte correctamente");
            redirect("?b=profile&s=Inicio&p=admin");
        }
    }

    ///// mascota

    public function editarmas(){
        
        if (isset($_GET["idmas"])) {
            $idMascota = $_GET["idmas"];
            $mascota = $this->object->mascota($idMascota);
            require_once "view/profile/admin/mascotas/editar.php";
        } else {
            echo "Error: ID de mascota no encontrado.";
            exit();
        }
    }
    public function GuardarInfoMas(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $idmas = $_POST["idmas"];
            $nombremas = $_POST["nommas"];
            $edadmas = $_POST["edadmas"];
            $genmas = $_POST["genmas"];
            $espciemas = $_POST["espmas"];

            $this->object->actualizamas($idmas, $nombremas, $edadmas,  $genmas, $espciemas);
            
            setNotify("success", "Se ha actualizado los datos del cleinte correctamente");
            redirect("?b=profile&s=Inicio&p=admin");
        }
    }
}

?>