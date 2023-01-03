<div class="massageList">
<div class="htMenu">
<a href="<?php printf('hero.php?show=%s&amp;subshow=%s',P_INVI_TREASURE,P_IN_TREASURE);?>"><?php echo $lang['Invitation'];?></a>
<a href="<?php printf('hero.php?show=%s&amp;subshow=%s',P_INVI_TREASURE,P_OUT_TREASURE);?>"><?php echo $lang['Accept'];?></a>
</div>
</div>
<?php  $subshow = isset($_GET['subshow'])?$_GET['subshow']:P_IN_TREASURE;  if($subshow == P_IN_TREASURE)   require_once('temp/hero/p_in_treasure.php');  else   require_once('temp/hero/p_out_treasure.php');  ?>