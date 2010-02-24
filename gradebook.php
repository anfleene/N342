<?php
  session_start();
  include "includes/header.inc";
?>
<div id="content">
  <div id="errorFlash" class="error" style="display:none"></div>
  <?php
    if(filter_input_array(INPUT_POST)){
      updateGrades();
      $grades = calcGrades();
      showGrades($grades);
      printForm();
    }else{
      printForm();
    }
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?php
// function defs
function updateGrades(){ 
  $formData = filter_input_array(INPUT_POST);
  for($i=0; $i < count($formData["name"]); $i++){
    $_SESSION['grades'][] = array("name" => $formData["name"][$i], "points_poss" => $formData["points_poss"][$i], "points_earned" => $formData["points_earned"][$i], "assignment_type" => $formData{"assignment_type"}[$i]);
  }
}

function calcGrades(){
  $grades = array();
  foreach($_SESSION['grades'] as $entry){
    $grades[$entry['assignment_type']]["points_earned"] += $entry["points_earned"];
    $grades[$entry['assignment_type']]["points_poss"] += $entry["points_poss"];
  }
  foreach($grades as $key => $scores){
    $percent = ($key == "lab") ? 40 : 20;
    $grades[$key] = ($scores["points_earned"] == 0) ? 0 : $scores["points_earned"] / $scores["points_poss"] * $percent;
  }
  return $grades;
}

function showGrades($grades){?>
    <div id="all_grades">
      <table class="show_grades">
        <thead>
          <tr>
            <th>Name</th>
            <th>Points Possible</th>
            <th>Points Earned</th>
            <th>Assignment Type</th>
            <th>Percentage Points</th>
          </tr>
        </thead>
        <tfoot>
          <p><a href="session_reset.php"><button type="button">Reset Grades</button></a></p>

        </tfoot>
        <tbody>
          <?php
            foreach($_SESSION['grades'] as $entry){?>
              <tr>
                <td><?= $entry['name']?></td>
                <td><?= $entry['points_poss']?></td>
                <td><?= $entry['points_earned']?></td>
                <td><?= $entry['assignment_type']?></td>
                <td><?= ($entry['points_earned'] / $entry['points_poss']) * 100 ?>%</td>                                    
              </tr>
            <?}
          ?>
        </tbody>
      </table>
    </div>
    <div id="grade_precents">
      <dl class="results">
        <dt>Lab % Points(40% Possible):</dt>
            <dd><?= $grades["lab"] ?>%</dd>
        <dt>Midterm % Points(20% Possible):</dt>
            <dd><?= $grades["midterm"] ?>%</dd>
        <dt>Final % Points(20% Possible):</dt>
            <dd><?= $grades["final"] ?>%</dd>
        <dt>Project % Points(20% Possible):</dt>
            <dd><?= $grades["project"] ?>%</dd>
        <dt>Final Grade:</dt>
            <dd><?= array_sum($grades) ?>%</dd>
      </dl>
    </div>
<?}

function printForm(){ ?>
<div class="update">
  <form action="gradebook.php" method="post">
    <fieldset>
      <table class="add_grades">
        <thead>
          <tr>
            <th><label for="name">Project Name</label></th>
            <th><label for="points_poss">Points Possible</label></th>
            <th><label for="points_earned">Points Earned</label></th>
            <th><label for="assignment_type">Assignment Type</label></th>       
          </tr>
        </thead>
        <tr>
          <td><input type="text" name="name[]" /></td>
          <td><input type="text" name="points_poss[]" class="number" /></td>
          <td><input type="text" name="points_earned[]" class="number" /></td>
          <td><select name="assignment_type[]">
            <option value="">Entry Type</option>
            <option value="lab">Labs</option>
            <option value="midterm">Midterm Exam</option>
            <option value="final">Final Exam</option>
            <option value="project">Final Project</option>
          </select></td>
      </table>
      <button type="button" class="new_entry">Add Another Entry</button>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
</div>
<?}

?>