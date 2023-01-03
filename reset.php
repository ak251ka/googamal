<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/utility.php');  require_once('lng/per.php');  require_once('lib/defines.php');  require_once('mail/recovery.php');  $code = isset($_GET['code']) ? $_GET['code'] : '';  $Error = 0;  if(!empty($code))  {      $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%sreset` WHERE `code` = \'%s\'',DB_PERFIX,$code));      if(!empty($row))      {          $dbo->DeleteRecord(DB_PERFIX.'reset',$row['id']);          if($dbo->AffectedRows())          {              $arr = array('password'=>$row['pass']);              $dbo->UpdateRow(DB_PERFIX.'reset',$arr,$row['pid']);              $Error = 1;          }      }      $Error = 3;  }  if(!empty($_POST))  {      $_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';      $_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';      $row = $dbo->ExectueRow(          sprintf('SELECT `id`,`name`,`email` FROM `%saccount` WHERE `name` = \'%s\' AND `email` = \'%s\' AND `ac` = \'1\'',DB_PERFIX,$_POST['name'],$_POST['email']));      if(!empty($row))      {          $arr = array();          $arr['code'] = GUID();          $pass = '';          $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';          for ($i = 0; $i < 8; $i++)          {              $n = mt_rand(0, strlen($alphabet) - 1);              $pass .= $alphabet[$n];          }          $arr['pid'] = $row['id'];          $arr['pass'] = sha1($pass);          $dbo->InsertRow(DB_PERFIX.'reset',$arr);          SendMail(sprintf($message,$subject,$row['name'],SERVER_NAME,$pass,SERVER_NAME,$arr['code']),$row['email'],$subject);          $Error = 2;      }  }  ?>


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
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jav/main.js"></script>
</head>
<body>
	<div class="mainCon">
		<div class="left">
			<?php require_once('temp/ind/left.php'); ?>
		</div>
	
		<div class="middle">
		<div class="log_top">
       
		</div>
		<div class="log_mid">
<?php  if(!$Error)  {  ?>
<form action="reset.php" method="POST">
<table>
<tr><td colspan="2">
<p><?php echo $lang['RequireNewPassword'];?></p>
</td></tr>
<tr><td><?php echo $lang['PlayerName'];?></td><td><input name = "name" type="text" value=""></td></tr>
<tr><td style="text-align:center;width:100px;"><?php echo $lang['Email'];?></td><td><input type="text" value="" name ="email" /></td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr>
</table>
</form>
<?php  }  elseif($Error == 1)      echo $lang['PasswordChenged'];  elseif($Error == 2)      printf($lang['E_SEND_SUC'],$lang['Password']);  elseif($Error == 3)  {  ?>
    <form action="reset.php" method="get">
        <table>
            <tr><td colspan="2">
                    <p><?php echo $lang['NotValidPassCode'];?></p>
                </td></tr>
            <tr><td style="text-align:center;width:100px;"><?php echo $lang['Code'];?></td><td><input type="text" value="" name ="code" /></td></tr>
            <tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr>
        </table>
    </form>
<?php  }  ?>
		</div>
		<div class="log_but" style="margin-top:-15px">
          
		</div>
		
		</div>
		<div class="right">
			<?php require_once('temp/ind/rigth.php'); ?>
		</div>
		</div>
</body>
</html>