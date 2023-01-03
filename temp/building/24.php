<div class="b_troop">
<?php  if($town->$u == 0)  {   echo $lang['BuildBuilding'].'</div>';   return;  }  ?>
<div class="massageList">
<div class="bMenu">
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,MAIN_EMBASSY);?>" class="m_i_w"><?php echo $lang['b24'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,SHOW_INVITATION);?>" class="m_i_w"><?php echo $lang['Invitation'];?></a>
</div>
</div>
<?php  $show = isset($_GET['show']) ? $_GET['show'] : MAIN_EMBASSY;  switch($show)  {   case SHOW_INVITATION:   require_once('temp/building/24_i.php');   break;   default:   case MAIN_EMBASSY:   require_once('temp/building/24_m.php');   break;  }  ?>
</div>