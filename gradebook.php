<?php
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <div id="errorFlash" class="error" style="display:none"></div>
  <?php
    if(filter_input_array(INPUT_POST)){
      $inputGrades = getGrades();
      $AvgGrades = calcGrades($inputGrades);
      showGrades($AvgGrades, $inputGrades);
      printForm($inputGrades);
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
function getGrades(){ 
  $formData = filter_input_array(INPUT_POST);
  $grades = array();
  for($i=0; $i < count($formData["name"]); $i++){
    $grades[] = array(
                        "name" => $formData["name"][$i], 
                        "points_poss" => $formData["points_poss"][$i], 
                        "points_earned" => $formData["points_earned"][$i], 
                        "assignment_type" => $formData{"assignment_type"}[$i]
                    );
  }
  return $grades;
}

function calcGrades($grades){
  $averages = array();
  
  $totalPoints = array();
  foreach($grades as $entry){
    $key = $entry['assignment_type'];
    $totalPoints[$key]["points_earned"] += $entry["points_earned"];
    $totalPoints[$key]["points_poss"] += $entry["points_poss"];
  }
  foreach($totalPoints as $key => $points){
    $percent = ($key == "lab") ? 40 : 20;
    $averages[$key] = ($points["points_earned"] == 0) ? 0 : $points["points_earned"] / $points["points_poss"] * $percent;
  }
  return $averages;
}

function showGrades($gradeAverges, $allGrades){?>
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
          <p><a class="reset" href="session_reset.php"><button type="button">Reset Grades</button></a></p>

        </tfoot>
        <tbody>
          <?php
            foreach($allGrades as $entry){?>
              <tr>
                <td><?= $entry['name']?></td>
                <td><?= $entry['points_poss']?></td>
                <td><?= $entry['points_earned']?></td>
                <td><?= $entry['assignment_type']?></td>
                <td><?= ($entry['points_earned'] / $entry['points_poss']) * 100 ?></td>                                    
              </tr>
            <?}
          ?>
        </tbody>
      </table>
    </div>
    <div id="grade_precents">
      <dl class="results">
        <dt>Lab % Points(40% Possible):</dt>
            <dd><?= $gradeAverges["lab"] ? $gradeAverges["lab"] : 0 ?>%</dd>
        <dt>Midterm % Points(20% Possible):</dt>
            <dd><?= $gradeAverges["midterm"] ? $gradeAverges["midterm"] : 0 ?>%</dd>
        <dt>Final % Points(20% Possible):</dt>
            <dd><?= $gradeAverges["final"] ? $gradeAverges["final"] : 0 ?>%</dd>
        <dt>Project % Points(20% Possible):</dt>
            <dd><?= $gradeAverges["project"] ? $gradeAverges["project"] : 0 ?>%</dd>
        <dt>Final Grade:</dt>
            <dd><?= array_sum($gradeAverges) ?>%</dd>
      </dl>
    </div>
<?}

function hiddenGrades($grades){
  foreach($grades as $entry){?>
    <input type='hidden' name='name[]' value='<?= $entry['name']?>'>
    <input type='hidden' name='points_poss[]' value='<?= $entry['points_poss']?>'>
    <input type='hidden' name='points_earned[]' value='<?= $entry['points_earned']?>'>
    <input type='hidden' name='assignment_type[]' value='<?= $entry['assignment_type']?>'>
<?}

  
}

function printForm($grades){ ?>
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
      <?php if(isset($grades))
              hiddenGrades($grades);
      ?>
      <button type="button" class="new_entry">Add Another Entry</button>
      <input type="submit" value="Submit" class="button" />
    </fieldset>
  </form>
</div>
<?}

?>