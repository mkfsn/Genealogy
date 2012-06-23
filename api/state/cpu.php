<?php

if ( !isset( $argv[1] ) || $argv[1]=="" ) {
	$result = array( array( "Error" => "Not Implmented") ,'Usage' => array("cpu", "mem", "eth0") );
	echo json_encode($result);
	exit;
}

$URL = "http://www.mkfsn.cdpa.tw/mrtg/cpu/localhost.html";
$UserAgent = "Mozilla/4.0";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$output = curl_exec($ch);
curl_close($ch);

//$output = file_get_contents( $URL );
/*
echo "<pre>";
echo nl2br( htmlspecialchars($output) );
echo "</pre>";
exit;
*/
$objDOM = new DOMDocument();
$objDOM->loadHTML( $output );

$tableRows = $objDOM->getElementsByTagName('table')->item(1)->getElementsByTagName('tr');

$rowsName = array();
foreach ( $tableRows->item(0)->getElementsByTagName('th') as $th ) {
	if ( $th->nodeValue == "" ) {
		$rowsName[] = "Item";
		continue;
	}
	$rowsName[] = str_replace ( "\\u00a0", "", trim ( $th->nodeValue ) );
}

for ( $i=1 ; $i<$tableRows->length ; $i++ ) {
	$tr = $tableRows->item($i);

	$tableCell = $tr->getElementsByTagName('td');

	$tmp = array();
	$tmp[ $rowsName[0] ] = str_replace( "　", "", trim ( $tr->getElementsByTagName('th')->item(0)->nodeValue ) );
	foreach ( $tableCell as $j => $td ) {
		$tmp[ $rowsName[$j+1] ] = str_replace ( "　", "", trim ( $td->nodeValue ) );
	}
	$result[] = $tmp;
	unset($tmp);
}

echo json_encode($result);

?>
