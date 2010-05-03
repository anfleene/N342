<div class='comment'>
  <p class='date'><?= $comment['created']?></p>
  <p class='body'><?= $comment['body']?></p>
  <? if(!isset($noPostLink)){?>
    <p><?= $html->link('Posted On', array('controller' => 'posts', 'action' => 'view', $comment['post_id']))?></p>
  <?}?>
</div>