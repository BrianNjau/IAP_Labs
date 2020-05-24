<?php
    include_once 'DBConnector.php';
    include_once 'user.php';
   
     $con = new DBConnector; // make db connection
    //data insert code
    if(isset($_POST['btn_save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];

        //create user object
        $user = new User ($first_name,$last_name,$city);
        if(!$user->validateForm()){
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }
        $res = $user->save();

        $read = $user->readAll();

       
        //Success checking code in user.php
    }
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
    session_start();
    if(!empty($_SESSION['form_errors'])){
        echo " ". $_SESSION['form_errors'];
        unset($_SESSION['form_errors']);
    }

    ?>
    
    </div>
    <td><input type="text" name="first_name" placeholder="First Name" ></td>
    </tr>
    <tr>
    <td><input type="text" name="last_name" placeholder="Last Name"></td>
    </tr>
    <tr>
    <td><input type="text" name="city_name" placeholder="City" ></td>
    </tr> <tr>
    <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
    </tr>

    </table>
    </form>
</body>
</html>