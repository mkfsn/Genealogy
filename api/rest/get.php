<?php
if(isset($argv[1])){
	switch($argv[1]){
		case "version"  :
			echo json_encode("0.01");
		exit;
		case "equipment" :
			getEquipment($argv);
		exit;
		case "location" :
			if(!isset($argv[2]) || $argv[2] == ""){
				include("../database/fBuilding.php");
				$res = funcBuilding();
				if($res['success'] == false){
					header("HTTP/1.1 404 Not Found");
				}else{
					header("HTTP/1.1 200 OK");
					echo json_encode($res["data"]);
				}
				exit;
			}else{
				include("../database/fList.php");
				$res = funcList(array("dorm" => $argv[2]));
				if($res['success'] == false){
					header("HTTP/1.1 404 Not Found");
				}else{
					header("HTTP/1.1 200 OK");
					echo json_encode($res["data"]);
				}

			}
		exit;
		case "crs_speech" :
			require('crs/crs_speech.php');
		exit;
		case "tele_fee" :
			require("tele_fee/query_hinet.php");
		exit;
		case "car_nsysu":
			require("car/car.php");
		exit;
		case "sport_nsysu":
			require("sport/sport.php");
		exit;
	}
}else{
	header("HTTP/1.1 200 OK");
}



?>
