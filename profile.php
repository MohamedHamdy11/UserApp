<?php
session_start();
require('includes/function.php');


if(!checkLogin())
    exit('you need to login to view this page,please <a href="login.php">Click Here</a> to login');

$user = $_SESSION['user'];

echo"<img width='200' height='160' src='uploads/".$user['image']."'/><br/>";


echo 'name : '.$user['username'].'<br/>';
echo 'email : '.$user['email'].'<br/>';

echo '<a href="logout.php">logout<a/> | <a href="edit.php">Edit</a>';
