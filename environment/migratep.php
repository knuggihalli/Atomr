<?php
include 'init.php';

if (isset($_SESSION['logged'])) {


// get variable sent from client-side page

  if (isset($_SESSION['Environment'])) {
    # this is for envrionments
    $ids = isset($_POST['my_variable']) ? strip_tags($_POST['my_variable']) :null;
    $idr = explode("*",$ids);

    $resp = env_get_process($_SESSION['envstart'],$_SESSION['envend'],$_SESSION['account_id'],$_SESSION['auth']);
    $results = $resp[0]['attributes']['NUMBEROFRESULTS'];

    for ($i=1; $i<$results+1; $i++) { 
      //Migrate all processess first
      $process_migration = migrate_process($resp[$i]['attributes']['PROCESSID'],$_SESSION['envend'],$_SESSION['account_id'],$_SESSION['auth']);

    }

  }else{

  }


   
}else{
    header('Location: index.php');
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

    <div class="col-md-8" align="left">
   

      <div class="panel panel-success">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <center><h4>Migration Successful</h4></center>
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


                        <h4>Migration Log File Download</h4>
                        </div>
                  </div>
                  
                  <div class="panel-body">
              
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
             

                        


                      <?php
      if ($_SESSION['Environment'] == 1) {
        ?>

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
<br>
<footer class="text-center">This application is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>














