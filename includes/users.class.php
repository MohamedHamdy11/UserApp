<?php
class users
{
    private $connection;
    private $userData;   //array row of user

    /**
     * connection DB
     */
    public function __construct()
    {
        $this->connection = new mysqli('localhost','root','','usersapp');
    }

    /**
     * login operation
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username,$password)
    {
        $result = $this->connection->query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'");

        if ($result->num_rows > 0)
        {
            $this->userData= $result->fetch_assoc();
            return true;
        }
        return false;
    }

    /**
     * register
     * @param $username
     * @param $password
     * @param $email
     * @param string $image
     * @return bool
     */
    public function register($username,$password,$email,$image='')
    {
        $this->connection->query("INSERT INTO `users`(`username`, `password`, `email`, `image`) VALUES ('$username','$password','$email','$image')");

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }

    /**
     *Edit data user
     * @param $id
     * @param $username
     * @param $password
     * @param $email
     * @param string $image
     * @return bool
     */
    public function edit($id,$username,$password,$email,$image='')
    {
        $id =(int)$id;

        $sql =" UPDATE `users` SET `username`='$username',`email`='$email'";

        if(strlen($password) > 0)
           $sql .=",`password`='$password'";

        if(strlen($image)>0)
            $sql .=",`image`='$image'";


        $sql .=" WHERE `id`=$id";

        $this->connection->query("$sql");

        if ($this->connection->affected_rows > 0)
            return true;

        return false;

    }

    /**
     * get user data
     * @return mixed
     */
    public function getUserData()
    {
        return $this->userData;
    }

    /**
     * select user(get user)
     * @param $id
     * @return array|null
     */
    public function getUser($id)
    {
        $id = (int)$id;
        $result = $this->connection->query("SELECT * FROM `users` WHERE `id`=$id  ");

        if ($result->num_rows > 0)
        {
            $this->userData= $result->fetch_assoc();
            return $this->userData;
        }
        return null;
    }

}

