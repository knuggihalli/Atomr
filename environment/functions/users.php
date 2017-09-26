<?php

function user_exists($username){


}
function loggedin(){
 
}

function post_data($url,$xml,$auth){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
  $resp = curl_exec($ch);
  curl_close($ch);
  $p = xml_parser_create();
  xml_parse_into_struct($p, $resp, $vals, $index);
  xml_parser_free($p);
  return $vals;
}

function get_all_environments($accountId,$auth){
	$url = "https://api.boomi.com/api/rest/v1/". $accountId ."/Environment/query";
	$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
  </QueryFilter>
</QueryConfig>';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
  $resp = curl_exec($ch);
  curl_close($ch);
  $p = xml_parser_create();
  xml_parse_into_struct($p, $resp, $vals, $index);
  xml_parser_free($p);
  return $vals;
}
function get_all_processes($accountId,$auth,$envid){
	$url = "https://api.boomi.com/api/rest/v1/". $accountId ."/ProcessEnvironmentAttachment/query";
	$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="EQUALS" property="environmentId" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression">
        <argument>'.$envid.'</argument>
    </expression>
  </QueryFilter>
</QueryConfig>';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
  $resp = curl_exec($ch);
  curl_close($ch);
  $p = xml_parser_create();
  xml_parse_into_struct($p, $resp, $vals, $index);
  xml_parser_free($p);
  return $vals;
}
function get_all_schedules($accountId,$auth,$atom,$process){
  $url = "https://api.boomi.com/api/rest/v1/".$accountId."/ProcessSchedules/query";
  $xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="and" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="GroupingExpression">
       <nestedExpression operator="EQUALS" property="atomId" xsi:type="SimpleExpression">
           <argument>'.$atom.'</argument>
       </nestedExpression>
       <nestedExpression operator="EQUALS" property="processId" xsi:type="SimpleExpression">
           <argument>'.$process.'</argument>
       </nestedExpression>
    </expression>
  </QueryFilter>
</QueryConfig>';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
  $resp = curl_exec($ch);
  curl_close($ch);
  $p = xml_parser_create();
  xml_parse_into_struct($p, $resp, $vals, $index);
  xml_parser_free($p);
  return $vals;
}
function get_schedule($accountId,$auth,$conceptID){
  $url = "https://api.boomi.com/api/rest/v1/".$accountId."/ProcessSchedules/" .$conceptID;
  $ch = curl_init($url);

curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);
curl_close($ch);
$p = xml_parser_create();
xml_parse_into_struct($p, $resp, $vals, $index);
xml_parser_free($p);
return $vals;
}
function get_all_atoms($accountId,$auth,$envid){
	$url = "https://api.boomi.com/api/rest/v1/". $accountId ."/EnvironmentAtomAttachment/query";
	$xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="EQUALS" property="environmentId" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression">
        <argument>'.$envid.'</argument>
    </expression>
  </QueryFilter>
</QueryConfig>';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
  $resp = curl_exec($ch);
  curl_close($ch);
  $p = xml_parser_create();
  xml_parse_into_struct($p, $resp, $vals, $index);
  xml_parser_free($p);
  return $vals;
}
function atom_data($atomid,$id,$auth){
$url = "https://platform.boomi.com/api/rest/v1/" .$id. "/Atom/".$atomid;
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch); 
curl_close($ch);
$p = xml_parser_create();
xml_parse_into_struct($p, $resp, $vals, $index);
xml_parser_free($p); 
return $vals;
}
?>
