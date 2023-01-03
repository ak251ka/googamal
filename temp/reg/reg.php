<form action="register.php" method="post">
<div class="error">
<?php  switch($nError)  {   case E_BLACK_NAME:    echo $lang['E_BLACK_NAME'];    break;   case E_NAME_IN_USE:    echo $lang['E_NAME_IN_USE'];    break;   case E_EMAIL_IN_USE:    echo $lang['E_EMAIL_IN_USE'];    break;   case E_VALID_EMAIL:    echo $lang['E_VALID_EMAIL'];    break;   case E_PASSWORD:    echo $lang['E_PASSWORD'];    break;  }  ?>
</div>
<div>
<table border="1">
<tr>
  <td colspan="2"><?php echo $lang['Submit'];?></td>
</tr>
<tr>
 <td><?php echo $lang['PlayerName'];?></td>
  <td><input id = "name" name = "name" type="text" value = "<?php if(isset($_POST['name'])) echo $_POST['name'];?>"  /></td>
</tr>
<tr>
  <td><?php echo $lang['Password']; ?></td>
  <td><input id = "p1" name = "p1" type="password" value = ""  /></td>
</tr>
<tr>
  <td><?php echo $lang['Repeat']; ?></td>
  <td><input id = "p2" name = "p2" type="password" value = ""  /></td>
</tr>
<tr>
  <td><?php echo $lang['Email'];?></td>
  <td><input id = "email" name = "email" type="text" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"  /></td>
</tr>
<tr>
    <td>
        <?php          $session->Captcha();          ?>
        <img src="captcha.php">
    </td>
    <td><input type="text" name="captcha"></td>
</tr>
</table>
</div>
<div>
<table border="1">
  <tr>
    <td rowspan="3"><img id = "ikind" src="img/troop/reg/t1.gif" /></td>
    <td style="height:50px;"><input type="radio" name="kind" value="1" checked="checked" onchange="KindChange('1');"/></td>
    <td><?php echo $lang['t1'];?></td>
    <td rowspan="3" width="300px" height="300"><p  id = "tkind"><?php echo $lang['tk1'];?></p></td>
  </tr>
  <tr style="height:50px;">
    <td><input type="radio" name="kind" value="2"  onchange="KindChange('2');"/></td>
    <td><?php echo $lang['t2'];?></td>
  </tr>
  <tr style="height:50px;">
    <td><input type="radio" name="kind" value="3" onchange="KindChange('3');"/></td>
    <td><?php echo $lang['t3'];?></td>
  </tr>
</table>
</div>
<div>
<table border="1">
<tr><td colspan="5" style="text-align:center;"><input type="radio" name="pos" value="<?php echo POS_RANDOM;?>" checked="checked" /><?php echo $lang['Random'];?> (?,?)</td></tr>
<tr>
<td><input type="radio" name="pos" value="<?php echo POS_NE;?>" /></td>
<td><?php echo $lang['NorthEast'];?></td>
<td><?php echo $lang['NorthWest'];?></td>
<td><input type="radio" name="pos" value="<?php echo POS_NW;?>" /></td>
</tr>
<tr>
<td><input type="radio" name="pos" value="<?php echo POS_SE;?>" /></td>
<td><?php echo $lang['SouthEast'];?></td>
<td><?php echo $lang['SouthWest'];?></td>
<td><input type="radio" name="pos" value="<?php echo POS_SW;?>" /></td>
</tr>
<tr><td colspan="4"><input type="checkbox" value="1" name="acc"><?php echo $lang['AcceptLow'];?></td> </tr>
</table>
</div>
<div>
<input type="submit" value="<?php echo $lang['Save'];?>" />
</div>
</form>
<script language="javascript" type="text/jscript">
var texts = Array();
<?php  printf('texts["tk1"] = "%s"; ',$lang['tk1']);  printf('texts["tk2"] = "%s"; ',$lang['tk2']);  printf('texts["tk3"] = "%s"; ',$lang['tk3']);  ?>
function KindChange(id)
{
	document.getElementById('ikind').src = 'img/troop/reg/t'+id+'.gif';
	document.getElementById('tkind').innerHTML = texts['tk'+id];
}
</script>