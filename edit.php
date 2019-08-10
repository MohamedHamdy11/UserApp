<?php
session_start();
require('includes/users.class.php');
require('includes/function.php');

if(!checkLogin())
    exit('you need to login to view this page,please <a href="login.php">Click Here</a> to login');

$user =$_SESSION['user'];


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

    if($error == 0 && ($type == 'image/png' || $type == 'image/jpg'))
    {
        if(move_uploaded_file($tmp,'uploads/'.$newname))
            $image = $newname;
    }


    if($usersObject->edit($user['id'],$username,$password,$email,$image))
    {
        //go to profile link
        echo "data updated successfully , to go to profile please ,<a href='profile.php'>click here<a/>";

        //new user data of session
        $_SESSION['user'] = $usersObject->getUser($user['id']);

        exit;
    }
    else
    {
        echo 'please write valid data';

    }
}

?>

<form action="edit.php" method="post" enctype="multipart/form-data">
    username<input type="text" name="username" value="<?php echo $user['username']?>" /><br/>
    password<input type="password" name="password" /><br/>
    email<input type="text" name="email" value="<?php echo $user['email']?>" /><br/>
    image<input type="file" name="image" /><br/>
    <input type="submit" name="submit" value=" Edit " /><br/>
</form>
