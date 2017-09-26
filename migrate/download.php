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
   print "Start Atom ID:" .$_SESSION['atomstart']. "\n";
   print "End Atom ID:" .$_SESSION['atomend']. "\n";

  print " \n";
   $proc = explode('*', $_SESSION['proc']);
   $amountp = count($proc);
   for ($y=1; $y<$amountp; $y++) { 
   	# code...
      print "Process Migrated:" .$proc[$y]. "\n";
   }

   print " \n";
   $ids = explode('*', $_SESSION['ids']);
   $amount = count($ids);
   for ($x=1; $x<$amount; $x++) { 
   	# code...
      print "Schedule Migrated:" .$ids[$x]. "\n";
   }

    print " \n";
    print "Thank you for using WorkFlow application provided by ConsiderCode.com\n";

}else{
    header('Location: index.php');
}
?>