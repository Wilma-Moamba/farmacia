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

            if (isset($_POST['action']) && isset($_POST['quantidade']) && is_numeric($_POST['quantidade'])) {
                $quantidade = $_POST['quantidade'];
                $action = $_POST['action'];
        
                if ($action === 'acrescentar') {
                    $medicine->quantidade += $quantidade;
                } 
                elseif ($action === 'reduzir' && $medicine->quantidade >= $quantidade) {
                    $medicine->quantidade -= $quantidade;
                }
        
                // $medicine->nome = $_POST['nome'];
                // $medicine->descricao = $_POST['descricao'];
                
                $medicine->save();
                echo "Quantidade atualizada com sucesso!";
                exit();
            } else {
                echo "Dados inválidos ou ação não especificada.";
            }
        }
        
    
        public function delete($id)
        {
            $medicine = Medicine::findById($id);
            $medicine->delete();

            header('Location:  ../views/medicine/visualizarStock.php');
        }
    }
?>
