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
  <form action="create_blog.php" method="post">
    <fieldset>
      <label for="title">Title:</label>
      <input type="text" name="title" />
      <label for="post">Post:</label>
      <textarea type="text" name="post"></textarea>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
</div>
<?}
?>