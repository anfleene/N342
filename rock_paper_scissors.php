<?php
  session_start();
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <div id="errorFlash" class="error" style="display:none"></div>
  <?php
    printForm();
    if($userGuess = filter_input(INPUT_POST, userGuess)){
      $compGuess = CompGuess();
      updateScores($userGuess, $compGuess);
    }
    
  ?>
</div>
<?php
  include "includes/footer.inc";
?>

<?php
// fuction defs

function compGuess(){
  return rand(0, 2);
}

function updateScores($userGuess, $compGuess){
  $beats = array(1,2,0);
  if($userGuess == $compGuess){
    $_SESSION['TIE']++;
  }else if($beats[$userGuess] == $compGuess){
    $_SESSION['LOSS']++;
  }else
    $_SESSION['WIN']++;
}
function printForm(){?>
  <div class="update">
    <form action = "rock_paper_scissors.php" method ="post">
      <fieldset>
      <button type = "submit"
              name = "userGuess"
              value = "0">rock</button>

      <button type = "submit"
              name = "userGuess"
              value = "1">paper</button>

      <button type = "submit"
              name = "userGuess"
              value = "2">scissors</button>

      <p><a href="session_reset.php" class="reset"><button type="button">Reset Grades</button></a></p>
      </fieldset>
    </form>
  </div>
<?}
?>