<?php
include "core/init.php";
if (isset($_SESSION['logged'])) {
 header('Location: main.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Atomr</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]> 
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		
    <style type="text/css">
			  body {
          display: table;
          height: 100%;
          width: 100%;
          position: relative;
          background: url("img/main.jpg") no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          background-color:#fff;
          z-index:-10;
        } 

      .white{ 
        text-decoration: none !important;
        color: #fff;
      }
      .color{
        color: #428bca;
      }
      #modal-dialog{
        background: #f2fafd;
      }

		</style>
	</head>

<body>
<!--login modal-->
<br>
<br>
<br>
<br>
<div class="container">
	<div class="row">



    <div id="loginModal" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="display: block;">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h2 class="text-center"><img src="img/logo.png" class="img-circle"><br>ATOMR</h2>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="core/api.php" method="post">
             <div class="form-group">
              <input type="text" class="form-control input-lg" name="url" placeholder="AccountID">
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-lg" name="username" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <br>
              <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <a href="/index.html"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></a>
      </div>  
      </div>
  </div>
  </div>
</div>

 

	
<div class="col-sm-4">
</div>
       <div class="col-sm-4">
          <div class="panel panel-primary">
                  <div class="panel-heading">
                        <div class="panel-title">
                  <center>
                        <a href="/index.html"><h2>Atomr</h2></a></center>
                        </div>
                  </div>
                  <div class="panel-body">
	<form action="core/api.php" method="post" class="form col-md-12 center-block">
            <div class="form-group">
              <input type="text" class="form-control input-lg" name="url" placeholder="Account ID">
            </div>
            <hr>
             <div class="form-group">
              <input type="text" class="form-control input-lg" name="username" placeholder="Username">
            </div>
             <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
            <div class="form-group">
            <br>
            <center>
              <button class="btn btn-primary btn-lg btn-block">Enter</button></center>
              <br>
              <br>
             <span><a class="color" href="/Atomr/pages/about.php">New To Atomr?</a></span>
            </div>
          </form>

                  </div>
        </div>
	</div>
</div>

<div class="col-sm-4"></div>


</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>
	<center><footer><a class="white" href="http://www.boomi.com">Dell Boomi |</a><a  class="white" href="pages/about.php"> About Atomr |</a><a class="white" href="http://www.considercode.com"> ConsiderCode</a></footer></center>

</html>