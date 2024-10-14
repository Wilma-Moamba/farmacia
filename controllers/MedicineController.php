<?php
    class MedicineController
    {
        public function index()
        {
            $medicines = Medicine::getAll();
            include 'views/medicine/list.php';
        }
    
        public function show($id)
        {
            $medicine = Medicine::findById($id);
            include 'views/medicine/detail.php';
        }
    
        public function create()
        {
            include 'views/medicine/form.php';
        }
    
        public function store()
        {
            $medicine = new Medicine();
            $medicine->nome = $_POST['nome'];
            $medicine->descricao = $_POST['descricao'];
            $medicine->quantidade = $_POST['quantidade'];
            $medicine->save();
            
            header('Location: ../views/users/adminDashboard.php');
        }
    
        public function edit($id)
        {
            $medicine = Medicine::findById($id);
            include 'views/medicine/form.php';
        }
    
        public function update($id) {
            $medicine = Medicine::findById($id);
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$quantidade = $_POST['quantidade'];

            if (isset($_POST['action']) && isset($_POST['quantidade']) && is_numeric($_POST['quantidade'])) {
                $quantidade = $_POST['quantidade'];
                $action = $_POST['action'];
        
                if ($action === 'acrescentar') {
                    $medicine->quantidade += $quantidade;
                    $medicine->registrarMovimento($id, $quantidade, 'entrada'); 
                } 
                elseif ($action === 'reduzir' && $medicine->quantidade >= $quantidade) {
                    $medicine->quantidade -= $quantidade;
                    $medicine->registrarMovimento($id, $quantidade, 'saida'); 
                }
                
                $medicine->save();
                echo "Quantidade atualizada com sucesso!";
                exit();
			}
			elseif (isset($_POST['id'])) {
				$medicine->nome = $nome;
				$medicine->id = $id;
				$medicine->quantidade = $quantidade;
				$medicine->descricao = $descricao;	
				$medicine->save();
				header('Location: ../views/medicine/visualizarStock.php');
				exit();
			}	
			else {
                echo "Dados inválidos ou ação não especificada.";
            }
        }
        
    
        public function delete($id)
        {
            $medicine = Medicine::findById($id);
            $medicine->delete();
            echo 'Item eliminado com sucesso';
        }
    }
?>
   
