<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//lib/defines.php');  $mT = 1;  $mT += $hero->GetPoint(14)*0.02;  $sT = $hero->GetPoint('HP3')/100;  $sT += $mT;  $hT = $town->$u - $dbo->ExectueScaler(sprintf('SELECT sum(`tr`) AS `c` FROM `%smarket` WHERE `tid1` = \'%s\' AND `d` = \'0\'',   DB_PERFIX,$town->id,$town->id),'c');    if(isset($_POST['com']))  {   if($_POST['com'] == RESOURCE_MARKET_PROPOSAL)   {    $_POST['pr1'] = isset($_POST['pr1']) ? ValidNumber($_POST['pr1'],true) : 0;    $_POST['pr2'] = isset($_POST['pr2']) ? ValidNumber($_POST['pr2'],true): 0;    $_POST['prn1'] = isset($_POST['prn1']) ? ValidNumber($_POST['prn1'],true): 0;    $_POST['prn2'] = isset($_POST['prn2']) ? ValidNumber($_POST['prn2'],true): 0;    if($_POST['pr1'] and $_POST['pr2'] and $_POST['prn1'] and $_POST['prn2'])    {     if($_POST['pr1'] != $_POST['pr2'] and $_POST['pr1'] < 6 and $_POST['pr2'] < 6)      if($_POST['prn1'] <=  $mT * 1000 * $hT)       $town->ProposalResource        ($_POST['pr1'], $_POST['pr2'], $_POST['prn1'], $_POST['prn2'], (int)ceil($_POST['prn1']/($mT*1000)), round($sT * TRADESFLOK));    }   }   elseif($_POST['com'] == RESOURCE_MARKET_PROPOSAL_CANCEL)    $town->CancelProposalResource(ValidNumber($_POST['kind'], true));  }  $hT = $town->$u - $dbo->ExectueScaler(sprintf('SELECT sum(`tr`) AS `c` FROM `%smarket` WHERE `tid1` = \'%s\' AND `d` = \'0\'',   DB_PERFIX,$town->id,$town->id),'c');  printf($lang['HaveTradesfolk'],$hT,$town->$u, $mT * 1000, $sT * TRADESFLOK);  ?>
<form action="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RESOURCE_MARKET_PROPOSAL);?>" method="post">
<input name = "com" type="hidden" value="<?php echo RESOURCE_MARKET_PROPOSAL;?>" />
<table>
<tr><td><?php echo $lang['Proposal'];?></td><td><img id = "img1" src="img/res/r1.gif" alt = "<?php echo $lang['r1'];?>" class="i30"></td>
<td><select name = "pr1" onChange="ChangeImgRes('img1',this);"><option selected = "selected" value="1"><?php echo $lang['r1'];?></option><?php   for($i=2;$i<6;$i++)   printf('<option value="%d">%s</option>',$i,$lang['r'.$i]);  ?></select></td><td><input type="text" name="prn1" value="0" /></td></tr>
<tr><td><?php echo $lang['Request'];?></td><td><img id = "img2" src="img/res/r1.gif" alt = "<?php echo $lang['r1'];?>" class="i30"></td>
<td><select name = "pr2" onChange="ChangeImgRes('img2',this);"><option selected = "selected" value="1"><?php echo $lang['r1'];?></option><?php   for($i=2;$i<6;$i++)   printf('<option value="%d">%s</option>',$i,$lang['r'.$i]);  ?></select></td><td><input type="text" name="prn2" value="0" /></td></tr>
</table>
<input type="submit" value="<?php echo $lang['Proposal'];?>" style="margin-top:10px;margin-bottom:10px;" />
</form>
<form id = "cpror" action="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RESOURCE_MARKET_PROPOSAL);?>" method="post">
<input name = "com" type="hidden" value="<?php echo RESOURCE_MARKET_PROPOSAL_CANCEL;?>" />
<input name = "kind" id = "kind" type="hidden" value="?"  />
<?php  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%smarket_p` WHERE `tid` = \'%s\' AND `d` = \'0\'',DB_PERFIX,$town->id));  if($dbo->RowsNumber($sql))  {   printf('<table><tr><td colspan="2">%s</td><td colspan="2">%s</td><td>%s</td></tr>',$lang['Proposal'], $lang['Request'],$lang['Action']);   while($row = $dbo->Read($sql))    printf('<tr><td><img src="img/res/r%d.gif" alt="%s" class = "i30" /></td><td>%s</td><td><img src="img/res/r%d.gif" alt="%s" class = "i30" /></td><td>%s</td><td><img class="i30s" onclick="SubmitForm(\'cpror\',\'kind\',\'%d\');" src="img/all/f2.gif" alt="%s" /></td></tr>',     $row['tr1'],$lang['r'.$row['tr1']],$row['r1'],$row['tr2'],$lang['r'.$row['tr2']],$row['r2'],$row['id'],$lang['Cancel']);   printf('</table>');  }  $dbo->Cancel($sql);  ?>
</div>