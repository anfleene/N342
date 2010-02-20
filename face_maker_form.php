<?php
  include "includes/header.inc";
?>
<div id="content">
     <form action='face_maker.php' method='post'>
        <fieldset>
          <label for="eyes">Eyes:</label>
          <select name="eyes">
            <option value="Blue">Blue Eyes</option>
            <option value="Red">Red Eyes</option>
            <option value="Crossed">Cross Eyes</option>
          </select>
          <label for="mouth">Mouth:</label>
          <select name="mouth">
            <option value="1">Smile</option>
            <option value="2">Lips</option>
          </select>
          <label for="nose">Nose:</label>
          <select name="nose">
            <option value="1">Normal</option>
            <option value="2">Red</option>
          </select>
          <input type="submit" value="Submit" class="button" />
        </fieldset>
      </form>
</div>
<?php
  include "includes/footer.inc";
?>
