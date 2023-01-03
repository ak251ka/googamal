<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/object.php');  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  require_once('eng/main/town.php');  define('UPDATE','up');  define('DESTROY','dis');  define('TERAIN_TROOP','tt');  define('RESEARCH_TROOP','ret');  define('RESEARCH_ELIXIR','ree');  define('RESEARCH_UPGRADE','reg');  define('USE_ELIXIR','ue');  define('BUILD_ELIXIR','be');  define('ELIXIR_MARKET','em');  define('MARKET','bm');  define('HAVE_PARTY', 'h_p');  define('SHOW_INVITATION','si');  define('MAIN_EMBASSY','me');  define('NEW_UNION','nu');  define('CANCEL_SEND_TROOP', 'cst');  define('LIST_TROOP', 'lt');  define('RETURN_TROOP', 'rt');  define('TROOP_GOLDEN_CLUB','gc');  define('RETURN_TROOP_BLOCKADE', 'rtb');  define('RETURN_TROOP_SUPPORT', 'rts');  define('SIMULATOR_PAGE','sim');  define('BLOCKAGE_PAGE_TROOP','bpt');  define('ADD_GOLDEN_CLUB','agc');  define('EDIT_GOLDEN_CLUB','egc');  define('DEL_GOLDEN_CLUB', 'dgc');  define('CHANGE_GOLDEN_CLUB', 'cgc');  define('SEND_GOLDEN_CLUB','sgc');    if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');    $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  if(isset($_GET['tid']))   $account->SwitchTown($_GET['tid']);  $bid = isset($_GET['bid'])? ValidNumber($_GET['bid'],true) : 0;  $town = $account->GetDefaultTown();  $union = new Union();  $report = new Report();  if(isset($_GET['id']))  {   $_GET['id'] = ValidNumber($_GET['id'],true);   $bid = 0;   for($i = 1;$i< 27; $i++)   {    $b = "b$i";    if($town->$b == $_GET['id'])    {     $bid = $i;     break;    }   }  }  $b = "b$bid";  $u = "u$bid";  if(!$bid or $bid > 27 or !$town->$b)   $session->Href('town.php');    function MaxTrain(Object &$obj)  {   global $town;   $train = -1;   for($i = 1;$i < 6;$i++)   {    $t = "r$i";    $s = $town->$t /  $obj->$t;    if($train == -1)     $train = $s;    elseif($train > $s)     $train = $s;   }      if($train < 0)          return 0;   return (int)floor($train);  }  if(isset($_POST['com']))  {   if(!$town->Lock() and $session->Permission(BAND_TOWN))    $_POST['com'] = '0';   switch($_POST['com'])   {    case UPDATE:     $_POST['build'] = isset($_POST['build'])?ValidNumber($_POST['build'],true):0;     $_POST['lvl'] = isset($_POST['lvl'])?ValidNumber($_POST['lvl'],true):0;     if(!$_POST['build'] or !$_POST['lvl'] or $_POST['build'] > 27)      break;     $b = 'b'.$_POST['build'];     $u = 'u'.$_POST['build'];     if($town->$b < 6 and $town->$u == 10 and !$town->cap)      break;     if($town->$b and $town->$u + 1 == $_POST['lvl'])      $town->BuildBuilding($_POST['build'], $town->$b,$_POST['lvl'], $plus->HavePlus('pb'));     break;    case NEW_UNION:     if($town->$b != '24' and $town->$u >= 3 )      break;     $error = NO_ERROR;     $union->Leave($account->uid, $account->id);     $account->uid = 0;     if(empty($_POST['uname']))      $error = E_NO_NAME;     elseif(IsBlackName($_POST['uname']))      $error = E_BLACK_NAME;     elseif($union->GetID($_POST['uname']))      $error = E_NAME_IN_USE;     else     {      $lim = (($town->$u - 2) * 5) + 10;      $_POST['slogan'] = isset($_POST['slogan']) ? $_POST['slogan'] : '';      $account->uid = $union->UnionEstablished($_POST['uname'], $_POST['slogan'], $lim, $account->id, $account->name, $town->id, $account->pop);     }        break;    case SHOW_INVITATION:     if($town->$b != '24' and !$town->$u )      break;     if(!isset($_POST['kind']) and !isset($_POST['subkind']) and $_POST['kind'] == '?')      break;     $error = NO_ERROR;     $_POST['subkind'] = ValidNumber($_POST['subkind'],true);     $row = $dbo->ExectueRow(sprintf('SELECT `i`.*,`u`.`members`, `u`.`limits` FROM `%sunion_i` AS `i` LEFT JOIN `%sunion_b` AS `u` ON (`i`.`uid` = `u`.`id`) WHERE `i`.`id` = \'%u\' AND `i`.`b` = \'%s\'',      DB_PERFIX,DB_PERFIX,$_POST['subkind'], $account->id));     if(!empty($row))     {      if($_POST['kind'])      {       if($account->uid)        $union->Leave($account->uid, $account->id);       if($row['members'] <= $row['limits'])       {        if($union->Join($row['uid'], $row['id'],$account->id))         $account->uid = $row['uid'];         else         $error = true;       }       else        $error = true;      }      else       $union->Rejection($row['uid'], $row['id'], $account->id);     }     break;   }   $town->UnLock();  }    $pm = new PM($session->aid);  $form->Header(array('buildings'),array('sliderButton','building'));  ?>
<div class="mainBuildings">
<div class="buildingName"><?php printf($lang['BuildingInfo'],$lang['b'.$town->$b],$town->$u);?></div>
<div class="buildingImage"><img id="bimg" alt = "<?php echo $lang['b'.$bid];?>" src="img/tow/big/b<?php echo $town->$b;?>.gif"/></div>
<div class="buildingInfo">
	<div class="textPadding">
<?php  $info = $town->GetBuildingInfo($town->$b);  printf('<p style="width:90%%;">%s</p>', $info['description']);  if($info['mb'])   printf($lang['MultiBuild'],$lang['b'.$town->$b],$info['lvl']);  printf($lang['bMaxLevel'], $info['lvl']);  ?></div>
</div>
<div class="buindingResNeeded">
<div class="textPadding">
<?php  if($town->$u + 1 <= $info['lvl'])  {   $count = $town->CountBuild();      if($town->$b < 6 and $town->$u >=10 and !$town->cap)          printf($lang['MaxPermission'], $lang['Level']);      else      {          printf('<center>%s</center>',$lang['UpCost']);          $lvl = $town->GetBuildingLevel($town->$b, $town->$u + 1);          $form->EchoCost($lvl['r1'],$lvl['r2'],$lvl['r3'],$lvl['r4'],$lvl['r5'],SecToString($town->BuildSpeed($town->$b,$lvl['times'])),$lvl['pop']);          echo '<br />';       if($count and !$plus->HavePlus('pb'))        printf($lang['MaxPermission'], $lang['Build']);       elseif($count == 2)     printf($lang['MaxPermission'], $lang['Build']);       elseif(!$town->$u)        echo $lang['BuildBuilding'];       elseif($town->Frozen())        echo $lang['FrozenTown'];       elseif($town->IsBuild($bid))     echo $lang['BuildBuilding'];          elseif(!$session->Permission(BAND_TOWN))              echo $lang['NoPermission'];       else          {        if(!$town->CanBuild($lvl['pop']) and ($town->$b != 5))         echo $lang['NotEnoughGold'];        elseif($town->l1 < $lvl['r1'] or $town->l1 < $lvl['r2'] or $town->l1 < $lvl['r3'] or $town->l1 < $lvl['r4'])         printf('<center>'.$lang['NotEnough'].'</center>',$lang['b7']);        elseif($town->l1 < $lvl['r5'])         printf('<center>'.$lang['NotEnough'].'</center>',$lang['b8']);        elseif(!$town->HaveEnough($lvl['r1'],$lvl['r2'],$lvl['r3'],$lvl['r4'],$lvl['r5']))         printf('<center>'.$lang['NotEnough'].'</center>',$lang['Resource']);        else         printf('<form action="building.php?tid=%s&amp;bid=%d" method="post"><input name="com" type="hidden" value="%s" /><input name="build" type="hidden" value="%d"  /><input id="ulvl" name ="lvl" type="hidden" value="?"   /><center><input type="submit" value="%s" onclick="SetValues(\'ulvl\',\'%d\');" /></center></form>',             $town->id, $bid, UPDATE, $bid, $lang['Build'], $town->$u + 1);       }      }  }  else   printf('<center>%s</center>', $lang['MaxLevel']);  ?>
</div>
</div>
<div style="clear:both"></div>
<div class="buildingJobTop"></div>
<div class="buildingJob">

	<div class="textPadding">
    <?php      if($session->Permission(BAND_TOWN))       require_once('temp/building/'.$town->$b.'.php');      else          $form->BlockPage();   ?>
    </div>

</div>
<div class="buildingJobBelow"></div>
</div>
<?php  $form->Footer();  $session->Save();  ?>