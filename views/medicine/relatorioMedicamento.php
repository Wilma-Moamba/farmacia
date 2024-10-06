<?php 
    include("../../sessionFile.php");
    if ($_SESSION['role'] !== 'Admin') {
        header('Location: userDashboard.php'); 
        exit();
    } 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/styleRelatorio.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <Script src="../../js/script.js"></Script>
    <title>Sistema</title>
</head>
<body>
    <div class="main-div">
        <div class="navbar">
            
                <ul class="navbar-items">
                    <li>
                        <a href="../users/adminDashboard.php">      Medicamentos</a>
                    </li>
                    <li>
                        <a href="visualizarStock.php">     Verificar Stock</a>
                    </li>
                    <li>
                        <a href="relatorioMedicamento.php">     Entradas e Saídas</a>
                    </li>
                    <li>
                        <a href="../users/registarUtilizadores.php">     Registar Utilizadores</a>
                    </li>
                    <!--
                    <li>
                        <a href="registar.php">     Registar</a>
                    </li>
                    <li>
                        <a href="visualizar.php">     Visualizar</a>
                    </li> -->
                    <li>
                        <a href='../../logout.php'>Logout</a>
                    </li>
                </ul>
        </div>
        <div>
            <h1>Relatorio Saidas entradas</h1>
        </div>   
    </div>
</body>
</html>