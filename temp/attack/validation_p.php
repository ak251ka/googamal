<div>

<table class="tableVal1">
<tr><td colspan="8" class="error"><center><?php  echo $Validation->ErrorString();  ?></center></td></tr>
<?php  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%stroop_info` WHERE `kind` = \'%s\'',DB_PERFIX,$account->kind));  $i = 1;  while($row = $dbo->Read($sql))  {   $list[$i] = new Object($row);   $form->AddModal('mot'.$i,$row['name'],sprintf('<img src="img/troop/b/%d_%d.gif" class="bigimg" alt="%s"/>%s',    $account->kind,$i,$row['name'],$row['desc']),$form->TroopInfo(    $row['r1'],$row['r2'],$row['r3'],$row['r4'],$row['r5'],    SecToString($row['times']),$row['used'],    $troops[$account->kind][$i][0],$troops[$account->kind][$i][1],$troops[$account->kind][$i][2],    $troops[$account->kind][$i][3],$troops[$account->kind][$i][4],$troops[$account->kind][$i][5]));   $i++;  }  $dbo->Cancel($sql);   for($i = 1;$i < 8;$i++)  printf('<tr><td><img id = "mot%1$d" alt="%3$s" class = "i30s" onClick = "modal.Show(\'mot%1$d\');" src="img/troop/s/%5$s_%1$d.gif"/></td><td>%6$d</td>  <td><img id = "mot%2$d" alt="%4$s" class = "i30s" onClick = "modal.Show(\'mot%2$d\');" src="img/troop/s/%5$s_%2$d.gif"/></td><td>%7$d</td></tr>'  ,$i,$i+7,$list[$i]->name,$list[$i+7]->name,$account->kind,$_POST['t'.$i],$_POST['t'.($i+7)]);  ?>
</table>
</div>
<div>
<table class="tableVal2">
<tr><td colspan="2"><?php echo $lang['Elixir'];?></td></tr>
<?php  $list = array();  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%selixir_i`',DB_PERFIX));  while($row = $dbo->Read($sql))   $list[$row['id']] = $row;  $dbo->Cancel($sql);  if($_POST['en1'])  {   printf('<tr><td><img id = "ie1" src="img/eli/%d.gif" alt="%s" class = "i30"/></td><td>%d</td></tr>',$_POST['e1'],'',$_POST['en1']);   $form->AddText('ie1',$list[$_POST['e1']]['desc']);   if($_POST['en2'])   {    printf('<tr><td><img id = "ie2" src="img/eli/%d.gif" alt="%s" class = "i30"/></td><td>%d</td></tr>',$_POST['e2'],'',$_POST['en2']);    $form->AddText('ie2',$list[$_POST['e2']]['desc']);   }   if($_POST['en3'])   {    printf('<tr><td><img id = "ie3" src="img/eli/%d.gif" alt="%s" class = "i30"/></td><td>%d</td></tr>',$_POST['e3'],'',$_POST['en3']);    $form->AddText('ie3',$list[$_POST['e3']]['desc']);   }     }  else   printf('<tr><td colspan="2">%s</td></tr>',$lang['NoRecord']);  ?>
</table>
</div>
<div>
<table class="tableVal3">
<tr><td><?php echo $lang['Kind'];?></td><td><?php   switch($_POST['kind'])  {   case A_RAPINE:    echo $lang['Rapine'];    break;   case A_ESPIAL:    echo $lang['Espial'];    break;   case A_SUPPORT:    echo $lang['Support'];    break;   case A_ATTACK:    echo $lang['Attack'];    break;   case A_BLOCKADE:    echo $lang['Blockade'];    break;   case A_MERGER:    echo $lang['Merger'];    break;  }  ?></td></tr>
<?php    printf('<tr><td style="width:80px;">%s</td><td style="width:120px;">%s</td></tr>',$lang['SendHero'],$_POST['h'] ? $lang['Yes']: $lang['No']);   if(isset($info['pid']) and $info['pid'])    printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Player'],$form->PlayerLink($info['pid'], $user->GetName($info['pid'])));   if(isset($info['uid']) and $info['uid'])    printf('<tr><td>%s</td><td><a href = "union.php?id=%s">%s</a></td></tr>',     $lang['Union'],$info['uid'],$union->GetName($info['uid']));   printf('<tr><td>%s</td><td><a href = "map.php?id=%s">%s</a></td></tr>', $lang['Name'], $Validation->_info['mid'],$Validation->_info['name']);      $traverse = $Validation->_distance;   $h = (int)floor($traverse / 3600);   $traverse -= ($h * 3600);   $m = (int)floor($traverse / 60);   $traverse -= $m * 60;   $s = $traverse;   printf('<tr><td>%s</td><td>%02d:%02d:%02d</td></tr>',$lang['TimeProcess'],$h,$m,$s);   printf('<tr><td>%s</td><td><span class="counter">%s</span></td></tr>',$lang['InHour'],date('H:i:s',$_SERVER['REQUEST_TIME'] + $Validation->_distance));  ?>


</table>
</div>
<div style="clear:both;"></div>
<div>
<?php  ShowForm($Validation->disabled);  ?>
</div>
<div id="info" style="display:none;">
<img src="img/all/c1.gif" alt="<?php echo $lang['Close'];?>" class ="i30s" onclick="ShowHide('info');"/>
<p>
<img id ="imgInfo" src="" alt="" />
</p>
</div>