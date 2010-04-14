<?php
  if(filter_input_array(INPUT_POST)){
   $title = filter_input(INPUT_POST, "title");
   $content = filter_input(INPUT_POST, "content");
   $post_id = create_post($title, $content);
   header('Location: /post_show.php?id='.$post_id.'');
  }else{
    header('Location: /post_new.php');
  }

function create_post($title, $content){
  include "includes/db_con.inc";
  $conn = conDB();
  $query = sprintf("INSERT INTO posts (title, content) VALUES('%s', '%s') ",
              mysql_real_escape_string($title),
              mysql_real_escape_string($content));
  q($query);
  $result = q("SELECT id FROM posts ORDER BY posts.id DESC LIMIT 1");
  $post = mysql_fetch_array($result);
  return $post['id'];
}

?>
