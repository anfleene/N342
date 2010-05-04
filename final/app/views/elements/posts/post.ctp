<?//this is the post view that is shared between view and index ?>
<div class='post' id='post_<?=$post['id']?>'>
  <p class='date'><?= $post['created']; ?></p>
  <h2><?= $html->link($post['title'],
  array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
  </h2>
  <div class='body'>
    <?= $html->para('', $post['body'], array(), true)?>
  </div>
  <div class='tags'>
    <ul>
      <li>Tags:</li>
      <?//create a list of tag links?>
      <?foreach($tags as $tag): ?>
        <?= $this->element('tags/tag', array('tag' => $tag))?>
      <? endforeach; ?>
    <ul>
  </div>
  <?//these are all the actions that can be performed on a post
    //the links change based on the data on a post
  ?>
  <div class='actions'>  
    <ul>
      <?//if there are comments already link to the number of comments?>
      <? if(!isset($post['comment_size']) || ($post['comment_size'] < 1)){?>
        <li><?= $html->link('Add A Comment',array('controller' => 'comments', 'action' => 'add', 'post_id' => $post['id']), array('class' => 'comment_add')) ?></li>
      <?}else{?>
        <li><?= $html->link('View '.$post['comment_size'].' Comments', array('action' => 'view', $post['id']))?></li>
      <?}?>
      <? if(isset($comments)){?>
        <li><?= $html->link('All Posts', array('controller' => 'posts', 'action' => 'index'))?>
      <?}?>
      <li><?= $html->link('Edit', array('action'=>'edit', $post['id']));?></li>
      <li><?= $html->link('Delete', array('action' => 'delete', $post['id']), null, 'Are you sure?' )?></li>
    </ul>
  </div>
  <?//render all the comments on this post?>
  <div class='comments'>
      <?php foreach ($comments as $comment): ?>
        <?= $this->element('comments/comment', array('comment' => $comment, 'noPostLink' => true)) ?>
      <? endforeach; ?>
  </div>
</div>