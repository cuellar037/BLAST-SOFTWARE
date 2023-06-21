<?php


class ProfileAdministradorController 
{
    public function Inicio()
    {
        $style = "<link rel='stylesheet' href='assets/css/style-profile-administrator.css'>";
        require_once "view/head.php";
        $nombreUsuario = $_SESSION['usuario'];
        $data = compact('nombreUsuario');
        require_once "view/profile/profileadministrador.php";
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    
}

