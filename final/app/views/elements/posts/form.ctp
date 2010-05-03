<?=$form->create('Post', array('action' => $action))?>
<?=$form->input('title')?>
<?=$form->input('body', array('rows' => '3'))?>
<?=$form->input('tags', array('class' => 'tagArea'))?>
<?=$form->input('id', array('type'=>'hidden'))?>
<?=$form->end('Save Post')?>
