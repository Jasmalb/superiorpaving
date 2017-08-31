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
    <!-- InstanceBeginEditable name="nav" -->
      <ul class="nav navbar-nav">
            <li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="https://brewpoint.superiorpaving.net/dailyplantreports.php">Daily Plant Reports</a></li>
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
<div class="col-xs-push-2 col-sm-8 col-xs-pull-2">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="inner cover">
              <div class="well">
          <div class="col-sm-12">
                <img src="images/banner.jpg" width="100%" height="auto" alt="banner"> 
                <h4 align="center"><label>Company ID</label><select name="Company ID"></select></h4>
          </div>
                <div class="col-sm-4">
                  <a href="#" class="titlelbl"><img src="images/ticketprocesses.jpg" width="59" height="57" alt="Ticket Processing"> Asphalt Ticketing Processing</a>
                  <a href="#" class="titlelbl"><img src="images/fob.jpg" width="60" height="57" alt="Customer FOB orders"> Customer (FOB) Orders</a>
                  <a href="#" class="titlelbl"><img src="images/dailyforeman.jpg" width="60" height="60" alt="daily forman progress"> Daily Foreman Progress</a> 
                  <a href="#" class="titlelbl"><img src="images/dailyjob.jpg" width="58" height="59" alt="Daily job sheets"> Daily Job Sheets</a>
                  <a href="dailyplantreports.php" class="titlelbl"><img src="images/dailyplant.jpg" width="57" height="60" alt="daily plant reports"> Daily Plant Reports</a>
                  <a href="#" class="titlelbl"><img src="images/daily-density.jpg" width="59" height="56" alt="densitytechnicanreports"> Density Technican Reports</a>
                  <a href="#" class="titlelbl"><img src="images/haultime.jpg" width="60" height="59" alt="haultime Dispatch">HaulTime Dispatch</a>
                </div>
                  <div class="col-sm-4">
                 <a href="#" class="titlelbl"><img src="images/haultiminsp.jpg" width="61" height="59" alt="haultime insp"> HaulTime Insp. Rpts</a>
                 <a href="#" class="titlelbl"><img src="images/jobstreeplanner.jpg" width="60" height="57" alt="Customer FOB orders"> Job Sheet Planner</a>
                 <a href="#" class="titlelbl"><img src="images/longhaultimestatus.jpg" width="60" height="60" alt="daily forman progress"> LowHaulTime Dispatch</a>
                 <a href="#" class="titlelbl"><img src="images/lowhaultimestatus.jpg" width="58" height="59" alt="Daily job sheets"> LowHaulTime Status</a>
                 <a href="#" class="titlelbl"><img src="images/maintainanceposting.jpg" width="57" height="60" alt="daily plant reports"> Maintenance Posting</a>
                 <a href="#" class="titlelbl"><img src="images/orderstatus.jpg" width="59" height="56" alt="density technican reports"> Order Status</a>
                 <a href="#" class="titlelbl"><img src="images/process-job.jpg" width="60" height="59" alt="haultime Dispatch"> Process Job</a>
                 </div>
                <div class="col-sm-4">
                 <a href="#" class="titlelbl"><img src="images/purchaseorder.jpg" width="59" height="57" alt="Ticket Processing"> Purchase Orders</a>
                 <a href="#" class="titlelbl"><img src="images/reports.jpg" width="60" height="57" alt="Customer FOB orders"> Reports</a>
                 <a href="#" class="titlelbl"><img src="images/safetychecklist.jpg" width="60" height="60" alt="daily forman progress"> Safety Checklist</a>
                 <a href="#" class="titlelbl"><img src="images/scoreboard.jpg" width="58" height="59" alt="Daily job sheets"> Scoreboard</a>
                 <a href="#" class="titlelbl"><img src="images/setup.jpg" width="57" height="60" alt="daily plant reports"> Setup</a>
                 <a href="#" class="titlelbl"><img src="images/ticketsearch.jpg" width="59" height="56" alt="density technican reports"> Ticket Search</a>
                 <a href="#" class="titlelbl"><img src="images/weightmaster.jpg" width="60" height="59" alt="haultime Dispatch"> Weighmaster Summary</a>
                </div>
       </div>
    </div>
</div>
</div>
</div>
</div>
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
