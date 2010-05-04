<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

  <head>
    <title><?= $title_for_layout?></title>
    <?= $scripts_for_layout ?>
    <script src="<?=$this->webroot?>js/jquery.js" type="text/javascript"></script>
    <script src="<?=$this->webroot?>js/jquery.tagarea.js" type="text/javascript"></script>
    <script src="<?=$this->webroot?>js/jquery.tagcloud.min.js" type="text/javascript"></script>
    <script src="<?=$this->webroot?>js/jquery.tinysort.min.js" type="text/javascript"></script>
    <script src="<?=$this->webroot?>js/app.js" type="text/javascript"></script> 
    <?=$html->css("global.css")?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1><?= $title_for_layout ?></h1>
      </div>
      <div id="content">
        <div id="body">
          <?= $content_for_layout ?> 
        </div>
        <?//insert the tag cloud on the lefthand side if the var is set?>
          <?if(isset($tag_cloud)){?>
            <div id="cloud">
              <?=$this->element("tags/cloud", array('cloud' => $tag_cloud))?>
            </div>
          <?}?>
      </div>
      <div id="footer">
        <?//link to the source of the project on github?>
        <h1><a href='http://github.com/anfleene/N342/tree/master/final/app'>Final Cakephp Sorce</a></h1>
      </div>
    </div>
  </body>
</html>
