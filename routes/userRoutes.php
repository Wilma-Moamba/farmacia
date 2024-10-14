<?php
 
require '../controllers/UserController.php';
require '../models/User.php';

$controller = new UserController();

if (isset($_GET['action']) && $_GET['action'] == 'login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->login();
} elseif (isset($_GET['action']) && $_GET['action'] == 'register' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->register();
} else {
    if (isset($_GET['action']) && $_GET['action'] == 'register') {
        include '../views/users/registarUtilizadores.php';
    } else {
        include '../views/login.php';
    }
}

?>
