<?php
  session_start();
  error_reporting(0);
  include "includes/header.inc";
?>
<div id="content">
  <div id="errorFlash" class="error" style="display:none"></div>
  <div ="sub_head">
    <h2>Rock Paper Scissors Lizard Spock</h2>
    <p><a href="http://www.youtube.com/watch?v=iapcKVn7DdY">Context</a></p>
  </div>
  <?php
    printForm();
    $userGuess = filter_input(INPUT_GET, "userGuess");
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
  return rand(0, 4);
}

function updateScores($userGuess, $compGuess){
  $beats = array(array(1,4),array(2,3),array(0,4),array(0,2),array(3,1));
  if($userGuess == $compGuess){
    $_SESSION['TIE']++;
    $winner = "Tie";
  }else if(in_array($compGuess, $beats[$userGuess])){
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
  $guessName = array("Rock", "Paper", "Scissors", "Lizard", "Spock")
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
    <ul class="image_list">
      <li><a href="?userGuess=0"><img src="images/rock.jpg" alt="rock" /></a></li>
      <li><a href="?userGuess=1"><img src="images/paper.jpg" alt="paper" /></a></li>
      <li><a href="?userGuess=2"><img src="images/scissors.jpg" alt="scissors" /></a></li>
      <li><a href="?userGuess=3"><img src="images/lizard.jpg" alt="lizard" /></a></li>
      <li><a href="?userGuess=4"><img src="images/spock.jpg" alt="spock" /></a></li>
    </ul>
  </div>
<?}
?>