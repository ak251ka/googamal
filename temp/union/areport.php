<?php  require_once('.//eng/main/report.php');  if($account->uid != $uid)  {   $form->BlockPage();   return;  }  $report = new Report;  $list = $report->GetUnionReport($uid);  ?>
<div>
<table class="t_w_700">
<tr><td><?php echo $lang['Action'];?></td><td><?php echo $lang['InDate'];?></td><td><?php echo $lang['Titel'];?></td></tr>
<?php  if(count($list))  {   foreach($list as &$l)    printf('<tr><td><img src="img/rep/%s_%s_1.gif" alt="report"/></td><td>%s</td><td>%s</td></tr>',     $l->kind,$l->l,DateToString($l->modify),sprintf($lang['REPORT_'.$l->kind],$l->aname,$l->bname));  }  else   printf('<tr><td colspan = "3">%s</td></tr>',$lang['NoRecord']);  ?>
</table>
</div>