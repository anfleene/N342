<?php
  include "includes/header.inc";
?>
  <?php
    $code = filter_input(INPUT_GET, "file");
    error_reporting(0);
  ?>
<div id="content">
  <pre><code>
  <?
    if($code != ""){
      $file = file_get_contents($code.".php", FILE_TEXT);
      if(!$file)
        $file = file_get_contents("includes/".$code.".inc", FILE_TEXT);
      if($file)
          echo htmlentities($file);
    }else{
      echo "a file name must be provided as a get parameter";
    }
  ?> 
</code>
</pre>
</div>
<?php
  include "includes/footer.inc";
?>
