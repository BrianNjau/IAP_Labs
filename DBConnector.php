<?php
class DBConnector{
        
//PDO code improvement Create connection
public $dsn = "mysql:host=localhost; dbname= btc3205; charset = utf8mb4";
public $options =[
    PDO ::ATTR_EMULATE_PREPARES =>false,
    PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,];

    function _construct(){
        try{
            $pdo = new PDO($dsn,"root","",$options);
        }catch(Exception $e){
            error_log($e->getMessage());
        }
         exit('Something weird happened');
        
        }

    }
        



?>