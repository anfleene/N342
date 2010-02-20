<?php
  function generateNav(){
    ?>
    <div id="nav">
		  <ul> <?
        if ($handle = opendir('.')) {
          while (false !== ($file = readdir($handle))) {
              if (preg_match('/^[^\.]+.php/', $file, $matches)) {
                ?><li><a href="<?= $file ?>"><?= ucwords(str_replace(array(".php", "_"), array("", " "), $file)) ?></a><span><a href="code_generator.php?file=<?= str_replace(".php", "", $file) ?>">source</a></span></li><?
              }
          }
          closedir($handle);
        }

        if ($handle = opendir('includes/')) {
          while (false !== ($file = readdir($handle))) {
              if (preg_match('/^[^\.]+.inc/', $file, $matches)) {
                ?><li><span class="head_foot"><a href="code_generator.php?file=<?= str_replace(".inc", "", $file) ?>"><?= ucwords(str_replace(".inc", "", $file)) ?> Source</a></span></li><?
              }
          }
          closedir($handle);
        } ?>
    	</ul >
		</div><?  
  }
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
                <link href="css/global.css" rel="stylesheet" type="text/css"/>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
                <title>N342</title>
        </head>
	<body>
		<div id="wrapper">
			<div id="header">
				<h1>N342 Index</h1>
			</div><!--HEADER-->
			<?php
        generateNav();
		  ?>