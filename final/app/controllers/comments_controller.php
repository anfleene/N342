<?php
/**
This is the comments controller, used to add comments to posts
**/
  class CommentsController extends AppController {
    var $name = 'Comments';
    
    //view a single comment
    function view() {
      $this->Comment->id = $this->params['id'];
      $this->set('comment', $this->Comment->read());
    }
    
    //add a new comment
    function add() {
      //set the post_id
      $this->Comment->post_id = $this->params['post_id'];
      if (!empty($this->data)) { 
        //save the new comment and set a success message and redirect
        if ($this->Comment->save($this->data)) {
          $this->Session->setFlash('Your comment has been saved.');
          $this->redirect(array('controller' => 'posts', 'action' => 'view', 'id' => $this->Comment->post_id));
        }
      }
    }
    
    //delete the passed comment
    function delete() {
       $this->Comment->delete($this->params['id']);
       $this->Session->setFlash('The post with id: '.$id.' has been deleted.');
       $this->redirect(array('controller' => 'posts', 'action'=>'view', $this->Comment->post_id));
    }
    
    //edit the passed comment
    function edit() {
      $this->Comment->id = $this->params['id'];
      if (empty($this->data)) {
        //find the paramed Comment
        $this->data = $this->Comment->read();
      } else {
        //update the paramed comment
        if ($this->Comment->save($this->data)) {
          $this->Session->setFlash('Your post has been updated.');
          $this->redirect(array('action' => 'view', $this->Comment->id));
        }
      }
    }
  }
