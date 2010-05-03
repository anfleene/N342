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
        <div id="nav">
          <?if(isset($tag_cloud)){?>
            <?=$this->element("tags/cloud", array('cloud' => $tag_cloud))?>
          <?}?>
        </div>
        
        <?= $content_for_layout ?> 
      </div>
      <div id="footer">
    
      </div>
    </div>
  </body>
</html>