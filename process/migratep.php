<?php
include 'init.php';

if (isset($_SESSION['logged'])) {


// get variable sent from client-side page

  if (isset($_SESSION['Environment'])) {
    # this is for envrionments
    $ids = isset($_POST['my_variable']) ? strip_tags($_POST['my_variable']) :null;
    $_SESSION['proc'] = 0;
    $url = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/ProcessEnvironmentAttachment/" ;
    $idr = explode("*",$ids);
    $amountid = count($idr);
    $x = 0; 
    $_SESSION['proc'] = 0;

    for ($i=1; $i<$amountid; $i++) { 
      $_SESSION['proc'] = $_SESSION['proc'] . "*" . $idr[$i];

     $xml = '<bns:ProcessEnvironmentAttachment environmentId="'. $_SESSION['envend'] .'" 
     processId="' . $idr[$i] .'" xmlns:bns="http://api.platform.boomi.com/" 
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
 

//For deploying processes that attached
$durl = "https://api.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Deployment/";
$date = date("Y/m/d");
if (isset($_SESSION['option'])) {
  if ($_SESSION['option'] == 1) {
    $dxml = '<bns:Deployment xmlns:bns="http://api.platform.boomi.com/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <bns:environmentId>'.$vals[0]['attributes']['ENVIRONMENTID'].'</bns:environmentId>
    <bns:processId>'.$idr[$i].'</bns:processId>
    <bns:notes>Deployed from the ATOMR platform on - '.$date.' via ConsiderCode Limmited</bns:notes>
</bns:Deployment>';

$dch = curl_init($durl);

curl_setopt($dch, CURLOPT_POST, 1);
curl_setopt($dch, CURLOPT_POSTFIELDS, $dxml);
curl_setopt($dch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
 
$dresp = curl_exec($dch);
curl_close($dch);

$dp = xml_parser_create();
xml_parse_into_struct($dp, $dresp, $dvals, $dindex);
xml_parser_free($dp);

$_SESSION['dvals'] = $dvals;
  }else{

  }
}
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
<br>
<footer class="text-center">This application is compliments of <a href="http://www.considercode.com"><strong>ConsiderCode</strong></a></footer>





  
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/Atomr/js/bootstrap.min.js"></script>
    <script src="/Atomr/js/scripts.js"></script>
  </body>
</html>














