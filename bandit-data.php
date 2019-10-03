<?php

include("file_handler.php");

$scores = loadscores();

?>

<p>The Bandit has made predictions <?php echo $scores[0]+$scores[2]; ?> times.</p>

<p>The Bandit has predicted that <?php echo $scores[0]; ?> people were male, <?php echo $scores[1]; ?> of these were correct.
The Bandit has predicted that <?php echo $scores[2]; ?> people were female, <?php echo $scores[3]; ?> of these were correct.
Overall, The Bandit has correctly predicted the gender of <?php echo floor(($scores[1]+$scores[3])*100/($scores[0]+$scores[2])); ?>% of people.</p>

<p>The Bandit has predicted that <?php echo $scores[4]; ?> people were right-handed, <?php echo $scores[5]; ?> of these were correct.
The Bandit has predicted that <?php echo $scores[6]; ?> people were left-handed, <?php echo $scores[7]; ?> of these were correct.
Overall, The Bandit has correctly predicted the handedness of <?php echo floor(($scores[5]+$scores[7])*100/($scores[4]+$scores[6])); ?>% of people.</p>

<p>The Bandit has predicted that <?php echo $scores[8]; ?> people were happy, <?php echo $scores[9]; ?> of these were correct.
The Bandit has predicted that <?php echo $scores[10]; ?> people were sad, <?php echo $scores[11]; ?> of these were correct.
Overall, The Bandit has correctly predicted the happiness of <?php echo floor(($scores[9]+$scores[11])*100/($scores[8]+$scores[10])); ?>% of people.</p>

<p>The Bandit has predicted that <?php echo $scores[12]; ?> people were wide awake, <?php echo $scores[13]; ?> of these were correct.
The Bandit has predicted that <?php echo $scores[14]; ?> people were sleepy, <?php echo $scores[15]; ?> of these were correct.
Overall, The Bandit has correctly predicted the awakeness of <?php echo floor(($scores[13]+$scores[15])*100/($scores[12]+$scores[14])); ?>% of people.</p>

<p>Overall, <?php echo floor(($scores[1]+$scores[3]+$scores[5]+$scores[7]+$scores[9]+$scores[11]+$scores[13]+$scores[15])*100/($scores[0]+$scores[2]+$scores[4]+$scores[6]+$scores[8]+$scores[10]+$scores[12]+$scores[14]));?>%
of The Bandit's predictions have been correct.</p>

<p>The following graphs show how the proportion of The Bandit's predicitions that were correct have changed with time.</p>

______
______
______
______

