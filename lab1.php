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
        $res = $user->save();

        //check for success
        if($res){
            echo "Save operation was successful";
            
        }else{
            echo "Error occured !";
        }

    }
?>
<html>
<head>
<title>Lab 1</title>
</head>
<body>
    <form method="post" action = "<?=$_SERVER['PHP_SELF']?>">
    <table align="center">
    <tr>
    <td><input type="text" name="first_name" placeholder="First Name" required></td>
    </tr>
    <tr>
    <td><input type="text" name="last_name" placeholder="Last Name" required></td>
    </tr>
    <tr>
    <td><input type="text" name="city_name" placeholder="City" required></td>
    </tr> <tr>
    <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
    </tr>

    </table>
    </form>
</body>
</html>