<?php
include 'init.php';

if (isset($_SESSION['logged'])) {

if (isset($_POST['atomstart']) && isset($_POST['atomend'])) {

    $answer = explode("*",$_POST['atomstart']);
    $answer2 = explode("*",$_POST['atomend']);
       
    $_SESSION['envstart'] = $answer[0];
    $_SESSION['envend'] = $answer2[0];   
 
    $_SESSION['envstartname'] = $answer[1];
    $_SESSION['envendname'] = $answer2[1];  
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
    .left{
    	float: left;
    }
    .right{
    	float: right;
    }

    </style>
  </head>
  <body>
   




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












<div class="breaker">
</div>


<!-- Main -->
<div class="container">

<div class="row">
  <div class="col-md-3">
      <!-- Left column -->

    </div><!-- /col-3 -->

    <div class="col-md-9">

    <div class="col-md-8" align="left">
   

              


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
                     <div class="col-xs-4"><center><h1><span class="glyphicon glyphicon-arrow-right"></span></h1></center></div>
                      <div class="col-xs-4"><h2><?php  if (isset($_SESSION['Environment'])){
                    
                    echo $_SESSION['envendname']; 

                    }else{
                    
                    echo $_SESSION['atomend']; 
                     } ?> &nbsp<span class="glyphicon glyphicon-cloud-download"></span> </h2></div>

                  </div>
                    <hr>
         <a href="/Atomr/environment/load.php" class="right"> <button name="answer" value='2' class="right btn btn-success">Deploy Migration</button></a>
         <a href="/Atomr/main.php" class="left"> <button name="answer" value='2' class="right btn btn-danger">Exit / Cancel</button></a>
     
              
              
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














