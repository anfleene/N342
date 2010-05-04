<?//render the shared post view for the current post?>
<?= $this->element("posts/post", array('post' => $post['Post'], 'comments' => $post['Comment'], 'tags' => $post['Tag']))?>