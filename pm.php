<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('eng/main/union.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('.//eng/sec/user.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');     $account->UpdateTown(time());  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);    define('WRITE','nw');  define('READ','rd');  define('INBOX','in');  define('OUTBOX','out');  define('ARC_IN','ain');  define('ARC_OUT','aout');  $error = UNKNOWN;  $show = isset($_GET['show']) ? $_GET['show']: INBOX;  if($session->Permission(SEND_PM))  {      if(!empty($_POST) and $_GET['show'] == WRITE)      {            if(isset($_POST['com']) and $_POST['com'] == 'sv')          {              if(isset($_POST['sub']))                  $subject = $_POST['sub'];              if(empty($subject))                  $subject = $lang['NewPm'];              $id = 0;              if(isset($_POST['to']))                  $id = $user->Find($_POST['to']);              if($id)              {                  $pm->NewRow();                  $pm->se = $account->id;                  $pm->re = $id;                  if($account->id < 7)                      $pm->flag = SYS_INFO | NOT_READ;                  else                      $pm->flag = NOT_READ;                  $pm->subject = $subject;                  if(isset($_POST['msg']))                      $pm->message = empty($_POST['msg'])?NULL :$_POST['msg'];                  else                      $pm->message = NULL;                  $pm->NewPm();                  $session->Href('pm.php?show='.OUTBOX);              }              else                  $error = E_USER_NOT_FIND;          }      }  }    $form->Header(array('pm','editor'),array('editor'));  $session->FreeMemory();  ?>
<div class="toolMenu">
<a href="pm.php?show=<?php echo WRITE;?>"><?php echo $lang['Write'];?></a>
<a href="pm.php?show=<?php echo INBOX;?>"><?php echo $lang['Inbox'];?></a>
<a href="pm.php?show=<?php echo OUTBOX;?>"><?php echo $lang['Outbox'];?></a>
<a href="pm.php?show=<?php echo ARC_IN;?>"><?php echo $lang['َArcInbox'];?></a>
<a href="pm.php?show=<?php echo ARC_OUT;?>"><?php echo $lang['َArcoutbox'];?></a>
</div>
<div class="pmTop">
<img src="img/pm/top.gif"  />
</div>
<div class="pm_main">
<?php  switch($show)  {   case WRITE:    require_once('temp/conn/npm.php');    break;   case READ:    require_once('temp/conn/rd.php');    break;   case OUTBOX:    require_once('temp/conn/out.php');    break;   case ARC_IN:    require_once('temp/conn/arin.php');    break;   case ARC_OUT:    require_once('temp/conn/arout.php');    break;   case INBOX:   default:    require_once('temp/conn/in.php');    break;  }  ?>
</div>
<div class="pmBut">
<img src="img/pm/but.gif"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>
