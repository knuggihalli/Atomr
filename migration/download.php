 <?php
session_start();

if (isset($_SESSION['logged'])) {

   header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=MigrationLog.txt");

   // do your Db stuff here to get the content into $content
   print "Migration Log File -\n";
   print "Date -" . date("Y-m-d") . "\n";
   print " \n"; 
   print "Account ID:" . $_SESSION['account_id'] . "\n";

  if (isset($_SESSION['Environment'])) {
       print "Environment Start ID:" .$_SESSION['envstart']. "\n";
   print "Environment End ID:" .$_SESSION['envend']. "\n";
   print "\n";
         print "Environment Start Name:" .$_SESSION['envstartname']. "\n";
   print "Environment End Name:" .$_SESSION['envendname']. "\n";
  }else{
       print "Start Atom ID:" .$_SESSION['atomstart']. "\n";
   print "End Atom ID:" .$_SESSION['atomend']. "\n";
  }

  print " \n";
 
print "Atoms Migrated: \n";
 
print "\n";


    $ids =  $_SESSION['migrated_atoms'];
    $idr = explode("*",$ids);
    $amountid = count($idr); 

    for ($i=1; $i<$amountid; $i++) { 

      print $idr[$i]. "\n";

   }

    print " \n";
    print "Thank you for using ATOMR application provided by ConsiderCode.com\n";

}else{
    header('Location: index.php');
}
?>