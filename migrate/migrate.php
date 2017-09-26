<?php
include 'init.php';

if (isset($_SESSION['logged'])) {
if (isset($_POST['atomstart']) && isset($_POST['atomend']) && empty($_SESSION['Environment'])) {
  if (isset($_POST['button'])) {
    if ($_POST['button'] == 'download') {
      # code for if downloading file
      if ($_POST['atomstart'] == $_POST['atomend']) {
      header('Location: /Atomr/migrate/index.php?cmt=Your start and end atoms have to be different');
    }else{
    $_SESSION['atomend'] = $_POST['atomend'];
    $_SESSION['atomstart'] = $_POST['atomstart']; 

    header('Location: /Atomr/migrate/file.php');

    }
     # End of code for downloading migration file
    }else{
    if ($_POST['atomstart'] == $_POST['atomend']) {
      header('Location: /Atomr/migrate/index.php?cmt=Your start and end atoms have to be different');
    }else{

    //Get all processes off of atom
    $_SESSION['atomend'] = $_POST['atomend'];
    $_SESSION['atomstart'] = $_POST['atomstart'];  
    $process = get_process($_SESSION['atomstart'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);  

    //save all process ids
    $processresults = $process[0]['attributes']['NUMBEROFRESULTS'];
    $pids = 0;

    for ($i=1; $i<$processresults+1; $i++) { 
      $pids= $pids . '*' . $process[$i]['attributes']['PROCESSID'];
    }

    $ids = explode('*', $pids);
    $amount = count($ids);

    //Migrate All processess into new atom
    $_SESSION['proc'] = 0;
    for ($x=1; $x<$amount; $x++) { 
      $_SESSION['proc'] = $_SESSION['proc'] ."*". $ids[$x];
      $migratep = migrate_process($ids[$x],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);
    }

    //Start Migrating Schedules
    if ($migratep == 1) {
      $sch = migrate_schedules($_SESSION['atomstart'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']); 
    }
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

    </style>
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
      <a class="navbar-brand" href="/Atomr/main.php">Atomr</a>
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
            <li><a href="/Atomr/core/out.php">Logout</a></li>
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

      <hr>
      <div class="panel panel-success">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Migration Licences</h4>
                     

                  
                        </div>
                  </div>
                  <div class="panel-body">

                      <p><b><?php echo $_SESSION['licenses'][2][3]; ?></b><?php echo'&nbsp; - &nbsp;'; 
                      echo '<br>';echo $_SESSION['licenses'][2][13];echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][2][15];
                      echo'<br>';echo $_SESSION['licenses'][2][17]; echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][2][19]; ?></p>
                      <hr>


                      <p><b><?php echo $_SESSION['licenses'][3][3]; ?></b><?php echo'&nbsp; - &nbsp;'; 
                      echo '<br>';echo $_SESSION['licenses'][3][13];echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][3][15];
                      echo'<br>';echo $_SESSION['licenses'][3][17]; echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][3][19]; ?></p>
                      <hr>

                      <p><b><?php echo $_SESSION['licenses'][4][3]; ?></b><?php echo'&nbsp; - &nbsp;'; 
                      echo '<br>';echo $_SESSION['licenses'][4][13];echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][4][15];
                      echo'<br>';echo $_SESSION['licenses'][4][17]; echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][4][19]; ?></p>
                      <hr>

                      <p><b><?php echo $_SESSION['licenses'][5][3]; ?></b><?php echo'&nbsp; - &nbsp;'; 
                      echo '<br>';echo $_SESSION['licenses'][5][13];echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][5][15];
                      echo'<br>';echo $_SESSION['licenses'][5][17]; echo'&nbsp; - &nbsp;';echo $_SESSION['licenses'][5][19]; ?></p>
         

                  </div>
        </div>
    </div><!-- /col-3 -->

    <div class="col-md-9">
     <strong><?php echo $_SESSION['account_id']; ?> - DashBoard</strong>
        <hr>

    <div class="col-md-8" align="left">
   

      <div class="panel panel-success">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4>Process Migration Successful</h4></center>
                        </div>
                  </div>
            
        </div>
              <div class="panel panel-success">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4>Schedule Migration Successful</h4></center>
                        </div>
                  </div>
            
        </div>


      <div class="panel panel-default">
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


                        <h4>Schedules</h4>
                        </div>
                  </div>
                  <div class="panel-body">
                
                <b>Migration Log File Download</u></b>
                <br>
                <br>
                <pre>
                <center><h3><a target="_blank" href="download.php">Download <span class="glyphicon glyphicon-download"></span></a></h3></center>
                </pre>
                <hr>
 
           

               
                


                
                <br>
           
          <form action="delete.php" method="post">
            <center><h3>What would you like to do with the old atom?</h3>
            <br>
            <br>
            <input type="radio" name="answer" value='1'> Delete Atom<br>
            <br>
            <input type="radio" name="answer" value='2'> Nothing, Exit
            <br>
            <br>
            <br>
            <br>
          <button type="submit" class="right btn btn-success">Exit / Finished</button></center>
          </form>
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                      <b><h4>Important Notice -</h4></b>
                      <hr>
                      <p>Remember when using workflow that your licenses might increase. Make sure you contact Dell Boomi and obtain a temporary liscence before using Workflow. <strong>Use at your own risk</strong></p>
                      <br>
                      <a href="#" class="btn btn-success btn-md active" role="button">Order Workflow License</a>
                      <br>
                      <br>
                       <b><h4>Deploying A Process -</h4></b>
                      <hr>
                      <p>In this step you can choose to deploy the moved processes. You do not have to deploy them right away you can always deploy them later on the deploy tab in the main menu.</p>
                      <br>
                      <a href="#" class="btn btn-primary btn-md active" role="button">Need Help?</a>
                      <a href="#" class="btn btn-warning btn-md active" role="button">Found a Bug?</a>
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
<footer class="text-center">This application is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>
















  <? 
  }

  }//end of the else statement after the atom input check
}else{//End of the second if statement
  if (isset($_SESSION['Environment']) && isset($_POST['atomstart']) && isset($_POST['atomend'])) {
    header('Location: /Atomr/migrate/index.php?cmt=These Atoms reside on environments please use the environment migration tool');
  }else{
  header('Location: /Atomr/migrate/index.php?cmt=You need to select both a start and end atom');
  }
}
}else{//End of the first if statement checking logged
  header('Location: /Atomr/index.php');
} 
?>
