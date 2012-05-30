<?php


$URL = "http://car.nsysu.edu.tw/cgi-bin/car/car_query.pl";
$posts = array( "condition_1"=>$argv[1], "query_type"=>"1", "submit"=>"%BDT%A9w");
$UserAgent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)";


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: zh-tw'));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $posts ));

$output = curl_exec($ch);
curl_close($ch);


$objDOM = new DOMDocument();
$objDOM->loadHTML( $output );

$tableRows = $objDOM->getElementsByTagName('table')->item(3)->getElementsByTagName('tr');

$rowsName = array();
$match = true;
foreach ( $tableRows->item(0)->getElementsByTagName('td') as $td ) {
	$rowsName[] = $td->nodeValue;
	if ( $td->nodeValue == "" )
		$match = false;
}
if ( count($rowsName) == 1 )
	$match = false;


$result = array();
for ( $i=1 ; $match && $i<$tableRows->length ; $i++ ) {
	$tr = $tableRows->item($i);
	$tableCell = $tr->getElementsByTagName('td');
	$tmp = array();

	foreach ( $tableCell as $j => $td ) {
		$tmp[ $rowsName[$j] ] = $td->nodeValue;
	}
	$result[] = $tmp;
	unset($tmp);
}

echo json_encode($result) ;

?>
