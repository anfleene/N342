<?php
//this script will display all the current posts in the database
  $posts = all_posts();
  //shut up warnings
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <ul id="subnav">
    <li><a href="post_new.php">New Post</a></li>
  </ul>
  <?php
  //build a table of all the posts
    postsTable($posts)
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?
//this function finds all the posts in the database
function all_posts(){
  include "includes/db_con.inc";
  $conn = conDB();
  $query = "SELECT * FROM posts"; 
  $posts = q($query);
  return $posts;
}
//this function 
function postsTable($posts){?>
    <div id="posts">
      <table>
        <thead>
          <tr>
            <th>Title</th>
            <th>Content Preview</th>
          </tr>
        </thead>
        <tbody>
          <?
            while ($post = mysql_fetch_array($posts, MYSQL_ASSOC)){
              postRow($post);
          }?>
        </tbody>
      </table>
    </div>
<?}

function postRow($post){?>
  <tr>
    <td><?= $post['title']?></td>
    <td><?= substr($post['content'],0, 32)?>...<a href="post_show.php?id=<?=$post['id']?>">[more]</a></td>
  </tr>
  
<?}

?>