<?php session_start();

if( isset($_SESSION['user']) ) {
    header( 'Location: index.php');
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $user = filter_var( strtolower( $_POST['user'] ), FILTER_SANITIZE_STRING );
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // echo "$user, $password, $password2";

    $errors = '';

    if( empty($user) || empty($password) || empty($password2) ) {
        $errors .= "<li>All fields must be filled</li>";
    } else {
        try {
			$conn = new PDO('mysql:host=localhost;dbname=php_login', 'root', '');

            $statement = $conn->prepare('SELECT * FROM users WHERE name = :user LIMIT 1');
            $statement->bindParam(':user', $user);
            $statement->execute();

            $result = $statement->fetch();

            if ($result != false) {
                	$errors .= '<li>El nombre de usuario ya existe</li>';
            } 
		} catch (PDOException $e) {
			echo "Error:" . $e->getMessage();
		}
    }   
}

require 'views/register.view.php';
session_unset();
session_destroy();
?>