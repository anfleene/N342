<?php
  class PostsController extends AppController {
    var $name = 'Posts';
    
    function index() {
      //find all tags
      $tags = $this->Post->Tag->find('all');
      //build the tag cloud
      $tag_cloud = array();
      foreach($tags as $tag){
        //find the number of posts that use the current tag ['name' => 'tagname', 'value' => numberoftags]
        $tag_cloud[] = array('name' => $tag['Tag']['name'], 'value' => $this->Post->PostsTag->find('count', array('conditions' => array('tag_id' => $tag['Tag']['id']))));
      }
      //make this availble to the view
      $this->set('tag_cloud', $tag_cloud);
      //if a tag is passed find the posts with that tag
      if(isset($this->params['url']['tag'])){
        $results = $this->Post->query("SELECT DISTINCT PostsTag.post_id  FROM posts as Post INNER JOIN posts_tags as PostsTag  ON ( PostsTag.tag_id = (SELECT id From tags where(name = '".$this->params['url']['tag']."')))");
        $ids = array();
        //loop through the array of posts and assign the id to the ids
        foreach($results as $post_id){
          $ids[]=$post_id['PostsTag']['post_id'];
        }
        //find all the posts with the passed ids
        $conditions = array('Post.id' => $ids);
        $this->set('posts', $this->Post->find('all', array('conditions' => $conditions)));
      //else find all the posts
      }else{
       $this->set('posts', $this->Post->find('all'));
      }
    }
    
    //display a single post
    function view() {
      $this->Post->id = $this->params['id'];
      $this->set('post', $this->Post->read());
    }
    
    //create a new post
    function add() {
      if (!empty($this->data)) { 
        if ($this->Post->save($this->data)) {
          $this->Session->setFlash('Your post has been saved.');
          $this->redirect(array('action' => 'index'));
        }
      }
    }
    
    //delete passed post
    function delete() {
       $this->Post->delete($this->params['id']);
       $this->Session->setFlash('The post with id: '.$this->params['id'].' has been deleted.');
       $this->redirect(array('action'=>'index'));
    }
    
    //edit the pased post
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