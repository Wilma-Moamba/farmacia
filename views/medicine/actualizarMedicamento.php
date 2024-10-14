
<?php 
    include("../../sessionFile.php");
<<<<<<< HEAD
	require_once('../../models/Medicine.php');
=======
	require($_SERVER['DOCUMENT_ROOT'] . '/farmacia/models/Medicine.php');
>>>>>>> 27a0976fd74f2da7bf4d92836d75f75226dabc13
	
	$id = $_GET['id'];
	$medicine = new Medicine();
	$selected_medicine = $medicine->findById($id);

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

							<form action="../../routes/medicineRoutes.php?action=update" method="post">
							<input type="hidden" name="id" value="<?= $id ?>">
								<div class="registarItem">
									<legend>Nome</legend>
									<input type="text" class="form-control" id="nomeAntibiotico"  name="nome" value="<?= $selected_medicine->nome ?>">
								</div>
								<div class="registarItem">
										<legend>Descrição</legend>
										<input type="text" class="form-control" id="miligramas" name="descricao" value="<?= $selected_medicine->descricao ?>">
								</div>    
								<div class="registarItem">
									<legend>Quantidade</legend>
									<input type="text" class="form-control" id="quantidade" name="quantidade" value="<?= $selected_medicine->quantidade ?>">
								</div>
								<div class="registarItem">
									<button type="submit" id="buttonRegistar">Actualizar</button>
								</div>
							</form>
                    	</div>
                    </div>
                </div>    
            </div>       
        </div>
    </div>
    <?php
       
    ?>
</body>
</html>
