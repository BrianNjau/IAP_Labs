<?php

include "Crud.php";
include "authenticator.php";
include_once "DBConnector.php";

class User implements Crud,Authenticator
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;


    function __construct($first_name, $last_name, $city_name, $username, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->username = $username;
        $this->password = $password;
    }

    
    public static function create(){
        $instance = new self($first_name=null, $last_name=null, $city_name=null, $username, $password);
        return $instance;
    }
    public function setUsername($username){
        $this->username=$username;

    }
    public function getUsername(){
        return $this->username;
        
    }
    public function setPassword($password){
        $this->password=$password;
        
    }
    public function getPassword(){
       return $this->password;
        
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getUserId()
    {
        return $this->$user_id;
    }

    public function save()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname= $this->username;
        $this->hashPassword();
        $pass=$this->password;
        // initialize PDO  
        $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $res = $pdo->prepare("INSERT INTO user(first_name,last_name,user_city,username,password) VALUES(?,?,?,?,?)");
        $res->execute([$fn, $ln, $city,$uname,$pass]);
        //check for success
        if ($res) {
            echo "Save operation was successful:\n";
        } else {
            echo "Error occured !";
        }

        return $res;
    }

    public function hashPassword(){
        $this->password=password_hash($this->password,PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect(){
        $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $found = false;
        $stmt = $pdo->prepare("SELECT * FROM user");






        $stmt->execute();

        /* Fetch all of the remaining rows in the result set */
        print("Fetch all of the values in DB:\n");
        
        while($row = $stmt->fetchAll(\PDO::FETCH_ASSOC)){
            if(password_verify($this->getPassword(),$row['password'])&& $this->getUsername()==$row['username']){
                $found=true;

            }

        }
        $pdo=null;
    return $found;
    }

    public function login(){
        if($this->isPasswordCorrect()){
            header("Location:private_page.php");
        }
    }
    public function createUserSession(){
        session_start();
        $_SESSION['username'] = $this->getUsername();
    }
    public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }

    public function readAll()
    {
        // initialize PDO  
        $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id > ?");
        $stmt->execute([0]);

        /* Fetch all of the remaining rows in the result set */
        print("Fetch all of the values in DB:\n");
        $result = $stmt->fetchAll();
        print_r($result);
    }

    public function isUserExist()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $sql ="SELECT * FROM  user ";
        
        $statement = $pdo->prepare($sql);  
               $statement->execute(  
                    array(  
                         'username'     =>     $_POST['username']
                         
                    )  
               );  
               $count = $statement->rowCount();  
               if($count > 0)  
               {  
                    $_SESSION['username'] = $_POST['username'];  
                    echo "Username taken";
                    header("Refresh:0");  
                    die();
               }  
  
    }
    

    public function readUnique()
    {
        return null;
    }
    public function search()
    {
        return null;
    }
    public function update()
    {
        return null;
    }
    public function removeOne()
    {
        return null;
    }
    public function removeAll()
    {
        return null;
    }
    public function validateForm()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        if ($fn == "" || $ln == "" || $city == "") {
            return false;
        }
        return true;
    }
    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }
}
