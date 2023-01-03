<?php  require_once('.//lib/config.php');  require_once('.//lib/dbo.php');  require_once('.//lib/utility.php');  require_once('.//lng/per.php');  require_once('.//lib/defines.php');  require_once('.//eng/sec/user.php');  require_once('.//eng/sec/session.php');  if($session->GetType() != UNKNOWN)      $session->Close();  if(!$session->CheckCaptcha())      $_POST = array();  $server = $dbo->ExectueRow(sprintf('SELECT * FROM `%sserver_info` WHERE `com` = \'%s\'',DB_PERFIX, SING_IN_START));  if($server['subkind'])   $nError = E_SERVER_END;  elseif($server['kind'] > $_SERVER['REQUEST_TIME'])   $nError = E_SERVER_START;  else   $nError = NO_ERROR;  mb_internal_encoding("UTF-8");  if(!empty($_POST) and ($nError == NO_ERROR) and isset($_POST['acc']) and (ValidNumber($_POST['acc']) == 1))  {   $arr = array();   $arr['name'] = isset($_POST['name']) ? trim(mb_substr($_POST['name'],0,32)) : '';   $arr['email'] = isset($_POST['email']) ? mb_substr($_POST['email'],0,50) : '';   $arr['kind'] = isset($_POST['kind']) ? ValidNumber($_POST['kind'],true) : 0;   $arr['pos'] = isset($_POST['pos']) ? ValidNumber($_POST['pos'],true) : 0;   $arr['code'] = GUID();   if($arr['pos'] > 4)    $arr['pos'] = POS_RANDOM;   if($arr['kind'] > 3)    $arr['kind'] = 1;   if($dbo->ExectueScaler(sprintf('SELECT `id` FROM `%saccount` WHERE `name` = \'%s\'',DB_PERFIX,$arr['name']),'id') or    $dbo->ExectueScaler(sprintf('SELECT `id` FROM `%ssingin` WHERE `name` = \'%s\'',DB_PERFIX,$arr['name']),'id'))     $nError = E_NAME_IN_USE;   elseif(IsBlackName($arr['name']))    $nError = E_BLACK_NAME;   elseif(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL))    $nError = E_VALID_EMAIL;   elseif($dbo->ExectueScaler(sprintf('SELECT `id` FROM `%saccount` WHERE `email` = \'%s\'',DB_PERFIX,$arr['email']),'id') or    $dbo->ExectueScaler(sprintf('SELECT `id` FROM `%ssingin` WHERE `email` = \'%s\'',DB_PERFIX,$arr['email']),'id'))     $nError = E_EMAIL_IN_USE;   elseif(empty($_POST['p1']) or empty($_POST['p2']) or $_POST['p1'] != $_POST['p2'])    $nError = E_PASSWORD;   else   {    require_once('.//mail/ac.php');    $arr['password'] = sha1($_POST['p1']);    $dbo->InsertRow(DB_PERFIX.'singin',$arr);    SendMail(sprintf($message,$subject,$arr['name'],$_POST['p1'],SERVER_NAME,$arr['code'],SERVER_NAME,$arr['code']),$arr['email'],$subject);    $session->Href('active.php');   }  }  ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
<link href="css/login.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jav/main.js?<?php echo time(); ?>"></script>
<title><?php echo $lang['Googamal'];?></title>
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
			<?php  if($nError == E_SERVER_END)   echo '<span class = "error">'.$lang['SERVER_END'].'</span>';  elseif($nError == E_SERVER_START)   printf($lang['SERVER_NOT_START'],DateToString($server['kind']),Until($server['kind'],'start'));  else   require_once('temp/reg/reg.php');  ?>
		</div>
		<div class="log_but" style="margin-top:-15px">
          
		</div>
		
		</div>
		<div class="right">
			<?php require_once('temp/ind/rigth.php'); ?>
		</div>
			
		</div>
<script language="javascript" type="text/javascript">
var timer = Array();
</script>
</body>
</html>