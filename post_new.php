<?php
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <ul id="subnav">
    <li><a href="post_index.php">Post Index</a></li>
  </ul>
    <?php
      printForm();
    ?>
  </div>
<?php
  include "includes/footer.inc";
?>

<?
function printForm(){ ?>
<div class="update">
  <form action="post_create.php" method="post">
    <fieldset>
      <label for="title">Title:</label>
      <input type="text" name="title" />
      <label for="body">Post:</label>
      <textarea type="text" name="body"></textarea>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
</div>
<?}
?>