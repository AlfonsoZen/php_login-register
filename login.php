<?php session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $user = filter_var( strtolower( $_POST['user'] ), FILTER_SANITIZE_STRING );
    $password = $_POST['password'];
    $password = hash( 'sha512', $password );

    $errors = '';
    
    try {
        $conn = new PDO('mysql:host=localhost;dbname=php_login', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $statement = $conn->prepare(
        'SELECT * FROM users WHERE name = :user AND password = :password'
    );    
    $statement->bindParam(':user', $user);
    $statement->bindParam(':password', $password);
    $statement->execute();

    $result = $statement->fetch();

    if( $result ) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
    } else {
        $errors .= '<li>Wrong user or password</li>';
    }
    
}

require "views/login.view.php";


?>