<?

require_once("DB.php");

$dbh = DB::connect('mysql://root:f5017aoslab@localhost/test');
$result = $dbh->query('SELECT * FROM users ORDER BY id');
if ( $result->numRows($result) > 0 ) {
 echo "\nID\tuserName\tPassword\n";
  while ( $data = $result->fetchRow() ) {
  echo "$data[0]\t$data[1]\t$data[2]\n";
  }
  echo "\n";
} else {
  echo "Ok;\n";
}

?>
