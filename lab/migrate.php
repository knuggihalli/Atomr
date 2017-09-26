<?php
include 'init.php';

if (isset($_SESSION['logged'])) {
  if (isset($_SESSION['Environment'])) {
    # this is for environment migration
    if (isset($_POST['atomstart']) && isset($_POST['atomend'])) {

    $answer = explode("*",$_POST['atomstart']);
    $answer2 = explode("*",$_POST['atomend']);
      
    $_SESSION['envstart'] = $answer[0];
    $_SESSION['envend'] = $answer2[0]; 

     $_SESSION['envstartname'] = $answer[1];
    $_SESSION['envendname'] = $answer2[1]; 

    $resp = env_get_process($_SESSION['envstart'],$_SESSION['envend'],$_SESSION['account_id'],$_SESSION['auth']);
    $results = $resp[0]['attributes']['NUMBEROFRESULTS'];

    }else{
      #this is for envrionments if nothing was selected
      header('Location: /Atomr/process/index.php?cmt=You must select an envrionment');
    }

  }else{
    #this is for regular atoms
    if (isset($_POST['atomstart']) && isset($_POST['atomend'])) {

    $answer = explode("*",$_POST['atomstart']);
    $answer2 = explode("*",$_POST['atomend']);
      
    $_SESSION['atomstart'] = $answer[0];
    $_SESSION['atomend'] = $answer2[0]; 

    //get all the processess off of the end atom
    $resp = get_process($_SESSION['atomend'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);
    $results = $resp[0]['attributes']['NUMBEROFRESULTS'];

    $id = 0;

    //Save all of the processes into id
    for ($i=1; $i<$results+1 ; $i++) { 
    $id = $id . "*" . $resp[$i]['attributes']['ID']; 
    }

    $ids = explode('*', $id);
    $amount = count($ids);

    for ($y=1; $y<$amount; $y++) { 
      echo $ids[$y] . '<br><br>';
      $psurl = "https://platform.boomi.com/api/rest/v1/".$_SESSION['account_id']."/ProcessSchedules/". $ids[$y] ."/";

      $psch = curl_init($psurl);

      curl_setopt($psch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
      curl_setopt($psch, CURLOPT_RETURNTRANSFER, 1);

      $psresp = curl_exec($psch);
      curl_close($psch);

      $psp = xml_parser_create();
      xml_parse_into_struct($psp, $psresp, $psvals, $psindex);
      xml_parser_free($psp);

      echo '<pre>';
      print_r($psvals);
      echo '</pre>';
    }


  }else{
    header('Location: /Atomr/process/index.php?cmt=You must select an atom');
  }
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
    .up{
      margin-top: -10px;
    }
     pre{
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

    <div class="col-md-9 up">
     <center><h3>Advanced Schedule Migration &nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-adjust"></span></h3></center>
        <hr>

    <div class="col-md-6" align="left">

    <?php 
    if (isset($cmt) || isset($cmt2)) {
      if (isset($cmt)) {
        echo '<div class="panel panel-danger">';
      }else{
        echo '<div class="panel panel-primary">';
      }
      ?>

      
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4><?php
                        if (isset($cmt)) {
                          echo "Error -" . $cmt;
                        }else{
                          echo $cmt2;
                        }

                          ?></h4></center>
                        </div>
                  </div>
             
        </div>

      <?php
    }
    ?>




      <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>    <?php 

                if (isset($_SESSION['Environment'])) {
                     echo "StartPoint Environment Schedules - ";
                  }else{
                    echo "StartPoint Atom Schedules - ";
                  }

                   ?></h4>
                        </div>
                  </div>
                  <div class="panel-body">
              
                  <?php

                  $resp = get_process($_SESSION['atomstart'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);
                  $results = $resp[0]['attributes']['NUMBEROFRESULTS'];

                  for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $resp[$i]['attributes']['PROCESSID']; 
                    echo '<pre>';
                      ?>
                      <input type="checkbox" name="process[]" value='<?php echo $id; ?>'>
                      <?php

                      if (isset($_SESSION['Environment'])) {
                #this is one for the environment
                echo "Type:"; print_r($resp[$i]['attributes']['XSI:TYPE']); echo '<br>';
                echo "Processes ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Environment ID:"; print_r($resp[$i]['attributes']['ENVIRONMENTID']);
                      }else{
                        #this is just for the atom
                echo "Atom ID:"; print_r($resp[$i]['attributes']['ATOMID']); echo '<br>';
                echo "Process ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Type:"; print_r($resp[$i]['attributes']['XSI:TYPE']);
                }

                 echo '</pre>';
                }
                ?>

                  
               

                </div>

                </div>
                </div>



    <div class="col-md-6" align="left">

    <?php 
    if (isset($cmt) || isset($cmt2)) {
      if (isset($cmt)) {
        echo '<div class="panel panel-danger">';
      }else{
        echo '<div class="panel panel-primary">';
      }
      ?>

      
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4><?php
                        if (isset($cmt)) {
                          echo "Error -" . $cmt;
                        }else{
                          echo $cmt2;
                        }

                          ?></h4></center>
                        </div>
                  </div>
             
        </div>

      <?php
    }
    ?>




      <div class="panel panel-warning">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>      <?php 

                if (isset($_SESSION['Environment'])) {
                     echo "EndPoint Environment - ";
                  }else{
                    echo "EndPoint Atom - ";
                  }

                   ?></h4>
                        </div>
                  </div>
                  <div class="panel-body">
                
        
        
              
<?php

                  $resp = get_process($_SESSION['atomend'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);
                  $results = $resp[0]['attributes']['NUMBEROFRESULTS'];

                  for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $resp[$i]['attributes']['PROCESSID']; 
                    echo '<pre>';
                      ?>
                      <input type="checkbox" name="process[]" value='<?php echo $id; ?>'>
                      <?php

                      if (isset($_SESSION['Environment'])) {
                #this is one for the environment
                echo "Type:"; print_r($resp[$i]['attributes']['XSI:TYPE']); echo '<br>';
                echo "Processes ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Environment ID:"; print_r($resp[$i]['attributes']['ENVIRONMENTID']);
                      }else{
                        #this is just for the atom
                echo "Atom ID:"; print_r($resp[$i]['attributes']['ATOMID']); echo '<br>';
                echo "Process ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Type:"; print_r($resp[$i]['attributes']['XSI:TYPE']);
                }

                 echo '</pre>';
                }
                ?>



              
              
                </div>

                </div>

                </div>
                   

               <div class="col-xs-12">

                <div class="panel panel-default">
                  <div class="panel-body">
                    <button type="submit" class="btn btn-primary btn-block">Import Schedules&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
                             </form> 
                  </div>
                </div>

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