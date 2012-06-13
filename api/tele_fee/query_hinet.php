<?php
if(!isset($argv[2])){
	header("HTTP/1.1 400 Bad Request");
	echo json_encode(array("error"=>array("message" => "no Enough Argv")));
	exit;
}
	$requestPhone = $argv[2];
	$requestIDNO = $argv[3];
	$UserAgent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; Foxy/1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://info.hinet.net/account/tele_fee.asp');
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
	//curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, "cgi_id_no=".$requestIDNO."&cgi_q2p_act=qry&cgi_q2p_mode=tq&cgi_sbutton=pressed&cgi_tel_no=".$requestPhone);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($ch);
	//print_r($output);
	preg_match('%Set-Cookie: ([^;]+);%',$output,$M);
        $output = iconv("BIG-5","UTF-8",$output);
	//echo htmlspecialchars($output);

curl_close($ch);

	print_r($M);
	echo '<br><br>';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, 'https://info.hinet.net/account/tele_fee.asp');
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, $UserAgent);
	curl_setopt($ch, CURLOPT_COOKIE, $M[1]);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "cgi_id_no=".$requestIDNO."&cgi_q2p_act=qry&cgi_q2p_mode=tq&cgi_sbutton=pressed&cgi_tel_no=".$requestPhone);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($ch);
	//print_r($output);
	//$output = iconv("BIG-5","UTF-8",$output);
	echo nl2br(htmlspecialchars($output));

	$doc = new DOMDocument();
	$doc->loadHTML($output);	

	$tables = $doc->getElementsByTagName('table');
	foreach ($tables as $key => $tb) {
		printf("<br>-$key------------------------------<br>");
	       print_r($tb->nodeValue);
	}
	print_r($tables->item(21)->nodeValue);
	

/*
        $output = str_replace('<body>','',$output);
        $output = str_replace('<div align="center"><center>','',$output);
        $output = str_replace('</center>  </div>','',$output);
        $output = str_replace('</body></html></center></div>','',$output);
        $out = array();
        $doc = new DOMDocument();
        $doc->loadHTML($output);
        $tableRows = $doc->getElementsByTagName('tr'); // get tr
        $attrName = array();

        foreach ($tableRows->item(0)->getElementsByTagName('td') as $th) {
                $attrName[] = $th->nodeValue;
        }
        for($i=1;$i<$tableRows->length;++$i) {
            $tr = $tableRows->item($i);
            $tableCells = $tr->getElementsByTagName('td');
            $tmp = array();
            foreach ($tableCells as $j=> $td) {
                $tmp[$attrName[$j]] = $td->nodeValue;
            }
            $out[] = $tmp;
            unset($tmp);
        }
        echo json_encode($out);
	
*/





?>
