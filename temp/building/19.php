<div class="massageList">
<div class="bMenu">
<a href="<?php echo 'attack.php';?>"><?php echo $lang['SendTroops'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,LIST_TROOP);?>" class="m_i_w"><?php echo $lang['Show'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RETURN_TROOP);?>"><?php echo $lang['Return'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,TROOP_GOLDEN_CLUB);?>"><?php echo $lang['PlusGolden'];?></a>
<a href="sim.php"><?php echo $lang['Simulator'];?></a>
<?php  if($town->IsBlockade())      printf('<a href="building.php?bid=%s&amp;tid=%s&amp;show=%s">%s</a>',$bid,$town->id,BLOCKAGE_PAGE_TROOP,$lang['Blockade']);  ?>
</div>
</div>
<?php  require_once('.//eng/main/troop.php');  require_once('.//lib/form.php');  $show = isset($_GET['show']) ? $_GET['show'] : LIST_TROOP;  $troopH = array();  function AddTroopH($kind)  {   global $troopH;   global $troops;   global $form;   global $lang;   if(isset($troopH[$kind]))    return $troopH[$kind];   $troopH[$kind] = sprintf('<tr><td><img src="img/troop/s/%1$s_1.gif" id = "tlnh%1$s_1" class="i24" /></td><td><img src="img/troop/s/%1$s_2.gif" id = "tlnh%1$s_2" class="i24" /></td><td><img src="img/troop/s/%1$s_3.gif" id = "tlnh%1$s_3" class="i24" /></td><td><img src="img/troop/s/%1$s_4.gif" id = "tlnh%1$s_4" class="i24" /></td><td><img src="img/troop/s/%1$s_5.gif" id = "tlnh%1$s_5" class="i24" /></td><td><img src="img/troop/s/%1$s_6.gif" id = "tlnh%1$s_6" class="i24" /></td><td><img src="img/troop/s/%1$s_7.gif" id = "tlnh%1$s_7" class="i24" /></td><td><img src="img/troop/s/%1$s_8.gif" id = "tlnh%1$s_8" class="i24" /></td><td><img src="img/troop/s/%1$s_9.gif" id = "tlnh%1$s_9" class="i24" /></td><td><img src="img/troop/s/%1$s_10.gif" id = "tlnh%1$s_10" class="i24" /></td><td><img src="img/troop/s/%1$s_11.gif" id = "tlnh%1$s_11" class="i24" /></td><td><img src="img/troop/s/%1$s_12.gif" id = "tlnh%1$s_12" class="i24" /></td><td><img src="img/troop/s/%1$s_13.gif" id = "tlnh%1$s_13" class="i24" /></td><td><img src="img/troop/s/%1$s_14.gif" id = "tlnh%1$s_14" class="i24" /></td><td><img src="img/troop/h.gif" id = "tlnh_h" class="i24" /></td></tr>',$kind);   for($i = 1;$i<15;$i++)    $form->AddText(sprintf('tlnh%d_%d',$kind,$i),$troops[$kind][$i][6]);   if(!isset($troopH['h']))   {    $form->AddText('tlnh_h',$lang['Hero']);    $troopH['h'] = 'h';   }   return $troopH[$kind];  }  switch ($show)  {     case TROOP_GOLDEN_CLUB:     require_once('temp/building/19_g.php');    break;   case RETURN_TROOP:    require_once('temp/building/19_b.php');    break;      case BLOCKAGE_PAGE_TROOP:          require_once('temp/building/19_bl.php');          break;   default:   case LIST_TROOP:    require_once('temp/building/19_l.php');    break;  }  ?>