<?php  if(isset($_POST['com']) and $_POST['com'] == P_EXCHANGE_PLUS)  {   $_POST['tbT'] = isset($_POST['tbT']) ? ValidNumber($_POST['tbT'],true) : 0;   if($_POST['tbT'])    $_POST['tbM'] = 0;   else    $_POST['tbM'] = isset($_POST['tbM']) ? ValidNumber($_POST['tbM'],true) : 0;   if($_POST['tbT'])    $plus->ExchengeM($_POST['tbT']);   elseif($_POST['tbM'])    $plus->ExchengeT($_POST['tbM']);  }  ?>
<div class="p_main">
<form action="plus.php?show=<?php echo P_EXCHANGE_PLUS;?>" method="post">
<input type="hidden" name="com" value="<?php echo P_EXCHANGE_PLUS;?>"  />

<table  class="p_table midDiv center" >
<tr><td colspan="4"><?php printf($lang['ExDesc'], EXCHANGE_M,EXCHANGE_T);?> </td></tr>
<tr><td><?php echo $lang['Talant'];?></td><td><a href="javascript:void(0);" onClick="SetValues('tbT',this.innerHTML);"><?php echo $account->talant + $account->t_b?></a></td>
<td><input id = "tbT" name = "tbT" type="text" value="0" onkeyup = "onKeyPress(this,'exM','<?php echo EXCHANGE_M?>',1);" onkeypress = "onKeyPress(this,'exM','<?php echo EXCHANGE_M?>',1);" /></td><td id = "exM"  width="150px;">0</td></tr>
<tr><td><?php echo $lang['Money'];?></td><td><a href="javascript:void(0);" onClick="SetValues('tbM',this.innerHTML);"><?php echo $account->money + $account->m_b?></a></td>
<td><input id = "tbM" name = "tbM" type="text" value="0"  onkeyup = "onKeyPress(this,'exT','<?php echo EXCHANGE_T?>',0);" onkeypress = "onKeyPress(this,'exT','<?php echo EXCHANGE_T?>',0);" /></td><td id = "exT">0</td></tr>
<tr><td colspan="4" class="center"><input type="submit" value="<?php echo $lang['Exchenge'];?>"/></td></tr>
</table>
</form>
</div>