<?php

class Medicine
{
    public $id;
    public $nome;
    public $descricao;
    public $quantidade;

    private static function getConnection()
    {
        $conn = new mysqli('localhost', 'root', '', 'sistema');
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function getAll()
    {
        $db = self::getConnection();
        $result = $db->query("SELECT * FROM medicamentos");

        $medicines = [];
        while ($row = $result->fetch_assoc()) {
            $medicine = new Medicine();
            $medicine->id = $row['id'];
            $medicine->nome = $row['nome'];
            $medicine->descricao = $row['descricao'];
            $medicine->quantidade = $row['quantidade'];
//            $medicine->dataModificacao = $row['dataModificacao'];
            $medicines[] = $medicine;
        }

        $db->close();
        return $medicines;
    }

    public static function findById($id)
    {
        $db = self::getConnection();
        $stmt = $db->prepare("SELECT * FROM medicamentos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicine = $result->fetch_object('Medicine');
        
        $stmt->close();
        $db->close();
        return $medicine;
    }

    public function save()
    {
        $db = self::getConnection();

        if ($this->id) {
            $stmt = $db->prepare("UPDATE medicamentos SET nome = ?, descricao = ?, quantidade = ? WHERE id = ?");
            $stmt->bind_param("sssi", $this->nome, $this->descricao, $this->quantidade, $this->id);
        } else {
            $stmt = $db->prepare("INSERT INTO medicamentos (nome, descricao, quantidade) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $this->nome, $this->descricao, $this->quantidade);
        }

		try {
			$stmt->execute(); 
		}
		catch(Exception $e) {
			die($e->getMessage());
		}

        $stmt->close();
        $db->close();
    }

    public function delete()
    {
        $db = self::getConnection();
        $stmt = $db->prepare("DELETE FROM medicamentos WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
    public function registrarMovimento($id_medicamento, $quantidade, $tipo_movimento) {
        $db = self::getConnection();
        $sql = "INSERT INTO movimentos (id_medicamento, quantidade, tipo_movimento, data_movimento) VALUES (?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iis", $id_medicamento, $quantidade, $tipo_movimento);
        $stmt->execute();
        $stmt->close();
    }

    // public function getMovimentacoes($id_medicamento, $specific_date = null) {
    //     $db = self::getConnection();
        
    //     // SQL para obter entradas e saídas agrupadas pela data
    //     $sql = "SELECT 
    //                 DATE(mov.data_movimento) AS data_movimento, 
    //                 SUM(CASE WHEN mov.tipo_movimento = 'entrada' THEN mov.quantidade ELSE 0 END) AS total_entradas,
    //                 SUM(CASE WHEN mov.tipo_movimento = 'saida' THEN mov.quantidade ELSE 0 END) AS total_saidas
    //             FROM movimentos mov
    //             JOIN medicamentos m ON mov.id_medicamento = m.id";
    
    //     // Adicionar condição para data específica
    //     if ($specific_date) {
    //         $sql .= " WHERE DATE(mov.data_movimento) = ?";
    //     }
    
    //     $sql .= " GROUP BY DATE(mov.data_movimento) 
    //               ORDER BY DATE(mov.data_movimento) DESC";
    
    //     $stmt = $db->prepare($sql);
        
    //     // Se uma data específica for fornecida, vinculá-la
    //     if ($specific_date) {
    //         $stmt->bind_param("s", $specific_date);
    //     }
    
    //     $stmt->execute();
    //     $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    //     $stmt->close();
        
    //     return $result;
    // }
    
    public function getMovimentacoes($id_medicamento) {
        $db = self::getConnection();
        $sql = "SELECT 
                m.nome,  
                mov.data_movimento, 
                SUM(CASE WHEN mov.tipo_movimento = 'entrada' THEN mov.quantidade ELSE 0 END) as total_entradas,
                SUM(CASE WHEN mov.tipo_movimento = 'saida' THEN mov.quantidade ELSE 0 END) as total_saidas
            FROM movimentos mov
            JOIN medicamentos m ON mov.id_medicamento = m.id
            WHERE mov.id_medicamento = ?
            GROUP BY mov.data_movimento, m.nome
            ORDER BY mov.data_movimento DESC";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id_medicamento);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        return $result;
    }
}
?>
