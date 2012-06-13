<?php

$hasargs = array(true, false, false);
if ( isset($argv[1]) && $argv[1]!="" )
	$hasargvs[1] = true;
if ( isset($argv[2]) && $argv[2]!="" )
	$hasargvs[2] = true;


$URL = "http://ph.osa.nsysu.edu.tw/files/15-1037-27623,c4340-1.php";
$UserAgent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: zh-tw'));

$output = curl_exec($ch);
curl_close($ch);

$objDOM = new DOMDocument();
$objDOM->loadHTML( $output );

$tableRows = $objDOM->getElementsByTagName('table')->item(2)->getElementsByTagName('tr');

$rowsName = array();
foreach ( $tableRows->item(0)->getElementsByTagName('td') as $td ) {
	$rowsName[] = $td->nodeValue;
}

$result = array();
for ( $i=1 ; $i<$tableRows->length ; $i++ ) {
	$tr = $tableRows->item($i);
	$tableCell = $tr->getElementsByTagName('td');
	$tmp = array();

	if ( $hasargvs[1] || $hasargv[2] )
		$match = false;
	else
		$match = true;

	foreach ( $tableCell as $j => $td ) {
		if ( $j == 0 && $hasargvs[1] ) {
			$fulldate = explode( "/", $td->nodeValue);
			if ( $fulldate[0] == $argv[1] ) {
				if ( $hasargvs[2] ) {
					if ( $argv[2] == $fulldate[1] )
						$match = true;
				}
				else
					$match = true;
			}
		}
		$tmp[ $rowsName[$j] ] = $td->nodeValue;
	}
	if ( $match )
		$result[] = $tmp;
	unset($tmp);
}

echo json_encode($result);

?>
