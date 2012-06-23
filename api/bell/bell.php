<?php


//$URL = "http://[2001:288:8001:d600:6616:f0ff:fe90:931a]:8080/bell";
$URL = 'http://140.117.182.118:8080/bell';
$posts = array( "condition_1"=>$argv[1], "query_type"=>"1", "submit"=>"%BDT%A9w");
$UserAgent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)";


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
