<?php
  if(filter_input_array(INPUT_GET)){
    $id = filter_input(INPUT_GET, "id");
    $post = find_post($id);
  }else{
    //post not found
    //redirect to index with error message
  }
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <?php
    print_post($post['title'], $post['content']);
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?
function print_post($title, $content){ ?>
<div class="blog">
  <h2><?=$title?></h3>
  <p><?=$content?></p>
  <p><?=$status?></p>
</div>
<?}

function find_post($id){
  include "includes/db_con.inc";
  $conn = conDB();
  $query = "SELECT * FROM posts where posts.id = '".$id."'"; 
  $result = q($query);
  $post = mysql_fetch_array($result);
  return $post;
}

?>