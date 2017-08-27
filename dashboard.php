<?php
//require_once('authenticate.php');
include("db.php");
session_start();



if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
function stringHashing($password,$salt){
 $hashedString=$password.$salt;
 for ($i=0; $i<50; $i++){
  $hashedString=hash('sha512',$password.$hashedString.$salt);
  }
 return $hashedString;
} 

// username and password sent from Form
$username=$_POST['username']; 
$password=$_POST['password']; 

$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers] WHERE User_ID='{$username}'";

$result = sqlsrv_query($db, $query);

if($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	$retrievedHash = stringHashing($password, $row["Salt"]);
}
//$count=sqlsrv_num_rows($result);

if($result === false){
     die( print_r( sqlsrv_errors(), true));
}


// If result matched $username and $password, table row must be 1 row
if($retrievedHash != $row["PasswordHash"]){
       echo "User/password not found";
}else{
header("location: adminpage.php");
}
}
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mainpage.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Superior Paving</title>
<!-- InstanceEndEditable -->
<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
 <div class="logo"><p align="center"><a href="#"><img src="images/superior-logo.png" width="250" height="118" alt="Superior Paving"></a></p></div>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-inverse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
                   <li class="active"><a href="dashboard.php">Home</a></li>
			<li><a href="adminpage.php">Admin</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- InstanceBeginEditable name="mainSection" -->
<div class="container-fluid" style="background-image:url(images/SliderBG1.jpg);margin-top:-20px">
<div class="row">
<div class="col-xs-push-4 col-sm-4 col-xs-pull-4">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="inner cover">
          <div class="well">
            <div id='fg_membersite'>
<h2>Dashboard</h2>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
          </div>
          </div></div>
          </div></div></div>
<!-- InstanceEndEditable -->
<footer class="text-center footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © Superior Paving. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>
