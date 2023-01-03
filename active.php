<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/utility.php');  require_once('lng/per.php');  require_once('lib/defines.php');  $code = isset($_GET['code']) ? $_GET['code'] : '';  $Error = 0;  if(!empty($code))  {   $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%ssingin` WHERE `code` = \'%s\'',DB_PERFIX,$code));   if(empty($row))    $Error = 1;   else   {    $arr = array();    $arr['name'] = $dbo->EscapeString($row['name']);    $arr['email'] = $row['email'];    $arr['kind'] = $row['kind'];    $arr['password'] = $row['password'];          $dbo->ExectueQuery(sprintf('DELETE FROM `%sinviation` WHERE `email` = \'%s\'',DB_PERFIX,$row['email']));          if($dbo->AffectedRows())              $arr['talant'] = '500';            $arr['permission'] = SEND_PM | READ_PM |              UNION_REPORT |              READ_REPORT |              OWNER |              CAN_RAPINE |              CAN_ESPIAL |              CAN_SUPPORT |              CAN_ATTACK |              CAN_MARKET |              USED_PLUS;    $arr['protected'] = $_SERVER['REQUEST_TIME'] + PROTECTED_TIME;    $arr['modify'] = $_SERVER['REQUEST_TIME'];    $dbo->InsertRow(DB_PERFIX.'account',$arr);    $pid = $dbo->InsertedID();    $dbo->ExectueQuery(sprintf('INSERT INTO `%sprofile` (`owner`, `kind`) VALUES (\'%s\', \'%s\');',     DB_PERFIX,$pid, PLAYER_KIND));    $dbo->ExectueQuery(sprintf('INSERT INTO `%spoint` ( `owner`, `kind`) VALUES (\'%s\', \'%s\');',     DB_PERFIX,$pid, PLAYER_KIND));    $arr = array();    $arr['pid'] = $pid;    $arr['name'] = $lang['NewTown'];    $arr['h'] = '1';    $arr['cap'] = '1';    $arr['pop'] = '1';    $arr['modify'] = (int)$_SERVER['REQUEST_TIME'];    $dbo->InsertRow(DB_PERFIX.'town', $arr);    $tid = $dbo->InsertedID();    $dbo->ExectueQuery(sprintf('UPDATE `%saccount` SET `tid` = \'%s\', `htid` = \'%s\' WHERE `id` = \'%s\' LIMIT 1',DB_PERFIX,     $tid, $tid, $pid));    if($row['pos'] == POS_RANDOM)     $row['pos'] = mt_rand(1,4);    $temp = '';    switch($row['pos'])    {     case POS_NE:      $temp = sprintf('(`x` > \'25\' AND `y` > \'25\' AND `kind` = \'%s\' AND `subid` = \'0\')  ORDER BY `id` ASC', MAP_TOWN);      break;     case POS_SE:      $temp = sprintf('(`x` > \'25\' AND `y` < \'-25\' AND `kind` = \'%s\' AND `subid` = \'0\')  ORDER BY `id` ASC', MAP_TOWN);      break;     case POS_NW:      $temp = sprintf('(`x` < \'-25\' AND `y` > \'25\' AND `kind` = \'%s\' AND `subid` = \'0\') ORDER BY `id` ASC', MAP_TOWN);      break;     case POS_SW:      $temp = sprintf('(`x` < \'-25\' AND `y` < \'-25\' AND `kind` = \'%s\' AND `subid` = \'0\') ORDER BY `id` ASC', MAP_TOWN);      break;    }    $dbo->ExectueQuery(sprintf('UPDATE `%smap_t` SET `subid` = \'%s\' WHERE %s LIMIT 1;',DB_PERFIX,$tid, $temp));    $dbo->ExectueQuery(     sprintf(   'UPDATE `%stown` AS `t`,`%smap_t` AS `m` SET `t`.`mid` = `m`.`id` WHERE `t`.`id` = \'%s\' AND `m`.`subid` = \'%s\' AND `m`.`kind` =\'%s\'',     DB_PERFIX, DB_PERFIX, $tid, $tid, MAP_TOWN));    $dbo->DeleteRecord(DB_PERFIX.'singin',$row['id']);    $Error = 2;   }  }  ?>


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
		<?php  if($Error ==2)  {   echo $lang['ActiveAccount'];  }else{  ?>
			<form action="active.php" method="get">
				<table>
					<tr><td colspan="2">
<p><?php echo $lang['EnterCode'];?></p>
</td></tr>
					<tr><td colspan="2" class="error"><?php  if($Error == 1)   echo $lang['NoRecord'];  else   echo '&nbsp;';  ?></td></tr>

					<tr><td style="text-align:center;width:100px;"><?php echo $lang['Code'];?></td><td><input type="text" value="" name ="code" /></td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr>
				</table>
			</form>
			<?php     }     ?>
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