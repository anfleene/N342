<?php
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