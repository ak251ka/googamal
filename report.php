<?php  require_once('eng/sec/session.php');  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/town.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');  $plus = $account->GetPlus();  $hero = $account->GetHero();  if(isset($_GET['id']))  {   $_GET['show'] = 'show';  }  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  define('LST','l');  define('ARC','a');  define('SHOW','show');  $form->Header(array('pm','report'),array('editor'));  $show = isset($_GET['show']) ? $_GET['show']: LST;  $report = new Report;  ?>
<div class="pmTop">
<img src="img/pm/top.gif"  />
</div>
<div class="pm_main">
<?php  switch($show)  {   case LST:    require_once('temp/report/lst.php');    break;   case ARC:    require_once('temp/report/arc.php');    break;   case SHOW:    require_once('temp/report/rd.php');  }  ?>
</div>
<div class="pmBut">
<img src="img/pm/but.gif"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>