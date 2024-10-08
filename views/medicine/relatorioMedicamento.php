<?php 
	require("../../models/Medicine.php");
    require("../../sessionFile.php");

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
	<link rel="stylesheet" href="../../css/styleVisualizarStock.css">
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
                        <a href="actualizarStock.php">     Actualizar Stock</a>
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
			<table>
				<thead>
					<th>ID</th>					
					<th>Data</th>					
					<th>Nome</th>					
					<th>Entradas</th>					
					<th>Saídas</th>					
				</thead>

				<tbody>
                <?php
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $medicine  = new Medicine();		
                    $medicines = $medicine->getAll(); 
                    ?>

                    <?php foreach($medicines as $data): 
                        $movimentacoes = $medicine->getMovimentacoes($data->id);

                        // Verifica se há movimentações
                        if ($movimentacoes):  
                            // Itera sobre todas as movimentações retornadas para o medicamento
                            foreach ($movimentacoes as $movimento): 
                    ?>
                                <tr>
                                    <td><?= $data->id ?></td>
                                    <td><?= isset($movimento['data_movimento']) ? $movimento['data_movimento'] : '-' ?></td>
                                    <td><?= $data->nome ?></td>
                                    <td><?= isset($movimento['total_entradas']) ? $movimento['total_entradas'] : '0' ?></td>
                                    <td><?= isset($movimento['total_saidas']) ? $movimento['total_saidas'] : '0' ?></td>   
                                </tr>
                    <?php 
                            endforeach;  
                        endif;  
                    endforeach; 
                    ?>

				</tbody>
			</table>
        </div>   
    </div>
</body>
</html>
