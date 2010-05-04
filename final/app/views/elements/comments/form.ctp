<?//this is the comment form that is shared by add and edit?>
<?= $form->create('Comment', array('url' => array('action' => $action, 'post_id' => $this->params['post_id'])))?>
<?= $form->input('body', array('rows' => '3')) ?>
<?= $form->input('post_id', array('type'=>'hidden', 'value' => $this->params['post_id'])) ?>
<?= $form->end("Submit") ?>
