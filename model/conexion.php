<?php 
date_default_timezone_set('America/Lima');
class Conexion{
    private $con;

    public function __construct() {
        $this->con = new mysqli('localhost', 'root', '', 'brferranza');

        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }
    }

    public function isEmailRegistered($email)
    {
        $sql_check = "SELECT * FROM tbuser WHERE email = '$email'";
        $result = $this->con->query($sql_check);
        return $result->num_rows > 0;
    }

    public function registerUser($name, $last, $email, $contrasena)
    {
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql_insert = "INSERT INTO tbuser (nombres, apellidos, email, contrasena, fecha_creacion) VALUES ('$name', '$last', '$email', '$contrasena_encriptada', current_timestamp())";
        if ($this->con->query($sql_insert) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function getLastInsertedUserId($email) {
        $sql = "SELECT id FROM tbuser WHERE email = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }


}
?>