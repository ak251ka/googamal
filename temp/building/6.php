<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  define('RESOURCE_MARKET_SEND','rms');  printf($lang['LevelPoint'].'<br />',($town->$u * 3).'%');  if($town->$u < $info['lvl'])      printf($lang['NextPoint'],(($town->$u + 1) * 3).'%');    echo '<br /><br />'.$lang['DestroyBuilding'];  if($town->$u <10)  {   echo $lang['LowLevel'];   return;  }  $canDes = true;  if(isset($_POST['com']) and $_POST['com'] == DESTROY)  {   $_POST['did'] = isset($_POST['did'])? ValidNumber($_POST['did'],true):0;   if($_POST['did'])   {    $b = 'b'.$_POST['did'];    $u = 'u'.$_POST['did'];        if($town->$b and $town->$u)     $town->DestroyBuilding($_POST['did'],$plus->HavePlus('pb'));   }  }  $count = $town->CountDestory();  if($count)  {   if(!$plus->HavePlus('pb'))   {    printf($lang['MaxPermission'], $lang['Destroy']);    $canDes = false;   }   if($count == 2)   {    printf($lang['MaxPermission'], $lang['Destroy']);    $canDes = false;   }  }    if($canDes)  {  ?>
<form action="<?php printf('building.php?bid=%s&amp;tid=%s',$bid,$town->id);?>" method="post">
<input type="hidden" name="com" value="<?php echo DESTROY;?>" />
<table><tr><td><?php echo $lang['Building'];?></td>
<td><select name="did"><option value="0"><?php echo $lang['Select'];?></option><?php  for($i = 1; $i<27;$i++)  {   $tb = "b$i";   $tu = "u$i";   if($town->$tb and $town->$tu > 0)   {    if(!$town->IsBuild($i))     printf('<option value="%d">%s</option>',$i,sprintf($lang['BuildingInfo'],$lang['b'.$town->$tb],$town->$tu));   }  }  ?>
</select></td>
<td><input type="submit" value="<?php echo $lang['Destroy'];?>" /></td>
</tr>
</table>
</form>
<?php  }  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%sbuilding_q` WHERE `tid` = \'%s\' AND `kind` = \'%s\' AND `d` = \'0\'',   DB_PERFIX,$town->id,DES_BUILDING));  if($dbo->RowsNumber($sql))  {   $i =0;   printf('<table><tr><td>%s</td><td>%s</td><td>%s</td></tr>',$lang['Building'],$lang['InHour'],$lang['Level']);   while($row = $dbo->Read($sql))   {    $tb = 'b'.$row['bid'];    $tu = 'u'.$row['bid'];    printf('<tr><td><img src="img/tow/sma/%s_0_1.gif" alt="%s" class="i30"/></td><td style="width:80px;">%s</td><td>%s→%s</td></tr>',     $town->$tb,$lang['b'.$town->$tb],Until($row['modify'],'dbt'.$i++),$row['lvl'],$town->$tu);   }   printf('</table>');  }  $dbo->Cancel($sql);  ?>
</div>