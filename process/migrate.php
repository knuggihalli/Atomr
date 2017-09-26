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

     $resp = get_process($_SESSION['atomstart'],$_SESSION['atomend'],$_SESSION['account_id'],$_SESSION['auth']);
        $results = $resp[0]['attributes']['NUMBEROFRESULTS'];


  }else{
    header('Location: /Atomr/process/index.php?cmt=You must select an atom');
  }
  }
}else{//End of the first if statement checking logged
  header('Location: /Atomr/index.php');
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
       <ul class="nav nav-stacked">
         <div class="panel panel-info">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4><?php if (isset($_SESSION['Environment'])) {
                          echo "Envrionment Points ";
                        }else{
                          echo "Atom Points";
                        } ?></h4>
                     

                  
                        </div>
                  </div>
                  <div class="panel-body">

                    <?php
                    if (isset($_SESSION['Environment'])) {
                        echo '<b>'. "Start Environment: " . '</b>';echo $_SESSION['envstartname'];echo '<br><hr>';
                        echo '<b>'."End Environment: ". '</b>';echo $_SESSION['envendname'];
                    }else{
                        echo '<b>'. "Start Atom: " . '</b>';echo $_SESSION['atomstart'];echo '<br><hr>';
                        echo '<b>'."End Atom: ". '</b>';echo $_SESSION['atomend'];
                    }

                    ?>

                  </div>
        </div>




        </li>
        
      </ul>

      
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
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Process Selection</h4>
                        </div>
                  </div>
                  <div class="panel-body">
                
                <b>

                  <?php 

                if (isset($_SESSION['Environment'])) {
                     echo "Environment Processes -  ";
                  }else{
                    echo "Atom Processes - ";
                  }

                   ?>
                  </b>
                <br>
                                  <script type="text/javascript">
                  function toggle(source) {
  checkboxes = document.getElementsByName('process[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
                  <hr>
                <pre>
                <input type="checkbox" onClick="toggle(this)" /> Select All</pre>
                <hr>
                <form action="confirm.php" method="post">
              
                <?php 




                for ($i=1; $i<$results+1 ; $i++) { 
                  $id = $resp[$i]['attributes']['PROCESSID']; 
                    echo '   <div class="panel panel-info">
                  <div class="panel-body">';
                    /*<input type="checkbox" name="process[]" value='<?php echo $id; ?>'>*/
                    $url = "https://api.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Process/". $resp[$i]['attributes']['PROCESSID'];
    //HTTP GET response from url=>// Get cURL resource
$ch = curl_init($url);

curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$respN = curl_exec($ch);
curl_close($ch);

$p = xml_parser_create();
xml_parse_into_struct($p, $respN, $vals, $index);
xml_parser_free($p);

                      ?>
                      <input type="checkbox" name="process[]" value='<?php echo $id; ?>'>
                      <?php

                      if (isset($_SESSION['Environment'])) {
                #this is one for the environment
                echo '<h4>';print_r($vals[0]['attributes']['NAME']); echo '</h4>';
                echo "Processes ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Environment ID:"; print_r($resp[$i]['attributes']['ENVIRONMENTID']);
                      }else{
                        #this is just for the atom
                echo "Name:"; print_r($vals[0]['attributes']['NAME']); echo '<br>';
                echo "Process ID:"; print_r($resp[$i]['attributes']['PROCESSID']);echo '<br>';
                echo "Atom ID:"; print_r($resp[$i]['attributes']['ATOMID']); echo '<br>';
                }

                 echo '</div></div>';
                }
                ?>




            <br>
            <br>

                <button type="submit" class="btn btn-danger btn-block">Migrate Processses&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>

                </form> 
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                   

              <div class="panel panel-info">
                  <div class="panel-body">
                    
              <b><h4>Important Notice -</h4></b>
        
                      <p>When you hit migrate Atomr will migrate all processes and schedules from the start point atom to the end point atom.</p>
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
<hr>
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
<footer class="text-center">This platform is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>