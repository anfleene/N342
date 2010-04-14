<?php
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
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
      <label for="content">Post:</label>
      <textarea type="text" name="content"></textarea>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
</div>
<?}
?>