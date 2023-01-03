<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('lib/dbo.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/mission.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');    $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  if($account->training == 13)      $mission->SetMission();  $town = $account->GetDefaultTown();    $pm = new PM($session->aid);  $union = new Union($account->uid);  $form->Header(array('map'),array('main','ajax','map'));  if(isset($_GET['x']) and isset( $_GET['y']))  {   $x = ValidNumber($_GET['x']);   $y = ValidNumber($_GET['y']);  }  elseif(isset($_GET['mid']))  {   $pos = $dbo->ExectueRow(sprintf('SELECT `x`,`y` FROM `%smap_t` WHERE `id` = \'%s\'',DB_PERFIX, ValidNumber($_GET['mid'],true)));   if(empty($pos))   {    $x = 0;    $y = 0;   }   else   {    $x = $pos['x'];    $y = $pos['y'];   }  }  else  {   $pos = $dbo->ExectueRow(sprintf('SELECT `x`,`y` FROM `%smap_t` WHERE `subid` = \'%s\' AND `kind` = \'%s\'',    DB_PERFIX, $town->id, MAP_TOWN));   $x = $pos['x'];   $y = $pos['y'];  }  ?>
<div>

<div id="map" class="map_cont" ></div>
<div class="pos">

<table border="1" style="display:none">
<tr>
	<td>X</td><td><input type="text" value="<?php echo $x;?>" name="tbX" id = "tbX"/></td>
	<td>Y</td><td><input type="text" value="<?php echo $y;?>" name="tbY" id = "tbY"/></td>
	<td colspan="2" class="center"><input type="button" value="show" onclick="Map.Start();"/></td>
</tr>
</table>
</div>

</div>
<script language="javascript" type="text/javascript">Map.Start();</script>
<?php  $session->Save();  $form->Footer();  ?>