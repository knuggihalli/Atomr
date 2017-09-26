 <?php
include 'init.php';

if (isset($_SESSION['logged'])) {
  if (isset($_POST['option'])) {
    $_SESSION['option'] = $_POST['option'];
  }

}else{//End of the first if statement checking logged
  header('Location: /Atomr/index.php');
} 

?>
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
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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

    </style>
  </head>
  <body>
    <?php   
  
       echo '<script type="text/javascript">';
      echo 'var post_datas = '. "'" . $_SESSION['val'] . "'" . ';';
      echo '</script>';
    ?> 

    <script type="text/javascript">
    $('#loading_spinner').show();
  
    var post_data = "my_variable="+post_datas;

$.ajax({
    url: 'migratep.php',
    type: 'POST',
    data: post_data,
    dataType: 'html',
    success: function(data) {
//Moved the hide event so it waits to run until the prior event completes
//It hide the spinner immediately, without waiting, until I moved it here
        $('#loading_spinner').hide();
        $('#1').hide();
        $('#2').hide();
        window.location.replace("migratep.php");
        alert("PROCESS MIGRATION SUCCESSFUL");
    },
    error: function() {
        alert("Oops it seems something went wrong...");
    }
});
</script>





<div class="my_update_panel"></div>

<p class="listprice"></p>

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

    button{
      float: right;
    }
    .left{
      float: left;
    }

     .pad{
      padding: 10px;
    }
        .breaker{
      width: 100%;
      height: 125px;
    }

    </style>
  </head>
  <body>
   


<nav class="navbar navbar-fixed-top header">
  <div class="col-md-12">
        <div class="navbar-header">
          
          <a href="main.php" class="navbar-brand">ATOMR</a>
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
           <li><a href="core/out.php">Logout</a></li>
                </ul>
             </li>
           </ul>
        </div>  
     </div> 
</nav>




<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <center><h4><br>Total Atom Migration- Step 2</h4></center>
      <div class="modal-body">
          <p>At this step you will be selecting your end point atom. This is the destination atom it is where all the data from the start point atom will travel. </p>
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


<!-- Main -->
<div class="container">
        <div class="alert alert-info alert-dismissable" id="loading_spinner">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Heads up!</strong> Your ATOMR Migration has been deployed please make sure your internet connection is stable and <u>DO NOT CLOSE THE TAB OR THE BROWSER</u>
          </div>

<div class="row">
  <div class="col-md-3">
      <!-- Left column -->

    </div><!-- /col-3 -->

    <div class="col-md-9">

    <div class="col-md-8" align="left">
   

      <div class="panel panel-success" id="1">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4>Migration Session Deployed - Loading...</h4></center>
                        </div>
                  </div>
            
        </div>
              


      <div class="panel panel-default" id="2">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                  <script type="text/javascript">
                  function toggle(source) {
  checkboxes = document.getElementsByName('process[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>


                        <h4>Migration Map -</h4>
                        </div>
                  </div>
                  <div class="panel-body">
                    <div class="row">
                    <div class="col-xs-4"><center><h2><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp <?php if (isset($_SESSION['Environment'])){
                       echo $_SESSION['envstartname'];
                    

                    }else{
                   echo $_SESSION['atomstart'];
                    
                     } ?></h2></center></div>
                     <div class="col-xs-4"><br><br><center> <img id="loading_spinner" src="migrate.gif" width="100%"/> </center></div>
                      <div class="col-xs-4"><h2><?php  if (isset($_SESSION['Environment'])){
                    
                    echo $_SESSION['envendname']; 

                    }else{
                    
                    echo $_SESSION['atomend']; 
                     } ?> &nbsp<span class="glyphicon glyphicon-cloud-download"></span> </h2></div>

                  </div>
                    <hr>

         <a href="/Atomr/main.php"> <button name="answer" value='2' class="right btn btn-danger btn-block">Exit / Cancel</button></a>
     
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                      
                    </div>
    </div>
    </div><!--/row-->
      
 
      
</div>
</div>
</div>
<!-- /Main -->

<br>
<br>
<br>
<footer id="loading_spinner" class="text-center">This platform is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>














