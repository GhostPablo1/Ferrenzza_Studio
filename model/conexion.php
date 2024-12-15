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
        $sql_check = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->con->query($sql_check);
        return $result->num_rows > 0;
    }

    public function registerUser($name, $last, $email, $password)
    {
        $contrasena_encriptada = password_hash($password, PASSWORD_DEFAULT);

        $sql_insert = "INSERT INTO user (rol_id, nombres, apellidos, email, contrasena, fecha_creacion) VALUES ('2', '$name', '$last', '$email', '$contrasena_encriptada', current_timestamp())";
        if ($this->con->query($sql_insert) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function createPersonaRecord($user_id) {
        $sql = "INSERT INTO persona (user_id) VALUES (?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    public function getLastInsertedUserId($email) {
        $sql = "SELECT id FROM user WHERE email = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }

    public function verifyToken($token) {
        $sql = "SELECT id, token_verificacion_expira FROM user WHERE token_verificacion = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->bind_result($id, $expira);
        $stmt->fetch();
        if ($id && new DateTime($expira) > new DateTime()) {
            return $id;
        }
        return false;
    }

    public function saveVerificationToken($user_id, $token, $expira) {
        $sql = "UPDATE user SET token_verificacion = ?, token_verificacion_expira = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $token, $expira, $user_id);
        return $stmt->execute();
    }

    public function verifyEmail($user_id) {
        $sql = "UPDATE user SET verificado = 1, token_verificacion = NULL, token_verificacion_expira = NULL WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    public function isEmailVerified($email) {
        $sql = "SELECT verificado FROM user WHERE email = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($verificado);
        $stmt->fetch();
        $stmt->close();
        return $verificado == 1;
    }

    public function loginUser($email, $password)
    {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->con->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['contrasena'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_rol_id'] = $user['rol_id'];
                $_SESSION['user_nombre'] = $user['nombres'];
                $_SESSION['user_email'] = $user['email'];
                return true;
            }
        }
        return false;
    }

    public function getUserRole($email) {
        $query = "SELECT rol_id FROM user WHERE email = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['rol_id'] : null;
    }

    public function getNombreByUserId($user_id) {
        $sql = "SELECT nombres FROM user WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}
?>