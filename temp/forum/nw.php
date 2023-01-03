<?php  require_once('eng/sec/user.php');  require_once('lib/object.php');  if(isset($_GET['uid']))   $uid = (int)$_GET['uid'];  else   $uid = $account->uid;    if(!$uid  or $account->uid != $uid)   $session->Href('block.php');  if(!$session->Permission(EDIT_FROM))   $session->Href('block.php');    if(!empty($_POST))  {   $nid = 0;   $obj = new Object();   $obj->uid = $uid;   $obj->name = empty($_POST['name'])?$lang['Unknown']:$_POST['name'];   $obj->desc = empty($_POST['desc'])?$lang['Unknown']:$_POST['desc'];   $obj->types = isset($_POST['types'])?$_POST['types']: ALL_USER;   $nid = $topic->InsertInto($obj);   if($obj->types == INVITED_MEMBER and $nid)   {    $arr = array();    foreach($_POST as $key=> $value)    {     if(NoNumbers($key) == 'mn' and !empty($value))     {      $id = $user->Find($value);      if($id)       $arr[count($arr)] = $id;     }    }    $topic->SetMember($nid, $arr);   }   if($nid)   {    $topic->Load($uid);    $t = $topic->Topics($nid);  ?>
<div>
<table>
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $t->name;?></td></tr>
<tr><td><?php echo $lang['Description'];?></td><td><?php echo $t->desc;?></td></tr>
<tr><td><?php echo $lang['Kind'];?></td><td><?php   switch($t->types)  {   case ALL_USER:    echo $lang['Open'];    break;   case UNION_MEMBER:    echo $lang['Union'];    break;   case INVITED_MEMBER:    echo $lang['Private'];    break;  }  ?>
</td></tr>
</table>
<?php  if($t->types == INVITED_MEMBER)  {   echo '<table id = "tbMem" border="1"><tr><td class="center">'.$lang['PlayerName'].'</td></tr>';   $m = $topic->LoadMember($t->id);   foreach($m as $l)   {    printf('<tr><td>%s</td></tr>',$l->name);   }   echo '</table>';  }  printf('<div class = "center">%s</div>', $form->Ahref('/forum.php?show='.TOPIC.'&amp;uid='.$uid,$lang['Return']));  return;   }  }  ?>

<form action="<?php printf('forum.php?show=%s&amp;uid=%s', NEW_TOPIC, $uid);?>" method="post">
<div>
<table>
<tr><td><?php echo $lang['Name'];?></td><td><input  name = "name" type="text" maxlength="32" value="" /></td></tr>
<tr><td><?php echo $lang['Description'];?></td><td><input name = "desc" type="text" maxlength="52" value="" /></td></tr>
<tr><td><?php echo $lang['Kind'];?></td><td>
<select id = "types" name="types" onchange="onChangeKind(<?php echo INVITED_MEMBER;?>);">
<option value="<?php echo ALL_USER;?>">
<?php echo $lang['Open'];?></option>
<option value="<?php echo UNION_MEMBER;?>">
<?php echo $lang['Union'];?></option>
<option value="<?php echo INVITED_MEMBER;?>">
<?php echo $lang['Private'];?></option>
</select>
</td></tr>
</table>
</div>
<div id = "divMem" style="display:none">
<table id = "tbMem" border="1">
<thead>
<tr><td class="center"><?php echo $lang['PlayerName'];?></td><td class="center"><?php echo $lang['Action'];?></td></tr>
</thead>
<tbody>
<?php  printf('<tr  id ="cR" style="display:none"><td><input name = "mn%d" type = "text" value=""/></td><td><input type="button" value="%s" onclick="RemoveRow(this);" /></td></tr>',0,$lang['Delete']);  printf('<tr><td><input name = "mn%d" type = "text" value=""/></td><td><input type="button" value="%s" onclick="RemoveRow(this);" /></td></tr>',1,$lang['Delete']);  ?>
</tbody>
<tfoot>
<tr><td class="center" colspan="2"><input type="button" value="<?php echo $lang['New'];?>" onclick="AddRow('tbMem','cR');"/></td></tr>
</tfoot>
</table>
</div>
<div class="center Pooling"><input type="submit" value="<?php echo $lang['Save'];?>" /><br /><br /><?php echo $form->Ahref('/forum.php?show='.TOPIC.'&amp;uid='.$uid,$lang['Return']);?></div>
</form>