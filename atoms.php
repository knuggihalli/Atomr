<?php
include "core/init.php";
if (isset($_SESSION['logged'])) {

$eurl = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Environment/query" ;
$testxml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression" 
       operator="EQUALS" property="classification">
       <argument>TEST</argument>
    </expression>
  </QueryFilter>
</QueryConfig>';
$prodxml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression" 
       operator="EQUALS" property="classification">
       <argument>PROD</argument>
    </expression>
  </QueryFilter>
</QueryConfig>';

$ech = curl_init($eurl);
 
curl_setopt($ech, CURLOPT_POST, 1);
curl_setopt($ech, CURLOPT_POSTFIELDS, $prodxml);
curl_setopt($ech, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ech,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
 
$eresp = curl_exec($ech);
curl_close($ech);


$ep = xml_parser_create();
xml_parse_into_struct($ep, $eresp, $evals, $eindex);
xml_parser_free($ep);

$tch = curl_init($eurl);
 
curl_setopt($tch, CURLOPT_POST, 1);
curl_setopt($tch, CURLOPT_POSTFIELDS, $testxml);
curl_setopt($tch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($tch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
 
$tresp = curl_exec($tch);
curl_close($tch);


$tp = xml_parser_create();
xml_parse_into_struct($tp, $tresp, $tvals, $tindex);
xml_parser_free($tp);



$eresults = $evals[0]['attributes']['NUMBEROFRESULTS'];
$tresults = $tvals[0]['attributes']['NUMBEROFRESULTS'];

if ($eresults > 0 || $tresults > 0) {
  $_SESSION['Environment'] = 1;
}else{

}



///END OF ENVIROMENT TEST


  if (isset($_GET['cmt'])) {
    $comment = $_GET['cmt'];

  }
 
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
    .inside{
      padding-top: 60px
    }
    .right{
      margin-left: 40px;
    }
     pre{
      border-radius: 50%;
      width: 200px;
      height: 200px;
      border: 2px solid #000;
      text-align: center;
      color: #fff;

    }
    .green{
      background-color: #27ae60;
    }
    .red{
      background-color: #e74c3c;
    }
    .white{
      color: #fff;
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
          
          <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-dashboard" style="color:#dd1111;"></i> Atoms <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
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
<div class="row">
  <div class="col-md-3">
       <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <h4>Migration Tools</h4>
                        </div>
                  </div>
                  <div class="panel-body"> 
                <ul class="nav nav-stacked">
        <li><a href="main.php">Main Dashboard &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-dashboard"></span></a></li>
        <li><a href="/Atomr/migration">Migrate Atom &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-random"></span></a></li>
      </ul>
      <hr>
       <ul class="nav nav-stacked">
        <li><a href="/Atomr/process">Migrate Process&nbsp;&nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-send"></span></a></li>
        <li><a href="/Atomr/schedule">Migrate Schedule&nbsp;&nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-adjust"></span></a></li>
        <li><a href="migrateschedules.php">Migrate Environments&nbsp;&nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-hdd"></span></a></li>
        <li><a href="migrateschedules.php">Atom Restoration&nbsp;&nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-screenshot"></span></a></li>

      </ul>
      <hr>
      <ul class="nav nav-stacked">
        <li><a href="help.php">Workflow Help&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-share-alt"></span></a></li>
        <li><a href="/Atomr/lab">Atomr Labs&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-leaf"></span></a></li>
      </ul>

                  </div>
        </div>
      
      <?php
      if ($_SESSION['Environment'] == 1) {
        ?>
      <hr>

        <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Environments Enabled?</h4>
                     

                  
                        </div>
                  </div>
                  <div class="panel-body">
                    
                      <p>It seems like your atomsphere account uses enviroments. Please be aware of what modules you can and cannot use on this account. If you have any further questions please visit the help center.</p>
                      <br>
                      <center>
                      <a href="#" class="btn btn-success btn-md active" role="button">Help Center</a></center>
                  </div>
        </div>

        <?php 
      }

 
      ?>
    </div><!-- /col-3 -->

    <div class="col-md-9">

    <div class="col-md-12" align="left">
      <div class="panel panel-primary">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                       <h4>Users Atoms &nbsp;&nbsp;<a class="white" href="atoms.php"><span class="glyphicon glyphicon-refresh"></span></a></h4>
                        </div>
                  </div>
                  <div class="panel-body">
            
                     <?php 
                      $url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Atom/query" ;
$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="and" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="GroupingExpression"> 
        <nestedExpression operator="EQUALS" property="type" xsi:type="SimpleExpression">
           <argument>ATOM</argument>
        </nestedExpression>
    </expression>
  </QueryFilter>
</QueryConfig>';
//open connection
$ch = curl_init($url);
 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
 
$resp = curl_exec($ch);
curl_close($ch);


$p = xml_parser_create();
xml_parse_into_struct($p, $resp, $vals, $index);
xml_parser_free($p);



$results = $vals[0]['attributes']['NUMBEROFRESULTS']; 

echo '<div class="row">';
     for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $vals[$i]['attributes']['ID']; 

                if ($vals[$i]['attributes']['STATUS'] == "OFFLINE") {
                     echo '<div class="col-sm-3 right"><pre class="inside red">';
             
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "Installed On:"; print_r($vals[$i]['attributes']['DATEINSTALLED']);echo '<br>';
                echo "Status:"; print_r($vals[$i]['attributes']['STATUS']);
      

                 echo '</pre></div>';
                }else{
                     echo '<div class="col-sm-3 right"><pre class="inside green">';
             
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "Installed On:"; print_r($vals[$i]['attributes']['DATEINSTALLED']);echo '<br>';
                echo "Status:"; print_r($vals[$i]['attributes']['STATUS']);
      

                 echo '</pre></div>';
                }

                }
echo '</div>';
                ?>
                      
                </div>

                </div>


              <div class="panel panel-success">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Account Information & Terms</h4>
                     
                  
                        </div>
                  </div>
                  <div class="panel-body">
                  All Workflow calls are authenticated using a user name and an Account ID. Each account’s usage request limit is calculated as 1000 times their number of licensed connectors.
                  </div>
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
<footer class="text-center">This platform is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>



<br>
<br>

  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>