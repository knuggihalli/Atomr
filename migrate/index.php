<?php
include 'init.php';
if (isset($_GET['cmt'])) {
  $cmt = $_GET['cmt'];
}
if (isset($_SESSION['logged'])) {
//Move Schedules
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
}else{
    header('Location: /Atomr/main.php');
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
    input{
      float: right;
    }
    button{
      float: right;
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
       <ul class="nav nav-stacked">
        <li><a href="/Atomr/main.php"> <span class="glyphicon glyphicon-arrow-left"> </span> &nbsp;&nbsp;Back To Dashboard</a></li>
        
      </ul>
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

    <?php 
    if (isset($_GET['cmt'])) {
      
      ?>

      <div class="panel panel-danger">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4>Error -  <?php echo $cmt; ?></h4></center>
                        </div>
                  </div>
             
        </div>

      <?php
    }
    ?>




      <div class="panel panel-default">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Atom Migration</h4>
                        </div>
                  </div>
                  <div class="panel-body">
                
                <b>StartPoint Atom - </b>
                <br>
                <br>
                <form action="migrate.php" method="post">
              
                <?php 
                for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $vals[$i]['attributes']['ID']; 
                    echo '<pre>';
                      ?>
                      <input type="radio" name="atomstart" value='<?php echo $id; ?>'>
                      <?php
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "Installed On:"; print_r($vals[$i]['attributes']['DATEINSTALLED']);echo '<br>';
                echo "Status:"; print_r($vals[$i]['attributes']['STATUS']);
      

                 echo '</pre>';
                }
                ?>




                <hr>

                <b>EndPoint Atom -</b>
                <br>
                <br>

                      <?php 
                for ($i=1; $i<$results+1 ; $i++) { 
                   $id = $vals[$i]['attributes']['ID']; 
                    echo '<pre>';
                    ?>
                      <input type="radio" name="atomend" value='<?php echo $id; ?>'>
                      <?php
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "Installed On:"; print_r($vals[$i]['attributes']['DATEINSTALLED']);echo '<br>';
                echo "Status:"; print_r($vals[$i]['attributes']['STATUS']);

                 echo '</pre>';
                }
                ?>
                <br>
                <hr>

                <button type="submit" name="button"  value="cloud" class="btn btn-primary btn-block">Migrate In The Cloud&nbsp;&nbsp;<span class="glyphicon glyphicon-cloud-upload"></span></button><br><br>
                </form> 

        
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                   

                         <b><h4>Important Notice -</h4></b>
                      <hr>
                      <p>When you hit migrate Atomr will migrate all processes and schedules from the start point atom to the end point atom.</p>
                      <br>
                      <a href="/help.html" class="btn btn-primary btn-md active" role="button">Need Help?</a>
                      <a href="#" class="btn btn-warning btn-md active" role="button">Found a Bug?</a>

                      <br>
                      <br>

                        


                      <?php
      if ($_SESSION['Environment'] == 1) {
        ?>
      <br>
      <br>
      <br>
        <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Environments Enabled?</h4>
      
                  
                        </div>
                  </div>
                  <div class="panel-body">
                    
                      <p>It seems like your atomsphere account uses enviroments. If you have not upgraded to a premium or enterprise account you may not be able to access all features of Workflow.</p>
                      <br>
                      <center>
                      <a href="#" class="btn btn-success btn-md active" role="button">Upgrade</a></center>
                  </div>
        </div>

        <?php 
      }

 
      ?>
                    </div>
    </div>

    </div><!--/row-->
      
 
      
</div>
</div>
</div>
<!-- /Main -->

<br>
<br>
<hr>
<footer class="text-center">This application is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>