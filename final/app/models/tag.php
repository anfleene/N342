<?php
//this is a very basic method that only contains a name and an id
//it is related directly to posts but all the logic is done on the post model
class Tag extends AppModel
{
    var $name = 'Tag';
    var $validate = array(
      'name' => array(
        'rule' => 'notEmpty'
       )
    );
}
?>