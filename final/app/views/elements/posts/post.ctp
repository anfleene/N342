<div class='post' id='post_<?=$post['id']?>'>
  <p class='date'><?= $post['created']; ?></p>
  <h2><?= $html->link($post['title'],
  array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
  </h2>
  <?= $html->para('body', $post['body'], array(), true)?>
  <div class='tags'>
    <ul>
    <?foreach($tags as $tag): ?>
      <?= $this->element('tags/tag', array('tag' => $tag))?>
    <? endforeach; ?>
    <ul>
  </div>
    <div id='comments'>
        <?php foreach ($comments as $comment): ?>
          <?= $this->element('comments/comment', array('comment' => $comment, 'noPostLink' => true)) ?>
        <? endforeach; ?>
    </div>
  <ul class='actions'>
    <? if(isset($comments) || ($post['comment_size'] < 1)){?>
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