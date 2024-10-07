<?php
class UserController {
    public function login() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::login($email, $password);

            if ($user) {
                session_start();
                $_SESSION['id'] = $user->id;
                $_SESSION['email'] = $user->email;
                $_SESSION['role'] = $user->role;
                $_SESSION['nome'] = $user->nome;
              
                if ($user->role == 'Admin') {
                    header('Location: ../views/users/adminDashboard.php'); 
                } else {
                    header('Location: ../views/users/userDashboard.php'); 
                }
                exit();
            } else {
                $error = "Email ou senha incorretos.";
                include '../views/login.php'; 
            }
        }
    }

    public function register() {
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $result = User::register($nome, $email, $password, $role);

            if ($result) {
                header('Location: ../views/users/registarUtilizadores.php');
                exit();
            } else {
                header('Location: ../views/users/registarUtilizadores.php?error=email_existe');
                exit();
            }
        }
    }
}


?>