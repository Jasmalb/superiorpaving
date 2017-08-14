<?php
include("db.php");
session_start();

if(isset($_POST['deleter']))
{
	DeleteRealtor();
}	
function DeleteRealtor() 
{
	include("db.php");
	$user_id = $_POST['user_id'];
		// Create connection
	$query = "DELETE FROM [BrewPoint].[dbo].[tblUsers] WHERE User_ID=?"; 
		// Check connection

	$stmt = sqlsrv_prepare($db, $query, array(&$user_id));
	if( !$stmt ) {
		die( print_r( sqlsrv_errors(), true) );
	}
		
	if( !sqlsrv_execute( $stmt ) ) {
		die( print_r( sqlsrv_errors(), true) );
	}

    return true;
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
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css"rel="stylesheet" type="text/css">
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

<!--<div class="row" style="background-image:url(images/greenbg.png);margin-top:-20px"> -->
	
	<div class="container">
	
	
	<?php

	
	$query = "SELECT * FROM [BrewPoint].[dbo].[tblUsers]";
	$result = sqlsrv_query($db, $query);
	
	echo "<hr><h2  style='margin-top:60px'>Employees</h2><p><a href='registeremployee.php'>Register New Employee</a></p>";

	if (sqlsrv_has_rows($result) > 0) {
		// output data of each row
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

			echo "
			<div class='row'>
			<div class='col-lg-12'>
	        <div class='col-lg-2'style='font-size:14px'><strong>Username: </strong>" . $row["User_ID"]. " </div><div class='col-lg-2'style='font-size:14px'><strong>First Name: </strong>" . $row["FirstName"]. " </div><div class='col-lg-2'style='font-size:14px'><strong>Last Name: </strong>" . $row["LastName"]. " </div>";
			
			echo "	<div class='col-lg-2'><form action='adminpage.php' method='post' onclick='return onDelete();'>
			<input type='hidden' name='user_id' id='user_id' value=".$row["User_ID"]." />
			<input type='hidden' name='deleter' id='deleter' value='1'/>
			<button class='btn btn-primary' type='submit'>Delete</button>	
			</form></div>";
			
			echo "	<div class='col-lg-2'><form action='modifyemployee.php' method='post'>
			<input type='hidden' name='id' id='id' value=".$row["ID"]." />
			<input type='hidden' name='modify' id='modify' value='1'/>
			<button class='btn btn-primary' type='submit'>Modify</button>	
			</form></div></div></div><hr>";
		}
	} else {
		echo "0 results";
	}
	


?>
</div>

</div>
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

<script language="JavaScript">
    function onDelete()
    {
        if(confirm('Are you sure you want to delete that record?')==true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
<!-- InstanceEnd --></html>
