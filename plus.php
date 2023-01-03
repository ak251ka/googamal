<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/utility.php');  require_once('eng/conn/pm.php');  require_once('eng/main/union.php');  require_once('eng/main/mission.php');  define('P_BUY_PLUS','buy');  define('P_EXCHANGE_PLUS','exchenge');  define('P_BUY_TALANT','talant');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');      $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = &$account->GetPlus();  $hero = &$account->GetHero();    $town = &$account->GetDefaultTown();  if($account->training == 8)      $mission->SetMission();    $pm = new PM($session->aid);    $show = isset($_GET['show'])?$_GET['show']: P_BUY_PLUS;  $form->Header(array('plus'),array('plus'));  ?>

<div class="massageList">
<div class="toolMenu">
<a href="plus.php?show=<?php echo P_BUY_PLUS;?>" class="m_i_w"><?php echo $lang['Plus'];?></a>
<a href="plus.php?show=<?php echo P_EXCHANGE_PLUS;?>" class="m_i_w"><?php echo $lang['Money'];?></a>
<a href="plus.php?show=<?php echo P_BUY_TALANT; ?>" class="m_i_w"><?php echo $lang['Buy'];?></a>
</div>
</div>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="bgm1">
<?php  if($session->Permission(BAND_TOWN | USED_PLUS))  {      switch($show)      {          case P_EXCHANGE_PLUS:              require_once('temp/plus/ex.php');              break;          case P_BUY_TALANT:              require_once('temp/plus/talant.php');              break;          case P_BUY_PLUS:          default:              require_once('temp/plus/buy.php');              break;      }  }  else      $form->BlockPage();  ?>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>