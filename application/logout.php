<?php

include("db.php");
session_start();

$_SESSION['currentUserId'] = null;
$_SESSION['userType'] = null;
$_SESSION['message'] = null;
$_SESSION['filtered'] = null;

header("Location: ../index.php");

?>
