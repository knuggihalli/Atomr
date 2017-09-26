<?php

function env_get_name($atomid,$id,$auth){

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
function env_get_atoms($start,$id,$auth){

  $url = "https://api.boomi.com/api/rest/v1/" .$id. "/EnvironmentAtomAttachment/query";
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

  $url = "https://platform.boomi.com/api/rest/v1/". $id ."/ProcessAtomAttachment/query" ;

$xml = '<bns:ProcessAtomAttachment atomId="'. $end .'" 
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


return 1;
}


?>