<?php
require_once('.//lib/dbo.php');
require_once('.//eng/main/union.php');
require_once('.//lib/form.php');
require_once('.//eng/sec/user.php');
require_once('.//lib/utility.php');
require_once('.//lib/defines.php');
require_once('.//eng/main/troop.php');
require_once('.//eng/main/town.php');

$sitter = $session->aid != $session->pid;
$list = array();
$_POST['t1'] = isset($_POST['t1']) ? ValidNumber($_POST['t1'], true) : 0;
$_POST['t2'] = isset($_POST['t2']) ? ValidNumber($_POST['t2'], true) : 0;
$_POST['t3'] = isset($_POST['t3']) ? ValidNumber($_POST['t3'], true) : 0;
$_POST['t4'] = isset($_POST['t4']) ? ValidNumber($_POST['t4'], true) : 0;
$_POST['t5'] = isset($_POST['t5']) ? ValidNumber($_POST['t5'], true) : 0;
$_POST['t6'] = isset($_POST['t6']) ? ValidNumber($_POST['t6'], true) : 0;
$_POST['t7'] = isset($_POST['t7']) ? ValidNumber($_POST['t7'], true) : 0;
$_POST['t8'] = isset($_POST['t8']) ? ValidNumber($_POST['t8'], true) : 0;
$_POST['t9'] = isset($_POST['t9']) ? ValidNumber($_POST['t9'], true) : 0;
$_POST['t10'] = isset($_POST['t10']) ? ValidNumber($_POST['t10'], true) : 0;
$_POST['t11'] = isset($_POST['t11']) ? ValidNumber($_POST['t11'], true) : 0;
$_POST['t12'] = isset($_POST['t12']) ? ValidNumber($_POST['t12'], true) : 0;
$_POST['t13'] = isset($_POST['t13']) ? ValidNumber($_POST['t13'], true) : 0;
$_POST['t14'] = isset($_POST['t14']) ? ValidNumber($_POST['t14'], true) : 0;
$_POST['kind'] = isset($_POST['kind']) ? ValidNumber($_POST['kind'], true) : 1;
$_POST['tbX'] = isset($_POST['tbX']) ? ValidNumber($_POST['tbX']) : 0;
$_POST['tbY'] = isset($_POST['tbY']) ? ValidNumber($_POST['tbY']) : 0;
$_POST['e1'] = isset($_POST['e1']) ? ValidNumber($_POST['e1'],true) : 0;
if($_POST['e1'] > ELIXIR_COMBIN)
	$_POST['e1'] = 0;
$_POST['en1'] = isset($_POST['en1']) ? ValidNumber($_POST['en1'],true) : 0;
$_POST['e2'] = isset($_POST['e2']) ? ValidNumber($_POST['e2'],true) : 0;
if($_POST['e2'] > ELIXIR_COMBIN)
	$_POST['e2'] = 0;
$_POST['en2'] = isset($_POST['en2']) ? ValidNumber($_POST['en2'],true) : 0;
$_POST['e3'] = isset($_POST['e3']) ? ValidNumber($_POST['e3'],true) : 0;
if($_POST['e3'] > ELIXIR_COMBIN)
	$_POST['e3'] = 0;
$_POST['en3'] = isset($_POST['en3']) ? ValidNumber($_POST['en3'],true) : 0;
$_POST['en1'] = $_POST['en1'] > $town->HaveElixir($_POST['e1']) ? $town->HaveElixir($_POST['e1']) : $_POST['en1'];
$_POST['en2'] = $_POST['en2'] > $town->HaveElixir($_POST['e2']) ? $town->HaveElixir($_POST['e2']) : $_POST['en2'];
$_POST['en3'] = $_POST['en3'] > $town->HaveElixir($_POST['e3']) ? $town->HaveElixir($_POST['e3']) : $_POST['en3'];
$_POST['h'] = isset($_POST['h']) ? ($_POST['h'] ? $town->h : 0 ): 0;
$used = 0;
$newTown = true;
$error = NO_ERROR;
$distance = 0;
$lowT = 0;
$lowTK = 0;
for($i = 1;$i < 15;$i++)
{
	$t = 't'.$i;
	$_POST[$t] = $_POST[$t] > $town->$t ? $town->$t : $_POST[$t];
	if($_POST[$t])
	{
		$used += $_POST[$t];
		switch($i)
		{
			case 1:
			case 2:
				$lowTK = P_ON_INFANTRY;
				if(!$lowT)
					$lowT = $i;
				break;
			case 3:
			case 4:
				if($lowTK)
					break;
				$lowTK = P_ON_ARCHERS;
				if(!$lowT)
					$lowT = $i;
				break;
			case 5:
			case 6:
			case 7:
				if($lowTK)
					break;
				$lowTK = P_ON_CAVALRY;
				if(!$lowT)
					$lowT = $i;
				break;
			case 8:
			case 9:
			case 10:
				if($lowTK != P_ON_WAR_MACHINE)
				{
					$lowTK = P_ON_WAR_MACHINE;
					$lowT = $i;
				}
				break;
			case 11:
			case 12:
			case 13:
				if($lowTK != P_ON_WAR_MACHINE and $lowT != 12)
				{
					$lowTK = P_ON_INFANTRY;
					$lowT = $i;
				}
				break;
			case 14:
				if($lowTK)
					break;
				$lowTK = P_ON_ALL_TROOP;
				$lowT = 14;
				$_POST['t14'] = 1;
				break;
		}
	}
}
$ec = array(0 => 0, 1 => 2, 2 => 0, 3 => 0, 4 => 5, 5 => 1, 6 => 3, 7 => 0, 8 => 1, 9 => 0, 10 => 1, 11 => 1, 12 => 2, 13 => 0.5, 14 => 0 ,15 => 1);
function ZeroElixir($force = false)
{
	if($force)
	{
		$_POST['e1'] = $_POST['e2'] = $_POST['e3'] =
		$_POST['en1'] = $_POST['en2'] = $_POST['en3'] = 0;
		return;
	}
	
	if(!$_POST['en1'])
	{
		$_POST['e1'] = $_POST['e2'] = $_POST['e3'] =
		$_POST['en1'] = $_POST['en2'] = $_POST['en3'] = 0;
	}
	elseif(!$_POST['en2'] or !$_POST['en3'])
	{
		$_POST['e2'] = $_POST['e3'] =
		$_POST['en2'] = $_POST['en3'] = 0;
		if($_POST['e1'] == ELIXIR_COMBIN)
		{
			$_POST['e1'] = $_POST['en1'] =  0;
		}
			
	}
}

function MatchElixir($used)
{
	global $ec;
	if($_POST['en1'] > $used)
		$_POST['en1'] = $used;
	ZeroElixir();
	if(($_POST['e2'] == ELIXIR_COMBIN) or ($_POST['e3'] == ELIXIR_COMBIN) or 
		!$ec[$_POST['e2']] or 
		!$ec[$_POST['e3']] or 
		!$_POST['en2'] or !$_POST['en3'])
	{
		ZeroElixir(true);
		return;
	}
	$arr = array();
	$arr[0] = $_POST['en1'];
	$arr[1] = (int)ceil($_POST['en2']/$ec[$_POST['e2']]);
	$arr[2] = (int)ceil($_POST['en3']/$ec[$_POST['e3']]);
	$t = min($arr);
	if(!$t)
	{
		ZeroElixir(true);
		return;
	}
	if($t != $_POST['en1'] and $_POST['en1'] >= max($arr))
		$_POST['en1'] = $t;
	else
		$t = $_POST['en1'];
	$_POST['en2'] = $t * $ec[$_POST['e2']] < $_POST['en2'] ? $t * $ec[$_POST['e2']] : $_POST['en2'];
	$_POST['en3'] = $t * $ec[$_POST['e3']] < $_POST['en3'] ? $t * $ec[$_POST['e3']] : $_POST['en3'];

}
if($_POST['kind'] != A_ATTACK and $_POST['kind'] != A_ESPIAL)
	ZeroElixir(true);
if($_POST['kind'] == A_ESPIAL)
{
	$_POST['t1'] = $_POST['t2'] = 
	$_POST['t3'] = $_POST['t4'] = 
	$_POST['t5'] = $_POST['t6'] = 
	$_POST['t8'] = $_POST['t9'] = 
	$_POST['t10'] = $_POST['t11'] = 
	$_POST['t12'] = $_POST['t13'] = 
	$_POST['t14'] = $_POST['h'] = 0;
	$used = $_POST['t7'];
	if($_POST['e1'] != ELIXIR_COMBIN)
	{
		$_POST['e2'] = $_POST['e3'] = $_POST['en2'] = $_POST['en3'] = 0;
		if($_POST['e1'] != 11 and $_POST['e1'] != 12)
			$_POST['e1'] = $_POST['en1'] = 0;
		elseif($used * $ec[$_POST['e1']] < $_POST['en1'])
			$_POST['en1'] =  $used * $ec[$_POST['e1']];
	}
	else
	{
		if(($_POST['e2'] != 11 and $_POST['e2'] != 12) or ($_POST['e3'] != 11 and $_POST['e3'] != 12))
			ZeroElixir(true);
		else
			MatchElixir($used);
	}
	
}
elseif($_POST['kind'] == A_ATTACK)
{
	if($_POST['e1'] != ELIXIR_COMBIN)
	{
		$_POST['e2'] = $_POST['e3'] = $_POST['en2'] = $_POST['en1'] = 0;
		if($_POST['e1'] == 11 and $_POST['e1'] == 12 or !$ec[$_POST['e1']])
			ZeroElixir(true);
	}
	else
	{
		if($_POST['e2'] == 11 or $_POST['e2'] == 12 or 
			$_POST['e3'] == 11 or $_POST['e3'] == 12)
			ZeroElixir(true);
		else
			MatchElixir($used);
	}
	
}

$t = '';
$info = null;
if(!$used and !$_POST['h'])
	$error = $error | E_ATTACK_NO_TROOP;
$pos = $dbo->ExectueRow(sprintf('SELECT * FROM `%smap_t` WHERE `x` = \'%d\' and `y` = \'%d\'',
		DB_PERFIX,$_POST['tbX'],$_POST['tbY']));

switch($pos['kind'])
{
	case MAP_TOWN:
		$info = $dbo->ExectueRow(sprintf('SELECT `id` as `tid`,`name`,`pid`,`uid`,`mid` FROM `%stown` WHERE `id` = \'%s\'',DB_PERFIX,$pos['subid']));
		if(empty($info))
		{
			$info['pid'] = $info['tid'] = 0;
			$info['mid'] = $pos['id'];
			$info['name'] = $lang['EmptyLand'];
		}
		$info['cid'] = 0;
		if($pos['subid'] == 0)
		{
			if($_POST['t14'])
			{
				for($i = 1;$i <14;$i++)
					$_POST['t'.$i] ='0';
				$_POST['h'] = '0';
				ZeroElixir(true);
				$_POST['kind'] = A_NEW_TOWN;
			}
			else
				$error = $error | E_ATTACK_EMPTY_LAND;
				
		}
		elseif($pos['subid'] == $town->id)
		{
			$_POST['kind'] = A_ATTACK;
			if(!$town->IsBlockade())
				$error = $error | E_ATTACK_SELF;
			else
				$distance = (int)ceil(ONE_TICK / 6) ;
		}
		else
		{
			if($info['pid'] == $town->pid)
			{
				if($_POST['kind'] == A_MERGER and !$plus->HaveTalant(MERGINGE_TROOP))
					$error = $error | E_ATTACK_MERGE_TALANT;
				elseif($_POST['kind'] != A_MERGER)
					$error = $error |  E_ATTACK_OWN;
			}
			elseif($union->IsAllay($account->uid, $info['uid']) and $_POST['kind'] != A_SUPPORT)
				$error = $error | E_ATTACK_ALLAY;
		}
		break;
	case MAP_GAP:
		$info = array('name' => $lang['Gap'],'mid' => $pos['id']);
		$error = $error |  E_ATTACK_GAP;
			break;
	case MAP_CLOONEY:
		if($pos['subid'])
			$info = $dbo->ExectueRow(sprintf('SELECT `id` AS `cid`,`pid`,`tid`, `uid`,`mid` FROM `%sclooney` WHERE `id` = \'%s\'',DB_PERFIX,$pos['subid']));
		else
			$info = $dbo->ExectueRow(sprintf('SELECT `id` AS `cid,`pid`,`tid`, `uid`,`mid` FROM `%sclooney` WHERE `mid` = \'%s\'',DB_PERFIX,$pos['id']));
		if(!(($_POST['kind'] == A_SUPPORT or $_POST['kind'] == A_ESPIAL) and $info['pid']))
			$_POST['kind'] = A_RAPINE;
		if($info['pid'])
		{
			if($info['pid'] == $town->pid and $_POST['kind'] != A_SUPPORT)
				$error = $error | E_ATTACK_OWN;
			elseif($union->IsAllay($info['uid'],$account->uid) and $_POST['kind'] != A_SUPPORT)
				$error = $error | E_ATTACK_ALLAY;
			$info['name'] = $lang['ClooneyCapture'];
		}
		else
			$info['name'] = $lang['Clooney'];
		break;
}
if($sitter and $_POST['kind'] > A_SUPPORT)
{
	if($_POST['kind'] == A_ATTACK and !$town->IsBlockade())
	{
		$_POST['kind'] = A_RAPINE;
		$error = $error | E_ATTACK_SITTER;
	}
}
if(!is_null($info) and !$distance)
{
	if(!$lowT)
	{
		$lowT = $hero->GetPoint('SPEED');
		$lowTK = P_ON_ALL_TROOP;
	}
	else
		$lowT = $troops[$account->kind][$lowT][5];
	$tPos = $dbo->ExectueRow(sprintf('SELECT `x`,`y` FROM `%smap_t` WHERE `id` = \'%s\'',DB_PERFIX,$town->mid));
	$lvl = $town->GetLevel(25);
	if($lvl > 0)
		$lvl = $lvl * 0.0125;
	else
		$lvl = 0;
	
	$distance = Distance($pos['x'],$tPos['x'],$pos['y'],$tPos['y'],$lowT, $lvl + $hero->SpeedTroop($lowTK) );
}
$disabled = false;
$temp = $error ? '' : '&nbsp;';

if(($error & E_ATTACK_NO_TROOP ) == E_ATTACK_NO_TROOP){
	$temp .= $lang['E_ATTACK_NO_TROOP'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_SITTER  ) == E_ATTACK_SITTER){
	$temp .= $lang['E_ATTACK_SITTER'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_EMPTY_LAND ) == E_ATTACK_EMPTY_LAND){
	$temp .= $lang['E_ATTACK_EMPTY_LAND'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_SELF ) == E_ATTACK_SELF){
	$temp .= $lang['E_ATTACK_SELF'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_GAP ) == E_ATTACK_GAP){
	$temp .= $lang['E_ATTACK_GAP'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_OWN ) == E_ATTACK_OWN){
	$temp .= $lang['E_ATTACK_OWN'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_ALLAY ) == E_ATTACK_ALLAY){
	$temp .= $lang['E_ATTACK_ALLAY'];
	$temp .='<br />';
}
if(($error & E_ATTACK_MERGE_TALANT ) == E_ATTACK_MERGE_TALANT){
	$temp .= $lang['E_ATTACK_MERGE_TALANT'];
	$temp .='<br />';
	$disabled = true;
}
if(($error & E_ATTACK_MERGE_SELF ) == E_ATTACK_MERGE_SELF){
	$temp .= $lang['E_ATTACK_MERGE_SELF'];
	$disabled = true;
}
if($user->UnderProtection($info['pid']))
{
	$temp .= $lang['UnderProtection'];
	$disabled = true;
}
