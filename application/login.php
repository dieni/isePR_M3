<?php
include("db.php");
session_start();

if(isset($_POST['submit'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];
    
    
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    

    if(!$result) {
        $_SESSION['message'] = "QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection);
        header('Location: ../index.php');
    } else {
        
        while($row = mysqli_fetch_assoc($result)) {
            $currentUserId = $row['userId'];
            $currentUserEmail = $row['email'];
            $userType = $row['type'];
            $db_user_password = $row['password'];
        }
        if (password_verify($password, $db_user_password)) {
            $_SESSION['currentUserId'] = $currentUserId;
            $_SESSION['userType'] = $userType;
            $_SESSION['message'] = "Login erfolgreich! Hallo " . $currentUserEmail . "!";
            
            if($userType == 'admin') {
                header('Location: ../admin.php');
            } else {
                header('Location: ../search.php');
            }
            
        } else {
            $_SESSION['message'] = "Login fehlgeschlagen!";
            header('Location: ../index.php');
        }
    }
    
}

?>
