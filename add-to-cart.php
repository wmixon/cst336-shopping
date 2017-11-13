<?php
    session_start();
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    //$_SESSION['cart'] = array();
    array_push($_SESSION['cart'], $_GET['id']);
    //$_SESSION['cart'] = array();
    header("Location: cart.php");
?>
