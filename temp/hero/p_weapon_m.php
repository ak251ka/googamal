<div class="massageList">
<div class="htMenu">
<a href="<?php printf('hero.php?show=%s&amp;subshow=%s',P_WEAPON_M,P_W_BUY);?>"><?php echo $lang['Buy'];?></a>
<a href="<?php printf('hero.php?show=%s&amp;subshow=%s',P_WEAPON_M,P_W_SELL);?>"><?php echo $lang['Sell'];?></a>
</div>
</div>
<?php  $subshow = isset($_GET['subshow'])?$_GET['subshow']:P_W_BUY;  if($subshow == P_W_BUY)   require_once('temp/hero/p_buy_w.php');  else   require_once('temp/hero/p_sell_w.php');  ?>