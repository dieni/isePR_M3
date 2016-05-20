<?php

include("db.php");
session_start();

if(isset($_POST['submit'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $homepage = $_POST['homepage'];
    $maxPerson = $_POST['maxPerson'];
    $preOrderTime = $_POST['preOrderTime'];
    $deliveryRadius = $_POST['deliveryRadius'];
    $servicePersonal = $_POST['servicePersonal'];
    $kitchen = $_POST['kitchen'];
    

    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO user (email, password, type) VALUES('$email', '$password', 'caterer')";
    $register_user_query = mysqli_query($connection, $query);
    
    $query2 = "INSERT INTO caterer (catererId, name, description, street, zip, city, phone, homepage, maxPerson, preOrderTime, deliveryRadius, servicePersonal) VALUES((SELECT userId from user WHERE email='$email'), '$name', '$description', '$street', '$zip', '$city', '$phone', '$homepage', '$maxPerson', '$preOrderTime', '$deliveryRadius', '$servicePersonal')";
    $register_user_query2 = mysqli_query($connection, $query2);
    
    foreach($kitchen as $kit){
        $query3 = "INSERT INTO catererskitchen (kitchenId, CatererId) VALUES('$kit', (SELECT userId from user WHERE email='$email'))";
        $register_user_query3 = mysqli_query($connection, $query3);
    }
    

    if(!$register_user_query || !$register_user_query2 || !$register_user_query3) {
        $_SESSION['message'] = "QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection);
        header('Location: ../registerCaterer.php');
    } else {
        $_SESSION['message'] = "Registrierung erfolgreich!";
        header('Location: ../index.php');
    }
    
}

?>
