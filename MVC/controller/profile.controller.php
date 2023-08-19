<?php
include_once "model/Profile.php";
include_once 'lib/privileges/privilegios.php';

class ProfileController
{
    private $object;
    public function __construct()
    {
        $this->object = new Profile();
    }

    //-----Metodo para redireccionar segun el rol de inicio de sesión-----//
    public function Inicio()
    {
        $roles = [
            Privilegios::Recepcionist->get() => "Recepcionista",
            Privilegios::Doctor->get() => "Doctor"
        ]; 

        // -----Variables para obtener las listas a mostrar----- //
        $privilegios = $this->object->getPrivileges();
        $proveedores = $this->object->getAll("proveedor");
        $users = $this->object->getAll("usuario"); 
        $mascota = $this->object->getAll("mascota");
        $productos = $this->object->getAll("producto");
        $categorias = $this->object->getAll("categoria"); 

        $privUser = Privilegios::User->get();
        $privRecepcionist = Privilegios::Recepcionist->get();
        $privDoctor = Privilegios::Doctor->get();
        $privAdmin = Privilegios::Admin->get(); 

        // -----Variables de Session----- //
        $usuario = $_SESSION['usuario'];
        $user = $this->object->selectUser($usuario);

        // -----Vistas Requeridas----- //
        $style = "<link rel='stylesheet' href='assets/css/style-profile.css'>";
        require_once "view/head.php";
        require_once "view/profile/profile.php";
        require_once "view/footerprofile.php";
    }

    public function errorPage(){
        $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-error404.css'";
        require_once "view/head.php"; 
        require_once "lib/error/error-404.php"; 
    }

    // -----METODOS DE REDIRECCION----- //

    // -----Metodo para redireccionar a vista de agregar Proveedor y Colaborador -----// check proveedor
    public function optionSaveRedirec()
    {
        $o = $_REQUEST['p'];
        switch ($o) {
            case 'proveedor':
                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php"; 
                require_once "view/profile/save/agregar-proveedor.php";
                break;
            case 'Colaborador' || 'Cliente':
                $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                require_once "view/head.php";
                require_once "view/profile/save/agregar-user.php";
                break;
            default:
                redirect("?b=profile&s=errorPage")->error("Pagina no encontrada")->send();
                break;
        }
    }

    // -----Metodo para redireccionar a vista de Editar Proveedor y Colaborador -----// check proveedor
    public function optionEditRedirec()
    {
        $o = $_REQUEST['p'];
        switch ($o) {
            case 'proveedor':
                if ($_GET['idprov']) {
                    $table = "proveedor";
                    $param = "idprov";
                    $idProveedor = $_GET['idprov'];
                    $proveedor = $this->object->existProfile($table, $param, $idProveedor);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/edit/editar-proveedor.php";
                }
                break;
            case 'colaborador':
                if ($_GET['idcola']) {
                    $table = "colaborador";
                    $param = "idcol";
                    $idColaborador = $_GET['idcola'];
                    $colaborador = $this->object->existProfile($table, $param, $idColaborador);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/admin/edit/editar-colaborador.php";
                }
                break;
            case 'cliente':
                if ($_GET['idcli']) {
                    $table = "cliente";
                    $param = "numid";
                    $idCliente = $_GET['idcli'];
                    $cliente = $this->object->existProfile($table, $param, $idCliente);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/admin/edit/editar-cliente.php";
                }
                break;
            case 'mascota':
                if ($_GET['idmas']) {
                    $table = "mascota";
                    $param = "idmas";
                    $idMascota = $_GET['idmas'];
                    $mascota = $this->object->existProfile($table, $param, $idMascota);
                    $style = "<link rel='stylesheet' type='text/css' href='assets/css/style-editarInfo.css'>";
                    require_once "view/head.php";
                    require_once "view/profile/admin/edit/editar-mascota.php";
                }
                break;
            default:
                redirect("?b=profile&s=Inicio&p=admin")->error("Pagina no encontrada")->send();
                break;
        }
    }

    // -----METODOS DE USUARIO ----- //

    //-----Metodo para actualizar datos de usuario-----//
    public function saveUser()
    {   
        $rol = ($_REQUEST['p'] == "Colaborador") ? "Colaborador" : (($_REQUEST['p'] == "Cliente") ? "Cliente" : "");

        if(empty($_POST['numid']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['nick']) || empty($_POST['pass']) || empty($_POST['pass2']) || empty($_POST['addres']) || empty($_POST['phone']) || empty($_POST['rol'])){
            redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("Complete todos los campos")->send();
        }else{
            if($this->object->verifyLeterString($_POST['numid'])){
                redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("El numero de Identificacion no puede llevar letras")->send();
            }else{
                if($this->object->selectParam("dniuser", "usuario", "dniuser", $_POST['numid'])){
                    redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("El numero de identificacion ya esta registrado con otro usuario")->send();
                }else{
                    if($this->object->verifyNumberString($_POST['name']) || $this->object->verifyNumberString($_POST['surname'])){
                        redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("Los nombres y apellidos deben ir sin numeros")->send();
                    }else{
                        if(!$this->object->verifyEmailString($_POST['email'])){
                            redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("Formato de correo electronico invalido")->send();
                        }else{
                            if($this->object->selectParam("nickuser", "usuario", "nickuser", $_POST['nick'])){
                                var_dump($this->object->selectParam("nickuser", "usuario", "nickuser", $_POST['nick'])); 
                                var_dump($_POST['nick']); 
                                // redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("El nickname ingresado se encuentra en uso")->send();
                            }else{
                                if($_POST['pass'] === $_POST['pass2']){
                                    if(!$this->object->verifyPasswordString($_POST['pass'])){
                                        redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("La contraseña no cumple con los estandares basicos de seguridad")->send();
                                    }else{
                                        if($this->object->verifyLeterString($_POST['phone']) || $this->object->verifyLeterString($_POST['phone2'])){
                                            redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("Los numeros de telefono pueden llevar letras")->send();
                                        }else{
                                            $c = new Profile(); 

                                            $c->dni = $_POST['numid'];  
                                            $c->name = $_POST['name'];  
                                            $c->surname = $_POST['surname'];  
                                            $c->nick = $_POST['nick'];  
                                            $c->pass = md5($_POST['pass']);  
                                            $c->email = $_POST['email'];  
                                            $c->addres = $_POST['addres'];  
                                            $c->zone = $_POST['zone'];  
                                            $c->phone = $_POST['phone'];  
                                            $c->phone2 = $_POST['phone'];  
                                            $c->privileges = ($_POST['rol'] == "recepcionista") ? Privilegios::Recepcionist->get() : (($_POST['rol'] == "veterinario") ? Privilegios::Doctor->get() : (($_POST['rol'] == "cliente") ? Privilegios::User->get() : null));

                                            if($this->object->saveUser($c)){
                                                redirect("?b=profile&s=Inicio")->success("Colaborador <strong>".$_REQUEST['name'] ." ".$_REQUEST['surname']."</strong> agregado con exito")->send();
                                            }else{
                                                redirect("?b=profile&s=Inicio")->error("Error en agregar al colaborador <strong>".$_REQUEST['name'] ." ".$_REQUEST['surname']."</strong>")->send();
                                            }
                                        }
                                    }
                                }else{
                                    redirect("?b=profile&s=optionSaveredirec&p=$rol")->error("Las contraseñas no coinciden")->send();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    //-----Metodo para actualizar datos de usuario-----// check
    public function updateUser()
    {
        if (isset($_REQUEST['btnUpdateProfile'])) {
            if (
                empty($_POST['numid']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['addres']) || empty($_POST['zone']) || empty($_POST['email']) || empty($_POST['phone'])
            ) {
                redirect("?b=profile&s=Inicio")->error("Se deben llenar todos los campos con (*)")->send();
            } else {
                if ($this->object->verifyLeterString($_POST['numid'])) {
                    redirect("?b=profile&s=Inicio")->error("El número de Identificación no puede llevar letras")->send();
                } else {
                    if ($this->object->selectParamBoolean("usuario","dniuser",$_POST['numid'])) {
                        $currentUser = $this->object->getAllUser($_POST['numid']);
                        if (!empty($currentUser)) {
                            $primerUsuario = $currentUser[0];
                            if ($primerUsuario['nickuser'] == $_SESSION['usuario']) {
                                $this->verifyUpdateUser(); 
                            } else {
                                redirect("?b=profile&s=Inicio")->error("El número de Identificación se encuentra registrado con otro usuario")->send();
                            }
                        } else {
                            redirect("?b=profile&s=Inicio")->error("No se encontraron usuarios para el número de identificación proporcionado.")->send();
                        }
                    } else {
                        $this->verifyUpdateUser(); 
                    }
                }
            }
        }
    }

    // -----Segunda parte para la actualizacion de datos de un usuario----- // check 
    private function verifyUpdateUser(){
        if ($this->object->verifyNumberString($_POST['name']) || $this->object->verifyNumberString($_POST['surname'])) {
            redirect("?b=profile&s=Inicio")->error("Los nombres y apellidos no pueden llevar numeros")->send();
        } else {
            if (!$this->object->verifyEmailString($_POST['email'])) {
                redirect("?b=profile&s=Inicio")->error("Formato de correo electronico invalido")->send();
            } else {
                if ($this->object->verifyLeterString($_POST['phone']) || $this->object->verifyLeterString($_POST['phone2'])) {
                    redirect("?b=profile&s=Inicio")->error("Los numero de telefonos no pueden contener letras")->send();
                } else {
                    $u = new Profile();
                    $u->id = $_POST['id'];
                    $u->dni = $_POST['numid'];
                    $u->name = $_POST['name'];
                    $u->surname = $_POST['surname'];
                    $u->email = $_POST['email'];
                    $u->addres = $_POST['addres'];
                    $u->zone = $_POST['zone'];
                    $u->phone = $_POST['phone'];
                    $u->phone2 = $_POST['phone2'];

                    if ($this->object->update($u)) {
                        redirect("?b=profile&s=Inicio")->success("Se ha actualizado la información del usuario")->send();
                    } else {
                        redirect("?b=profile&s=Inicio&p=admin")->error("No se pudo actualizar el usuario")->send();
                    }
                }
            }
        }
    }

    // -----METODOS DE PROVEEDOR ----- //

    // -----Metodo para guardar la informacion de un Proveedor----- //
    public function saveProveedor()
    {
        if(empty($_POST['name']) || empty($_POST['addres']) || empty($_POST['email']) || empty($_POST['phone'])){
            redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("Se deben llenar todos los campos")->send(); 
        }else{
            if(!$this->object->verifyEmailString($_POST['email'])){
                redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("Formato de correo electronico invalido")->send();
            }else{
                if($this->object->verifyLeterString($_POST['phone'])){
                    redirect("?b=profile&s=optionSaveRedirec&p=proveedor")->error("el numero de telefono no puede llevar letras")->send();    
                }else{
                    
                    $p = new Profile(); 
                    $p->name = $_POST['name']; 
                    $p->addres = $_POST['addres']; 
                    $p->email = $_POST['email']; 
                    $p->phone = $_POST['phone']; 

                    if($this->object->saveProveedor($p)){
                        redirect("?b=profile&s=Inicio")->success("Proveedor <strong>".$_POST['name']."</strong> agregado con exito")->send();
                    }else{
                        redirect("?b=profile&s=Inicio")->error("Error al guardar el proveedor")->send();
                    }
                    
                }
            }
        }
    }

    // -----Metodo para Editar la informacion del Proveedor ----- //

    public function editProveedor(){
        if(empty($_POST['id']) || empty($_POST['name']) || empty($_POST['addres']) || empty($_POST['email']) || empty($_POST['phone'])){
            $id = $_REQUEST['idprov'];
            redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=".$id)->error("Complete  todos los campos")->send();
        }else{
            if($this->object->verifyLeterString($_POST['id'])){
                $id = $_REQUEST['idprov'];
                redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=".$id)->error("El id no puede contener letras")->send();
            }else{
                if(!$this->object->verifyEmailString($_POST['email'])){
                    $id = $_REQUEST['idprov'];
                    redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=".$id)->error("Formato de correo electronico invalido")->send();
                }else{
                    if($this->object->verifyLeterString($_POST['phone'])){
                        $id = $_REQUEST['idprov'];
                        redirect("?b=profile&s=optionEditRedirec&p=proveedor&idprov=".$id)->error("El numero de telefono no puede tener letras")->send();
                    }else{
                        $p = new Profile(); 
                        $p->name = $_POST['name']; 
                        $p->addres = $_POST['addres']; 
                        $p->email = $_POST['email']; 
                        $p->phone = $_POST['phone']; 
                        $p->id = $_POST['id']; 

                        if($this->object->updateProveedor($p)){
                            redirect("?b=profile&s=Inicio")->success("Informacion de proveedor <strong>".$_POST['name']."</strong> editada con exito!")->send();
                        }else{
                            redirect("?b=profile&s=Inicio")->error("Error al editar informacion del Proveedor <strong>".$_POST['name']."</strong>")->send();
                        }

                    }
                }
            }
        }
    }  
    
    // -----Metodo para eliminar Proveedor ----- //

    public function deleteProveedor()
    {
        $table = "proveedor";
        $param = "idprov";
        $id = $_REQUEST['id']; 
        var_dump($action = $this->object->deleteUser($table, $param, $id));
        if ($action) {
            redirect("?b=profile&s=Inicio&p=admin")->success("Se ha eliminado el proveedor ".$_REQUEST['name']." con exito")->send();
        } else {
            redirect("?b=profile&s=Inicio&p=admin")->error("No se pudo eliminar el proveedor, revise que no haya ningun producto asignado a este proveedor. ")->send();
        }
    }









    //Metodo para cerrar Sesion
    public function cerrarSesion()
    {
        session_destroy();
        redirect("index.php")->success("Se ha cerrado la sesion correctamente")->send();
        exit();
    }
}