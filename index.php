<?php  require_once('lib/dbo.php');  require_once('lng/per.php');  require_once('eng/sec/session.php');  require_once('eng/sec/user.php');  require_once('lib/defines.php');  require_once('lib/object.php');  if($session->GetType() == LOG)   $session->Close(LOG);  $CanLog = true;  $nERROR = NO_ERROR;  $logStart = $dbo->ExectueScaler(sprintf('SELECT `kind` FROM `%sserver_info` WHERE `com` = \'%s\' AND `kind` >= \'%s\'',   DB_PERFIX, LOG_IN_START, $_SERVER['REQUEST_TIME']),'kind');  $repiar = $dbo->ExectueScaler(sprintf('SELECT `kind` FROM `%sserver_info` WHERE `com` = \'%s\' AND `kind` >= \'%s\'',   DB_PERFIX,REPAIR_SERVER,$_SERVER['REQUEST_TIME']),'kind');  if($session->GetType() != LOG_IN)   $session->NewSession(LOG_IN);  if((int)$session->tried > LOG_TRY)  {   $CanLog = false;   $nERROR = E_MAXTRY;  }  if((int)$session->tried > 2 and !$nERROR)  {   if(!$session->CheckCaptcha())    $nERROR = E_CAPTCHA;   else    $session->ClearCaptcha();  }  if(!$nERROR and isset($_POST['tbName']) and isset($_POST['tbPassword']))  {   $user->Load($_POST['tbName'],$_POST['tbPassword']);   $nERROR = $user->GetError();   if($nERROR == NO_ERROR)   {    $session->Close();    $session->NewRow();    $session->aid = $user->aid;    $session->pid = $user->pid;    $session->NewSession(LOG);    $session->Save();    header('Location: town.php');    die();   }  }  printf('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');  ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="<?php echo $lang['Googamal'];?>">
<meta name="keywords" content="<?php echo $lang['MetaK'];?>">
<meta name="Description" content="<?php echo $lang['MetaD'];?>">
<meta name="generator" content="<?php echo $lang['Googamal'];?>">
<meta name="publisher" content="<?php echo $lang['Googamal'];?>">
<meta name="designer" content="<?php echo $lang['Googamal'];?>">
<meta name="robots" content="INDEX, NOFOLLOW">
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jav/main.js"></script>

</head>
<body onload="main();">
	<div class="mainCon">
		<div class="left">
			<?php require_once('temp/ind/left.php'); ?>
		</div>
	
		<div class="middle">
		<div class="log_top">
       
		</div>
		<div class="log_mid">
<?php  if($logStart)   printf($lang['SERVER_NOT_START'], DateToString($logStart), Until($logStart,'start'));  elseif($repiar)   printf($lang['SERVER_REPAIR'], DateToString($repiar), Until($repiar,'start'));  else   require_once('temp/reg/log_mid.php');  ?>
</div>
<div class="log_but" style="margin-top:-15px">
<div style="width:445px;margin-right:45px;background-color:#D6EBEB; width:430px;opacity:0.7; filter:alpha(opacity=70);"><?php echo $lang['IranLow'];?></div>
</div>		
</div>
<div class="right"><?php require_once('temp/ind/rigth.php'); ?></div>
</div>
<div style="clear:both"></div>
<div style="margin:auto;background-color:#D6EBEB; width:400px;opacity:0.7; filter:alpha(opacity=70);"><center style="direction: rtl;"><img src = "img/esra.jpg" alt = "esra" align="center" /><?php echo $lang['Company'];?></center></div>
<script language="javascript" type="text/javascript">
var timer = Array();
</script>
</body>
</html>
<?php  $session->Save();  ?>