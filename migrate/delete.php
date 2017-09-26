<?php
include 'init.php';

if (isset($_SESSION['logged'])) {
	
if(isset($_POST['answer'])){
 $answer = $_POST['answer'];

if ($answer == 1) {
  //Delete Section
$delurl = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] ."/Atom/" . $_SESSION['atomstart'] ;

$delch = curl_init();
curl_setopt($delch, CURLOPT_URL, $delurl);
curl_setopt($delch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($delch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($delch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));

$output = curl_exec($delch);
curl_close($delch);

$t = xml_parser_create();
xml_parse_into_struct($t, $output, $val, $index);
xml_parser_free($t);

header('Location: /Atomr/main.php?cmt= Atom has been deleted');

}else{
  header('Location: /Atomr/main.php');
}


}else{
	header('Location: /BoomiWorkflow/core/migratep.php?cmt=You must choose a process to migrate');}
}else{
    header('Location: index.php');
}
?>
