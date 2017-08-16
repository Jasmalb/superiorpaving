<?php
include("db.php");
session_start();

function stringHashing($password,$salt){
 $hashedString=$password.$salt;
 for ($i=0; $i<50; $i++){
  $hashedString=hash('sha512',$password.$hashedString.$salt);
  }
 return $hashedString;
}

$id = $_POST['id'];

$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers] WHERE ID='{$id}'";

$result = sqlsrv_query($db, $query);

if($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
	$id=$row['ID']; 
	$user_id=$row['User_ID']; 
	$lastcompany=$row['LastCompany'];
	$firstname=$row['FirstName']; 
	$lastname=$row['LastName']; 
	$emailaddress=$row['EmailAddress']; 
	$phonenumber=$row['PhoneNumber']; 
	$company_id=$row['Company_ID']; 
	$lastforemanset=$row['LastForemanSet']; 
	$region_id=$row['Region_ID']; 
	$lastplantset=$row['LastPlantSet']; 
	$emailpassword=$row['EmailPassword']; 
	$salt=$row['Salt'];

}


if($result === false){
     die( print_r( sqlsrv_errors(), true));
}


if(isset($_POST['Submit']))
{


$iv = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
//var_dump($iv);

// username and password sent from Form
$id = $_POST['id'];
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

$query = "UPDATE [BrewPoint].[dbo].[tblUsers]
			SET User_ID = ?
		   , LastCompany = ?
           , FirstName = ?
           , LastName = ?
           , EmailAddress = ?
           , PhoneNumber = ?
           , Company_ID = ?
           , LastForemanSet = ?
           , Region_ID = ?
           , LastPlantSet = ?
           , EmailPassword = ?
		   , PasswordHash = CONVERT(varbinary(MAX),?)
		   , Salt = ?
		   WHERE ID = ?";
		   

$stmt = sqlsrv_prepare($db, $query, array( &$user_id, &$lastcompany, &$firstname, &$lastname, &$emailaddress, 
	&$phonenumber, &$company_id, &$lastforemanset, &$region_id, &$lastplantset, &$emailpassword, &$hashpass, $iv, &$id));
		   
if( !sqlsrv_execute( $stmt ) ) {
	die( print_r( sqlsrv_errors(), true) );
} else {
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
<title>Modify Employee</title>
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
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- InstanceBeginEditable name="mainSection" -->

<div class="container">
  <div class="row mainbg">
    <div class="text-center col-sm-12">
    <div class="modal-content" style="margin-top:75px;margin-bottom:150px;">
    <div class="modal-header">
      <h2 class="modal-title" id="myModalLabel">Modify Employee Records</h2>
      <img src="images/photologo.png" alt=""></div>
    <div class="modal-body">
	<!-- Form Code Start -->
    
<form class="form-horizontal" id='register' action='modifyemployee.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Employee</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'></span></div>


<div class='form-group'>
    <label class='col-sm-5 control-label' for='id' >ID Number: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='id' id='id' value='<?= $id ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastcompany' >Last Company Number: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastcompany' id='lastcompany' value='<?= $lastcompany ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='firstname' >First Name: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='firstname' id='firstname' value='<?= $firstname ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastname' >Last Name: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastname' id='lastname' value='<?= $lastname ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='emailaddress' >Email Address:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='emailaddress' id='emailaddress' value='<?= $emailaddress ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='phonenumber' >Phone Number: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='phonenumber' id='phonenumber' value='<?= $phonenumber ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='company_id' >Company ID: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='company_id' id='company_id' value='<?= $company_id ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastforemanset' >Last Foreman Set: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastforemanset' id='lastforemanset' value='<?= $lastforemanset ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='region_id' >Region ID: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='region_id' id='region_id' value='<?= $region_id ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='lastplantset' >last Plant Set:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='lastplantset' id='lastplantset' value='<?= $lastplantset ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='emailpassword' >Enmail Password:</label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='emailpassword' id='emailpassword' value='<?= $emailpassword ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='user_id' >User ID: </label>
    <div class='col-sm-7'>
    <input class='form-control' type='text' name='user_id' id='user_id' value='<?= $user_id ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
    </div>
</div>

<div class='form-group'>
    <label class='col-sm-5 control-label' for='password' >New Password(Required):</label>
    <div class='col-sm-7'>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <input class='form-control' type='password' name='password' id='password' maxlength="50" />
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
    </div>
</div>




<div class='modal-footer'> <a href='index.php'>
            <button type='button' class='btn btn-default'>Close</button>
            </a>
    <input type='submit' name='Submit' value='Submit' class='btn btn-primary'/>
</div>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>

</fieldset>
</form>
</div>
</div>
</div>

</div>
</div>
</div>
<hr>
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
