<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  require_once('.//eng/main/rank.php');  $count = $dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%sunion_b`',DB_PERFIX),'c');  $page = isset($_GET['page']) ? ValidNumber($_GET['page'],true) : 0;  $row = isset($_GET['row']) ? ValidNumber($_GET['row'],true) : 10;  if($row >100)   $row = 100;  if(!$plus->HavePlus('pb'))   $row = 10;  if(isset($_POST['name']))  {        $id = $dbo->ExectueScaler(sprintf('SELECT `id` FROM `%sunion_b` WHERE `name` = \'%s\' LIMIT 1',          DB_PERFIX,$_POST['name']),'id');      if($id)          $page = (int)floor($rank->GetPos(DB_PERFIX.'union_b',$id) / $row);  }  if($page * $row > $count)   $page = 0;  $dbo->ExectueQuery('SET @prev_value = NULL;');  $dbo->ExectueQuery('SET @rank_count = 0;');  $sql = $dbo->ExectueQuery(sprintf('SELECT `t`.* FROM(SELECT `id`,`name`, `pop`,`ap`,`dp`, CASE WHEN @prev_value = `pop` THEN @rank_count WHEN @prev_value := `pop` THEN @rank_count := @rank_count + 1 END AS `rank` FROM `%sunion_b` ORDER BY `pop` DESC) AS `t`  LIMIT %d, %d', DB_PERFIX, $page * $row, $row));  ?>
<form action= "<?php printf('statistics.php?show=%s&amp;',SHOW_PLAYER);?>" method="post">
<table class="_table">
<tr><td width="50px;"><?php echo $lang['Index'];?></td>
<td width="50px;"><?php echo $lang['Rank'];?></td>
<td><?php echo $lang['Name'];?></td>
<td width="100px;"><img src="img/troop/ap.gif" class="i30"  alt = "<?php echo $lang['AP'];?>"/></td>
<td width="100px;"><img src="img/troop/dp.gif" class="i30"  alt = "<?php echo $lang['DP'];?>"/></td>
<td width="100px;"><img src="img/res/pop.gif" class="i30"  alt = "<?php echo $lang['Pop'];?>"/></td>
</tr>
<?php  $i = 1 + ($page * $row);  while($r = $dbo->Read($sql))   printf('<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$i++,$r['rank'], $form->UnionLink($r['id'],$r['name']),$r['ap'],$r['dp'],$r['pop']);  $dbo->Cancel($sql);  if(!isset($_POST['name']))  {      $_POST['name'] = $union->GetName($account->uid);  }  ?>
<tr><td colspan="6"><?php echo Paging($count,sprintf('statistics.php?show=%s&amp;',SHOW_UNION), $row, $page)?></td></tr>
    <tr><td><?php echo $lang['Name']?></td><td><input type="text" name = "name" value="<?php              echo $_POST['name']; ?>" /></td><td colspan="4"><input type = "submit" value = "<?php echo $lang['Search'];?>"/></td></tr>
</table>
</form>