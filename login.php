<?php
session_start();
require('includes/users.class.php');
require('includes/function.php');


if(isset($_POST['submit']))
{
    $usersObject = new users();

    $username = $_POST['username'];
    $password = $_POST['password'];

if($usersObject->login($username,$password))
{
    //get data
    $user = $usersObject->getUserData();

    //session
    $_SESSION['user'] = $user;


    //go to profile link
    echo "to go to profile please ,<a href='profile.php'>click here<a/>";
    exit;
}
else
{
    echo 'please write valid data';

}
}

?>

<form action="login.php" method="post">
    username<input type="text" name="username" /><br/>
    password<input type="password" name="password" /><br/>
    <input type="submit" name="submit" value="Login" /><br/>
</form>
