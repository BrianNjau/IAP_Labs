<?php

session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
?>

<html>
<head>
<title>Private</title>
<script src="validate.js"></script>
<link rel="stylesheet" href="validate.css">
</head>
<body>
    <p>This is a private page</p>
    <p>Lets protect it polite</p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>