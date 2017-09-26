 <?php
session_start();

if (isset($_SESSION['logged'])) {

   header("Content-type: text/plain");
   $date = date("l jS \of F Y h:i:s A");
   $filename = $date . ".html";

   header("Content-Disposition: attachment; filename=" . $filename);

   // do your Db stuff here to get the content into $content
  ?>

<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href="http://atomr.net/Atomr/css/bootstrap.min.css" rel="stylesheet">
<link href="http://atomr.net/Atomr/css/styles.css" rel="stylesheet">

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Atomr</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script>
$(document).ready(function(){
  $("button").click(function(){

window.location.replace("http://atomr.net/Atomr/migration.php?start=".&_SESSION['atomstart'] ."&end=". $_SESSION['atomend']);

  });
});
</script>
</head>

<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Atomr</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"></i><?php echo $_SESSION['account_id'];?><span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li class="pad">Status: <?php echo $_SESSION['accountstatus']; ?></li>
           <li class="pad">ID: <?php echo $_SESSION['account_id']; ?></li>
           <li class="pad">Expire: <?php echo $_SESSION['accountexpire']; ?></li>
           <li class="pad">Support: <?php echo $_SESSION['supportlevel']; ?></li>
           <hr>
            <li><a href="core/out.php">Logout</a></li>
          </ul>
        </li>
    
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
<div class="row">
  <div class="col-md-3">
      <!-- Left column -->
      <strong>Migration Information</strong>
      <hr>
      <ul class="nav nav-stacked">
        <div class="panel panel-primary">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Start & End Points</h4>
                        </div>
                  </div>
                  <div class="panel-body">
                    <b>Start:</b> <?php echo $_SESSION['atomstart']; ?>
                    <hr>
                     <b>End:</b> <?php echo $_SESSION['atomend']; ?>
     
                     <center>
                      
                  </div>
        </div>
      </ul>

          </div><!-- /col-3 -->

    <div class="col-md-9">
     <strong><?php echo $_SESSION['name']; ?> - DashBoard</strong>
        <hr>

         <div class="panel panel-default">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Migration</h4>
                        </div>
                  </div>
                  <div class="panel-body">
             
                      <h3>This is a total migration from the start to the endpoint atom, when you hit the run button everything from the start atom will shift to the end atom including processes and schedules.</h3>
                             <center>
                              <br>
                      <hr>
                       <button type="submit" name="button" value="download" class="btn btn-success btn-block">Run Migration</button>
                    </center>
                  </div>
        </div>

    </div>
    </div><!--/row-->
      
 
      
</div>
</div>
</div>
<!-- /Main -->

<div class="container">
<br>
<br>
<hr>
</div>
<footer class="text-center">This application is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>



<br>
<br>



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="http://atomr.net/Atomr/js/bootstrap.min.js"></script>
</body>
</html>




<?php

}else{
    header('Location: index.php');
}
?>