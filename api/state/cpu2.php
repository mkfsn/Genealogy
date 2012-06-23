<?php

$URL = "http://www.mkfsn.cdpa.tw/~mkfsn/cputemp.php";
$posts = array( "condition_1"=>$argv[1], "query_type"=>"1", "submit"=>"%BDT%A9w");
$UserAgent = "";


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$output = curl_exec($ch);
curl_close($ch);
echo $output



?>
