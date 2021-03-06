<?php
include("db.php");
//require_once('authenticate.php');


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
$salt = null;

$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers] WHERE User_ID='{$username}'";

$result = sqlsrv_query($db, $query);

if($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	$salt=$row["Salt"];
}
//$count=sqlsrv_num_rows($result);

$query2 = "SELECT * FROM [BrewPoint].[dbo].[tblUsers] WHERE PasswordHash=HASHBYTES(?, ? + ?)";
$params = array('SHA2_512', $password, $salt); 
$result2 = sqlsrv_query($db, $query2, $params);

if($row2 = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC)) {
	$retrievedHash = "valid";
} else {
	$retrievedHash = "invalid";
}

if($result === false){
    die( print_r( sqlsrv_errors(), true));
}


// If result matched $username and $password, table row must be 1 row
if($retrievedHash === "invalid"){
		echo "User/password not found";      
} else
{
	session_start();
	$_SESSION["authenticated"] = 'true';
header("location: dashboard.php");
exit;
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
    <!-- InstanceBeginEditable name="nav" -->
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
      <!-- InstanceEndEditable -->
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- InstanceBeginEditable name="mainSection" -->
<div class="container-fluid bg">
<div class="row">
<div class="col-xs-push-4 col-sm-4 col-xs-pull-4">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="inner cover">
          <div class="well">
            <div id='fg_membersite'>
<form class='form-horizontal' id='login' action='index.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'></span></div>
<div class='form-group'>
    <label class='col-sm-5 control-label' for='username' >UserName*:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='username' id='username' value='' maxlength="50" />
    <span id='login_username_errorloc' class='error'></span>
</div>
</div>
<div class='form-group'>
    <label class='col-sm-5 control-label' for='password' >Password*:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='password' name='password' id='password' maxlength="50" />
    <span id='login_password_errorloc' class='error'></span>
</div>
</div>
<input type='hidden' name='CSRFtoken' value='135c6b2ebca27bfccd94498ffd8c62e7d712e9c6c17ef58d2e433ede28a042fdb0d85665f3171b83df0a045a881e9a0925665e4526d0b9bc9bf909f75454503d' />
<?php 
if (isset($retrievedHash)) {
	if ($retrievedHash == 'invalid') {
		echo "Username and Password combination ";
	} else {
	}	
} else {
}
?>
<div class='modal-footer'>
    <input type='submit' name='Submit' value='Submit' class='btn btn-success' />
</div>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
</fieldset>
</form>
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
<!-- InstanceBeginEditable name="script" -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
