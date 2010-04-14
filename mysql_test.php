<?php
mysql_connect("342.local:3306", "root", "") or die(mysql_error());
echo "Connected to MySQL<br />";
mysql_select_db("n342") or die(mysql_error());
echo "Connected to n342 DB";
?>
