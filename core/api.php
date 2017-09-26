<?php
include 'init.php';

if(isset($_POST['url']) && isset($_POST['username']) && isset($_POST['password'])){
  
  //Set variables 
  $accounturl = $_POST['url'];
  $username = $_POST['username'];
  $password = $_POST['password'];
 
  //Base64 encode the password and username 
  $str = $username . ":". $password;
  $encode = base64_encode($str);
  $auth = "Basic" . " " . $encode;
 
  //Explode the url and extract the user id
  $account = $accounturl;
  
  //Check if userid and encode are set
  if (isset($account) && isset($auth)) {
    //construct url based on account
    $url = "https://platform.boomi.com/api/rest/v1/". $account ."/Account/". $account;
    //HTTP GET response from url=>// Get cURL resource
$ch = curl_init($url);

curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$resp = curl_exec($ch);
curl_close($ch);

$p = xml_parser_create();
xml_parse_into_struct($p, $resp, $vals, $index);
xml_parser_free($p);

    $_SESSION['logged'] = 1;
    $_SESSION['auth'] = $auth;
    $_SESSION['account_id'] = $account;
    $_SESSION['supportlevel'] = $vals[0]['attributes']['SUPPORTLEVEL'];
    $_SESSION['accountexpire'] = $vals[0]['attributes']['EXPIRATIONDATE'];
    $_SESSION['accountstatus'] = $vals[0]['attributes']['STATUS'];
    $_SESSION['name'] = $vals[0]['attributes']['NAME'];

for($x=0; $x<=7; $x++){
$vals[$x] = serialize($vals[$x]);
//$vals[$x] = str_replace("a:","",$vals[$x]);
//$vals[$x] = str_replace("s:","",$vals[$x]);
$vals[$x] = str_replace("{"," ",$vals[$x]);
$vals[$x] = str_replace("}"," ",$vals[$x]);
$vals[$x] = explode('"', $vals[$x]);
$vals[$x] = str_replace("s","",$vals[$x]);
$vals[$x] = str_replace("a","",$vals[$x]);
}

    $_SESSION['licenses'] = $vals;
    header('Location: /Atomr/main.php');


  }else{
    header('Location: index.php?cmt=We could not verify your account');
  }

}else{
  header('Location: index.php?cmt=You need to enter all fields');
}
?>