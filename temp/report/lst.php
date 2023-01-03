<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  if(isset($_POST['com']))  {   if($_POST['com'] == 'del')   {    foreach($_POST as $key => $value)    {     $value = ValidNumber($value,true);     if(NoNumbers($key) == 'cb')      $report->SetFlag($value,$account->id,RE_DEL);    }   }   elseif($_POST['com'] == 'arc')   {    foreach($_POST as $key => $value)    {     $value = ValidNumber($value,true);     if(NoNumbers($key) == 'cb')      $pm->RemoveFlag(RECIVER, $value, RE_ARC);    }   }  }  $count = $dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `num` FROM `%sreports` WHERE `pid` = \'%s\' AND NOT (`flag` & \'%d\')',   DB_PERFIX, $account->id, RE_DEL | RE_ARC),'num');  $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;  $row = isset($_GET['row']) ? (int)$_GET['row'] : 10;  if($row >100)   $row = 100;  if(!$plus->HavePlus('pb'))   $row = 10;    if($page * $row > $count)   $page = 0;  $sql = $dbo->ExectueQuery(sprintf('SELECT `r`.`id` , `r`.`pid1` , `a`.`name` AS `name1` , `r`.`pid2` , `b`.`name` AS `name2` , `r`.`kind` , `r`.`l` , `r`.`flag`, `r`.`modify` FROM `%sreports` AS `r` LEFT JOIN `%saccount` AS `a` ON ( `r`.`pid1` = `a`.`id` ) LEFT JOIN `%saccount` AS `b` ON ( `r`.`pid2` = `b`.`id` ) WHERE `r`.`pid` = \'%s\' AND NOT (`r`.`flag` & \'%d\') ORDER BY `r`.`modify` DESC LIMIT %d, %d',   DB_PERFIX,DB_PERFIX,DB_PERFIX, $account->id, RE_DEL | RE_ARC, $page * $row, $row));  ?>
<div class="massageList">
<form action="report.php?show=<?php echo LST;?>&amp;page=<?php echo $page;?>&amp;row=<?php echo $row?>" method="post" name="msg" id = "msg">
<input type="hidden" name="com" id="com" value="?" />
<center><h2><?php echo $lang['Report'];?></h2></center>
<table class="hovertable" style="border: 1px solid black; margin-right:140px; width:530px;margin-top:5px; margin-bottom:10px;">

<tr>
<td style="width:16px;text-align:center;">&nbsp;</td>
<td style="width:16px;text-align:center;">&nbsp;</td>
<td style="width:300px;text-align:center;"><span class=""><?php echo $lang['Titel'];?></span></td>
<td style="width:125px;text-align:center;"><span class=""><?php echo $lang['Subject'];?></span></td>
<td style="width:125px;text-align:center;"><span class=""><?php echo $lang['InDate'];?></span></td>
</tr>
<?php  if(!$dbo->RowsNumber($sql))   printf('<tr><td colspan = "5" class = "center">%s</td></tr>',$lang['NoRecord']);  else  {   $i = 0;   while($r = $dbo->Read($sql))   {    printf('<tr><td><input type="checkbox" value="%u" name="cb%d" /></td>', $r['id'], $i++);    $read = $r['flag'] & RE_READ;    printf('<td><img class = "i30" src = "img/rep/%s%s%s.gif" alt="%s" /></td>',$r['kind'],$read ? '1' : '0',$r['l']     ,$read ? $lang['Readed']: $lang['NotRead']);    if($row['kind'] != RE_ADVENTURE)    {     printf('<td><a href ="report.php?show=show&amp;id=%s">%s</a></td>',$r['id'],      sprintf($lang['REPORT_'.$r['kind']], $r['pid1'] ? $r['name1'] : $lang['t6'],      $r['pid2'] ? $r['name2'] : $lang['t4']));     printf('<td>%s</td>', $r['kind'] != RE_TRADE ? ($r['pid1'] == $account->id ? $lang['Attacker'] : $lang['Defendant']) : '-' );         }    else     printf('<td>%s</td>',$lang['REPORT_4']);    printf('<td>%s</td></tr>',DateToString($r['modify']));   }  }  $dbo->Cancel($sql);  gc_collect_cycles();  ?>
<tr><td colspan="2"><input type="checkbox" id = "all" onchange="SetAll('msg','all');" /> <td colspan="3">
<input type="button" onclick="SubmitForm('msg','com','del');" class="buttonClass" value = "<?php echo $lang['Delete'];?>"/>
</td></tr>
<tr>
<td colspan="2"><?php echo $lang['PageNumber'];?></td>
<td colspan="3">
<div class="pagination">
<?php echo Paging($count,sprintf('report.php?show=%s&amp;',LST), $row, $page);?>
</div>
</td>
</tr>
</table>
</form>
<?php  if($plus->HavePlus('pb'))  {  ?>
<div class="Pooling">
<form action="report.php" method="get">
<input type="hidden" name = "show" value="<?php echo LST;?>"/>
<input type="hidden" name="page" value="<?php echo $page;?>"/>
<input type="text" id="row" name="row" value="<?php echo $row;?>" />
<input type="submit" value="<?php echo $lang['Show'];?>" class="buttonClass" />
</form>
</div>
<?php  }  ?>
</div>