<?php
/**
this is a basic comment model, very simple
the only attributes are body, id, and post_id
**/
   class Comment extends AppModel {
     var $name = 'Comment';
     var $belongsTo = 'Post';
     
     var $validate = array(
       'body' => array(
         'rule' => 'notEmpty'
        )
      );
   }
?>
