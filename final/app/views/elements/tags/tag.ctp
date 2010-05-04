<?//this is a link to the post index with the current tag as a scope?>
<li><?= $html->link($tag['name'], array('controller' => 'posts', 'action' => 'index', '?tag='.$tag['name']))?></li>