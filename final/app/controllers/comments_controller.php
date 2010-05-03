<?php
  class CommentsController extends AppController {
    var $name = 'Comments';
    
    function view() {
      $this->Comment->id = $this->params['id'];
      $this->set('comment', $this->Comment->read());
    }
    
    function add() {
      $this->Comment->post_id = $this->params['post_id'];
      if (!empty($this->data)) { 
        if ($this->Comment->save($this->data)) {
          $this->Session->setFlash('Your comment has been saved.');
          $this->redirect(array('controller' => 'posts', 'action' => 'view', 'id' => $this->Comment->post_id));
        }
      }
    }
    
    function delete() {
       $this->Comment->delete($this->params['id']);
       $this->Session->setFlash('The post with id: '.$id.' has been deleted.');
       $this->redirect(array('controller' => 'posts', 'action'=>'view', $this->Comment->post_id));
    }
    
    function edit() {
      $this->Comment->id = $this->params['id'];
      if (empty($this->data)) {
        $this->data = $this->Comment->read();
      } else {
        if ($this->Comment->save($this->data)) {
          $this->Session->setFlash('Your post has been updated.');
          $this->redirect(array('action' => 'view', $this->Comment->id));
        }
      }
    }
  }
