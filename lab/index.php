<?php
include 'init.php';
if (isset($_GET['cmt'])) {
  $cmt = $_GET['cmt'];
}
if (isset($_SESSION['logged'])) {
//Move Schedules

if (isset($_SESSION['Environment'])) {
  $cmt2 = "It seems your are using enviroments please slect what Environments you want to migrate processes from";

$url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Environment/query" ;
$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
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
}


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
    .up{
      margin-top: -10px;
    }
    pre{
      white-space:nowrap; 
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
        <li><a href="/Atomr/main.php"> <span class="glyphicon glyphicon-arrow-left"> </span> &nbsp;&nbsp;Dashboard</a></li>
        
      </ul>
      <hr>
          


              <div class="panel panel-default">
          
                  <div class="panel-body">
                
          
                <form action="index.php" method="GET">
              
                            <?php 
                  $url = "https://platform.boomi.com/api/rest/v1/" .$_SESSION['account_id']. "/Process/query";
   
  $xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
  </QueryFilter>
  </QueryConfig>';

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


  $amt = $vals[0]['attributes']['NUMBEROFRESULTS'];
                for ($i=1; $i<$amt ; $i++) { 
                  $id = $vals[$i]['attributes']['ID']; 
                  $name = $vals[$i]['attributes']['NAME']; 
                    echo '<pre>';
                      ?>
                      <style type="text/css">
                      .styled{
                        text-align: left;
                        border: 0px;
                        text-decoration: none;
                        background: transparent;
                      }
                      </style>
                      <button type="submit" class="styled" name="cmt" value='<?php echo $id; ?>'>
                      <?php

                      if (isset($_SESSION['Environment'])) {
                #this is one for the environment
                echo "Name:"; print_r($vals[$i]['attributes']['ID']); echo '<br>';
                echo "Environment ID:"; print_r($vals[$i]['attributes']['ID']);
                      }else{
                        #this is just for the atom
                echo '<b>'. "Name:" . '</b>'; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                }

                 echo '</pre>';
                }
                ?>


              
              
              
                </div>

                </div>


      
      
    </div><!-- /col-3 -->

    <div class="col-md-9 up">
     <center><h3>Atomr Labs &nbsp;&nbsp;&nbsp; <span class="glyphicon glyphicon-leaf"></span></h3></center>
        <hr>
   




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style type="text/css">
.a {
width: 150px;
height:150px;
border-radius: 50%;
border: 2px solid #000;
 background-color: green;
position:fixed;
text-align: center;
color: #fff;
font-size: 20px;
}

.inside{
  padding-top: 60px;
}
</style>
<script> 
$(document).ready(function(){
    animateDiv();
    $( "#draggable" ).draggable();
});

function makeNewPosition(){
    
    // Get viewport dimensions (remove the dimension of the div)
    var h = $(".col-md-10").height() - 50;
    var w = $(".col-md-10").width() - 50;
    
    var nh = Math.floor(Math.random() * h);
    var nw = Math.floor(Math.random() * w);
    
    return [nh,nw];    
    
}

function animateDiv(){
    var newq = makeNewPosition();
    var oldq = $('.a1').offset();
    var speed = calcSpeed([oldq.top, oldq.left], newq);
    
    $('.a1').animate({ top: newq[0], left: newq[1] }, speed, function(){
      animateDiv();        
    });



    var newq = makeNewPosition();
    var oldq = $('.a2').offset();
    var speed = calcSpeed([oldq.top, oldq.left], newq);
    
    $('.a2').animate({ top: newq[0], left: newq[1] }, speed, function(){
      animateDiv();        
    });
    
};

function calcSpeed(prev, next) {
    
    var x = Math.abs(prev[1] - next[1]);
    var y = Math.abs(prev[0] - next[0]);
    
    var greatest = x > y ? x : y;
    
    var speedModifier = 0.1;

    var speed = Math.ceil(greatest/speedModifier);

    return speed;

}
</script> 
</head>
 
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

for ($i=1; $i<$results+1 ; $i++) { 
$color = $vals[$i]['attributes']['STATUS'];

if ($color == "ONLINE") {
   $val = "green";
 } else{
  $val = "red";
 }

?>

<style type="text/css">
.a<?php echo $i; ?> {
width: 150px;
height:150px;
border-radius: 50%;
border: 2px solid #000;
 background-color: <?php echo $val; ?>;
position:fixed;
text-align: center;
color: #fff;
font-size: 20px;
}
.a<?php echo $i; ?>:hover {
width: 200px;
height:200px;
}
</style>

<!--<div class='a<?php echo $i; ?>'>
<div class="inside"><?php echo $vals[$i]['attributes']['NAME']; ?></div>
</div>-->


<?php

}
               
                ?>




<!--[if lt IE 9]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
<script src="tag.js" type="text/javascript"></script>
 <script type="text/javascript">
  window.onload = function() {
    try {
      TagCanvas.Start('myCanvas');
      TagCanvas.Start('Canvas');
    } catch(e) {
      // something went wrong, hide the canvas container
      document.getElementById('myCanvasContainer').style.display = 'none';
    }
  };
 </script>

 
 <style type="text/css">
  .black{
    color: #000;
  }
  #myCanvasContainer{
    color: #000;
    background: #000;
  }
 </style>

 <?php

$url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Process/query" ;
$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
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


 if (isset($_GET['cmt'])) {

         

                echo '<b>' ."Process ID: ".'</b>'. $_GET['cmt'] . '<hr>';



                $surl = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/ProcessSchedules/query";
                $sxml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
                  <QueryFilter>
    
                  </QueryFilter>
                </QueryConfig>';

                    //HTTP GET response from url=>// Get cURL resource
                $sch = curl_init($surl);
                 
                curl_setopt($sch, CURLOPT_POST, 1);
                curl_setopt($sch, CURLOPT_POSTFIELDS, $sxml);
                curl_setopt($sch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($sch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
                 
                $sresp = curl_exec($sch);
                curl_close($sch);

                $sp = xml_parser_create();
                xml_parse_into_struct($sp, $sresp, $svals, $sindex);
                xml_parser_free($sp);

             

                $x = 0;
                $d = 0;
                $s =0;

                while (isset($svals[$x]['tag'])) {
                  if (isset($svals[$x]['attributes']['ID'])) {
                    $d = $d."*" . $svals[$x]['attributes']['ID'];
                    $x = $x+1;
                  }else{
                    $x = $x+1;
                  } 
                }
        
                $ids = explode('*', $d);
                $amount = count($ids);
                for ($g=1; $g<$amount ; $g++) { 
        
          $shurl = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/ProcessSchedules/". $ids[$g];

          $shch = curl_init($shurl);

          curl_setopt($shch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
          curl_setopt($shch, CURLOPT_RETURNTRANSFER, 1);

          $shresp = curl_exec($shch);
          curl_close($shch);

          $shp = xml_parser_create();
          xml_parse_into_struct($shp, $shresp, $shvals, $shindex);
          xml_parser_free($shp);


                while(isset($shvals[$s]['tag'])){
                  if (isset($shvals[$s]['attributes']['YEARS'])) {
                      
                     

          

     

?>
<div class="row">
<div id="myCanvasContainer" class="col-xs-1">
 <canvas width="1px" height="500px" id="myCanvas">

  <p>This is a browser that doesnt support the canvas element</p>
  <ul class="black">
  


                      <?php 
                      if (isset($_GET['cmt'])) {
                        # code...
                      }else{
                for ($i=1; $i<$results+1 ; $i++) { 
              
                echo ' <li class="black"><a href="/Atomr/lab/index.php?cmt='.$vals[$i]['attributes']['ID'].'">'; print_r($vals[$i]['attributes']['NAME']); echo ' </a></li>';

                }}
                ?>
               
  </ul>


 </canvas>


</div> 
<div id="myCanvasContainer" class="col-xs-11">
 <canvas width="800px" height="500px" id="Canvas">

  <p>This is a browser that doesnt support the canvas element</p>
  <ul class="black">
  


                      <?php 


              echo ' <li class="black"><a href="/Atomr/lab/index.php?cmt='.$vals[$i]['attributes']['ID'].'">'; echo "Year: ". $year = $shvals[$s]['attributes']['YEARS']; echo ' </a></li>';
 echo ' <li class="black"><a href="/Atomr/lab/index.php?cmt='.$vals[$i]['attributes']['ID'].'">'; echo "MONTHS: ". $year = $shvals[$s]['attributes']['MONTHS']; echo ' </a></li>';

  echo ' <li class="black"><a href="/Atomr/lab/index.php?cmt='.$vals[$i]['attributes']['ID'].'">'; echo "Minutes: ". $year = $shvals[$s]['attributes']['MINUTES']; echo ' </a></li>';

   echo ' <li class="black"><a href="/Atomr/lab/index.php?cmt='.$vals[$i]['attributes']['ID'].'">'; echo "Days: ". $year = $shvals[$s]['attributes']['DAYSOFMONTH']; echo ' </a></li>';



            
           



                    $s = $s+1;
                  }else{
                    $s = $s+1;}
                  } 

        }
          

                }else{
                  echo "Please select a process to view Information";
                }

                ?>
               
  </ul>


 </canvas>
 

</div>


</div>








    </div>
    </div><!--/row-->
      
 
      
</div>
</div>
</div>
<!-- /Main -->




  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>