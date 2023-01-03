<div class="b_troop">
<?php  require_once('.//lib/dbo.php');  $limits = $dbo->ExectueScaler(   sprintf('SELECT SUM(`func`) AS `func` FROM `%sbuilding_d` WHERE `bid` =\'%s\' AND `lvl` <= \'%s\'',DB_PERFIX,$town->$b, $town->$u + 1),'func');  printf($lang['LevelPoint'].'<br />',$town->workers);  if($town->$u != $info['lvl'])   printf($lang['NextPoint'],$limits);  ?>
</div>