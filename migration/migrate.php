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

<!--Help modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <center><h4><br>Atom Migration - Step 3</h4></center>
      <div class="modal-body">
          <p>In this step you will select all the atoms that will move to the endpoint environment. You can confirm your start point and endpoint environment on the left hand side of the page. If this is not correct please exit the process and start over.</p>
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
          <h2 class="text-center">About Atom Migration</h2>
      </div>
      <div class="modal-body">
          <p>Atom migration is the process of taking an atom and moving it from one environment to another. Remember this does not affect what processes and schedules are on the atom. Atoms will inherit processes and schedules from the environment they are placed in. If you would like to attach processes to environments please use the Process Migration Module provided by Atomr on the dashboard.</p>
                </div>
      <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
      </div>
  </div>
  </div>
</div>

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

   




      <div class="panel panel-default">
                  <div class="panel-heading">
                        <div class="panel-title">
                  
                        <h4>Atom Selection</h4>
                        </div>
                  </div>
                  <div class="panel-body">
       
                                  <script type="text/javascript">
                  function toggle(source) {
  checkboxes = document.getElementsByName('atoms[]');
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



                  $resp = env_get_atoms($_SESSION['envstart'],$_SESSION['account_id'],$_SESSION['auth']);
                  $amt = $resp[0]['attributes']['NUMBEROFRESULTS'];


                  for ($i=1; $i<$amt+1; $i++) { 
                     $id = $resp[$i]['attributes']['ATOMID'];
                     $atom = env_get_name($resp[$i]['attributes']['ATOMID'],$_SESSION['account_id'],$_SESSION['auth']);
                      echo '   <div class="panel panel-info">
                  <div class="panel-body">';
                      ?>
                      <input type="checkbox" name="atoms[]" value='<?php echo $id; ?>'>
                      <?php

                     
                  echo $atom[0]['attributes']['NAME'];echo '<br>';
                  echo $atom[0]['attributes']['HOSTNAME'];echo '<br>';
                  echo $atom[0]['attributes']['DATEINSTALLED'];echo '<br>';
                  echo $atom[0]['attributes']['STATUS'];echo '<br>';

                      echo '   </div>
                  </div>';
                  } 

                 
            
                ?>




            <br>
            <br>

                <button type="submit" class="btn btn-danger btn-block">Migrate Atoms&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>

                </form> 
              
              
                </div>

                </div>
                </div>
                   <div class="col-md-4">
                   

              <div class="panel panel-info">
                  <div class="panel-body">
                    
              <b><h4>Important Notice -</h4></b>
        
                      <p>When you hit migrate Atomr will migrate all Atoms from the start point atom to the end point environment.</p>
           
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