<?php
include("db.php");
session_start();
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
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="requestPhotos.php">Realtor</a></li>
        <li><a href="photographerPage.php">Photographer</a></li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</nav>
	</div></div>
	
	<div class="container">
	
	
	<?php
	//if($adminsite->CheckLogin())
	//{
	$servername = "localhost";
	$username = "forty1";
	$password = "Bxb65HcL!";
	$dbname = "forty1";

	// Create connection
	//$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	//if ($conn->connect_error) {
	//	die("Connection failed: " . $conn->connect_error);
	//} 
	
	$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers]";
	$result = sqlsrv_query($db, $query);
	
	echo "<hr><h2  style='margin-top:60px'>Members</h2><p><a href='registermember.php'>Register New Member</a></p>";

	if (sqlsrv_has_rows($result) > 0) {
		// output data of each row
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

			echo "
			<div class='col-sm-12'>
	        <div class='col-lg-3'style='font-size:13px'><strong>Username: </strong>" . $row["User_ID"]. " </div><div class='col-lg-3'style='font-size:13px'><strong>First Name: </strong>" . $row["FirstName"]. " </div><div class='col-lg-3'style='font-size:13px'><strong>Last Name: </strong>" . $row["LastName"]. " </div>";
			
			echo "	<div class='col-lg-3'><form action='index.php' method='post'>
			<input type='hidden' name='iduser' id='iduser' value=".$row["User_ID"]." />
			<input type='hidden' name='deleter' id='deleter' value='1'/>
			<button class='btn btn-primary' type='submit'>Delete</button>	
			</form></div></div>";
		}
	} else {
		echo "0 results";
	}
	


?>


</div></div>
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
