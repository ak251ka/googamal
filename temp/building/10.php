<div class="b_troop">
<?php  require_once('.//lib/dbo.php');  printf($lang['AllPoint'].'<br />',$town->hiding );  if($town->$u < $info['lvl'])   printf($lang['NextPoint'],$town->hiding + $dbo->ExectueScaler(              sprintf('SELECT `func` FROM `%sbuilding_d` WHERE `bid` =\'%s\' AND `lvl` = \'%s\'',                  DB_PERFIX, $town->$b, $town->$u + 1),'func'));  else   printf($lang['LevelPoint'].'<br />',$dbo->ExectueScaler(          sprintf('SELECT SUM(`func`) AS `func` FROM `%sbuilding_d` WHERE `bid` =\'%s\' AND `lvl` <= \'%s\'',              DB_PERFIX, $town->$b, $info['lvl']),'func'));  ?>
</div>