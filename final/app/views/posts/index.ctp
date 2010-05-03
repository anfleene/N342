<!-- File: /app/views/posts/index.ctp -->
<h1>Blog posts</h1>
<div class='actions'>
  <h3><?= $html->link('Add Post',array('controller' => 'posts', 'action' => 'add'))?></h3>
</div>
<div id='posts'>
  <?php foreach ($posts as $post): ?>
    <?$post['Post']['comment_size'] = count($post['Comment'])?>
    <?= $this->element("posts/post", array('post' => $post['Post'], 'comments' => array(), 'tags' => $post['Tag']))?>
  <?php endforeach; ?>
</div>
