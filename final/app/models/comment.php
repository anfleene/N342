<?php
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
