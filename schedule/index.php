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

<?php

include 'template/nav.php';

?>
<!-- Main -->
<div class="container">
<div class="row">
  <div class="col-md-3">
      <!-- Left column -->

 
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


    <div class="col-md-8" align="left">

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




      <div class="panel panel-default">
          
                  <div class="panel-body">
                
                <b>

                  <?php 

                if (isset($_SESSION['Environment'])) {
                     echo "StartPoint Environment - ";
                  }else{
                    echo "StartPoint Atom - ";
                  }

                   ?>
                  </b>
                <br>
                <br>
                <form action="endpoint.php" method="post">
              
                <?php 
                for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $vals[$i]['attributes']['ID']; 
                  $name = $vals[$i]['attributes']['NAME']; 
                    echo '<pre>';
                      ?>
                      <input type="radio" name="atomstart" value='<?php echo $id ."*". $name; ?>'>
                      <?php

                      if (isset($_SESSION['Environment'])) {
                #this is one for the environment
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "CLASSIFICATION:"; print_r($vals[$i]['attributes']['CLASSIFICATION']);echo '<br>';
                echo "Environment ID:"; print_r($vals[$i]['attributes']['ID']);
                      }else{
                        #this is just for the atom
                echo "Name:"; print_r($vals[$i]['attributes']['NAME']); echo '<br>';
                echo "Installed On:"; print_r($vals[$i]['attributes']['DATEINSTALLED']);echo '<br>';
                echo "Status:"; print_r($vals[$i]['attributes']['STATUS']);
                }

                 echo '</pre>';
                }
                ?>




                <hr>

        

                <button type="submit" class="btn btn-success btn-block">Select Endpoint&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>

                </form> 
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                   

                     

<div class="panel panel-info">
                  <div class="panel-body">
                    
              <b><h4>Process Migration</h4></b>
        
                      <p>You have started a process migration, this will move processes across environments or atoms.</p>
                      <br>
                      <a href="#" class="btn btn-primary btn-md active" role="button">Need Help?</a>
                      <a href="#" class="btn btn-warning btn-md active" role="button">Found a Bug?</a>

                      <br>
                      <br>
                  </div>
        </div>

                        


                      <?php
      if ($_SESSION['Environment'] == 1) {
        ?>

        <div class="panel panel-info">
            
                  

      
                  
                  
                  <div class="panel-body">
                    <h4>Environments Enabled?</h4>

                      <p>It seems like your atomsphere account uses enviroments. Please be aware of what modules you can and cannot use on this account. If you have any further questions please visit the help center.</p>
             
                      <br>
                      <center>
                      <a href="#" class="btn btn-success btn-md active" role="button">Help Center</a></center>
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
<footer class="text-center">This platform is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>