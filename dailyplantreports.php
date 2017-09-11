<?php
include("db.php");
session_start();


function checkforrecord()
{
	$dateSelect=$_POST['dateselect']; 
	$plantSelect=$_POST['plantselect'];
	$shiftSelect=$_POST['shiftselect'];
	echo "$dateSelect $plantSelect $shiftSelect";
}

if(array_key_exists('test',$_POST)){
   checkforrecord();
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
<title>Daily Plant Reports</title>
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
<link rel="stylesheet" href="css/jquery-ui.css">
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  jQuery( function() {
    jQuery( "#datepicker" ).datepicker();
  } );
  </script>
  <style>
  .accordion-toggle:hover {
      text-decoration: none;
    }
  </style>
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
<div class="container-fluid toolbg">
<div class="row">
<div class="col-xs-push-2 col-sm-8 col-xs-pull-2">
        <div class="cover-container">
          <div class="inner cover">
          <div class="col-sm-12 dailyplantrep">
          <div class="col-sm-3">
		  <form method="post">
               <p class="gold"><label>Go to Date:  </label><input type="text" name="dateselect" value="01/01/2017" id="datepicker"></p>
			   <p class="gold"><label>Plant:  </label>
				<?php
				$query = "SELECT * FROM [BrewPoint].[dbo].[tblDeliveryLocations]";
				$result = sqlsrv_query($db, $query);
				
				if (sqlsrv_has_rows($result) > 0) {
				// output data of each row
				echo "<select name='plantselect'>";
					while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
						
						echo "<option value=" . $row["LocationDescription"]. ">" . $row["LocationName"]. "</option>";
						
						
					}
				echo "</select></p>";
				}
                  ?>     
               <p class="gold"><label>Shift:  </label>
			   <select name="shiftselect">
			   <option value="Day">Day</option>
			   <option value="Night">Night</option>
			   </select></p>
          </div>
               <div class="col-sm-2">
			   
				<input type="submit" class="bg-primary" name="test" id="test" value="Go To Record" /><br/>
				</form>
               </div>
               <div class="col-sm-7">
               </div>
          </div>
              <div class="container-fluid gray">
                <div class="col-sm-12">
<script>
$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
</script>
 <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span class="glyphicon glyphicon-plus"></span> AGG Materials</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2"><span class="glyphicon glyphicon-plus"></span> Job Sales</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
 <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3"><span class="glyphicon glyphicon-plus"></span> FOB Sales</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4"><span class="glyphicon glyphicon-plus"></span> Other Sales</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5"><span class="glyphicon glyphicon-plus"></span> Rap/Waste</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6"><span class="glyphicon glyphicon-plus"></span> Start/Stop Times</a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7"><span class="glyphicon glyphicon-plus"></span> Inv. Transfers</a>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8"><span class="glyphicon glyphicon-plus"></span> Notes</a>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9"><span class="glyphicon glyphicon-plus"></span> Time & Temp</a>
        </h4>
      </div>
      <div id="collapse9" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
   <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse10"><span class="glyphicon glyphicon-plus"></span> Daily Summary</a>
        </h4>
      </div>
      <div id="collapse10" class="panel-collapse collapse">
        <div class="panel-body">Panel Body</div>
        <div class="panel-footer">Panel Footer</div>
      </div>
    </div>
  </div>
                </div>
       </div>
       <div class="col-sm-12" style="background-color:#000;margin-bottom:15px">
        <div class="col-sm-4"> <a href="#"><img src="images/backbook.png" width="82" height="82" alt="Back Button"></a></div> 
        <div class="col-sm-3">
          <a href="#"><img src="images/rewindall.png" width="44" height="82" alt="rewind all"></a>
          <a href="#"><img src="images/rewind.png" width="46" height="82" alt="backwards"></a>
          <a href="#"><img src="images/forward.png" width="46" height="82" alt="forward"></a>
          <a href="#"><img src="images/forwardall.png" width="48" height="82" alt="forward all"></a>
          </div>
          <div class="col-sm-3">
          <a href="#"><img src="images/email.png" width="82" height="82" alt="email"></a>
          <a href="#"><img src="images/search.png" width="80" height="82" alt="search"></a>
          <a href="#"><img src="images/trash.png" width="80" height="82" alt="trash"></a>
          </div>
        <div class="col-sm-2">
        </div>
        </div>
</div>
</div>
</div>
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
<!-- InstanceBeginEditable name="script" -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--<script src="js/jquery-1.11.3.min.js"></script>--> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
