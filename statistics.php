<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/object.php');  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/mission.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  if($account->training == 21)      $mission->SetMission();  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $town = $account->GetDefaultTown();  $plus = $account->GetPlus();  $hero = $account->GetHero();  $pm = new PM($session->aid);  $union = new Union();  $form->Header(array('statistics'),array());  define('SHOW_TEN','st');  define('SHOW_UNION','su');  define('SHOW_PLAYER','sp');  $_GET['show'] = isset($_GET['show']) ? $_GET['show'] : SHOW_PLAYER;  ?>
<div class="massageList">
<div class="toolMenu">
<a href="statistics.php?show=<?php echo SHOW_PLAYER;?>" class="m_i_w"><?php echo $lang['Player'];?></a>
<a href="statistics.php?show=<?php echo SHOW_UNION;?>" class="m_i_w"><?php echo $lang['Union'];?></a>
<a href="statistics.php?show=<?php echo SHOW_TEN;?>" class="m_i_w"><?php echo $lang['TopTen'];?></a>
</div>
</div>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="bgm1">
<?php  if($_GET['show'] == SHOW_PLAYER)   require_once('temp/statistics/pl.php');  elseif($_GET['show'] == SHOW_UNION)   require_once('temp/statistics/un.php');  else   require_once('temp/statistics/tt.php');  ?>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>