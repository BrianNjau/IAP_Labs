<?php
    session_start();
    include_once 'DBConnector.php';
    include_once 'user.php';   
     $con = new DBConnector; // make db connection
    //data insert code
    if(isset($_POST['btn_save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password= $_POST['password'];

        //create user object
        $user = new User ($first_name,$last_name,$city,$username,$password);
        if(!$user->validateForm()){
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }
       // $check = $user->isUserExist();        
       
        
        $connect = new PDO('mysql:host=localhost;dbname=btc3205', 'root', '');  
        $query = "SELECT * FROM user WHERE username = :username";  
        $statement = $connect->prepare($query);  
        $statement->execute(  
             array(  
                  'username'     =>     $_POST['username'] 
                  
             )  
        );  
        $count = $statement->rowCount();  
        if($count > 0)  
        {  
             $_SESSION['username'] = $_POST['username'];  
             echo" Username Taken";  
        }  
        else  
        {  
            $res = $user->save(); 
         
        }  


      }elseif (isset($_POST['btn_Print'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password= $_POST['password'];
        $user = new User ($first_name,$last_name,$city,$username,$password);
        $read = $user->readAll();
        die();
      }
       
        //Success checking code in user.php
    
    //read all objects in db
    
?>
<html>
<head>
<title>Lab 1</title>
<script src="validate.js"></script>
<link rel="stylesheet" href="validate.css">
</head>
<body>
    <form method="POST" name="user_details" id="user_details" onsubmit="return validateForm()" action = "<?=$_SERVER['PHP_SELF']?>">
    <table align="center">
    <tr>
    <div id="form-errors">
    <?php  
    if(!empty($_SESSION['form_errors'])){
        echo " ". $_SESSION['form_errors'];
        unset($_SESSION['form_errors']);
    } ?>
    
    </div>
    <td><input type="text" name="first_name" placeholder="First Name" ></td>
    </tr>
    <tr>
    <td><input type="text" name="last_name" placeholder="Last Name"></td>
    </tr>
    <tr>
    <td><input type="text" name="city_name" placeholder="City" ></td>
    </tr> <tr>
    <td><input type="text" name="username" placeholder="Username" ></td>
    </tr> <tr>
    <td><input type="password" name="password" placeholder="Password"></td>
    </tr> <tr>
    <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>

    <td><button type="submit" name="btn_Print"><strong>PRINT ALL </strong></button></td>
    </tr>

<tr>
<td><a href="login.php">Login</a></td>
</tr>
    </table>
    </form>
</body>
</html>