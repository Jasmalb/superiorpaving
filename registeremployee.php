<?php
include("db.php");
require_once("./helperfunctions.php");

session_start();

$errors = array(); 


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $passwordd = isset($_POST['passwordd']) ? $_POST['passwordd'] : null;
	
	if(strlen(trim($user_id)) === 0){
        //username validation
        $errors[] = "You must enter a User ID!";
    }
	
	if(strlen(trim($password)) === 0){
        //password validation
        $errors[] = "You must enter a password!";
    }

	if(strlen(trim($passwordd)) === 0){
        //confirm password validation
        $errors[] = "You must repeat your password to confirm!";
    }
	
if($password != $passwordd)
{
	//validation to see if the passwords are the same
    $errors[] = "The password and repeat password fields must match!";
}

include 'db.php';

if(empty($errors)){


$iv = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
var_dump($iv);

// username and password sent from Form
$user_id=$_POST['user_id']; 
$lastcompany=$_POST['lastcompany'];
$firstname=$_POST['firstname']; 
$lastname=$_POST['lastname']; 
$emailaddress=$_POST['emailaddress']; 
$phonenumber=$_POST['phonenumber']; 
$company_id=$_POST['company_id']; 
$lastforemanset=$_POST['lastforemanset']; 
$region_id=$_POST['region_id']; 
$lastplantset=$_POST['lastplantset']; 
$emailpassword=$_POST['emailpassword']; 
$password=$_POST['password'];  

$hashpass = stringHashing($password, $iv);
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
		   (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, CONVERT(varbinary(MAX),HASHBYTES(?, ? + ?)), ?)";
		   
$params = array($user_id, $lastcompany, $firstname, $lastname, $emailaddress, $phonenumber, 
		$company_id, $lastforemanset, $region_id, $lastplantset, $emailpassword, 'SHA2_512', $password, $iv, $iv); 
		   

if (!sqlsrv_query($db, $query, $params))
{
	die( print_r( sqlsrv_errors(), true));
} else {
	header("location: adminpage.php");
}
}
}

function stringHashing($password,$salt){
 $hashedString=$password.$salt;
 for ($i=0; $i<50; $i++){
  $hashedString=hash('sha512',$password.$hashedString.$salt);
  }
 return $hashedString;
}  



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>41 Photograpy</title>
	
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css"rel="stylesheet" type="text/css">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	
	<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
             <li class="active"><a href="adminpage.php">Home</a></li>
			<li><a href="registeremployee.php">Register Employee</a></li>
			<li><a href="logout.php">logout</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="row" style="background-image:url(images/greenbg.png);margin-top:-20px"> 	
    
<div class="modal-content" style="margin-top:75px;margin-bottom:150px;">
    <div class="modal-header">
      <h2 class="modal-title" id="myModalLabel">Register Employee Login</h2>
      <img src="images/photologo.png" alt=""></div>
    <div class="modal-body">
	<!-- Form Code Start -->
    
<form class="form-horizontal" id='register' action='registeremployee.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'><?php 
if(!empty($errors)){ 
    echo '<h1>Error(s)!</h1>';
    foreach($errors as $errorMessage){
        echo $errorMessage . '<br>';
    }
} 
?><p>* required fields</p></div>

<div><span class='error'></span></div>




<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastcompany' >Last Company Number: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastcompany' id='lastcompany' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='firstname' >First Name: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='firstname' id='firstname' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastname' >Last Name: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastname' id='lastname' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='emailaddress' >Email Address:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='emailaddress' id='emailaddress' value='' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='phonenumber' >Phone Number: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='phonenumber' id='phonenumber' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='company_id' >Company ID: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='company_id' id='company_id' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastforemanset' >Last Foreman Set: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastforemanset' id='lastforemanset' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='region_id' >Region ID: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='region_id' id='region_id' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastplantset' >last Plant Set:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastplantset' id='lastplantset' value='' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='emailpassword' >Enmail Password:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='emailpassword' id='emailpassword' value='' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='user_id' >User ID*: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='user_id' id='user_id' value='' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='password' >Password*:</label>
    <div class='col-sm-7'>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <input class='form-control' type='password' name='password' id='password' maxlength="50" />
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='passwordd' >Repeat Password*:</label>
    <div class='col-sm-7'>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <input class='form-control' type='passwordd' name='passwordd' id='passwordd' maxlength="50" />
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
    </div>
</div>

<div class='modal-footer'> <a href='adminpage.php'>
            <button type='button' class='btn btn-default'>Close</button>
            </a>
    <input type='submit' name='Submit' value='Submit' class='btn btn-primary'/>
</div>

</fieldset>
</form>
</div>
</div>
</div>


<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com -->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    //frmvalidator.addValidation("name","req","Please provide your name");

    //frmvalidator.addValidation("email","req","Please provide your email address");

    //frmvalidator.addValidation("email","email","Please provide a valid email address");
	
	//frmvalidator.addValidation("address","req","Please provide your Address");
	
	//frmvalidator.addValidation("dob","req","Please provide your Date of Birth");
	
	//frmvalidator.addValidation("phone","req","Please provide your Phone Number");
	
	//frmvalidator.addValidation("dlnumber","req","Please provide your Driver License Number");
	
	//frmvalidator.addValidation("confelon","req","Please answer the convicted felon question");
	
	//frmvalidator.addValidation("econtact","req","Please provide an emergency contact");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");

 ]]>
</script> 
-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>

</body>
</html>