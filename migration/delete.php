<?php
include 'init.php';

if (isset($_SESSION['logged'])) {
	
if(isset($_POST['answer'])){
 $answer = $_POST['answer'];

if ($answer == 1) {
  //Delete Section

$depurl ="https://platform.boomi.com/api/rest/v1/".$_SESSION['account_id']."/Deployment/";

$dxml= '<bns:Deployment xmlns:bns="http://api.platform.boomi.com/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <bns:environmentId>'. $_SESSION['envend'] .'</bns:environmentId>
    <bns:processId>' . $process .'</bns:processId>
    <bns:notes>via RESTish request:</bns:notes>
</bns:Deployment>';

$dch = curl_init($depurl);
curl_setopt($dch, CURLOPT_POST, 1);
curl_setopt($dch, CURLOPT_POSTFIELDS, $dxml);
curl_setopt($dch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dch,CURLOPT_HTTPHEADER,array('Authorization:' . $_SESSION['auth']));
 
$dresp = curl_exec($dch);
curl_close($dch);

$dp = xml_parser_create();
xml_parse_into_struct($dp, $dresp, $dvals, $dindex);
xml_parser_free($dp);

header('Location: /Atomr/main.php?cmt= process has been deployed');

}else{
  header('Location: /Atomr/main.php');
}


}else{
	header('Location: /BoomiWorkflow/core/migratep.php?cmt=You must choose a process to migrate');}
}else{
    header('Location: index.php');
}
?>
