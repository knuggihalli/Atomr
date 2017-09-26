<?php
include "core/init.php";
if (isset($_SESSION['logged'])) {


 
}else{
  header('Location: index.php');
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
    <style type="text/css">
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




<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
        <div class="navbar-header">
          
          <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Dashboard <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
          <ul class="nav dropdown-menu">
              <li><a href="main.php"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Dashboard</a></li>
              <li><a href="atoms.php"><i class="glyphicon glyphicon-dashboard" style="color:#0000aa;"></i> Atoms</a></li>
              <li><a href="process.php"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Process/Schedules</a></li>
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
             <li class="active"><a href="#"><?php echo "Account Expires: ". $_SESSION['accountexpire']; ?></a></li>
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
      <center><h4><br>Welcome To Atomr Help</h4></center>
      <div class="modal-body">
          <p>In order to make the Atomr platform simple and intuitive, the folks at ConsiderCode llc have implemented QuickHelp, a tool that you can use while operating on the Atomr platform. QuickHelp is available on every screen of Atomr, it will let you know what to do at your current step of migration. </p>
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
<?php 
    if (isset($_GET['cmt'])) {
      
      ?>



        <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Heads up!</strong> <?php echo $comment; ?>
          </div>

      <?php
    }
    ?>
<style type="text/css">
.red{background: #e74c3c !important;}
.green{background: #2ecc71 !important;}
.test{background: #fff !important;}
.prod{background: #ccc !important;}
.clear{background: transparent!important; border: 0px !important;}
</style>



<div class="row">
  <div class="col-md-2">
       <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Environment</h4>
                        </div>
                  </div>
                  <div class="panel-body"> 
                      <?php
                      //START PUTTING EVERYTHING YOU PUT INTO THE GET AREA LIKE ENVIRONMENT AND ATOM INTO A SESISON
                      //MAKE EVERYTHING IN THIS PROGRAM IN TERMS OF A SESSION
                        $value = get_all_environments($_SESSION['account_id'],$_SESSION['auth']);
                        $amt = $value[0]['attributes']['NUMBEROFRESULTS'];
                        for ($i=1; $i<$amt+1; $i++) { 

                        if ($value[$i]['attributes']['CLASSIFICATION'] == "TEST") {$color = "test";}else{$color = "prod";}
      
                          echo '<form action="" method="get"><div class="panel panel-info '.$color.'"><div class="panel-body"><button class="clear" name="environment" type="submit" value="'.$value[$i]['attributes']['ID'].'">';
                          echo "Name: " . $value[$i]['attributes']['NAME']; echo '<br>';
                          echo "Type: " . $value[$i]['attributes']['CLASSIFICATION']; echo '<br>';
                          echo '</button></div></div></form>';
                        }
                      ?>
                  </div>
        </div>
    </div><!-- /col-2 -->

      <div class="col-md-3">
       <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Atoms</h4>
                        </div>
                  </div>
                  <div class="panel-body"> 
                  <?php
                  if (isset($_GET['environment'])){
                    $envid = $_GET['environment'];
                    $atoms = get_all_atoms($_SESSION['account_id'],$_SESSION['auth'],$envid);
                    $atom_amt = $atoms[0]['attributes']['NUMBEROFRESULTS'];
                    for ($i=1; $i<$atom_amt+1; $i++) { 

                    $selected_atom = atom_data($atoms[$i]['attributes']['ATOMID'],$_SESSION['account_id'],$_SESSION['auth']);
                    if ($selected_atom[0]['attributes']['STATUS'] = "OFFLINE") {$color = "red";}else{$color = "green";}

                    echo '<form action="" method="get"><div class="panel panel-info '.$color.'"><div class="panel-body"><button class="clear" name="atom" type="submit" value="'.$selected_atom[0]['attributes']['ID'].'">';
                    echo "Name: " . $selected_atom[0]['attributes']['NAME']; echo '<br>';
                    echo "Host: " . $selected_atom[0]['attributes']['HOSTNAME']; echo '<br>';
                    echo "Status: " . $selected_atom[0]['attributes']['STATUS']; echo '<br>';
                    echo '<input type="hidden" name="environment" value="'.$atoms[$i]['attributes']['ENVIRONMENTID'].'">';
                    echo '</button></div></div></form>';

                    }
                  }else{
                      echo "You do not have any atoms in this environment";
                    }
                  ?>
                  </div>
        </div>
    </div><!-- /col-2 -->


      <div class="col-md-3">
       <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Process</h4>
                        </div>
                  </div>
                  <div class="panel-body"> 
                  <?php
                    if (isset($_GET['atom'])&& isset($_GET['environment'])) {
                      $envid = $_GET['environment'];
                      $processes = get_all_processes($_SESSION['account_id'],$_SESSION['auth'],$envid);
                      //echo '<pre>';print_r($processes);echo '</pre>';

                      $process_amt = $processes[0]['attributes']['NUMBEROFRESULTS'];
                      for ($i=1; $i<$process_amt+1; $i++) { 
                       
                        $proc_id = $processes[$i]['attributes']['PROCESSID'];

                      
                          echo '<form action="" method="get"><div class="panel panel-info"><div class="panel-body"><button class="clear" name="process" type="submit" value="'.$proc_id.'">';
                        echo $proc_id;echo '<br>'; 
                        echo '<input type="hidden" name="environment" value="'.$_GET['environment'].'">';
                        echo '<input type="hidden" name="atom" value="'.$_GET['atom'].'">';
                    echo '</button></div></div></form>';
                      }

                    }else{
                      echo "You do not have any processes on this atom...";
                    }
                  ?>
                  </div>
        </div>
    </div><!-- /col-3 -->

  <div class="col-md-3">
       <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Schedule</h4>
                        </div>
                  </div>
                  <div class="panel-body"> 
                        <?php
                    if (isset($_GET['atom'])&& isset($_GET['environment'])&& isset($_GET['process'])) {
                      $schedule = get_all_schedules($_SESSION['account_id'],$_SESSION['auth'],$_GET['atom'],$_GET['process']);
                       
                      $num_results = $schedule[0]['attributes']['NUMBEROFRESULTS'];
                      for ($i=1; $i<$num_results+1; $i++) { 
                        if ($schedule[$i]['attributes']['PROCESSID'] == $_GET['process']) {
                           $sch = get_schedule($_SESSION['account_id'],$_SESSION['auth'],$schedule[1]['attributes']['ID']);   
                        if (isset($sch[1]['attributes']['YEARS'])) {
                                echo '<div class="panel panel-info"><div class="panel-body">';
                        echo "YEARS: " . $sch[1]['attributes']['YEARS'] . '<br>';
                        echo "MONTHS: " . $sch[1]['attributes']['MONTHS']. '<br>';
                        echo "DAYSOFMONTH: ". $sch[1]['attributes']['DAYSOFMONTH']. '<br>';
                        echo "DAYSOFWEEK: ". $sch[1]['attributes']['DAYSOFWEEK']. '<br>';
                        echo "HOURS: ". $sch[1]['attributes']['HOURS']. '<br>';
                        echo "MINUTES: ". $sch[1]['attributes']['MINUTES']. '<br>';
                        echo '</div></div>';
                        }else{
                          echo "No scheudles for this process";
                        }
            

                        }else{}
                      }
                    }else{
                      echo "You do not have any processes on this atom...";
                    }
                  ?>
                  </div>
        </div>
    </div><!-- /col-5 -->

    </div>

<div class="container">


  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>