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
            $medicine->name = $row['nome'];
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
            $stmt = $db->prepare("UPDATE medicamentos SET nome = ?, descricao = ?, quantidade = ? WHERE id = ?");
            $stmt->bind_param("ssss", $this->nome, $this->descricao, $this->quantidade, $this->id);
        } else {
            $stmt = $db->prepare("INSERT INTO medicamentos (nome, descricao, quantidade) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $this->nome, $this->descricao, $this->quantidade);
        }

        $stmt->execute();
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