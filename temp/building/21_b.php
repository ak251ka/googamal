<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//lib/defines.php');  $one = 1;  if(isset($_POST['com']) and $_POST['com'] == BUILD_ELIXIR)  {   $_POST['kind'] = isset($_POST['kind']) ? ValidNumber($_POST['kind'],true): 0;   if($_POST['kind'] or $_POST['kind'] < 16 or ($town->res_e & ($one << $_POST['kind'] - 1)))   {    if($town->Lock())    {     $bt = $list[$_POST['kind']]->times - ($list[$_POST['kind']]->times * $town->$u * 0.02);     $bt = $bt*($hero->GetPoint('HP1') == 0 ? 1 : $hero->GetPoint('HP1')/100);     $town->BuildElixir($_POST['kind'],     $list[$_POST['kind']]->pro,     $list[$_POST['kind']]->r1,     $list[$_POST['kind']]->r2,     $list[$_POST['kind']]->r3,     $list[$_POST['kind']]->r4,     $list[$_POST['kind']]->r5,$bt);    }    $town->UnLock();   }  }  ?>
<div>
<a href="javascript:void(0);" onclick="ShowHide('buildElixir');"><?php echo $lang['Build'];?></a>
<div id = "buildElixir">
<form action="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid, $town->id,BUILD_ELIXIR);?>" method="post">
<input type="hidden" name="com" value="<?php echo BUILD_ELIXIR;?>" />
<input type="hidden" name="kind" id = "kind" value="?"  />
<table>
<tr><td><?php echo $lang['Elixir'];?></td><td><?php echo $lang['Cost'];?></td><td><?php echo $lang['Number'];?></td><td><?php echo $lang['Total'];?></td><td><?php echo $lang['Action'];?></td></tr>
<?php  $j =0;  $i = 0;  foreach($list as &$l)  {   $i++;   if(($town->res_e &($one <<($i - 1))) == 0)    continue;      $j++;   printf('<tr><td><img src="img/eli/%d.gif" class = "i30s" onclick="modal.Show(\'mo%d\');" alt = "%s" /></td><td>',    $l->id,$l->id,$l->name);   $acthion = sprintf('<input type="submit" value="%s" onclick="SetValues(\'kind\',\'%d\');"  />',$lang['Build'],$l->id);   if(!$town->HaveEnough($l->r1 ,$l->r2,$l->r3 ,$l->r4 ,$l->r5 ))    $acthion = sprintf($lang['NotEnough'],$lang['Resource']);   $bt = $l->times - ($l->times * $town->$u * 0.02);   $bt = $bt*($hero->GetPoint('HP1') == 0 ? 1 : $hero->GetPoint('HP1')/100);   $form->EchoCost($l->r1 ,$l->r2 ,$l->r3 ,$l->r4 ,$l->r5 ,SecToString($bt),0);   $e = 'e'.$l->id;   printf('</td><td>%s</td><td>%s</td><td>%s</td></tr>', $l->pro,$town->$e, $acthion);  }  if(!$j)   printf('<tr><td colspan="5">%s</td></tr>',$lang['NoRecord']);  ?>
</table>
</form>
</div>
</div>
<table>
<tr><td colspan="3"><?php printf('<center><b>%s</b></center>',$lang['ElixrBuilding']);?></td></tr>

<tr><td><?php echo $lang['Elixir'];?></td><td><?php echo $lang['Number'];?></td><td style="min-width:80px;"><?php echo $lang['InDate'];?></td></tr>
<?php  $i = 0;  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%selixir_b` WHERE `tid` = \'%s\' AND `d` = \'0\' ORDER BY `modify` ASC',DB_PERFIX,$town->id));  if($dbo->RowsNumber($sql))  {   while($row = $dbo->Read($sql))    printf('<tr><td><img src="img/eli/%d.gif" class = "i30s" onclick="modal.Show(\'mo%d\');" alt = "%s" /></td><td>%s</td><td>%s</td></tr>',     $row['eid'],$row['eid'],$list[$row['eid']]->name,$row['et'], $form->Addtimer($row['modify'],'building.php?id=21'));  }  else   printf('<tr><td colspan="3">%s</td></tr>',$lang['NoRecord']);  $dbo->Cancel($sql);  ?>
</table>
</div>