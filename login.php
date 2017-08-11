<?php
include("db.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
include 'db.php';
// username and password sent from Form
$username=$_POST['username']; 
$password=$_POST['password']; 
//$password=md5($password); // Encrypted Password

$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers] WHERE User_ID='{$username}' AND "
         ."Salt='{$password}'";
//$sql="SELECT id FROM tblUsers WHERE username='$username' and passcode='$password'";
$result = sqlsrv_query($db, $query);
//$count=sqlsrv_num_rows($result);

if($result === false){
     die( print_r( sqlsrv_errors(), true));
}

// If result matched $username and $password, table row must be 1 row
if(sqlsrv_has_rows($result) != 1){
       echo "User/password not found";
}else{
header("location: welcome.php");
}
}
?>
<form action="login.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />
<label>Password :</label>
<input type="password" name="password"/><br/>
<input type="submit" value=" Login "/><br />
</form>