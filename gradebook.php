<?php
  session_start();
  include "includes/header.inc";
?>
<div id="content">
  <?php
    if(filter_input_array(INPUT_POST)){
      updateGrades();
      showGrades();
      printForm();
    }else{
      printForm();
    }
  ?>
  <pre><?= var_dump($_SESSION['grades'])?></pre>
</div>
<?php
  include "includes/footer.inc";
?>

<?php
// function defs
function updateGrades(){ 
  $_SESSION['grades'][] = array(
                filter_input(INPUT_POST, "name"),
                filter_input(INPUT_POST, "points_poss"), 
                filter_input(INPUT_POST, "points_earned"),
                filter_input(INPUT_POST, "assignment_type")
              );
}

function showGrades(){?>
  <a href="session_reset.php">Reset Grades</a>
<?}

function printForm(){ ?>
  <form action="gradebook.php" method="post">
    <fieldset>
      <div class="grades">
        <label for="name">Project Name:</label>
        <input type="text" name="name" />
        <label for="points_poss">Points Possible:</label>
        <input type="text" name="points_poss" />
        <label for="points_earned">Points Earned:</label>
        <input type="text" name="points_earned" />
        <label for="assignment_type">Assignment Type:</label>
        <select name="assignment_type">
          <option value="lab">Labs</option>
          <option value="midterm">Midterm Exam</option>
          <option value="final">Final Exam</option>
          <option value="project">Final Project</option>
        </select>
      </div>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
<?}

?>