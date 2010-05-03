<ul id="tag_cloud">
  <h1>Currently Used Tags</h1>
  <? foreach ($cloud as $tag): ?>
    <li value='<?=$tag['value']?>' title='<?=$tag['name']?>'><?=$html->link($tag['name'], array('controller' => 'posts', 'action' => 'index', '?tag='.$tag['name']))?></li>
  <? endforeach ?>
</ul>