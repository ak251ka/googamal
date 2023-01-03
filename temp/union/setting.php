<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  require_once('.//eng/main/union.php');  require_once('.//eng/sec/user.php');  require_once('.//eng/sec/session.php');  if(!$session->Permission(BAND_TOWN | OWNER) or ($uid != $account->uid))  {   $form->BlockPage();   return;  }  if(isset($_POST['com']))  {   switch($_POST['com'])   {    case LEAVE_UNION:     $union->Leave($account->uid, $account->id);     $session->Href('town.php');     break;    case INVITE:     if(!($isOfficer & INVITE_UNION))      break;     if(!isset($_POST['pname']))      break;     $pid = $user->Find($_POST['pname']);     if(!$pid)      break;     $t = $union->IsInvitation($account->uid, $pid);     if(!empty($t) or $union->IsMember($account->uid, $pid))     {      printf('<center class = "error">%s</center>',$lang['HadInvitation']);      break;     }     $union->Invitation($uid,$account->id,$pid, $lang['Invitation']);     break;    case INVITE_CANCEL:     if(!isset($_POST['kind']))      break;     if($isOfficer & INVITE_UNION)     {      $_POST['kind'] = ValidNumber($_POST['kind'],true);      $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%sunion_i` WHERE `id` = \'%s\' and `uid` = \'%s\'',       DB_PERFIX, $_POST['kind'], $account->uid));      if(!empty($row))       $union->CancelInvitation($account->uid,$row['id'],$account->id, $row['b']);     }   }  }  echo $lang['ExitUnion'];  ?>
<form action="union.php?show=<?php echo P_U_SETTING;?>" method="post">
<input type="hidden" name="com" value="<?php echo LEAVE_UNION;?>" />
<input type="submit" value="<?php echo $lang['Exit'];?>" />
</form>
<?php  if(!$isOfficer)   return;  if($isOfficer & INVITE_UNION)  {  ?>
<div class="u_d_right t_w_300">
<a href="javascript:void(0);" onclick="ShowHide('dim');"><?php echo $lang['Invitation'];?></a>
<div id = "dim">
<form action="union.php?show=<?php echo P_U_SETTING;?>" method="post">
<input type="hidden" name="com" value="<?php echo INVITE;?>" />
<table>
<tr><td><?php echo $lang['Name'];?></td><td><input type="text" name="pname"  /></td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Invitation'];?>" /></td></tr>
</table>
</form>
<form id = "can_in" action="union.php?show=<?php echo P_U_SETTING;?>" method="post">
<input type="hidden" name="com" value="<?php echo INVITE_CANCEL;?>" />
<input type="hidden" name="kind" id = "kind" value="?" />
<table class="td75">
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $lang['Invitation'];?></td><td><?php echo $lang['InDate'];?></td><td><?php echo $lang['Action'];?></td></tr>
<?php  $sql = $dbo->ExectueQuery(sprintf('SELECT `i`.*,`a`.`name` AS `aname`, `b`.`name` AS `bname` FROM `%1$sunion_i` AS `i` LEFT JOIN `%1$saccount` AS `a` ON (`i`.`a` = `a`.`id`) LEFT JOIN `%1$saccount` AS `b` ON (`i`.`b` = `b`.`id`) WHERE `i`.`uid` = \'%2$s\'',DB_PERFIX,$account->uid));  if($dbo->RowsNumber($sql))  {   $form->AddText('cifp',$lang['Cancel']);   while($row = $dbo->Read($sql))   {    $aname = empty($row['aname']) ? '???' : $form->PlayerLink($row['a'],$row['aname']);    printf('<tr><td>%s</td><td>%s</td><td>%s</td><td><img src="img/all/f2.gif" id =  "cifp" class="i24s" onclick="SubmitForm(\'can_in\',\'kind\',\'%s\');"  /></td></tr>',     $form->PlayerLink($row['b'],$row['bname']),$aname,DateToString($row['modify']),$row['id']);   }  }  else   printf('<tr><td colspan="4">%s</td></tr>',$lang['NoRecord']);  $dbo->Cancel($sql);  gc_collect_cycles();  ?>
</table>
</form>
</div>
</div>
<?php  }  if($isOfficer & SET_RANK_UNION)  {  ?>
<div class="u_d_left t_w_300">
<a href="javascript:void(0);" onclick="ShowHide('umr');"><?php echo $lang['Members'];?></a>
<div id = "umr">
<table>
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $lang['U_Rank'];?></td><td>
<img src="img/point/ap.gif" alt="<?php printf('%s %s',$lang['AP'],$lang['Union']); ?>" class="i30"/><td><img src="img/point/dp.gif" alt="<?php printf('%s %s',$lang['DP'],$lang['Union']); ?>" class="i30"/></td><td><?php echo $lang['Fire'];?></td><td colspan="2"><?php echo $lang['Rank']?></td><td><?php echo $lang['Officer'];?></td></tr>
<?php  $form->AddText('f_f_u',$lang['Fire']);  $form->AddText('inc',$lang['Increase']);  $form->AddText('dec',$lang['Decrease']);  $form->AddText('off',$lang['Officer']);  $list = $union->GetMemberInfo($account->uid);  $j =0;  foreach($list as &$l)  {   if($l->pid == $account->id or $l->pid  == $info->pid)    continue;   $j++;   printf('<tr id ="rol_%s"><td>%s</td><td id= "r_u_%s">%s</td><td>%s</td><td>%s</td> <td><img id = "f_f_u" class="i24s" src="img/all/f2.gif" onclick="Management.UnionFire(\'%8$s\', this);"  /></td> <td><img id = "inc" class="i24s" src="img/all/e1.gif" onclick="Management.UnionRank(\'%7$s\',\'i\');" /></td><td><img id = "dec" class="i24s" src="img/all/e2.gif" onclick="Management.UnionRank(\'%7$s\',\'d\');" /></td><td><img id = "off" class="i24s" src="img/all/b2.gif" onclick="Management.GetInfo(\'%8$s\',this);" /></td></tr>',    $l->id,$form->PlayerLink($l->pid,$l->name),$l->id,$lang['U_R_'.$l->rank],$l->ap,$l->dp,$l->id,$l->pid);  }  if(!$j)   printf('<tr><td colspan="8" class ="center">%s</td></tr>',$lang['NoRecord']);  ?>
</table>
<br />
<br />
<table  id = "otp" style="display:none;"><tr><td><?php echo $lang['Name'];?></td><td id ="mname">&nbsp;</td></tr><tr><td><?php echo $lang['Post'];?></td><td><input type="text" id = "opost" /></td></tr><tr><td><?php echo $lang['MInvitation']?></td><td><input type="checkbox" id = "minv" /></td></tr><tr><td><?php echo $lang['MMembers']?></td><td><input type="checkbox" id = "mmem" /></td></tr><tr><td><?php echo $lang['MForum']?></td><td><input type="checkbox" id = "mfor" /></td></tr><tr><td><?php echo $lang['MPolicy']?></td><td><input type="checkbox" id = "mpol" /></td></tr><tr><td class="center"><input id = "sbp" type="button" value="<?php echo $lang['Save'];?>" /></td><td class="center"><input id = "cbp" type="button" value="<?php echo $lang['Cancel'];?>" /></td></tr></table>
</div>
</div>
<div style="clear:both"></div>
<?php  }  ?>
<script language="javascript" type="text/javascript">
Management.Setup('otp');
</script>