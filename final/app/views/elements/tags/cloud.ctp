<ul id="tag_cloud">
  <? foreach ($cloud as $tag): ?>
    <li value='<?=$tag['value']?>' title='<?=$tag['name']?>'><?=$html->link($tag['name'], array('controller' => 'posts', 'action' => 'index', '?tag='.$tag['name']))?></li>
  <? endforeach ?>
</ul>