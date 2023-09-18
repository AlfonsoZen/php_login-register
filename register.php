<?php session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $errors = '';

    if (empty($user) || empty($password) || empty($password2)) {
        $errors = "<li>All fields must be filled</li>";

    } else {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=php_login', 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

        $statement = $conn->prepare('SELECT * FROM users WHERE name = :user LIMIT 1');
        $statement->bindParam(':user', $user);
        $statement->execute();

        $result = $statement->fetch();

        if ($result != false) {
            $errors .= '<li>The username already exists</li>';
        }

        $password = hash('sha512', $password);
        $password2 = hash('sha512', $password2);

        if ($password != $password2) {
            $errors .= '<li>Passwords are not the same.</li>';
        }
    }

    if ($errors == '') {
        $statement = $conn->prepare('INSERT INTO users(id, name, password) VALUES (null, :name, :password)');
        $statement->bindParam(':name', $user);
        $statement->bindParam(':password', $password);
        $statement->execute();

        header('Location: login.php');
    }


}

require 'views/register.view.php';

session_unset();
session_destroy();
?>
