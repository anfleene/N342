<?php
  session_start();
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <div id="errorFlash" class="error" style="display:none"></div>
  <?php
    printForm();
    $userGuess = filter_input(INPUT_POST, "userGuess");
    if(isset($userGuess)){
      $compGuess = CompGuess();
      $winner = updateScores($userGuess, $compGuess);
      printResults($userGuess, $compGuess, $winner);
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
    $winner = "Tie";
  }else if($beats[$userGuess] == $compGuess){
    $_SESSION['LOSS']++;
    $winner = "Computer";
  }else{
   $_SESSION['WIN']++;
   $winner = "Human"; 
  }
  return $winner;
}

function percent($key){
  $total = $_SESSION['WIN'] ? $_SESSION['WIN'] : 0;
  $total += $_SESSION['LOSS'] ? $_SESSION['LOSS'] : 0;
  $total += $_SESSION['TIE'] ? $_SESSION['TIE'] : 0;
  return round($_SESSION[$key] ? ($_SESSION[$key] / $total * 100) : 0, 2);
}

function printResults($human, $comp, $winner ){
  $guessName = array("Rock", "Paper", "Scissors")
?>
  <div>
   <dl class="results">
     <dt>Human Guess:</dt>
      <dd><?= $guessName[$human]?></dd>
     <dt>Computer Guess:</dt>
      <dd><?= $guessName[$comp]?></dd>
     <dt>Winner:</dt>
      <dd><?= $winner?></dd>
   </dl>
   <dl class="results">
     <dt>Human Wins:</dt>
      <dd><?= $_SESSION['WIN'] ? $_SESSION['WIN'] : 0?>(<?= percent('WIN') ?>%)</dd>
     <dt>Computer Wins:</dt>
      <dd><?= $_SESSION['LOSS'] ? $_SESSION['LOSS'] : 0?>(<?= percent('LOSS') ?>%)</dd>
     <dt>Ties:</dt>
      <dd><?= $_SESSION['TIE'] ? $_SESSION['TIE'] : 0?>(<?= percent('TIE') ?>%)</dd>
   </dl>
   <??>
  </div> 
<?}
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