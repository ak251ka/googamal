<?php  require_once('.//eng/sec/user.php');  require_once('.//lib/form.php');  if(!$session->Permission(READ_PM) or !isset($_GET['id']) or !$pm->Load($_GET['id']))  {      echo '<div class="massageList">';   $form->BlockPage();      echo '</div>';   return;  }  $name = '';  if($account->id == $pm->re)  {   $name = $user->GetName($pm->se);   $pm->RemoveFlag(RECIVER, $pm->id, NOT_READ);  }  else   $name = $user->GetName($pm->re);  ?>
<div class="massageList">
<table class="hovertable">
<tr><td><?php echo $account->id == $pm->re? $lang['Sender']: $lang['Reciver'];?></td><td><?php  if(empty($name))   echo '&nbsp;';  else   echo $form->PlayerLink($account->id == $pm->re ? $pm->se: $pm->re,$name);      $t=1;  ?></td></tr>
<tr><td><?php echo $lang['Subject'];?></td><td><?php echo $pm->subject;?></td></tr>
<tr><td><?php echo $lang['InDate'];?></td><td><?php echo DateToString($pm->modify);?></td></tr>
<input id="Payam" type="hidden" value="<?php echo $pm->message;?>"/>
<tr> <td colspan="2" id="textM"><div class="readB"><?php  if($pm->flag & UNI_INFO)  {   $info = explode(":",$pm->message);   if($info[0] == 'uis')   {    $uname = $union->GetName($info[1]);    $pname = $user->GetName($info[2]);        if(empty($uname))     $form->BlockPage($lang['InvitationInvalid']);    else    {     $pname = empty($pname) ? '???' : $form->PlayerLink($info[2], $pname);     printf($lang['InvitationText'],$pname,$form->UnionLink($info[1],$uname));     echo $lang['AutoMessage'];    }   }   elseif($info[0] == 'tis')   {    $pname = $user->GetName($info[1]);    if(empty($pname) or !$hero->HaveInvitation($info[2]))     $form->BlockPage($lang['InvitationInvalid']);    else    {     printf($lang['InvitationTreasure'],$form->PlayerLink($info[1],$pname));     echo $lang['AutoMessage'];    }   }  }  else   printf($form->replace($pm->message));  ?></div></td></tr>
<tr><td colspan="2" class="center">
<form action="pm.php?show=<?php echo WRITE;?>" method="post">
<input type="hidden" name="com" value="nw" />
<input type="hidden" name = "pid" value="<?php echo $account->id == $pm->re ? $pm->se : $pm->re;?>" />
<input type="hidden" name = "sub" value="<?php echo $pm->subject; ?>" />
<input value="<?php echo $lang['Replay'];?>" type="submit" />
</form>
</td>
</tr>
</table>
</div>