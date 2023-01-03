<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/utility.php');  require_once('eng/conn/pm.php');  require_once('eng/main/union.php');  define('NEW_PASSWORD','np');  define('SET_SITTER','sis');  define('CANCEL_SITER','cs');  define('DEL_ACCOUNT','da');  $error = NO_ERROR;  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');  $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  function GetPermission($in)  {      $per = 0;      if(isset($_POST['ps'.$in.'1']) and $_POST['ps'.$in.'1'])          $per = $per | CAN_RAPINE;      if(isset($_POST['ps'.$in.'2']) and $_POST['ps'.$in.'2'])          $per = $per | CAN_SUPPORT;      if(isset($_POST['ps'.$in.'3']) and $_POST['ps'.$in.'3'])          $per = $per | CAN_MARKET;      if(isset($_POST['ps'.$in.'4']) and $_POST['ps'.$in.'4'])      {          $per = $per | READ_PM;          $per =  $per |SEND_PM;      }        if(isset($_POST['ps'.$in.'5']) and $_POST['ps'.$in.'5'])          $per = $per | READ_REPORT;      if(isset($_POST['ps'.$in.'6']) and $_POST['ps'.$in.'6'])          $per = $per | USED_PLUS;      return $per;  }  if(isset($_POST['com']) and $_POST['com'] != '?')  {      switch($_POST['com'])      {          case NEW_PASSWORD:              $_POST['oldPass'] = isset($_POST['oldPass']) ? ($_POST['oldPass'] != '' ? sha1($_POST['oldPass']) : '') : '';              if($_POST['oldPass'] == '')                  break;              $_POST['newPass'] = isset($_POST['newPass']) ? ($_POST['oldPass'] != '' ? sha1($_POST['newPass']) : '') :  '';              $_POST['newPassRep'] = isset($_POST['newPassRep']) ? ($_POST['oldPass'] != '' ? sha1($_POST['newPassRep']) : '') : '';              if($account->password != $_POST['oldPass'])                  $session->Href('index.php');              else              {                  if(($_POST['newPass'] != $_POST['newPassRep']) or empty($_POST['newPass']))                      $error = E_PASSWORD;                  else                  {                      $account->SetFields(array('password' => $_POST['newPass']));                      $error = NEW_PASSWORD;                  }              }              break;          case SET_SITTER:              $_POST['s1'] = isset($_POST['s1']) ? $_POST['s1'] : '';              $_POST['s2'] = isset($_POST['s2']) ? $_POST['s2'] : '';              $per1 = GetPermission('1');              $per2 = GetPermission('2');              if($_POST['s1'] != '')                  $error = $account->SetSitter('1',$_POST['s1'],$per1);              if($_POST['s2'] != '')              {                    if($_POST['s1'] == '')                      $error = $account->SetSitter('1',$_POST['s1'],$per1);                  else                      $error = $account->SetSitter('2',$_POST['s2'],$per2);              }              break;          CASE CANCEL_SITER:              $_POST['kind'] = (isset($_POST['kind']) ? ValidNumber($_POST['kind'],true) : 0);              $account->RemoveBeSitter($_POST['kind']);              break;          CASE DEL_ACCOUNT:              var_dump($_POST);              $_POST['delPass'] = (isset($_POST['delPass']) ? (empty($_POST['delPass']) ? '' :sha1($_POST['delPass']) ): '');              $_POST['delEmail'] = (isset($_POST['delEmail']) ? $_POST['delEmail'] :'');              var_dump($_POST);     var_dump(($account->password == $_POST['delPass']) and ($account->email == $_POST['delEmail']));              if(($account->password == $_POST['delPass']) and ($account->email == $_POST['delEmail']))                  $account->Deleting();              break;        }  }  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = &$account->GetPlus();  $hero = &$account->GetHero();  $town = &$account->GetDefaultTown();  $pm = new PM($session->aid);  $form->Header(array('settings'),array());  ?>
<div class="Settings">
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="bgm1">
<?php if($session->pid == $session->aid){?>
<form id = "SettingForm" method="post" action="setting.php">
<input type="hidden" name="com" id = "com" value="?" />
<input type="hidden" name="kind" id = "kind" value="?" />
  <div class="changePass MarginWidth">
    <table class="w670">
     <?php       if(isset($_POST['com']) and ($_POST['com'] == NEW_PASSWORD))       {           if($error == E_PASSWORD)               printf('<tr><td class="error" colspan = "2">%s</td></tr>',$lang['E_PASSWORD']);           elseif($error == NEW_PASSWORD)               printf('<tr><td class="error" colspan = "2">%s</td></tr>',$lang['ChangePassword']);       }       ?>
	 <tr>
	  <td colspan="2" class="center bgColorS"><?php echo $lang['ChangePassword'];?></td>
	</tr>
	 <tr>
	  <td style="width:100px;"><?php echo $lang['Password'];?></td>
	  <td><input type="password" name="oldPass"/></td>
	</tr>
	<tr>
        <td><?php echo $lang['New'];?></td>
	  <td><input type="password" name="newPass"/></td>
	</tr>
	<tr>
	  <td><?php echo $lang['Repeat'];?></td>
	  <td><input type="password" name="newPassRep"/></td>
	 </tr>
	 <tr>
	  <td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>" onclick="SetValues('com','<?php echo NEW_PASSWORD;?>');"/></td>
	</tr>
	</table>
  </div>
<br/>
  <div class="sitterSettings MarginWidth">
  <table class="w670">
      <?php        if(isset($_POST['com']) and ($_POST['com'] == SET_SITTER) and $error == MAX_SITTER)            printf('<tr><td class="error" colspan = "3">%s</td></tr>',$lang['MaxSitter']);        ?>
	<tr>
	  <td colspan="3" class="center bgColorS"><?php echo $lang['SitterSetting'];?></td>
	</tr>
	<tr>
	  <td style="width:130px;"><?php echo $lang['Sitter1'];?></td>
	  <td colspan="2"><input type="text" name="s1" <?php if($account->sitter1) printf('value = "%s" ',$account->GetName($account->sitter1));?>/></td>
	</tr>
	<tr>
	  <td><input type="checkbox" name="ps11" value="1" <?php  if(($account->setting1 & CAN_RAPINE) == CAN_RAPINE) echo ' checked '; ?>/><?php echo $lang['PS1'];?></td>
	  <td><input type="checkbox" name="ps12" value="1" <?php  if(($account->setting1 & CAN_SUPPORT) == CAN_SUPPORT) echo ' checked '; ?>/><?php echo $lang['PS2'];?></td>
	  <td><input type="checkbox" name="ps13" value="1" <?php  if(($account->setting1 & CAN_MARKET) == CAN_MARKET) echo ' checked '; ?>/><?php echo $lang['PS3'];?></td>
	</tr>
	<tr>	 
	  <td><input type="checkbox" name="ps14" value="1" <?php  if(($account->setting1 & (READ_PM | SEND_PM)) == (SEND_PM | READ_PM)) echo ' checked '; ?>/><?php echo $lang['PS4'];?></td>
	  <td><input type="checkbox" name="ps15" value="1" <?php  if(($account->setting1 & READ_REPORT) == READ_REPORT) echo ' checked '; ?>/><?php echo $lang['PS5'];?></td>
	  <td><input type="checkbox" name="ps16" value="1" <?php  if(($account->setting1 & USED_PLUS) == USED_PLUS) echo ' checked '; ?>/><?php echo $lang['PS6'];?></td>
	</tr>
	<tr>
	  <td><?php echo $lang['Sitter2'];?></td>
	  <td><input type="text" name="s2"  <?php if($account->sitter2) printf('value = "%s" ',$account->GetName($account->sitter2));?>/></td>
	 </tr>
      <tr>
          <td><input type="checkbox" name="ps21" value="1" <?php  if(($account->setting2 & CAN_RAPINE) == CAN_RAPINE) echo ' checked '; ?>/><?php echo $lang['PS1'];?></td>
          <td><input type="checkbox" name="ps22" value="1" <?php  if(($account->setting2 & CAN_SUPPORT) == CAN_SUPPORT) echo ' checked '; ?>/><?php echo $lang['PS2'];?></td>
          <td><input type="checkbox" name="ps23" value="1" <?php  if(($account->setting2 & CAN_MARKET) == CAN_MARKET) echo ' checked '; ?>/><?php echo $lang['PS3'];?></td>
      </tr>
      <tr>
          <td><input type="checkbox" name="ps24" value="1" <?php  if(($account->setting2 & (READ_PM | SEND_PM)) == (SEND_PM | READ_PM)) echo ' checked '; ?>/><?php echo $lang['PS4'];?></td>
          <td><input type="checkbox" name="ps25" value="1" <?php  if(($account->setting2 & READ_REPORT) == READ_REPORT) echo ' checked '; ?>/><?php echo $lang['PS5'];?></td>
          <td><input type="checkbox" name="ps26" value="1" <?php  if(($account->setting2 & USED_PLUS) == USED_PLUS) echo ' checked '; ?>/><?php echo $lang['PS6'];?></td>
      </tr>
	<tr>
	  <td colspan="3" class="center"><input type="submit" value="<?php echo $lang['Save'];?>" onclick="SetValues('com','<?php echo SET_SITTER;?>');"/></td>
	</tr>
	  
	</table>
  </div>
<br/>
  <div class="isSitter MarginWidth">
    <table class="w670">
	 <tr>
	  <td class="center bgColorS" colspan="2"><?php echo $lang['AccountSitter'];?></td>
	 </tr>
        <?php          $arr = $account->GetBeSitter();          if(!count($arr))              printf('<td colspan="2">%s</td>',$lang['NoRecord']);          else          {              foreach($arr as $r)              {                  printf('<tr><td><img src="img/all/c1.gif" class="i30s" onclick="SetValues(\'com\',\'%s\');SubmitForm(\'SettingForm\',\'kind\',\'%s\');" alt = "%s"/></td><td>%s</td></tr>',                  CANCEL_SITER,$r['id'],$lang['Cancel'],$form->PlayerLink($r['id'],$r['name']));                  printf('<tr></tr><td>%s</td><td>%s</td></tr>',                      (($r['setting'] & CAN_RAPINE) == CAN_RAPINE) ? $lang['PS1'] : '&nbsp;',                      (($r['setting'] & CAN_SUPPORT)== CAN_SUPPORT)? $lang['PS2'] : '&nbsp;');                  printf('<tr><td>%s</td><td>%s</td></tr>',                      (($r['setting'] & CAN_MARKET) == CAN_MARKET) ? $lang['PS3'] : '&nbsp;',                      (($r['setting'] & (READ_PM | SEND_PM))== (READ_PM | SEND_PM))? $lang['PS4'] : '&nbsp;');                  printf('<tr><td>%s</td><td>%s</td></tr>',                      (($r['setting'] & READ_REPORT) == READ_REPORT) ? $lang['PS5'] : '&nbsp;',                      (($r['setting'] & USED_PLUS)== USED_PLUS)? $lang['PS6'] : '&nbsp;');              }                            }          ?>

	</table>
  </div>
<br/>
  <div class="deleteAcc MarginWidth">
    <table class="w670">
	 <tr>
	  <td class="center bgColorS" colspan="2"><?php echo $lang['DelAccount'];?></td>
	 </tr>
	 <tr>
	  <td colspan="2"><?php echo $lang['DEL_T'];?></td>
	 </tr>
     <tr><td <?php if(!$account->IsDeleting()) echo 'colspan="2"';?>><?php echo ($account->IsDeleting() ? $lang['CancelDel'] : $lang['DelAccount']);?></td></tr>
        <?php              if($account->IsDeleting())                  printf('<td>%s %s</td>',$lang['DelAccount'], $form->Addtimer($account->IsDeleting(),'index.php'));          ?>
	 <tr>
	  <td style="width:100px;"><?php echo $lang['Password'];?></td>
	  <td><input type="password" name="delPass"/></td>
	 </tr>
     <tr>
        <td style="width:100px;"><?php echo $lang['Email'];?></td>
        <td><input type="text" name="delEmail" /></td>
     </tr>
	 <tr>
	  <td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>" onclick="SetValues('com','<?php echo DEL_ACCOUNT;?>');"/></td>
	</tr>
	</table>
  </div>
</form>
<?php } else      $form->BlockPage($lang['E_ATTACK_SITTER']);?>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
</div>
<?php  $form->Footer();  $session->Save();  ?>