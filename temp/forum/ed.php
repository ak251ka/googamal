<?php  require_once('eng/sec/user.php');  if(!$session->Permission(EDIT_FROM))   $session->Href('block.php');    if(isset($_GET['uid']) and is_numeric($_GET['uid']))   $uid = (int)$_GET['uid'];  else   $uid = $account->uid;    if(!$uid or !isset($_GET['id']))   $session->Href('block.php');     $topic->Load($uid);  $t = $topic->Topics($_GET['id']);  if(!$t or $account->uid != $uid)   $session->Href('block.php');    if(!empty($_POST))  {   if(isset($_POST['subkind']) and $_POST['subkind'] == 'del')   {    $topic->DeleteTopic($t->id);    printf('<div class="center">%s<br /><br />%s</div>',    $lang['DelMessage'],$form->Ahref('/forum.php?show='.TOPIC,$lang['Return']));    return;   }   if(isset($_POST['subkind']) and $_POST['subkind'] == 'ed')   {    $t->name = empty($_POST['name'])?$lang['Unknown']:$_POST['name'];    $t->desc = empty($_POST['desc'])?$lang['Unknown']:$_POST['desc'];    $t->types = isset($_POST['types'])?$_POST['types']: ALL_USER;    if($t->types != INVITED_MEMBER)     $topic->DelMembers($_GET['id']);    else    {     $arr = array();     foreach($_POST as $key=> $value)     {      if(NoNumbers($key) == 'mn' and !empty($value))      {       $id = $user->Find($value);       if($id)        $arr[count($arr)] = $id;      }     }     $topic->SetMember($t->id, $arr);    }    $topic->SaveTopic($t);   }  }  $m = $topic->LoadMember($t->id);  ?>
<form action="<?php printf('forum.php?show=%s&amp;uid=%s&amp;id=%s',EDIT,$uid,$t->id);?>" method="post">
<input type="hidden" value="ed" name="subkind" id="subkind" />
<div>
<table>
<tr><td><?php echo $lang['Action'];?></td><td class="center"><input type="submit" value="<?php echo $lang['Delete'];?>" onclick="SetValues('subkind','del');" /></td></tr>
<tr><td><?php echo $lang['Name'];?></td><td><input  name = "name" type="text" maxlength="32" value="<?php echo $t->name;?>" /></td></tr>
<tr><td><?php echo $lang['Description'];?></td><td><input name = "desc" type="text" maxlength="52" value="<?php echo $t->desc;?>" /></td></tr>
<tr><td><?php echo $lang['Kind'];?></td><td>
<select id = "types" name="types" onchange="onChangeKind(<?php echo INVITED_MEMBER;?>);">
<option value="<?php echo ALL_USER;?>" <?php if($t->types == ALL_USER) echo 'selected="selected"';?>>
<?php echo $lang['Open'];?></option>
<option value="<?php echo UNION_MEMBER;?>" <?php if($t->types == UNION_MEMBER) echo 'selected="selected"';?>>
<?php echo $lang['Union'];?></option>
<option value="<?php echo INVITED_MEMBER;?>" <?php if($t->types == INVITED_MEMBER) echo 'selected="selected"';?>>
<?php echo $lang['Private'];?></option>
</select>
</td></tr>
</table>
</div>
<div id = "divMem" <?php if($t->types!= INVITED_MEMBER) echo ' style="display:none" ';?>>
<table id = "tbMem">
<thead>
<tr><td class="center"><?php echo $lang['PlayerName'];?></td><td class="center"><?php echo $lang['Action'];?></td></tr>
</thead>
<tbody>
<?php  printf('<tr  id ="cR" style="display:none"><td><input name = "mn%d" type = "text" value=""/></td><td><input type="button" value="%s" onclick="RemoveRow(this);" /></td></tr>',0,$lang['Delete']);  $i = 1;  foreach($m as $l)  {   printf('<tr><td><input name = "mn%d" type = "text" value="%s"/></td><td><input type="button" value="%s" onclick="RemoveRow(this);" /></td></tr>',$i++,$l->name,$lang['Delete']);   }  printf('<tr><td><input name = "mn%d" type = "text" value=""/></td><td><input type="button" value="%s" onclick="RemoveRow(this);" /></td></tr>',$i,$lang['Delete']);    ?>
</tbody>
<tfoot>
<tr><td class="center" colspan="2"><input type="button" value="<?php echo $lang['New'];?>" onclick="AddRow('tbMem','cR');"/></td></tr>
</tfoot>
</table>
</div>
<div class="center Pooling">
<input type="submit" value="<?php echo $lang['Save'];?>" onclick="SetValues('subkind','ed');" />
<br /><br />
<?php echo $form->Ahref('/forum.php?show='.TOPIC.'&amp;uid='.$uid,$lang['Return']);?>
</div>
</form>