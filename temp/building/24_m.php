<div class="b_troop">
<?php  require_once('.//lib/dbo.php');  require_once('.//eng/main/union.php');  $row = NULL;  if($account->uid)   $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%sunion_b` WHERE `id` = \'%s\'',DB_PERFIX, $account->uid));    echo '<div style="width:700px;">';  if(!empty($row))  {   printf($lang['PlayerUnion'].'<br />', $row['name']);   if($row['tid'] == $town->id)    printf($lang['UnionLimits'], $row['limits'], $row['members']);  }  else   echo $lang['NoUnion'];  if($town->$u < 3)  {   printf('%s</div></div>',$lang['LowLevel']);   return;  }  ?>
<form action="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,MAIN_EMBASSY);?>" method="post">
<table>
<tr><td colspan="2"><?php echo $lang['UnionEs'];?></td></tr>
<input type="hidden" name="com" value="<?php echo NEW_UNION;?>"  />
<tr><td><?php echo $lang['Name'];?></td><td><input type="text" name="uname" /></td></tr>
<tr><td><?php echo $lang['Slogan'];?></td><td><input type="text" name="slogan" /></td></tr>
<tr><td colspan="2" class ="center"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr>
<tr></tr>
</table>
</form>
</div>
</div>