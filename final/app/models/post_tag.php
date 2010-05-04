<?php
//this is the join table for posts and tags
class PostTag extends AppModel
{
    var $name = 'PostTag';
    var $belongsTo = array('Post', 'Tag');
}
?>