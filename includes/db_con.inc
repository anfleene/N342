<?php
  include "includes/mysql_constants.def";
  
  function conDB(){
    $conn = mysql_connect(DBHOST, USER, PASSWORD) or die('Error connecting to mysql');
    mysql_select_db(DB);
    return $conn;
  }
  
  function q($query){
    $results = mysql_query($query) or die(mysql_error());
    return $results;
  }
?>