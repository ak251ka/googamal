<div class="b_troop">
<?php  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  require_once('.//lib/defines.php');  define('RESOURCE_MARKET_SEND','rms');  define('RESOURCE_MARKET_BUY','rmb');  define('RESOURCE_MARKET_PROPOSAL','rmp');  define('RESOURCE_MARKET_PROPOSAL_CANCEL','rmpc');  define('CHANGE_RESOURCE_MARKET','crm');  if($town->$u == 0)  {   echo $lang['BuildBuilding'].'</div>';   return;  }  gc_collect_cycles();  $show = isset($_GET['show'])?$_GET['show']:RESOURCE_MARKET_SEND;  ?>
<div class="massageList">
<div class="bMenu">
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RESOURCE_MARKET_SEND);?>" class="m_i_w"><?php echo $lang['Send'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RESOURCE_MARKET_BUY);?>" class="m_i_w"><?php echo $lang['Buy'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,RESOURCE_MARKET_PROPOSAL);?>" class="m_i_w"><?php echo $lang['Proposal'];?></a>
<a href="<?php printf('building.php?bid=%s&amp;tid=%s&amp;show=%s',$bid,$town->id,CHANGE_RESOURCE_MARKET);?>" class="m_i_w"><?php echo $lang['Exchenge'];?></a>
</div>
</div>
<?php  switch($show)  {   default:   case RESOURCE_MARKET_SEND:    require_once('temp/building/9_s.php');    break;   case RESOURCE_MARKET_BUY:    require_once('temp/building/9_b.php');    break;   case RESOURCE_MARKET_PROPOSAL:    require_once('temp/building/9_p.php');    break;      case CHANGE_RESOURCE_MARKET:          require_once('temp/building/9_c.php');          break;  }  ?>
</div>