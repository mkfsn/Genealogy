<?php
  define('DB_NAME','device');
  define('DB_USER','apitest');
  define('DB_PASSWD','F5017Aoslab');
  define('DB_HOST','');
  define('DB_TYPE','sqlite');
  $dbh = new PDO(DB_TYPE.':../../database/login.db');
  $sth = $dbh->prepare('SELECT * FROM `endpoint`');
  $sth->execute();
  $ans = array();
  while($meta = $sth->fetch(PDO::FETCH_ASSOC))
  {
 	$ans[] = $meta;
  //>-print_r($meta);
  }
 
 //print_r($ans);
 echo json_encode($ans);
?>
