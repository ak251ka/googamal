<?php  require_once('lib/dbo.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  $off = $dbo->ExectueScaler(      sprintf('SELECT `subkind` FROM `%sserver_info` WHERE `com` = \'%s\' AND `kind` >= \'%s\'',          DB_PERFIX, TALANT_OFF, $_SERVER['REQUEST_TIME']),'subkind');  $off /= 100;  $prices = array();  $i= 1;  $last = 100;  foreach(array(1,2,5,10,20,50) as $t)  {      $price = $t * 10000;      $prices[$i]['id'] = $i;      $prices[$i]['talant'] = (int)round(($price / $last)/10);      $prices[$i]['price'] = ($t*10000) * (1 - $off);      $last -= 5;      $i++;    }  if(isset($_POST['bp']) and ValidNumber($_POST['bp']) and(isset($prices[$_POST['bp']])))  {      require_once('bill.php');      return;  }  ?>
<div class="p_main">
<?php echo $lang['BuyTalant'];?>
<form action="plus.php?show=<?php echo P_BUY_TALANT;?>" method="post">
<input name = "bp" id = "bp" type="hidden" value="?" />
<div>
<table class="p_table center buyTalant">
<tr>
    <td><img src= "img/plus/t.gif" alt = "<?php echo $lang['Talant'];?>" class="i24"/></td>
	<td><?php echo $lang['Price'].' '.$lang['Currency'];?></td>
	<td><?php echo $lang['Discount'];?></td>
	<td><?php echo $lang['Buy'];?></td>
</tr>
<?php      for($i= 1;$i<=count($prices);$i++)  {      printf('<tr><td>%d</td><td>%s</td><td>%d %%</td><td><input type="submit" onclick="SetValues(\'bp\',\'%d\');" value="%s"/></td></tr>',          $prices[$i]['talant'], number_format($prices[$i]['price']), $off * 100, $prices[$i]['id'], $lang['Buy']);  }      ?>
</table>
</form>
</div>
</div>