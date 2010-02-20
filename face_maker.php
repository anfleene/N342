<?php
  include "includes/header.inc";
?>
<?php
  $eyes = filter_input(INPUT_POST, "eyes");
  $mouth = filter_input(INPUT_POST, "mouth");
  $nose = filter_input(INPUT_POST, "nose");
?>
<div id="content">
  <div id="head">
    <img src="images/head.gif" alt="head"/>
  </div>
  <div id="eye">
    <img src="images/eye<?= $eyes ?>.gif" alt="eye<?= $eyes ?>"/>
  </div>
  <div id="nose">
    <img src="images/nose<?= $nose ?>.gif" alt="nose<?= $nose ?>"/>
  </div>
  <div id="mouth">
    <img src="images/mouth<?= $mouth ?>.gif" alt="mouth<?= $mouth ?>"/>
  </div>
</div>
<?php
  include "includes/footer.inc";
?>
