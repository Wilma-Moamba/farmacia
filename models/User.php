<?php
class User {
    public $id;
    public $role;
    public $nome;
    public $email;
    public $password;

    private static function getConnection() {
        $conn = new mysqli('localhost', 'root', '', 'sistema');
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function login($email, $password) {
        $db = self::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();

        if ($user && password_verify($password, $user->password)) {
            return $user; 
        }

        return false; 
    }

    public static function register($nome, $email, $password, $role = 'user') {
        $db = self::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return false; 
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (role, nome, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $role, $nome, $email, $hashed_password);
        if ($stmt->execute()) {
            return true; 
        }

        return false; 
    }
}

//$user = new User();

//$user->register("Wady", "wady@gmail.com", "wady");
//$user->register("Wady", "wadyadmin@gmail.com", "wady", "Admin");

//echo '<span style="color: red;">Sucess</span>';
?>
