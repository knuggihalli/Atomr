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


function get_schedules($start,$end,$id,$auth){
$surl = "https://platform.boomi.com/api/rest/v1/". $id ."/ProcessSchedules/query";
$sxml = '<QueryConfig xmlns="http://api.platform.boomi.com/">
  <QueryFilter>
    <expression operator="and" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="GroupingExpression">
       <nestedExpression operator="EQUALS" property="atomId" xsi:type="SimpleExpression">
           <argument>' . $start .'</argument>
       </nestedExpression>
    </expression>
  </QueryFilter>
</QueryConfig>';

    //HTTP GET response from url=>// Get cURL resource
$sch = curl_init($surl);
 
curl_setopt($sch, CURLOPT_POST, 1);
curl_setopt($sch, CURLOPT_POSTFIELDS, $sxml);
curl_setopt($sch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($sch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
 
$sresp = curl_exec($sch);
curl_close($sch);

$sp = xml_parser_create();
xml_parse_into_struct($sp, $sresp, $svals, $sindex);
xml_parser_free($sp);



$sresults = $svals[0]['attributes']['NUMBEROFRESULTS'];
$x = 0;
$s = 0;
$d = 0;
$year = 0;
$month = 0;
$daysOfMonth = 0;
$daysOfWeek = 0;
$hours = 0;
$minutes = 0;
$_SESSION['ids'] = 0;

                while (isset($svals[$x]['tag'])) {
                  if (isset($svals[$x]['attributes']['ID'])) {
                    $d = $d."*" . $svals[$x]['attributes']['ID'];
                    $x = $x+1;
                  }else{
                    $x = $x+1;
                  } 
                }
        
                $ids = explode('*', $d);
                $amount = count($ids);
                for ($g=1; $g<$amount ; $g++) { 


                  $_SESSION['ids'] = $_SESSION['ids'] ."*". $ids[$g];

                  $shurl = "https://platform.boomi.com/api/rest/v1/". $id ."/ProcessSchedules/". $ids[$g];

                  $shch = curl_init($shurl);

          curl_setopt($shch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
          curl_setopt($shch, CURLOPT_RETURNTRANSFER, 1);

          $shresp = curl_exec($shch);
          curl_close($shch);

          $shp = xml_parser_create();
          xml_parse_into_struct($shp, $shresp, $shvals, $shindex);
          xml_parser_free($shp);

          

       

                //get all the values and build an xml document
                while(isset($shvals[$s]['tag'])){
                  if (isset($shvals[$s]['attributes']['YEARS'])) {
                    $year = $shvals[$s]['attributes']['YEARS'];
                    $month = $shvals[$s]['attributes']['MONTHS'];
                    $daysOfMonth = $shvals[$s]['attributes']['DAYSOFMONTH'];
                    $daysOfWeek = $shvals[$s]['attributes']['DAYSOFWEEK'];
                    $hours = $shvals[$s]['attributes']['HOURS'];
                    $minutes = $shvals[$s]['attributes']['MINUTES'];

                    $murl = "https://platform.boomi.com/api/rest/v1/". $_SESSION['account_id'] . "/ProcessSchedules/".$ids[$g]."/update";
                  
                    $mxml = ($shresp) . PHP_EOL;
                    $mxml = str_replace($start,$end,$mxml);

                    

$mch = curl_init($murl);
 
curl_setopt($mch, CURLOPT_POST, 1);
curl_setopt($mch, CURLOPT_POSTFIELDS, $mxml);
curl_setopt($mch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($mch,CURLOPT_HTTPHEADER,array('Authorization:' . $auth));
 
$mresp = curl_exec($mch);
curl_close($mch);

$mp = xml_parser_create();
xml_parse_into_struct($mp, $mresp, $mvals, $mindex);
xml_parser_free($mp);



                    $s = $s+1;
                  }else{
                    $s = $s+1;
                  } 




                   

                }


                }
 
}






?>