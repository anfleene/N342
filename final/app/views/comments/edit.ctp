<h1>Edit Post</h1>
<?php
//this renders a form that can be edited
  echo $form->create('Comment', array('action' => 'edit'));
  echo $form->input('body', array('rows' => '3'));
  echo $form->input('id', array('type'=>'hidden')); 
  echo $form->end('Save Comment');
?>