<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  require_once('.//lib/object.php');  require_once('.//eng/main/troop.php');  require_once('.//lib/form.php');  $elixir = array();  $sql = $dbo->ExectueQuery(sprintf('SELECT `id`,`name` FROM `%selixir_i`',DB_PERFIX));  while($row = $dbo->Read($sql))   $elixir[$row['id']] = $row['name'];  $dbo->Cancel($sql);  gc_collect_cycles();  $table =   sprintf('<tr><td>%14$s</td><td><img src="img/troop/s/%1$s_1.gif" alt="%2$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_2.gif" alt="%3$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_3.gif" alt="%4$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_4.gif" alt="%5$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_5.gif" alt="%6$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_6.gif" alt="%7$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_7.gif" alt="%8$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_8.gif" alt="%9$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_9.gif" alt="%10$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_10.gif" alt="%11$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_11.gif" alt="%12$s" class = "i24"/></td><td><img src="img/troop/s/%1$s_12.gif" alt="%13$s" class = "i24"/></td><td colspan="2">%16$s</td><td>%15$s</td></tr>'   ,$account->kind   , $troops[$account->kind][ 1][6]   , $troops[$account->kind][ 2][6]   , $troops[$account->kind][ 3][6]   , $troops[$account->kind][ 4][6]   , $troops[$account->kind][ 5][6]   , $troops[$account->kind][ 6][6]   , $troops[$account->kind][ 7][6]   , $troops[$account->kind][ 8][6]   , $troops[$account->kind][ 9][6]   , $troops[$account->kind][10][6]   , $troops[$account->kind][11][6]   , $troops[$account->kind][12][6]   ,$lang['Level'],$lang['Action'],$lang['Elixir']);  if($account->life == 0)   printf('<center><blink>%s</blink></center>',$lang['DeadHero']);  elseif($town->GetLevel(19) == -1)   printf('<center><blink>%s</blink></center>',$lang['Nb19']);  elseif(!$hero->Available())   printf('<center><blink>%s</blink></center>',$lang['NotAvailable']);  $sql = $dbo->ExectueQuery(sprintf('SELECT `tm`.*,`a`.`id` AS `aid`,`a`.`name` FROM `%1$shero_tm` AS `tm` LEFT JOIN `%1$saccount` AS `a` ON(`tm`.`pid` = `a`.`id`) WHERE `tm`.`modify` >= \'%2$s\' AND `tm`.`id` IN ( SELECT `itid` FROM `%1$shero_ti` AS `ti` WHERE `ti`.`pid` = \'%3$s\')', DB_PERFIX, $_SERVER['REQUEST_TIME'] + (4 * ONE_TICK),$account->id));  ?>
<form action="<?php printf('hero.php?show=%s&amp;subshow=%s',P_INVI_TREASURE, P_OUT_TREASURE);?>" method="post">
<input type="hidden" name = "com" value="<?php echo P_FIND_TREASURE;?>"  />
<input type="hidden" name="kind" value="<?php echo ACCEPT_INVITE;?>" />
<input type="hidden" name="subkind" id = "sub1" value="?"  />
<div class="h_t_t">
<?php  while($row = $dbo->Read($sql))  {   printf('<table><tr><td colspan="16" class="center">%s</td></tr>',$form->PlayerLink($row['aid'], $row['name']));   echo $table;   printf('<tr><td>%s</td>', $row['lvl']);   $b = true;   for($i = 1;$i<13; $i++)   {    $t = "t$i";    if($row[$t] > $town->$t)    {     $b = false;     printf('<td style="color:#F00"><blink>%s</blink></td>',$row[$t]);    }    else     printf('<td>%s</td>',$row[$t]);   }   if(!$row['e'])    echo '<td colspan="2">&nbsp;</td>';   else   {    printf('<td><img src="img/eli/%s.gif" alt="%s" class="i24" /></td>',$row['e'], $elixir[$row['e']]);    $t = 'e'.$row['e'];    if($row['en'] > $town->$t)    {     $b = false;     printf('<td style="color:#F00"><blink>%d</blink></td>',$row['en']);    }    else     printf('<td>%d</td>',$row['en']);   }   if(!$b)    printf('<td rowspan="3">%s</td>', $lang['Requirement']);   elseif($hero->Available())    printf('<td rowspan="3" class="center"><input type="submit" onclick="SetValues(\'sub1\',\'%s\');"  value ="%s"/></td></tr>',     $row['id'], $lang['Active']);   else    printf('<td rowspan="3" class="center">%s</td></tr>', $lang['NotAvailable']);   $sql2 = $dbo->ExectueQuery(    sprintf('SELECT `t`.`id`,`i`.`name`,`i`.`t1`,`i`.`t2`,`i`.`t3`,`i`.`t4` FROM `%1$shero_tmi` AS `t` LEFT JOIN `%1$shero_i` AS `i` ON (`t`.`hid` = `i`.`id`) WHERE `t`.`tid` = \'%2$s\'',     DB_PERFIX,$row['id']));    $items = array();    $i = 0;    while($r = $dbo->Read($sql2))     $items[$i++] = new Object($r);    $dbo->Cancel($sql2);    printf('<tr><td  colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td>%s</tr><tr><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td colspan = "2" class="box">%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',     $form->HeroItem($items[0],$power)      , isset($items[1]) ? $form->HeroItem($items[1],$power) : '&nbsp;'      , isset($items[2]) ? $form->HeroItem($items[2],$power) : '&nbsp;'      , isset($items[3]) ? $form->HeroItem($items[3],$power) : '&nbsp;'      , isset($items[4]) ? $form->HeroItem($items[4],$power) : '&nbsp;'      ,'<td><img src = "img/res/r1.gif" id = "r1" class = "i24" /></td><td><img src = "img/res/r2.gif" id = "r2" class = "i24" /></td><td><img src = "img/res/r3.gif" id = "r3" class = "i24" /></td><td><img src = "img/res/r4.gif" id = "r4" class = "i24" /></td><td><img src = "img/res/r5.gif" id = "r5" class = "i24" /></td>'      , isset($items[5]) ? $form->HeroItem($items[5],$power) : '&nbsp;'      , isset($items[6]) ? $form->HeroItem($items[6],$power) : '&nbsp;'      , isset($items[7]) ? $form->HeroItem($items[7],$power) : '&nbsp;'      , isset($items[8]) ? $form->HeroItem($items[8],$power) : '&nbsp;'      , isset($items[9]) ? $form->HeroItem($items[9],$power) : '&nbsp;'      ,$row['r'],$row['r'],$row['r'],$row['r'],$row['r']);     unset($items);   echo '</table>';   gc_collect_cycles();  }  $dbo->Cancel($sql);  ?>
</div>
</form>