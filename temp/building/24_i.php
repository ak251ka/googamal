<?php  require_once('.//eng/main/union.php');  if(isset($error) and $error)   printf('<center class = "error">%s</center>',$lang['NoRoomUnion']);  ?>
<form id = "uil" action="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s', $bid, $town->id, SHOW_INVITATION); ?>" method="post">
<input type="hidden" name="com" value="<?php echo SHOW_INVITATION;?>"  />
<input type="hidden" name="kind" id="kind" value="?" />
<input type="hidden" name="subkind" id = "subkind" value="?"  />
<table border="1">
<tr><td><?php echo $lang['Union']?></td><td><?php echo $lang['Invitation'];?></td><td><?php echo $lang['Accept'];?></td><td><?php echo $lang['Cancel'];?></td></tr>
<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  $sql = $dbo->ExectueQuery(sprintf('SELECT `i` . * , `a`.`name` AS `aname` , `u`.`name` AS `uname` FROM `%1$sunion_i` AS `i` LEFT JOIN `%1$saccount` AS `a` ON ( `i`.`a` = `a`.`id` ) LEFT JOIN `%1$sunion_b` AS `u` ON ( `i`.`uid` = `u`.`id` ) WHERE `i`.`b` = \'%2$s\'',   DB_PERFIX, $account->id));  if($dbo->RowsNumber($sql))  {   $form->AddText('acci',$lang['Accept']);   $form->AddText('caci',$lang['Cancel']);   while($row = $dbo->Read($sql))   {    $pname = empty($row['aname']) ? '' : $form->PlayerLink($row['a'],$row['aname']);    printf('<tr><td>%s</td><td>%s</td><td><img src="img/all/e2.gif" class = "i24s" id = "acci" onclick="SetValues(\'subkind\',\'%s\');SubmitForm(\'uil\',\'kind\',\'1\');"  /></td><td><img src="img/all/f2.gif" class = "i24s" id = "caci" onclick="SetValues(\'subkind\',\'%s\');SubmitForm(\'uil\',\'kind\',\'0\');"  /></td></tr>',$form->UnionLink($row['uid'],$row['uname']),$pname,$row['id'],$row['id']);   }  }  else   printf('<tr><td colspan="4">%s</td></tr>',$lang['NoRecord']);  $dbo->Cancel($sql);  ?>
</table>
</form>
