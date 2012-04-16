<?php
if(!isset($argv[2])){
	header("HTTP/1.1 400 Bad Request");
	echo json_encode(array("error"=>array("message" => "no Enough Argv")));
	exit;
}
	$requestID = $argv[2];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, "http://selcrs.nsysu.edu.tw/crs_sph/crs_sph.asp?ACTION=37&QM_STUID=" . $requestID);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POST,true);
	$output = curl_exec($ch);
	$output = iconv("BIG5","UTF-8",$output);
	print_r($output);
	






?>
