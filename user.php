<?php

include "Crud.php";

class User implements Crud{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    

    function __construct($first_name,$last_name,$city_name){
        $this->first_name = $first_name;
        $this->last_name= $last_name;
        $this->city_name=$city_name;

    }
    public function setUserId($user_id){
        $this->user_id = $user_id;

    }
    public function getUserId(){
        return $this->$user_id;
    }

    public function save(){
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;  
        // initialize PDO  
        $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $res = $pdo ->prepare("INSERT INTO user(first_name,last_name,user_city) VALUES(?,?,?)");
        $res->execute([$fn,$ln,$city]);
          //check for success
          if($res){
            echo "Save operation was successful:\n" ;
            
        }else{
            echo "Error occured !";
        }

        return $res;
    }
    public function readAll(){
          // initialize PDO  
          $pdo = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id > ?");
        $stmt->execute([0]);

/* Fetch all of the remaining rows in the result set */
        print("Fetch all of the values in DB:\n");
        $result = $stmt->fetchAll();
        print_r($result);   

    }

    public function readUnique(){
        return null;
    }public function search(){
        return null;
    }public function update(){
        return null;
    }public function removeOne(){
        return null;
    }public function removeAll(){
        return null;
    }
    public function validateForm(){
        $fn = $this ->first_name;
        $ln = $this->last_name;
        $city= $this->city_name;
        if($fn=="" || $ln=="" || $city==""){
            return false;
        }
        return true;
    }
    public function createFormErrorSessions(){
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }
}
?>