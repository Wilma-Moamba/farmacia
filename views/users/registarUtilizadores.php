<?php 
    include("../../sessionFile.php");
      if ($_SESSION['role'] !== 'Admin') {
        header('Location: registarUtilizadores.php'); 
        exit();
        }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/styleAdminDashboard.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <title>Registar Utilizadores</title>
</head>
<body>
    <div class="main-div">
        <div class="navbar">
        <ul class="navbar-items">
                    <li>
                        <a href="adminDashboard.php">      Medicamentos</a>
                    </li>
                    <li>
                        <a href="../medicine/visualizarStock.php">     Verificar Stock</a>
                    </li>
                    <li>
                        <a href="../medicine/actualizarStock.php">     Actualizar Stock</a>
                    </li> 
                    <li>
                        <a href="../medicine/relatorioMedicamento.php">     Entradas e Saídas</a>
                    </li>
                    <li>
                        <a href="../medicine/relatorio.php">     Relatório</a>
                    </li>
                    <li>
                        <a href="registarUtilizadores.php">     Registar Utilizadores</a>
                    </li>
                    <!-- <li>
                        <a href="visualizarUtilizadores.php">     Visualizar utilizadores</a>
                    </li>
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
        <div class="subMain-div">
            <div class="subSubMain-div">
                <div class="blocos">
                    <div class="registar">
                        <form action="../../routes/userRoutes.php?action=register" method="post">  
                            <div class="registarItem">
                                <legend>Role</legend>
                                <input type="text" class="form-control" name="role" required>
                            </div>
                            <div class="registarItem">
                                <legend>Nome</legend>
                                <input type="text" class="form-control" name="nome" required>
                            </div>    
                            <div class="registarItem">
                                <legend>Email</legend>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="registarItem">
                                <legend>Password</legend>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="registarItem">
                                <button type="submit" id="buttonRegistar">Registar</button>
                            </div>
                        </form>
                    </div>
                    <div class="notificacoes">
                        <h1>Notificações</h1>
                        <h2>Campos aqui</h2>
                    </div>
                </div>
                <div class="gerir">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sistema";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Conexão falhou: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr class='item'><th>ID</th><th>Role</th><th>Nome</th><th>Email</th></tr>";
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='item'>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "</tr>";
                        }
                        
                        echo "</table>";
                    } else {
                        echo "Nenhum registro encontrado.";
                    }
                    
                    $conn->close();
                    ?>        
                </div>
            </div>    
        </div>       
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
