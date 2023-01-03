<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/forum/topic.php');  require_once('eng/main/account.php');  require_once('eng/conn/pm.php');  require_once('eng/main/union.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  $plus = $account->GetPlus();  define('TOPIC', 'tp');  define('POST', 'po');  define('NEW_TOPIC','nw');  define('EDIT', 'ed');    define('E_POST', 'edp');  define('N_POST', 'np');    $show = isset($_GET['show']) ? $_GET['show']: TOPIC;  $form->Header(array('forum','editor'), array('ajax','topic','editor'));  $session->FreeMemory();  ?>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="forumL">
<?php  switch($show)  {   case NEW_TOPIC:    require_once('temp/forum/nw.php');    break;   case EDIT:    require_once('temp/forum/ed.php');    break;   case POST:    require_once('temp/forum/po.php');    break;   case N_POST:    require_once('temp/forum/np.php');    break;   case E_POST:    require_once('temp/forum/edp.php');    break;   case TOPIC:   default:    require_once('temp/forum/tp.php');    break;     }  ?>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>