<?php
require('../utils/functions.php');

if ($_POST && isset($_REQUEST['firstName'])) {
    $user['firstName'] = $_REQUEST['firstName'];
    $user['lastName'] = $_REQUEST['lastName'];
    $user['phoneNumber'] = $_REQUEST['phoneNumber'];
    $user['username'] = $_REQUEST['username'];
    $user['address'] = $_REQUEST['address'];
    $user['country'] = $_REQUEST['country'];
    $user['password'] = $_REQUEST['password'];

    if (saveUser($user)) {
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: /?error=Invalid user data");
    }
}
?>