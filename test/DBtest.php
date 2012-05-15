<html><head><meta http-equiv="Content-Type" content="text/html";
charset=UTF-8">
<title>ex</title>
</head><body>
<?
$db_server="localhost";
$db_name="test";
$db_user="root";
$db_password="f5017aoslab";
if(!@mysql_connect($db_server,$db_user,$db_password))
	die("can not connect to database");
else 
	die("done");
mysql_query("SET NAME utf8");

if(!@mysql_select_db($db_name))
	die("can not use database");
?></body>
</html>