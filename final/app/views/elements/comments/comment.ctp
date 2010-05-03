<p><small><?= $comment['created']?></small></p>
<p><?= $comment['body']?></p>
<? if(!isset($noPostLink)){?>
  <p><?= $html->link('Posted On', array('controller' => 'posts', 'action' => 'view', $comment['post_id']))?></p>
<?}?>