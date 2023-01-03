<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid, true);  if(!$account->IsLoad())   $session->Href('index.php');    $account->UpdateTown(time());  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  $report = new Report;  $uid = 0;  if(isset($_GET['id']))   $uid = ValidNumber($_GET['id']);  if($uid == 0)   $uid = $account->uid;  define('P_DETAIL','det');  define('P_EVENT','eve');  define('P_ATTACKS','ap');  define('P_DEFINES','dp');  define('P_U_SETTING','stu');    define('LEAVE_UNION', 'lu');  define('MANAGE','mg');  define('POLICY','po');  define('INVITE','inv');  define('INVITE_CANCEL','cinv');  define('FIRE_MEM','fm');  define('EDIT_PROFILE', 'dfp');  $form->Header(array('union','editor'),array('ajax','union','editor'));  $info =  $union->GetInfo($uid);  if(!$info)  {   $form->BlockPage();   return;  }  $show = isset($_GET['show'])? $_GET['show'] : P_DETAIL;  if($account->uid == $uid)  {   $isOfficer = $union->IsOfficer($uid, $account->id);  ?>
<div class="massageList">
<div class="toolMenu">
<a href="union.php?show=<?php echo P_DETAIL;?>"><?php echo $lang['Description'];?></a>
<a href="union.php?show=<?php echo P_EVENT;?>"><?php echo $lang['Event'];?></a>
<a href="union.php?show=<?php echo P_ATTACKS;?>"><?php echo $lang['Attacks'];?></a>
<a href="union.php?show=<?php echo P_DEFINES;?>"><?php echo $lang['Defences'];?></a>
<a href="union.php?show=<?php echo P_U_SETTING;?>"><?php echo $lang['Setting'];?></a>
</div>
</div>
<?php  }  ?>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="bgm1">
<div class="u_table">
<?php  switch($show)  {   case P_U_SETTING:    require_once('temp/union/setting.php');    break;   case P_DEFINES:    require_once('temp/union/dreport.php');    break;   case P_ATTACKS:    require_once('temp/union/areport.php');    break;   case P_EVENT:    require_once('temp/union/event.php');    break;   case P_DETAIL:   default:    require_once('temp/union/detail.php');    break;  }  ?>
</div>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>