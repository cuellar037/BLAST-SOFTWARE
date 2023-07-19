<?php

include_once "model/login.php";

class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login();
    }

    public function Inicio()
    {
        $style = "<link rel='stylesheet' href='assets/css/style-login.css'>";
        require_once "view/head.php";
        require_once "view/login/login.php";
    }

    public function validarUser()
    {
        $usuario = $_POST['ctUser'];
        $password = $_POST['ctPassword'];

        if (empty($usuario) || empty($password)) {
            header('Location: ?b=login');
        } else {
            $usuario_valido = $this->loginModel->validarUsuario($usuario, $password);
            if ($usuario_valido) {
                $tipoUsuario = $this->loginModel->obtenerRol($usuario);

                session_start();
                $_SESSION['usuario'] = $usuario;
                var_dump($_SESSION['usuario'] = $usuario);
                $_SESSION['tipoUsuario'] = $tipoUsuario;
                var_dump($_SESSION['tipoUsuario'] = $tipoUsuario);
                $_SESSION['ultimaActividad'] = time();
                var_dump($_SESSION['ultimaActividad'] = time());
                setNotify("success", "Ha iniciado sesión correctamente");

                switch ($tipoUsuario) {
                    case "cliente":
                        header('Location: ?b=profile&s=Inicio&p=customer');
                        break;
                    case "administrador":
                        header('Location: ?b=profile&s=Inicio&p=admin');
                        break;
                    case "colaborador":
                        $rolColaborador = $this->loginModel->obtenerRolColaborador($usuario);
                        switch ($rolColaborador) {
                            case "veterinario":
                                header('Location: ?b=profile&s=Inicio&p=vet');
                                break;
                            case "recepcionista":
                                header('Location: ?b=profile&s=Inicio&p=recepcionist');
                                break;
                            case "colaborador":
                                header('Location: ?b=profilecolaborador&s=Inicio&p=collaborator');
                                break;
                            default:
                                // Redirigir a una página de error o manejar el caso adecuadamente
                                break;
                        }
                        break;
                    default:
                        // Redirigir a una página de error o manejar el caso adecuadamente
                        break;
                }

                exit();
            } else {
                setcookie("notify", serialize(["status" => "error", "message" => "El usuario ingresado no existe"]), time() + 5, "/");
                header('location: ?b=login&s=Inicio&p=admin');
            }
        }
    }
}