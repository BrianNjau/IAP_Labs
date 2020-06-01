<?php

include_once 'DBConnector.php';
include_once 'user.php';


session_start();  

// TEST 

try  
{  
     $connect = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');  
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
     if(isset($_POST['btn_login']))  
     {  
          if(empty($_POST['username']) || empty($_POST['password']))  
          {  
             echo "Put some data";
          }  
          else  
          {  
               $query = "SELECT * FROM user WHERE username = :username AND password = :password";  
               $statement = $connect->prepare($query);  
               $statement->execute(  
                    array(  
                         'username'     =>     $_POST['username'],  
                         'password'     =>     $_POST['password']  
                    )  
               );  
               $count = $statement->rowCount();  
               if($count > 0)  
               {  
                    $_SESSION['username'] = $_POST['username'];  
                    header("location:private_page.php");  
               }  
               else  
               {  
                    echo '<label>Wrong Data</label>';  
               }  
          }  
     }  
}  
catch(PDOException $error)  
{  
     $message = $error->getMessage();  
}  






// $con = new DBConnector;

// if(isset($_POST['btn_login'])){
//     $username = $_POST['username'];
//     $password =$_POST['password'];
//     $instance = User::create( $username, $password);
//     $instance->setPassword($password);
//     $instance->setUsername($username);

//     if($instance ->isPasswordCorrect()){
//         $instance->login();

//        $con->null;
//         $instance->createUserSession();

//     }else{
//        $con->null;
//         // header("Location:login.php");
//     }



// }


?>

<html>
<head>
<title>Login</title>
<script src="validate.js"></script>
<link rel="stylesheet" href="validate.css">
</head>
<body>
    <form method="POST" name="login" id="login" onsubmit="return validateForm()" action = "<?=$_SERVER['PHP_SELF']?>">
    <table align ="center">
    <tr>
    
    <td><input type="text"  name="username" placeholder="Username" ></td>
    </tr>
    <tr>
    
    <td><input type="password"  name="password" placeholder="Password" ></td>
    </tr>
    
    <tr>
    
    <td><button type="submit" name="btn_login"><strong>login</strong></button></td>
    </tr>
    </table>
    
    </form>
</body>
</html>