<?php

function sanatize($data){
$data = strip_tags($data);
$data = htmlentities($data);
return mysql_real_escape_string($data); 
}
function sanatize_entry($data){
return mysql_real_escape_string($data);
}
function sanatize_cover($url){
$url = urlencode($url);
$url = mysql_real_escape_string($url);
return $url;
}
function encrypt($data1){
//salt
	$salt = "loginr";
	$data1 = $data1 . $salt;

$num1 = sha1($data1);
$num2 = md5($num1);
$num3 = crypt($num2);

return $num2;

}

function lock($data2){

$chars = str_split($data2);
$encrypted = '';

foreach ($chars as $character) {
	$encrypted .= (ord($character) * 4) . '.';
}
return $encrypted;
}

function unlock($message){

$chars = explode('.', $message);
$decrypted = '';

foreach ($chars as $character) {
	$decrypted .= (chr($character / 4));
}
return $decrypted;

}

?>