<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//lib/defines.php');  if($town->$u == 0)  {   echo $lang['BuildBuilding'].'</div>';   return;  }  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%selixir_i`',DB_PERFIX));  $list = array();  $one = 1;  while($row = $dbo->Read($sql))  {   $list[$row['id']] = new Object($row);   $footer = sprintf('<img id = "r1" src="img/res/r1.gif" alt="%s" class="i24" />%s<img id = "r2" src="img/res/r2.gif" alt="%s" class="i24" />%s<img id = "r3" src="img/res/r3.gif" alt="%s" class="i24" />%s<img id = "r4" src="img/res/r4.gif" alt="%s" class="i24" />%s<img id = "r5" src="img/res/r5.gif" alt="%s" class="i24" />%s<img id = "rt" src="img/res/t.gif" alt="%s" class="i24" />%s',    $lang['r1'],$row['r1'],$lang['r2'],$row['r2'],$lang['r3'],$row['r3'],$lang['r4'],$row['r4'],$lang['r5'],$row['r5'],$lang['TimeProcess'],    SecToString($row['times']));   $form->AddModal('mo'.$row['id'],$row['name'],sprintf('<img src="img/eli/%d.gif" alt="%s"/>%s',    $row['id'],$row['name'],$row['desc']),$footer);  }  $dbo->Cancel($sql);  gc_collect_cycles();  $show = isset($_GET['show'])?$_GET['show']:BUILD_ELIXIR;  ?>
<div class="massageList">
<div class="bMenu">
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,BUILD_ELIXIR);?>" class="m_i_w"><?php echo $lang['Build'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,USE_ELIXIR);?>"><?php echo $lang['Using'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,MARKET);?>"><?php echo $lang['Send'];?></a>
</div>
</div>
<?php  switch($show)  {   case USE_ELIXIR:    require_once('temp/building/21_u.php');    break;   default:   case BUILD_ELIXIR:    require_once('temp/building/21_b.php');    break;   case MARKET:    require_once('temp/building/21_m.php');    break;  }  ?>
</div>