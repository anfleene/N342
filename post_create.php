<?php
//get input
  if(filter_input_array(INPUT_POST)){
   $title = filter_input(INPUT_POST, "title");
   $content = filter_input(INPUT_POST, "content");
//create a post
   $post_id = create_post($title, $content);
//if the create returns an id redirect to the show method 
   header('Location: /post_show.php?id='.$post_id.'');
  }else{
    //if the post isn't created redirect back to new
    header('Location: /post_new.php');
  }

//this function actually creates a new post
function create_post($title, $content){
  //establish a database connection
  include "includes/db_con.inc";
  $conn = conDB();
  //build an insert query
  $query = sprintf("INSERT INTO posts (title, content) VALUES('%s', '%s') ",
              mysql_real_escape_string($title),
              mysql_real_escape_string($content));
  q($query);
  //select the most recently created post
  $result = q("SELECT id FROM posts ORDER BY posts.id DESC LIMIT 1");
  $post = mysql_fetch_array($result);
  //return the id of the last post
  return $post['id'];
}

?>
