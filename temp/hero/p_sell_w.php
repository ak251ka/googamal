<div style="margin-right:10px;margin-top:10px;">
<?php  require_once('.//lib/form.php');  require_once('.//eng/main/hero.php');  require_once('.//lib/utility.php');  ?>
<div style="float:right;">
<div class="a_back mRight50"><a href="javascript:void(0);" onclick="ShowHide('ahi');"><?php echo $lang['AvailableItem'];?></a></div>
<div id = "ahi">
<div class="h_b_t_i">
<form  id = "f_<?php echo P_W_SELL;?>" method="get" action="hero.php">
<input type="hidden" name = "com" value= "f_<?php echo P_W_SELL;?>"/>
<input type="hidden" name = "fil" id = "fil_0" value="?" />
<?php  foreach ($_GET as $key => $value)  {   if($key != 'fil' and $key != 'com')    printf('<input type="hidden" value="%s" name="%s" />',$value, $key);  }  printf('<img alt="%s" src="img/all/a3.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_0\',\'0\');"/>',    $lang['All'],P_W_SELL);  for($i = 1; $i < 11; $i++)   printf('<img alt="%s" src="img/her/itm/%d_1_%d.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_0\',\'%d\');"/>',    $lang['H_Weapon'.$i],$i, $i > 4 ? 0 : 1,P_W_SELL,$i);  ?>
</form>
</div>

<form id = "<?php echo P_W_SELL;?>" action="<?php printf('hero.php?show=%s&amp;subshow=%s',P_WEAPON_M,P_W_SELL); ?>" method="post">
<input type="hidden" name="com" value="<?php echo P_WEAPON_M;?>" />
<input type="hidden" name="kind" value="<?php echo P_W_SELL;?>" />
<input type="hidden" name="subkind" id = "sub1" value="?" />
<table class="h_table" style="margin-top:5px; margin-right:50px;width:300px;">
<?php  if($hero->CountMarket(MARKET_SELL) < MAX_SELL_WEAPON)  {   $filter  = 0;   if(isset($_GET['fil']) and isset($_GET['com']) and $_GET['com'] == 'f_'.P_W_SELL and is_numeric($_GET['fil']))    $filter =  $_GET['fil'];   $temp = 0;   $Items = $hero->GetItems();   foreach($Items as &$l)   {    if($filter)    {     if($l->box > 10 and $l->t1 == $filter)     {     printf('<tr><td>%s</td><td>%s</td><td><img alt="%s" src="img/mk/sell_s.gif" onClick="SubmitForm(\'%s\',\'%s\',\'%s\');" class="i30s"/></td></tr>',      $form->HeroItem($l,$power),$l->name,$lang['Sell'],P_W_SELL,'sub1',$l->id);     $temp++;     }    }    elseif($l->box > 10)    {     printf('<tr><td>%s</td><td>%s</td><td><img alt="%s" src="img/mk/sell_s.gif" onClick="SubmitForm(\'%s\',\'%s\',\'%s\');" class="i30s"/></td></tr>',$form->HeroItem($l,$power),$l->name,$lang['Sell'],P_W_SELL,'sub1',$l->id);     $temp++;    }  }   if(!$temp)    printf('<tr><td  style="width:300px;">%s</td></tr>',$lang['NoRecord']);  }  else   printf('<tr><td  style="width:300px;">%s</td></tr>',sprintf($lang['MaxPermission'], $lang['Sell']));  ?>
</table>
</form>
</div>
</div>
<div style="float:left;">

<div class="a_back mLeft50"><a href="javascript:void(0);" onclick="ShowHide('selllist');"><?php echo $lang['Sell'];?></a></div>
<div id = "selllist">
<div class="h_b_t_i2">
<form  id = "f_<?php echo P_W_C_SELL;?>" method="get" action="hero.php">
<input type="hidden" name = "com" value= "f_<?php echo P_W_C_SELL;?>"/>
<input type="hidden" name = "fil" id = "fil_1" value="?" />
<?php  foreach ($_GET as $key => $value)  {   if($key != 'fil' and $key != 'com')    printf('<input type="hidden" value="%s" name="%s" />',$value, $key);  }  printf('<img alt="%s" src="img/all/a3.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_1\',\'0\');"/>',    $lang['All'],P_W_C_SELL);  for($i = 1; $i < 11; $i++)   printf('<img alt="%s" src="img/her/itm/%d_1_%d.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_1\',\'%d\');"/>',    $lang['H_Weapon'.$i],$i, $i > 4 ? 0 : 1,P_W_C_SELL,$i);  ?>
</form>
</div>
<?php  $filter = false;  if(isset($_GET['fil']) and isset($_GET['com']) and $_GET['com'] == 'f_'.P_W_C_SELL and is_numeric($_GET['fil']))   $filter =  $_GET['fil'];  $list = $hero->GetMarketList(MARKET_SELL, $filter);  ?>
<form id = "<?php echo P_W_C_SELL;?>" action="<?php printf('hero.php?show=%s&amp;subshow=%s',P_WEAPON_M, P_W_SELL); ?>" method="post">
<input type="hidden" name="com" value="<?php echo P_WEAPON_M;?>" />
<input type="hidden" name="kind" value="<?php echo P_W_C_SELL;?>" />
<input type="hidden" name="subkind" id = "sub2" value="?" />
<table class="h_table" style="margin-top:5px;">
<tr><td><?php echo $lang['H_Weapon'];?></td><td><img src="img/mk/ise.gif" alt="<?php echo $lang['InSell'];?>" class="i30" /></td>
<td><img src="img/mk/minb.gif" alt="<?php echo $lang['MinBuy'];?>" class="i30" /></td>
<td><img src="img/mk/sell_s.gif" alt="<?php echo $lang['Price'];?>" class="i30" /></td>
<td><img src="img/mk/maxb.gif" alt="<?php echo $lang['MaxBuy'];?>" class="i30" /></td>
<td style="width:70px;"><?php echo $lang['InDate'];?></td>
<td><?php echo $lang['Action'];?></td></tr>
<?php  if(count($list))  {     foreach ($list as &$s)   {    printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',     $form->HeroItem($s,$power),$s->ise, $s->m1,$s->nb,$s->m2, $form->Addtimer($s->modify,sprintf('hero.php?show=%s&subshow=%s',P_WEAPON_M, P_W_SELL)),     $s->ise ? sprintf('<img id = "cncs" src="img/all/f2.gif" alt="%s" class="i30"/>',$lang['Cancel']):         sprintf('<img src="img/all/e2.gif" alt="%s" onClick="SubmitForm(\'%s\',\'%s\',\'%s\');" class="i30s"/>',         $lang['Cancel'],P_W_C_SELL, 'sub2', $s->id));   }   $form->AddText('cncs', $lang['CanNotCancel']);  }  else   printf('<tr><td colspan="7" class = "center">%s</td></tr>',$lang['NoRecord']);  ?>

</table>
</form>
</div>
</div>
<div style="clear:both"></div>
<br />
<div style="float:right;">
<div class="a_back mRight50"><a href="javascript:void(0);" onclick="ShowHide('soldlist');"><?php echo $lang['Sold'];?></a></div>
<div id = "soldlist">
<div class="h_b_t_i">
<form  id = "f_<?php echo P_W_D_SOLD;?>" method="get" action="hero.php">
<input type="hidden" name = "com" value= "f_<?php echo P_W_D_SOLD;?>"/>
<input type="hidden" name = "fil" id = "fil_2" value="?" />
<?php  foreach ($_GET as $key => $value)  {   if($key != 'fil' and $key != 'com')    printf('<input type="hidden" value="%s" name="%s" />',$value, $key);  }  printf('<img alt="%s" src="img/all/a3.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_2\',\'0\');"/>',    $lang['All'],P_W_D_SOLD);  for($i = 1; $i < 11; $i++)   printf('<img alt="%s" src="img/her/itm/%d_1_%d.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_2\',\'%d\');"/>',    $lang['H_Weapon'.$i],$i, $i > 4 ? 0 : 1,P_W_D_SOLD,$i);  ?>
</form>
</div>

<table class="h_table" style="margin-top:5px; margin-right:50px;">
<tr><td><?php echo $lang['H_Weapon'];?></td><td><img src="img/mk/ise.gif" alt="<?php echo $lang['InSell'];?>" class="i30" /></td>
<td><img src="img/mk/minb.gif" alt="<?php echo $lang['MinBuy'];?>" class="i30" /></td>
<td><img src="img/mk/sell_s.gif" alt="<?php echo $lang['Price'];?>" class="i30" /></td>
<td><img src="img/mk/maxb.gif" alt="<?php echo $lang['MaxBuy'];?>" class="i30" /></td>
<td style="width:70px;"><?php echo $lang['InDate'];?></td>
<td><?php echo $lang['Delete'];?></td></tr>
<?php  $filter = false;  if(isset($_GET['fil']) and isset($_GET['com']) and $_GET['com'] == 'f_'.P_W_D_SOLD and is_numeric($_GET['fil']))   $filter =  $_GET['fil'];  $count = $hero->CountMarket(MARKET_SOLD,$filter);  $page = isset($_GET['page'])?(int)$_GET['page'] :0;  $row = isset($_GET['row'])?(int)$_GET['row']: 30;  if($row > 50 or $row < 0)  $row = 50;  if($count < $page * $row)   $page = 0;  $list = $hero->GetMarketList(MARKET_SOLD, $filter, $page,$row);  if(count($list))  {   $i =0;   foreach ($list as &$s)   {    printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><input type="checkbox" value="%u" name="cb%d" /></td></tr>',     $form->HeroItem($s,$power),$s->ise, $s->m1, $s->nb, $s->m2,DateToString($s->modify),$s->id,$i++);   }  }  else   printf('<tr><td colspan="7" class = "center">%s</td></tr>',$lang['NoRecord']);  $filter = sprintf('hero.php?',P_WEAPON_M, P_W_SELL);  $list = array();  foreach ($_GET as $key => $value)  {   if($key != 'page' and $key != 'row')   {    $filter .= sprintf('%s=%s&amp;',$key,$value);    $list[$key] = $value;     }  }  ?>
<tr><td colspan="6" class = "center"><input type="submit" value="<?php echo $lang['Delete'];?>" /></td><td><input type="checkbox" id = "all" onchange="SetAll('<?php echo P_W_D_SOLD;?>','all');" /></td></tr>
<tr><td colspan="7"><?php echo Paging($count,$filter,$row,$page);?></td></tr>
</table>
</form>
<?php  unset($list['show']);  if($plus->HavePlus('pb'))    echo $form->AddPagingForm('hero',P_WEAPON_M,$page,$row,$list);  ?>
</div>
</div>

<div style="float:left;">

<div class="a_back mLeft50"><a href="javascript:void(0);" onclick="ShowHide('buylist');"><?php echo $lang['Buy'];?></a></div>
<div id = "buylist">
<div class="h_b_t_i2">
<form  id = "f_<?php echo P_W_BOUGTH;?>" method="get" action="hero.php">
<input type="hidden" name = "com" value= "f_<?php echo P_W_BOUGTH;?>"/>
<input type="hidden" name = "fil" id = "fil_3" value="?" />
<?php  foreach ($_GET as $key => $value)  {   if($key != 'fil' and $key != 'com')    printf('<input type="hidden" value="%s" name="%s" />',$value, $key);  }  printf('<img alt="%s" src="img/all/a3.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_3\',\'0\');"/>',    $lang['All'],P_W_BOUGTH);  for($i = 1; $i < 11; $i++)   printf('<img alt="%s" src="img/her/itm/%d_1_%d.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_3\',\'%d\');"/>',    $lang['H_Weapon'.$i],$i, $i > 4 ? 0 : 1,P_W_BOUGTH,$i);  ?>
</form>
</div>
<?php  $filter = false;  if(isset($_GET['fil']) and isset($_GET['com']) and $_GET['com'] == 'f_'.P_W_BOUGTH and is_numeric($_GET['fil']))   $filter =  $_GET['fil'];  $list = $hero->GetMarketList(MARKET_BOUGHT, $filter);  ?>

<table class="h_table" style="margin-top:5px;width:300px;">
<tr><td><?php echo $lang['H_Weapon'];?></td><td><img src="img/mk/ise.gif" alt="<?php echo $lang['InSell'];?>" class="i30" /></td>
<td><img src="img/mk/minb.gif" alt="<?php echo $lang['MinBuy'];?>" class="i30" /></td>
<td><img src="img/mk/sell_s.gif" alt="<?php echo $lang['Price'];?>" class="i30" /></td>
<td><img src="img/mk/maxb.gif" alt="<?php echo $lang['MaxBuy'];?>" class="i30" /></td>
<td style="width:70px;"><?php echo $lang['InDate'];?></td></tr>
<?php  if(count($list))  {      $i =0;        foreach ($list as &$s)      {          printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',              $form->HeroItem($s,$power),$s->ise, $s->m1, $s->nb, $s->m2,DateToString($s->modify));      }  }  else      printf('<tr><td colspan="7" class = "center">%s</td></tr>',$lang['NoRecord']);  ?>
<tr><td></td></tr>
</table>

</div>
</div>
<div style="clear:both"></div>
</div>
