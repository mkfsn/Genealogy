<?php


$URL = "http://140.117.183.242";
$UserAgent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)";

if($argv[2] == "on"){
	$URL .= "/Z";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$output = curl_exec($ch);
curl_close($ch);
echo json_encode("Success");



?>
