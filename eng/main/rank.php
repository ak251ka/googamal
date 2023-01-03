<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/defines.php');  class Rank  {   protected function StartRanking()   {    global $dbo;    $dbo->ExectueQuery('SET @prev_value = NULL;');    $dbo->ExectueQuery('SET @rank_count = 0;');   }   public function GetRank($table, $field,$id)   {    $this->StartRanking();          global $dbo;    return $dbo->ExectueScaler(sprintf('SELECT `rank` FROM(SELECT `id`, `%1$s`, CASE WHEN @prev_value = `%1$s` THEN @rank_count WHEN @prev_value := `%1$s` THEN @rank_count := @rank_count + 1 END AS `rank` FROM `%2$s` ORDER BY `%1$s` DESC) AS `t`  WHERE `t`.`id` = \'%3$s\'', $field, $table, $id) ,'rank');   }      public function GetPos($table,$id)      {          $this->StartRanking();          global $dbo;          $dbo->ExectueQuery('SET @ind := \'0\';');          return $dbo->ExectueScaler(sprintf('SELECT `rank`.`ind` FROM (SELECT id, `pop`, @ind := @ind + 1 AS `ind`, CASE WHEN @prev_value = `pop` THEN @rank_count WHEN @prev_value := `pop` THEN @rank_count := @rank_count + 1 END AS `rank` FROM `%s` ORDER BY `pop` DESC) AS `rank` WHERE `rank`.`id` = \'%s\'',$table,$id),'ind');      }  }  $rank = new Rank;  ?>