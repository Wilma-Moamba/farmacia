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
            $medicine->nome = $row['nomeAntibiotico'];
            $medicine->descricao = $row['descricao'];
            $medicine->quantidade = $row['quantidade'];
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
            $stmt = $db->prepare("UPDATE medicamentos SET nomeAntibiotico = ?, descricao = ?, quantidade = ? WHERE id = ?");
            $stmt->bind_param("sssi", $this->nome, $this->descricao, $this->quantidade, $this->id);
        } else {
            $stmt = $db->prepare("INSERT INTO medicamentos (nomeAntibiotico, descricao, quantidade) VALUES (?, ?, ?)");
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



}
?>
