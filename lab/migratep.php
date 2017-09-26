<?php
include 'init.php';

if (isset($_SESSION['logged'])) {
  if (isset($_SESSION['Environment'])) {
    # this is for envrionments
    $_SESSION['proc'] = 0;
    $url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/ProcessEnvironmentAttachment/" ;

    foreach ($_POST['process'] as $process) {
      $_SESSION['proc'] = $_SESSION['proc'] ."*". $process;


    $xml = '<bns:ProcessEnvironmentAttachment environmentId="'. $_SESSION['envend'] .'" 
     processId="' . $process .'" xmlns:bns="http://api.platform.boomi.com/" 
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>';    

      $xml = (string)$xml;


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

    }

  }else{

    $_SESSION['proc'] = 0;
    $url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/ProcessAtomAttachment/" ;

    foreach ($_POST['process'] as $process) {
      $_SESSION['proc'] = $_SESSION['proc'] ."*". $process;


    $xml = '<bns:ProcessAtomAttachment atomId="'.$_SESSION['atomend'].'" 
     processId="'.$process.'" xmlns:bns="http://api.platform.boomi.com/" 
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>';    

      $xml = (string)$xml;


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
}

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

                    <?php
                    if (isset($_SESSION['Environment'])){
                        echo '<b>Start: </b>'; echo $_SESSION['envstartname']; echo '<hr>'; 
                    
                    echo '<b>End:</b> '; echo $_SESSION['envendname']; 

                    }else{
                    echo '<b>Start: </b>'; echo $_SESSION['atomstart']; echo '<hr>'; 
                    
                    echo '<b>End:</b> '; echo $_SESSION['atomend']; 
                     }
                    ?>
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

          <button type="submit"  name="answer" value='2' class="right btn btn-success btn-block">Exit / Finished</button></center>
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














