<div class="b_troop">
<table>
    <tr><td colspan><?php echo $lang['CP'];?></td><td><?php echo round($account->cp);?></td></tr>
    <tr><td colspan="2"><?php printf($lang['NextPoint'],$account->NeedCP());?></td></tr>
    <tr><td><?php echo $lang['Town'];?></td><td><?php echo round($town->cp);?></td></tr>
    <tr><td><?php echo $lang['AllTown'];?></td>
        <td><?php echo round($dbo->ExectueScaler(sprintf('SELECT SUM(`cp`) AS `cp` FROM `%stown` WHERE `pid` = \'%s\'',                  DB_PERFIX,$account->id),'cp'));?></td></tr>
</table>
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//eng/main/troop.php');  require_once('.//lib/defines.php');  if($town->$u == 0)  {   echo $lang['BuildBuilding'].'</div>';   return;  }  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%stroop_info` WHERE `kind` = \'%s\' ORDER BY `id` LIMIT 12,2',DB_PERFIX,$account->kind));  $list = array();  $i =0;  while($row = $dbo->Read($sql))  {   $row['times'] = round($row['times'] *(ONE_TICK/ONE_HOUR));   $list[$i++] = new Object($row);   $form->AddModal('mo'.$i,$row['name'],sprintf('<img src="img/troop/b/%d_%d.gif" class="bigimg" alt="%s"/>%s',    $account->kind,$i + 12,$row['name'],$row['desc']),$form->TroopInfo(    $row['r1'],$row['r2'],$row['r3'],$row['r4'],$row['r5'],    SecToString($row['times']),$troops[$account->kind][$i + 12][8],    $troops[$account->kind][$i + 12][0],$troops[$account->kind][$i + 12][1],$troops[$account->kind][$i + 12][2],    $troops[$account->kind][$i + 12][3],$troops[$account->kind][$i + 12][4],$troops[$account->kind][$i + 12][5]));  }  $dbo->Cancel($sql);  gc_collect_cycles();    $bph = $town->$u * 0.03;  $maxT = 0;  $tN = $dbo->ExectueScaler(sprintf('SELECT COUNT( * ) AS `c` FROM `%stroop_t` WHERE `tid` = \'%s\' AND `bid` = \'22\' AND `d` = \'0\'',   DB_PERFIX, $town->id),'c');  if(!$town->tid1)   $maxT++;  if(!$town->tid2)   $maxT++;    $tN += $dbo->ExectueScaler(sprintf('SELECT SUM( `t14` ) + SUM( `t13` ) AS `s` FROM `%stroop_su` WHERE `tid1` = \'%s\' and `d` = \'0\'',   DB_PERFIX, $town->id), 's');  $tN +=  $dbo->ExectueScaler(sprintf('SELECT SUM( `t14` ) + SUM( `t13` ) AS `s` FROM `%stroop_s` WHERE `tid1` = \'%s\' and `d` = \'0\'',   DB_PERFIX, $town->id), 's');  if($town->$u < 20 and $maxT > 1)   $maxT = 1;  $maxT -= ($town->t13 + $town->t14);  if(isset($_POST['com']) and $_POST['com'] == TERAIN_TROOP)  {   $tn = $maxT;   $maxT -= $tN;     $tN = 0;   $_POST['tbT1'] = isset($_POST['tbT1'])? ValidNumber($_POST['tbT1'],true): 0;   $_POST['tbT2'] = isset($_POST['tbT2'])? ValidNumber($_POST['tbT2'],true): 0;   $t = MaxTrain($list[0]);   if($t > $maxT)    $t = $maxT;   if($_POST['tbT1'] and $_POST['tbT1'] > $t)    $_POST['tbT1'] = $t;   $t = MaxTrain($list[1]);   if($t > $maxT)    $t = $maxT;   if($_POST['tbT2'] and $_POST['tbT2'] > $t)    $_POST['tbT2'] = $t;     if($town->$u < 20 and $_POST['tbT2'])    $_POST['tbT2'] = 1;     if($town->Lock())   {    if($_POST['tbT1']  and ($town->$u == 20))          {     $town->TrainTroop( 22, 13, $list[0]->times - ($list[0]->times * $bph), $_POST['tbT1'],       $list[0]->r1,$list[0]->r2,$list[0]->r3,$list[0]->r4,$list[0]->r5, $list[0]->used);              $maxT-= $_POST['tbT1'];          }    if($_POST['tbT2'] and ($maxT > 0))     $town->TrainTroop( 22, 14, $list[1]->times - ($list[1]->times * $bph), $_POST['tbT2'],       $list[1]->r1, $list[1]->r2, $list[1]->r3, $list[1]->r4, $list[1]->r5, $list[1]->used);   }   $town->UnLock();   $tN = $dbo->ExectueScaler(sprintf('SELECT COUNT( * ) AS `c` FROM `%stroop_t` WHERE `tid` = \'%s\' AND `bid` = \'22\'  and `d` = \'0\'',    DB_PERFIX, $town->id),'c');   $maxT = $tn;  }  $maxT -= $tN;  if(((!$town->tid1 and $town->$u >= 10) or ($town->$u == 20 and !$town->tid2)) and $maxT)  {   printf('<form action="%s" method="post"><input type="hidden" name="com" value="%s" /><table><tr><td>%s</td><td>%s</td><td colspan="2">%s</td><td>   %s</td></tr>',sprintf('building.php?bid=%s&amp;tid=%s',$bid,$town->id),TERAIN_TROOP,$lang['Troops'],$lang['Cost'],$lang['Number'],$lang['Action']);   if($town->$u == 20)   {    printf('<tr><td><img src="img/troop/s/%s_13.gif" class = "i30s" onclick="modal.Show(\'mo1\');" alt = "%s"/></td><td>',     $account->kind,$list[0]->name);    $form->EchoCost($list[0]->r1,$list[0]->r2,$list[0]->r3,$list[0]->r4,$list[0]->r5,SecToString($list[0]->times - ceil($list[0]->times * $bph))     , '4');     $t = MaxTrain($list[0]);    if($t > $maxT)     $t = $maxT;    printf('</td><td><a href="javascript:void(0);" onclick="SetValues(\'tbT1\',this.innerHTML);">%s</a></td><td><input type="text" value="0" name="tbT1" id="tbT1"  /></td><td><input type="submit" value="%s" /></td></tr>',$t, $lang['Training']);   }   printf('<tr><td><img src="img/troop/s/%s_14.gif" class = "i30s" onclick="modal.Show(\'mo2\');" alt = "%s"/></td><td>',     $account->kind,$list[1]->name);    $form->EchoCost($list[1]->r1,$list[1]->r2,$list[1]->r3,$list[1]->r4,$list[1]->r5,SecToString($list[1]->times - ceil($list[1]->times * $bph))     , '4');     $t = MaxTrain($list[1]);    if($t > $maxT)     $t = $maxT;    if($town->$u < 20 and $t > 1)     $t = 1;    printf('</td><td><a href="javascript:void(0);" onclick="SetValues(\'tbT2\',this.innerHTML);">%s</a></td><td><input type="text" value="0" name="tbT2" id="tbT2"  /></td><td><input type="submit" value="%s" " /></td></tr>',$t, $lang['Training']);   echo '</table></form>';  }  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%stroop_t` WHERE `tid` = \'%s\' AND `bid` = \'22\' AND `d` = \'0\' ORDER BY `end`',   DB_PERFIX, $town->id));  if($dbo->RowsNumber($sql))  {   echo $lang['TrainingTroop'];   printf('<table><tr><td>%s</td><td></td><td colspan="2">%s</td><td>%s</td><td>%s</td></tr>',$lang['Troops'],$lang['Number'],$lang['TimeProcess'],    $lang['EndTime'],$lang['InDate']);   $i = 0;   while($row = $dbo->Read($sql))   {    $start = $row['start'];    $end = $row['end'];    $modify = $town->modify;    $last = 0;    if($start > $_SERVER['REQUEST_TIME'])    {     $num = (int)floor(($end - $start)/$row['et']);     $last = ($start - $_SERVER['REQUEST_TIME']) + $row['et'];    }    else    {     if($end > $_SERVER['REQUEST_TIME'])     {      $num = (int)floor(($end - $_SERVER['REQUEST_TIME'])/$row['et']);      $last = ($end - $_SERVER['REQUEST_TIME']) - $num *$row['et'];      $num++;     }     else      $num = $last = 0;    }    $tt = $row['tt'] == 13 ? 1 : 2;     printf('<tr><td><img src="img/troop/s/%s_%s.gif" class = "i30s" onclick="modal.Show(\'mo%s\');" alt = "%s"/></td><td id ="ttp%sn">%s</td><td id ="ttp%sl">%s</td><td class="ttrain" id ="ttp%d">%s</td><td style="min-width:80px;">%s</td><td>%s</td></tr>',     $account->kind,$row['tt'],$tt,$list[$tt - 1]->name,$i,$num,$i,SecToString($row['et']),$i,SecToString($last),     Until($end,'ttimer'.$i),DateToString($end));    $i++;   }   echo '</table>';   $dbo->Cancel($sql);  }  if($town->tid1 or $town-> tid2)  {   printf('<table><tr><td>%s</td><td>%s</td><td>%s</td></tr>',$lang['Town'],$lang['Peculiarities'],$lang['Loyalty']);   if($town->tid1)   {    $row = $dbo->ExectueRow(sprintf('SELECT `t`.`id` , `t`.`name` , `m`.`x` , `m`.`y` , `t`.`loyalty` FROM `%stown` AS `t` LEFT JOIN `%smap_t` AS `m` ON ( `t`.`mid` = `m`.`id` ) WHERE `t`.`id` = \'%s\'',DB_PERFIX, DB_PERFIX, $town->tid1));    printf('<tr><td>%s</td><td>(%s,%s)</td><td>%d %%</td></tr>',     $form->TownLink($row['id'],$row['name']),$row['x'],$row['y'],$row['loyalty']);   }   if($town->tid2)   {    $row = $dbo->ExectueRow(sprintf('SELECT `t`.`id` , `t`.`name` , `m`.`x` , `m`.`y` , `t`.`loyalty` FROM `%stown` AS `t` LEFT JOIN `%smap_t` AS `m` ON ( `t`.`mid` = `m`.`id` ) WHERE `t`.`id` = \'%s\'',DB_PERFIX, DB_PERFIX, $town->tid2));    printf('<tr><td>%s</td><td>(%s,%s)</td><td>%d %%</td></tr>',     $form->TownLink($row['id'],$row['name']),$row['x'],$row['y'],$row['loyalty']);   }   echo '</table>';  }  ?>
