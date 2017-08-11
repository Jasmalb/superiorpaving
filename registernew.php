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
$hashpass = stringHashing("test", "test");
$query = "INSERT INTO [BrewPoint].[dbo].[tblUsers]
			(User_ID
           ,LastCompany
           ,FirstName
           ,LastName
           ,EmailAddress
           ,PhoneNumber
           ,Company_ID
           ,LastForemanSet
           ,Region_ID
           ,LastPlantSet
           ,EmailPassword
           ,PasswordHash
           ,Salt) VALUES
		   (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, CONVERT(varbinary(MAX),?), ?)";
		   
$params = array('test', 5, 'test', 'test', 'test', 'test', '5', 'test', 5, 'test', 'test', $hashpass, 'test'); 
		   
//$sql="SELECT id FROM tblUsers WHERE username='$username' and passcode='$password'";
if (!sqlsrv_query($db, $query, $params))
{
	die( print_r( sqlsrv_errors(), true));
}
//$count=sqlsrv_num_rows($result);
/*
if($result === false){
     die( print_r( sqlsrv_errors(), true));
}
*/
// If result matched $username and $password, table row must be 1 row
/*if(sqlsrv_has_rows($result) != 1){
       echo "User/password not found";
}else{
header("location: welcome.php");
}
*/
}

function stringHashing($password,$salt){
 $hashedString=$password.$salt;
 for ($i=0; $i<50; $i++){
  $hashedString=hash('sha512',$password.$hashedString.$salt);
  }
 return $hashedString;
}  

?>
<form action="registernew.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />
<label>Password :</label>
<input type="password" name="password"/><br/>
<input type="submit" value=" Login "/><br />
</form>