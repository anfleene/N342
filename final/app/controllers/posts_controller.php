<?php
  class PostsController extends AppController {
    var $name = 'Posts';
    
    function index() {
      $tags = $this->Post->Tag->find('all');
      $tag_cloud = array();
      foreach($tags as $tag){
        $tag_cloud[] = array('name' => $tag['Tag']['name'], 'value' => $this->Post->PostsTag->find('count', array('conditions' => array('tag_id' => $tag['Tag']['id']))));
      }
      $this->set('tag_cloud', $tag_cloud);
      if(isset($this->params['url']['tag'])){
        $results = $this->Post->query("SELECT DISTINCT PostsTag.post_id  FROM posts as Post INNER JOIN posts_tags as PostsTag  ON ( PostsTag.tag_id = (SELECT id From tags where(name = '".$this->params['url']['tag']."')))");
        $ids = array();
        foreach($results as $post_id){
          $ids[]=$post_id['PostsTag']['post_id'];
        }
        $conditions = array('Post.id' => $ids);
        $this->set('posts', $this->Post->find('all', array('conditions' => $conditions)));
      }else{
       $this->set('posts', $this->Post->find('all'));
      }
    }
    
    function view() {
      $this->Post->id = $this->params['id'];
      $this->set('post', $this->Post->read());
    }
    
    function add() {
      if (!empty($this->data)) { 
        if ($this->Post->save($this->data)) {
          $this->Session->setFlash('Your post has been saved.');
          $this->redirect(array('action' => 'index'));
        }
      }
    }
    
    function delete() {
       $this->Post->delete($this->params['id']);
       $this->Session->setFlash('The post with id: '.$this->params['id'].' has been deleted.');
       $this->redirect(array('action'=>'index'));
    }
    
    function edit() {
      $this->Post->id = $this->params['id'];
      if (empty($this->data)) {
        $this->data = $this->Post->read();
      } else {
        if ($this->Post->save($this->data)) {
          $this->Session->setFlash('Your post has been updated.');
          $this->redirect(array('action' => 'view', $this->Post->id));
        }
      }
    }
  }
?>