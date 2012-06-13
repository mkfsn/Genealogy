<?
  #mysql_connect("140.117.202.201","apitest","F5017Aoslab");
  #mysql_select_db("device");
  #mysql_query("set name utf8");
  #mysql_close();
 
  define('DB_NAME','device');
  define('DB_USER','apitest');
  define('DB_PASSWD','F5017Aoslab');
  define('DB_HOST','140.117.202.201');
  define('DB_TYPE','mysql');
  $dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
  $sth = $dbh->prepare('SELECT * FROM `device1` WHERE 1');
  $sth->execute();
  $ans = array();
  while($meta = $sth->fetch(PDO::FETCH_ASSOC))
  {
  >---$ans[] = $meta;
  //>-print_r($meta);
  }
 
 //print_r($ans);
 echo json_encode($ans);
?>
