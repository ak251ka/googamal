<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//eng/main/troop.php');  require_once('.//lib/defines.php');  if($town->$u == 0)  {   echo $lang['BuildBuilding'].'</div>';   return;  }  $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%sresearch` WHERE `kind` = \'%s\' AND `tid` = \'%s\' AND `d` = \'0\'',   DB_PERFIX, RES_PARTY, $town->id));  if(isset($_POST['com']) and ($_POST['com'] == HAVE_PARTY) and empty($row))  {       $_POST['kind'] = isset($_POST['kind']) ? ValidNumber($_POST['kind'],true) : 0;   if($_POST['kind'] > $town->$u)    $_POST['kind'] = $town->$u;   if($_POST['kind'])   {    if($town->Lock())    {     $r = (($_POST['kind']* 2) + 1) * 500;         if($town->HaveEnough($r,$r,$r,$r,$r))     {      $town->Research(round(($_POST['kind'] + ($town->$u/4)) * 50),      $r,$r,$r,$r,$r, $_SERVER['REQUEST_TIME'] + ($_POST['kind'] * ONE_TICK), RES_PARTY);     }    }    $town->UnLock();   }      $row = $dbo->ExectueRow(          sprintf('SELECT * FROM `%sresearch` WHERE `kind` = \'%s\' AND `tid` = \'%s\' AND `d` = \'0\'',    DB_PERFIX, RES_PARTY, $town->id));  }  if(!empty($row))   printf('<table border="1"><tr><td>%s</td><td>%s<img src="img/res/cp.gif" alt="%s" class="i24" /></td><td>%s</td></tr></table>',    $lang['Party'],$row['subkind'],     $lang['CP'],     $form->Addtimer($row['modify'],    sprintf('building.php?tid=%s&bid=%s',$town->id,$bid)));  else  {  ?>
<form action="<?php printf('building.php?tid=%s&amp;bid=%s',$town->id,$bid);?>" method="post">
<input type="hidden" name="com" value="<?php echo HAVE_PARTY;?>"  />
<table>
<tr><td colspan="3" class="center"><img src="img/res/t.gif" alt="<?php echo $lang['TimeProcess'];?>" class = "i24"/></td><td colspan="3">
<input type="text" name = "kind"  value = "0" onkeyup="Party(this,'<?php echo $town->$u;?>');" onkeypress="Party(this,'<?php echo $town->$u;?>');" /></td></tr>
<tr>
<td><img src = "img/res/r1.gif" class="i30" alt="<?php echo $lang['r1'];?>"  /></td>
<td><img src = "img/res/r2.gif" class="i30" alt="<?php echo $lang['r2'];?>"  /></td>
<td><img src = "img/res/r3.gif" class="i30" alt="<?php echo $lang['r3'];?>"  /></td>
<td><img src = "img/res/r4.gif" class="i30" alt="<?php echo $lang['r4'];?>"  /></td>
<td><img src = "img/res/r5.gif" class="i30" alt="<?php echo $lang['r5'];?>"  /></td>
<td><img src = "img/res/cp.gif" class="i30" alt="<?php echo $lang['CP'];?>"  /></td>
</tr>
<tr>
<td id = "par_1">0</td>
<td id = "par_2">0</td>
<td id = "par_3">0</td>
<td id = "par_4">0</td>
<td id = "par_5">0</td>
<td id = "par_6">0</td>
</tr>
<tr><td colspan="6" class="center"><input type="submit" value="<?php echo $lang['Party'];?>" /></td></tr>
</table>

</form>
<?php   }  ?>
</div>