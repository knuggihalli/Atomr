

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Atomr</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="/Atomr/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="/Atomr/css/styles.css" rel="stylesheet">
    <style type="text/css">
    input{
      float: right;
    } 
    button{
      float: right;
    }
    .pad{
      padding: 10px;
    }
       .breaker{
      width: 100%;
      height: 125px;
    }

pre {
  padding: 0.1em 0.5em 0.3em 0.7em;
  border-left: 11px solid #ccc;
  margin: 1.7em 0 1.7em 0.3em;
  overflow: auto;
  }
    </style>
  </head>
  <body>
<!-- Header -->





<nav class="navbar navbar-fixed-top header">
  <div class="col-md-12">
        <div class="navbar-header">
          
          <a href="/Atomr/index.php" class="navbar-brand">ATOMR</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1">
          <i class="glyphicon glyphicon-search"></i>
          </button>
      
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse1">
          <form class="navbar-form pull-left">
              <div class="input-group" style="max-width:470px;">
                <input type="text" class="form-control" placeholder="Search Help Documents" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
             <li><a href="#" id="btnToggle"><i class="glyphicon glyphicon-th-large"></i></a></li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                <ul class="dropdown-menu">
           <li class="pad">Status: <?php echo $_SESSION['accountstatus']; ?></li>
           <li class="pad">ID: <br><?php echo $_SESSION['account_id']; ?></li>
           <li class="pad">Expire:<br> <?php echo $_SESSION['accountexpire']; ?></li>
           <li class="pad">Support: <?php echo $_SESSION['supportlevel']; ?></li>
           <hr>
           <li><a href="/Atomr/core/out.php">Logout</a></li>
                </ul>
             </li>
           </ul>
        </div>  
     </div> 
</nav>




<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
        <div class="navbar-header">
          
          <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Dashboard <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
          <ul class="nav dropdown-menu">
              <li><a href="/Atomr/main.php"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Dashboard</a></li>
              <li><a href="/Atomr/atoms.php"><i class="glyphicon glyphicon-dashboard" style="color:#0000aa;"></i> Atoms</a></li>
              <li><a href="/Atomr/process.php"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Process/Schedules</a></li>
              <li class="nav-divider"></li>
              <li><a href="#"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Module Store</a></li>
          </ul>
          
          
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
      
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse2">
          <ul class="nav navbar-nav navbar-right">
             <li class="active"><a href="#">Process Migration &nbsp;&nbsp;<span class="glyphicon glyphicon-random"></span></a></li>
             <li><a href="#loginModal" role="button" data-toggle="modal">Quick Help</a></li>
             <li><a href="#aboutModal" role="button" data-toggle="modal">About</a></li>
           </ul>
        </div>  
     </div> 
</div>



<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <center><h4><br>Process Migration - Step 1</h4></center>
      <div class="modal-body">
          <p>Plese select the startpoint for where process should be copied from.</p>
      </div>
      <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
      </div>
  </div>
  </div>
</div>




<!--about modal-->
<div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="text-center">About</h2>
      </div>
      <div class="modal-body">
          <p>Make managing integration proceesses on Atomsphere simple with Atomr and migration. Sign in securly with Dell Boomi and manage Atoms, Processes, and Schedules. Choose what processes and schedules you want to migrate. The easy to look at UI will manage the hardwork allowing you to focus on your buisness and its integration</p>
      </div>
      <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
      </div>
  </div>
  </div>
</div>







<div class="breaker">
</div>
