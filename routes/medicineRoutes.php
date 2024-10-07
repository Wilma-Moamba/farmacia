<?php
require '../controllers/MedicineController.php';
require '../models/Medicine.php';

$controller = new MedicineController();

if (isset($_GET['action']) && $_GET['action'] == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->store();
} elseif (isset($_GET['action']) && $_GET['action'] == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $controller->update($_POST['id']);
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'create') {
    $controller->create();
} elseif (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $controller->edit($_GET['id']);
} elseif (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
    $controller->show($_GET['id']);
}
elseif (isset($_GET['action']) && $_GET['action'] == 'delete' &&  $_SERVER['REQUEST_METHOD'] == 'POST') {
	$controller->delete($_POST['id']);
}
else {
    $controller->index();
}
