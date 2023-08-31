<?php session_start();  

if( isset($_SESSION['usuario']) ){
    header( 'Location: content.php' );
} else {
    header( 'Location: register.php' );
}

?>