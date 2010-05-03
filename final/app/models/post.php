<?php
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
     
     var $validate = array(
       'title' => array(
         'rule' => 'notEmpty'
        ),
        'body' => array(
          'rule' => 'notEmpty'
        )
      );
      
      
      function beforeSave() {
        if(isset($this->data['Post']['tags']))
          $this->_parse_tags();
        return true;
      }
      
      function afterFind(array $results){
        $new_results = array();
        foreach($results as $post){
          $post['Post']['tags'] = $this->_build_tags($post['Tag']);
          $new_results[] = $post;
        }
        return $new_results;
      }
      
      function _parse_tags(){
        // Define the new tag model
        $Tag =& new Tag;
        // Parse out all of the 
        $tag_list = explode(" ", $this->data['Post']['tags']);
        $tags = array(); // New tag array to store tag id and names from db
        foreach($tag_list as $t) {
            if ($tag = $Tag->findByName($t)) {
                $tags[] = array_merge($tag['Tag'], array('PostsTag' => array('id' => '', 'post_id' => $this->id, 'tag_id' => $tag['Tag']['id'])));
            } else {
                $Tag->save(array('id' => '', 'name' => $t));
                $tag_id = $Tag->getLastInsertID();
                $tags[] = array('id' => $tag_id, 'name' => $t, 'PostsTag' => array('id' => '', 'post_id' => $this->id, 'tag_id' => $tag_id));
            }
            unset($tag);
        }
        // This formats the tags field before save...
        $this->data['Tag'] = $tags;
      }
      
      function _build_tags($tags){
        $tag_names = array();
        foreach($tags as $tag){
          $tag_names[] = $tag['name'];
        }
        return implode(" ", $tag_names);
      }
   }
?>
