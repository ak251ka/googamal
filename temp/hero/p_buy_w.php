<div style="margin-right:10px;margin-top:10px;">
<div class="h_b_t_i">
<form  id = "f_<?php echo P_W_BUY;?>" method="get" action="hero.php">
<input type="hidden" name = "com" value= "f_<?php echo P_W_BUY;?>"/>
<input type="hidden" name = "fil" id = "fil_0" value="?" />
<?php  foreach ($_GET as $key => $value)  {   if($key != 'fil' and $key != 'com')    printf('<input type="hidden" value="%s" name="%s" />',$value, $key);  }  printf('<img alt="%s" src="img/all/a3.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_0\',\'0\');"/>',    $lang['All'],P_W_BUY);  for($i = 1; $i < 11; $i++)   printf('<img alt="%s" src="img/her/itm/%d_1_%d.gif" class = "i24s" onclick="SubmitForm(\'f_%s\',\'fil_0\',\'%d\');"/>',    $lang['H_Weapon'.$i],$i, $i > 4 ? 0 : 1,P_W_BUY,$i);  ?>
</form>
</div>
<div>
<table class="h_table mRight50" style="margin-top:2px;width:660px;">
<tr><td><?php echo $lang['H_Weapon'];?></td><td><img src="img/mk/ise.gif" alt="<?php echo $lang['InSell'];?>" class="i30" /></td>
<td><img src="img/mk/minb.gif" alt="<?php echo $lang['MinBuy'];?>" class="i30" /></td>
<td><img src="img/mk/sell_s.gif" alt="<?php echo $lang['Price'];?>" class="i30" /></td>
<td><img src="img/mk/maxb.gif" alt="<?php echo $lang['MaxBuy'];?>" class="i30" /></td>
<td width="80px"><?php echo $lang['InDate'];?></td>
<td><?php echo $lang['Action'];?></td></tr>
<?php  $filter = false;  if(isset($_GET['fil']) and isset($_GET['com']) and $_GET['com'] == 'f_'.P_W_BUY and is_numeric($_GET['fil']))   $filter =  $_GET['fil'];  $count = $hero->CountMarket(MARKET_BUY,$filter);  $page = isset($_GET['page'])?(int)$_GET['page'] :0;  $row = isset($_GET['row'])?(int)$_GET['row']: 30;  if($row > 50 or $row < 0)   $row = 50;  if($count < $page * $row)   $page = 0;  $list = $hero->GetMarketList(MARKET_BUY, $filter);  if(count($list))  {     foreach ($list as &$s)   {    printf('<tr id = "tr_%s"><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><input type="button" value="%s" onclick="Market.ShowHide(this,\'%s\');" /></td></tr>',     $s->id,$form->HeroItem($s,$power),$s->ise, $s->m1,$s->nb,$s->m2, $form->Addtimer($s->modify,     sprintf('hero.php?show=%s&subshow=%s',P_WEAPON_M, P_W_BUY)),$lang['Buy'],$s->id);   }  }  else   printf('<tr><td colspan="7" class = "center">%s</td></tr>',$lang['NoRecord']);  $filter = sprintf('hero.php?',P_WEAPON_M, P_W_SELL);  $list = array();  foreach ($_GET as $key => $value)  {   if($key != 'page' and $key != 'row')   {    $filter .= sprintf('%s=%s&amp;',$key,$value);    $list[$key] = $value;     }  }  ?>
<tr><td colspan="7" class = "rightAlign" style="padding-right:10px;"><?php echo Paging($count,$filter,$row,$page);?></td></tr>
</table>
<?php  unset($list['show']);  if($plus->HavePlus('pb'))    echo $form->AddPagingForm('hero',P_WEAPON_M,$page,$row,$list);  ?>
</div>
<table id ="bform" class="h_table" style="margin-top:10px;width:660px;display:none;">
<tr><td colspan="2" class="center"><span class="error" id ="bError">&nbsp;</span></td>
<td rowspan="4"><img id = "btBuy" class = "i30s" src="img/plus/h.gif" alt="<?php echo $lang['Buy'];?>" />
<td rowspan="4"><img id = "btClose" class = "i30s" src="img/all/f2.gif" alt="<?php echo $lang['Cancel'];?>" /></tr>
<tr><td><?php echo $lang['Name'];?></td><td id="lbname"></td></tr>
<tr><td><?php echo $lang['MaxBuy'];?></td><td id ="maxBuy"></td></tr>
<tr><td><?php echo $lang['Price'];?></td><td><input type="text" id="bprice" value="0"/></td></tr>
</table>
</div>


<script language="javascript" type="text/javascript">Market.Setup('bform');</script>