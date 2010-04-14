<?php
  $posts = all_posts();
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <?php
    postsTable($posts)
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?

function all_posts(){
  include "includes/db_con.inc";
  $conn = conDB();
  $query = "SELECT * FROM posts"; 
  $posts = q($query);
  return $posts;
}

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