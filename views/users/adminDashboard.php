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
    <link href="../../css/styleAdminDashboard.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <Script src="../../js/script.js"></Script>
    <title>Sistema</title>
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
                        <form action="../../routes/medicineRoutes.php?action=create" method="post" >  
                            <div class="registarItem">
                                <legend>Nome</legend>
                                <input type="text" class="form-control" id="nomeAntibiotico"  name="nome">
                            </div>
                            <div class="registarItem">
                                    <legend>Descrição</legend>
                                    <input type="text" class="form-control" id="miligramas" name="descricao">
                            </div>    
                            <div class="registarItem">
                                <legend>Quantidade</legend>
                                <input type="text" class="form-control" id="quantidade" name="quantidade">
                            </div>
                            <div class="registarItem">
                                <button type="submit" id="buttonRegistar">Registar</button>
                            </div>
                        </form>
                        </div>
                        <div class="notificacoes">
                            <h4>Medicamentos escassos</h4>
                            <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "sistema";
                                
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
                                if ($conn->connect_error) {
                                    die("Conexão falhou: " . $conn->connect_error);
                                }
                                
                                $sql = "SELECT * FROM medicamentos";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    echo "<table>";
                                    echo "<tr class='item'><th>ID</th><th>Nome</th><th>Descrição</th><th>Quantidade</th></tr>";
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        if($row['quantidade'] < 20){
                                            echo "<tr class='item'>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['nome'] . "</td>";
                                            echo "<td>" . $row['descricao'] . "</td>";
                                            echo "<td>" . $row['quantidade'] . "</td>";;
                                            echo "<td><button class='buttonYes' onclick='acrescentar(" . $row['id'] . ")'>Acrescentar</button></td>";
                                            echo "<td><button class='buttonNo' onclick='reduzir(" . $row['id'] . ")'>Reduzir</button></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    
                                    echo "</table>";
                                } else {
                                    echo "Nenhum registro encontrado.";
                                }
                                
                                $conn->close();
                            ?>
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
                        
                        $sql = "SELECT * FROM medicamentos WHERE dataModificacao >= NOW() - INTERVAL 1 DAY";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            echo "<table>";
                            echo "<tr class='item'><th>ID</th><th>Nome</th><th>Descrição</th><th>Quantidade</th></tr>";
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='item'>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['descricao'] . "</td>";
                                echo "<td>" . $row['quantidade'] . "</td>";;
                                echo "<td><button class='buttonYes' onclick='acrescentar(" . $row['id'] . ")'>Acrescentar</button></td>";
                                echo "<td><button class='buttonNo' onclick='reduzir(" . $row['id'] . ")'>Reduzir</button></td>";
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
    </div>
    <?php
       
    ?>
</body>
</html>
