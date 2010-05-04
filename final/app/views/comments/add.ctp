<?//this view renders the shared comment form?>
<h1>Add Comment</h1>
<?= $this->element('comments/form', array('action' => 'add')) ?>