<?php
/**
This is the post class
It contains several interesting relationships
It has many comments
and it has and belongs to many tags
cakephp's HABTM is a total hack
**/
   class Post extends AppModel {
     var $name = 'Post';
     
     var $hasMany = array(
        'Comment' => array(
          'className' => 'Comment',
          'foreignKey' =>  'post_id',
          'dependent'=> true,
          'order' => 'Comment.created'
        )
     );
     
     var $hasAndBelongsToMany = array('Tag' =>
                                  array('className'    => 'Tag',
                                        'joinTable'    => 'posts_tags',
                                        'foreignKey'   => 'post_id',
                                        'associationForeignKey'=> 'tag_id',
                                        'unique'       => true, 
                                        'conditions' =>  '',
                                        'fields' => '',
                                        'order' => '',
                                        'limit' => '',
                                        'offset' => '',
                                        'finderQuery' => '',
                                        'deleteQuery' => '',
                                        'insertQuery' => ''
                                    )
                                  );
     //validate that each post has a title and body
     var $validate = array(
       'title' => array(
         'rule' => 'notEmpty'
        ),
        'body' => array(
          'rule' => 'notEmpty'
        )
      );
      
      //run this before the model saves
      function beforeSave() {
        //if the fake tag attribute is set
        if(isset($this->data['Post']['tags']))
          $this->_parse_tags();
          //parse the tags into usable model objects
        return true;
      }
      
      //run this after the model is found
      function afterFind(array $results){
        //this method creates a fake tags attribute to be formated for the tag cloud
        $new_results = array();
        //run for each row in the returned result
        foreach($results as $post){
          //buiild the tags
          $post['Post']['tags'] = $this->_build_tags($post['Tag']);
          //insert the newly formated post into a new result set
          $new_results[] = $post;
        }
        return $new_results;
      }
      
      //this method parses the tags attribute into tag models
      function _parse_tags(){
        // Define the new tag model
        $Tag =& new Tag;
        // split all the tags on a space into an array
        $tag_list = explode(" ", $this->data['Post']['tags']);
        $tags = array(); // New tag array to store tag id and names from db
        foreach($tag_list as $t) {
            //the tag already exists
            if ($tag = $Tag->findByName($t)) {
              //add the join table relationship to the Tag model to connect it to the post  
              $tags[] = array_merge($tag['Tag'], array('PostsTag' => array('id' => '', 'post_id' => $this->id, 'tag_id' => $tag['Tag']['id'])));
            } else {
              //create a new tag
              $Tag->save(array('id' => '', 'name' => $t));
              //get the id of the recently created tag
              $tag_id = $Tag->getLastInsertID();
              //add the join table relationship to the Tag model to connect it to the post
              $tags[] = array('id' => $tag_id, 'name' => $t, 'PostsTag' => array('id' => '', 'post_id' => $this->id, 'tag_id' => $tag_id));
            }
            //just to be safe
            unset($tag);
        }
        // add all of the tags into the post's tag container
        $this->data['Tag'] = $tags;
      }
      
      //this method builds the tags attribute on the post model
      function _build_tags($tags){
        $tag_names = array();
        //put all the tag names into an array
        foreach($tags as $tag){
          $tag_names[] = $tag['name'];
        }
        //implode the array into a space delimeted string
        return implode(" ", $tag_names);
      }
   }
?>
