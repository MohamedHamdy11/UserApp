<?php
session_start();
require('includes/users.class.php');
require('includes/function.php');

if(checkLogin())
    exit('you are already logged in to goto profile please <a href="profile.php">Click Here</a>');

if(isset($_POST['submit']))
{
    $usersObject = new users();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];

    //image
    $name  = $_FILES['image']['name'];
    $type  = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $tmp   = $_FILES['image']['tmp_name'];
    $size  = $_FILES['image']['size'];

    $newname = md5(date('U')).$name;

    $image = '';

    if($type == 'image/png' || $type == 'image/jpg')
    {
        if(move_uploaded_file($tmp,'uploads/'.$newname))
            $image = $newname;
    }


    if($usersObject->register($username,$password,$email,$image))
    {
        //go to profile link
        echo "thanx for registration , to go to login please ,<a href='login.php'>click here<a/>";
        exit;
    }
    else
    {
        echo 'please write valid data';

    }
}

?>

<form action="register.php" method="post" enctype="multipart/form-data">
    username<input type="text" name="username" /><br/>
    password<input type="password" name="password" /><br/>
    email<input type="text" name="email" /><br/>
    image<input type="file" name="image" /><br/>
    <input type="submit" name="submit" value="register" /><br/>
</form>
