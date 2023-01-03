<div class="b_troop">
<?php  require_once('.//lib/dbo.php');  if($town->$u < 20)   printf($lang['NextPoint'], floor(($town->$u + 1)* 1.25));  else   printf($lang['NextPoint'], floor($town->$u* 1.25));  ?>
</div>