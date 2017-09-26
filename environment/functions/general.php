<?php

function env_get_process($start,$end,$id,$auth){

  $url = "https://platform.boomi.com/api/rest/v1/" .$id. "/ProcessEnvironmentAttachment/query";
    $xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="EQUALS" property="environmentId" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression">
        <argument>'.$start.'</argument>
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

function get_process($start,$end,$id,$auth){

  $url = "https://platform.boomi.com/api/rest/v1/" .$id. "/ProcessAtomAttachment/query";
    $xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="EQUALS" property="atomId" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression">
        <argument>'.$start.'</argument>
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

function migrate_process($process,$end,$id,$auth){

  $url = "https://platform.boomi.com/api/rest/v1/". $id ."/ProcessEnvironmentAttachment/" ;

 $xml = '<bns:ProcessEnvironmentAttachment environmentId="'. $end .'" 
     processId="' . $process .'" xmlns:bns="http://api.platform.boomi.com/" 
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>';    

  //Set the start and end atom session
  //open connection
	$xml = (string)$xml;


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

//Deployment
$durl = "https://api.boomi.com/api/rest/v1/". $id ."/Deployment/";
$date = date("Y/m/d");

$dxml = '<bns:Deployment xmlns:bns="http://api.platform.boomi.com/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <bns:environmentId>'.$end.'</bns:environmentId>
    <bns:processId>'.$process.'</bns:processId>
    <bns:notes>Deployed from the ATOMR platform on - '.$date.' via ConsiderCode Limmited</bns:notes>
</bns:Deployment>';

$dch = curl_init($durl);

curl_setopt($dch, CURLOPT_POST, 1);
curl_setopt($dch, CURLOPT_POSTFIELDS, $dxml);
curl_setopt($dch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
 
$dresp = curl_exec($dch);
curl_close($dch);

$dp = xml_parser_create();
xml_parse_into_struct($dp, $dresp, $dvals, $dindex);
xml_parser_free($dp);

return 1;
}

function migrate_schedule($accountid,$startenv,$auth){ 

  $url = " https://api.boomi.com/api/rest/v1/".$accountid."/ProcessEnvironmentAttachment/query";

  $xml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="EQUALS" property="environmentId" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="SimpleExpression">
        <argument>'.$startenv.'</argument>
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


?>