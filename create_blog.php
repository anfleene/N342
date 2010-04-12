<?php
  if(filter_input_array(INPUT_POST)){
   $title = filter_input(INPUT_POST, "title");
   $post = filter_input(INPUT_POST, "post");
   $conn = connect_to_db();
   mysql_close($conn);
  }else{
    header('Location: /new_blog.php');
  }
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <?php
   printBlog($title, $post);
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?
function printBlog($title, $post){ ?>
<div class="blog">
  <h2><?=$title?></h3>
  <p><?=$post?></p>
</div>
<?}

function connect_to_db(){
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';

  $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');

  $dbname = 'mobi_development';
  mysql_select_db($dbname);
  return $conn;
}

?>
