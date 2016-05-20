<?php

include("db.php");
session_start();

if(isset($_POST['submit'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];
    $recommendedBy = $_POST['recommendedBy'];


    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO user (email, password, type, recommendedBy) VALUES('$email', '$password', 'customer', '$recommendedBy')";
    $register_user_query = mysqli_query($connection, $query);


    if(!$register_user_query) {
        $_SESSION['message'] = "QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection);
        header('Location: ../registerCustomer.php');
    } else {
        $_SESSION['message'] = "Registrierung erfolgreich!";
        header('Location: ../index.php');
    }

}

?>
