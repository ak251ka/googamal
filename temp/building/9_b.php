<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//lib/defines.php');  require_once('.//lib/utility.php');  require_once('.//eng/main/account.php');  $filter = '';    $mT = 1;  $mT += $hero->GetPoint(14)*0.02;  $sT = $hero->GetPoint('HP3')/100;  $sT += $mT;  $hT = $town->$u - $dbo->ExectueScaler(sprintf('SELECT sum(`tr`) AS `c` FROM `%smarket` WHERE `tid1` = \'%s\' AND `d` = \'0\'',   DB_PERFIX,$town->id,$town->id),'c');  $pos = $dbo->ExectueRow(sprintf('SELECT `x`,`y` FROM `%smap_t` WHERE `id` = \'%s\'',DB_PERFIX, $town->mid));  if(isset($_POST['com']) and $_POST['com'] == RESOURCE_MARKET_BUY)  {   $town->Lock();   $_POST['subkind'] = isset($_POST['subkind']) ? ValidNumber($_POST['subkind'],true): 0;   $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%smarket_p` WHERE `id` = \'%u\' AND `d` = \'0\'',DB_PERFIX, $_POST['subkind']));   $arr = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0);   if(!empty($row) and $town->IsLock())   {    $arr[$row['tr2']] = $row['r2'];    if($town->HaveEnough($arr[1], $arr[2], $arr[3], $arr[4], $arr[5]))    {     $dbo->ExectueQuery(sprintf('UPDATE `%smarket_p` SET `d` = \'1\' WHERE `id` = \'%s\' AND `d` = \'0\' LIMIT 1',      DB_PERFIX, $row['id']));     if($dbo->AffectedRows())     {      if(ceil($row['r2'] / ($mT * 1000)) <= $hT)      {       $town->SubResource($arr[1], $arr[2], $arr[3], $arr[4], $arr[5]);       $town->SendResource($row['tid'], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5],        Distance($pos['x'],$row['x'],$pos['y'],$row['y'], TRADESFLOK * $sT),         (int)ceil($row['r2'] / ($mT * 1000)));       $dis = Distance($pos['x'],$row['x'],$pos['y'],$row['y'], TRADESFLOK * $sT);       $row2 = array('tid2' => $town->id, 'pid2' =>$account->id,           'kind' => MARKET_SEND, 'len' => $dis, 'modify' => $dis + $_SERVER['REQUEST_TIME']);       $dbo->UpdateRow(DB_PERFIX.'market', $row2, $row['mid']);      }     }    }    $town->UnLock();   }  }  if(isset($_GET['fil']) and ValidNumber($_GET['fil'],true) < 6)  {   if($_GET['fil'])    $filter = sprintf('AND `tr1` = \'%s\'',$_GET['fil']);  }    $count = $dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%smarket_p` WHERE `pid` != \'%s\' AND `d` = \'0\''.$filter,   DB_PERFIX,$account->id),'c');  $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;  $r = isset($_GET['row']) ? ValidNumber($_GET['row'],true) : 20;  if($r >100)   $r = 100;  if(!$plus->HavePlus('pb'))   $r = 20;    if($page * $r > $count)   $page = 0;  $market = $dbo->ExectueQuery(sprintf('SELECT `p`.*,`t`.`name` AS `tname`, `a`.`name` AS `pname` FROM `%smarket_p` AS `p` LEFT JOIN  `%stown` AS `t` ON (`p`.`tid` = `t`.`id`) LEFT JOIN  `%saccount` AS `a` ON (`p`.`pid` = `a`.`id`) WHERE `p`.`pid` != \'%s\' %s AND `p`.`d` = \'0\' LIMIT %d,%d',   DB_PERFIX, DB_PERFIX, DB_PERFIX,$account->id,$filter,$page*$r,$r));  ?>
<form id = "f_9_b" action="building.php" method="get">
<?php  $fH = false;  $gets = array();  $i =0;  foreach($_GET as $key => $value)  {   if($key == 'fil')    $fH = true;   printf('<input type="hidden" name="%s" value="%s" id="%s"  />',$key,$value,$key);   $gets[$i++] = sprintf('%s=%s',$key,$value);  }  if(!$fH)  {   printf('<input type="hidden" name="%s" value="%s" id="%s"  />','fil',0,'fil');   $gets[$i++] = sprintf('%s=%s','fil','0');  }  ?>
<div class="resDiv"><img src="img/all/a3.gif" alt="<?php echo $lang['All'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','0');" /><img src="img/res/r1.gif" alt="<?php echo $lang['r1'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','1');" /><img src="img/res/r2.gif" alt="<?php echo $lang['r2'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','2');" /><img src="img/res/r3.gif" alt="<?php echo $lang['r3'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','3');" /><img src="img/res/r4.gif" alt="<?php echo $lang['r4'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','4');" /><img src="img/res/r5.gif" alt="<?php echo $lang['r5'];?>" class="i30s" onclick="SubmitForm('f_9_b','fil','5');" /></div></form>
<form id = "fbr_9_b" action="<?php  echo 'building.php?'.implode('&amp;',$gets);  ?>" method="post">
<input type="hidden" name="com" value="<?php echo RESOURCE_MARKET_BUY;?>" />
<input type="hidden" name="subkind" id = "subkind" value="?" />
<table width="500px">
<tr><td colspan="2"><?php echo $lang['Proposal'];?></td><td colspan="2"><?php echo $lang['Request'];?></td><td><?php echo $lang['Player'];?></td><td><?php echo $lang['Town'];?></td><td><?php echo $lang['Distance'];?></td><td><?php echo $lang['Buy'];?></td></tr>
<?php  if($dbo->RowsNumber($market))  {   $arr = array('1' =>0, '2' =>0, '3' =>0, '4' =>0, '5' =>0);   while($row = $dbo->Read($market))   {    $arr[$row['tr2']] = $row['r2'];    $buy = ($row['r2'] >  $mT * 1000 * $hT) ? $lang['E_NO_Tradesfolk'] :      ($town->HaveEnough($arr[1],$arr[2],$arr[3],$arr[4],$arr[5]) ?     sprintf('<img src="img/mk/sell_s.gif" alt="%s" class="i24s" onclick ="SubmitForm(\'fbr_9_b\',\'subkind\',\'%s\');"/>',$lang['Buy'], $row['id']) :     sprintf($lang['NotEnough'],$lang['Resource'])     );    $arr[$row['tr2']] = 0;    printf('<tr><td><img src="img/res/r%s.gif" alt="%s"  class = "i24" /></td><td>%s</td><td><img src="img/res/r%s.gif" alt="%s"  class = "i24" /></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',     $row['tr1'],$lang['r'.$row['tr1']],$row['r1'],$row['tr2'],$lang['r'.$row['tr2']],$row['r2'],     $form->PlayerLink($row['pid'],$row['pname']),$form->TownLink($row['tid'],$row['tname']),     SecToString(Distance($row['x'],$pos['x'],$row['y'], $pos['y'], $row['sp'])),$buy);    gc_collect_cycles();   }  }  else   printf('<tr><td colspan="9">%s</td></tr>',$lang['NoRecord']);  $dbo->Cancel($market);  ?>
<tr><td colspan="9"><?php   $fH = false;  $gets = array();  $i =0;  foreach($_GET as $key => $value)  {   if($key == 'row' or $key == 'page')    continue;   if($key == 'fil')    $fH = true;   $gets[$i++] = sprintf('%s=%s',$key,$value);  }  if(!$fH)   $gets[$i++] = sprintf('%s=%s','fil','0');  echo Paging($count,'building.php?'.implode('&amp;',$gets).'&amp;', $r, $page);    ?></td></tr>
</table>
</form>
<?php  $gets = array();  $gets['fil'] = isset($_GET['fil']) ? $_GET['fil'] : 0;  $gets['tid'] = $town->id;  $gets['bid'] = $bid;  if($plus->HavePlus('pb'))   echo $form->AddPagingForm('building',RESOURCE_MARKET_BUY,$page,$r,$gets);  ?>
</div>