<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/town.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/troop.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  require_once('eng/main/mission.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');  $plus = &$account->GetPlus();  $hero = &$account->GetHero();  if(isset($_GET['id']))  {   if(!$account->SwitchTown($_GET['id']))    $session->Href('detail.php?kind=town&id='.$_GET['id']);  }  $town = &$account->GetDefaultTown();  if(isset($_POST['com']))  {   if($_POST['com'] == 'cb' and isset($_POST['kind']))    $town->CancelBuild($_POST['kind']);      elseif($_POST['com'] == 'sm')          $mission->SetMission();  }  $pm = new PM($session->aid);    $form->Header(array('town'),array('town'));  $mapArray = array();    $mapArray[0][0] = ' shape="rect" coords="406,158,447,192" ';  $mapArray[0][1] = ' shape="poly" coords="407,162,394,176,411,196,446,195,458,178,458,153,442,138,423,139" ';    $mapArray[1][0] = ' shape="rect" coords="253,234,294,268" ';  $mapArray[1][1] = ' shape="poly" coords="244,223,244,247,259,264,281,264,293,247,293,222,277,207,258,208" ';    $mapArray[2][0] = ' shape="rect" coords="316,181,357,215" ';  $mapArray[2][1] = ' shape="poly" coords="307,178,307,202,322,219,344,219,356,202,356,177,340,162,321,163" ';    $mapArray[3][0] = ' shape="rect" coords="637,243,678,277" ';  $mapArray[3][1] = ' shape="poly" coords="632,238,632,262,647,279,669,279,681,262,681,237,665,222,646,223" ';    $mapArray[4][0] = ' shape="rect" coords="184,260,225,294" ';  $mapArray[4][1] = ' shape="poly" coords="179,249,179,273,194,290,216,290,228,273,228,248,212,233,193,234" ';    $mapArray[5][0] = ' shape="rect" coords="388,273,438,311" ';  $mapArray[5][1] = ' shape="poly" coords="373,272,389,261,391,240,419,239,433,264,453,283,434,311,398,319,376,297" ';    $mapArray[6][0] = ' shape="rect" coords="479,163,520,197" ';  $mapArray[6][1] = ' shape="poly" coords="473,155,473,179,488,196,510,196,522,179,522,154,506,139,487,140" ';    $mapArray[7][0] = ' shape="rect" coords="540,163,581,197" ';  $mapArray[7][1] = ' shape="poly" coords="528,156,528,180,543,197,565,197,577,180,577,155,561,140,542,141" ';    $mapArray[8][0] = ' shape="rect" coords="580,203,621,237" ';  $mapArray[8][1] = ' shape="poly" coords="572,193,572,217,587,234,609,234,621,217,621,192,605,177,586,178" ';    $mapArray[9][0] = ' shape="rect" coords="321,269,362,303" ';  $mapArray[9][1] = ' shape="poly" coords="319,259,319,283,334,300,356,300,368,283,368,258,352,243,333,244" ';    $mapArray[10][0] = ' shape="rect" coords="477,274,518,308" ';  $mapArray[10][1] = ' shape="poly" coords="467,268,467,292,482,309,504,309,516,292,516,267,500,252,481,253" ';    $mapArray[11][0] = ' shape="rect" coords="558,274,599,308" ';  $mapArray[11][1] = ' shape="poly" coords="552,273,552,297,567,314,589,314,601,297,601,272,585,257,566,258" ';    $mapArray[12][0] = ' shape="rect" coords="614,304,655,338" ';  $mapArray[12][1] = ' shape="poly" coords="605,298,605,322,620,339,642,339,654,322,654,297,638,282,619,283" ';    $mapArray[13][0] = ' shape="rect" coords="474,325,515,359" ';  $mapArray[13][1] = ' shape="poly" coords="468,329,468,353,483,370,505,370,517,353,517,328,501,313,482,314" ';    $mapArray[14][0] = ' shape="rect" coords="303,319,344,353" ';  $mapArray[14][1] = ' shape="poly" coords="293,313,293,337,308,354,330,354,342,337,342,312,326,297,307,298" ';    $mapArray[15][0] = ' shape="rect" coords="225,309,266,343" ';  $mapArray[15][1] = ' shape="poly" coords="222,300,222,324,237,341,259,341,271,324,271,299,255,284,236,285" ';    $mapArray[16][0] = ' shape="rect" coords="103,282,144,316" ';  $mapArray[16][1] = ' shape="poly" coords="95,273,95,297,110,314,132,314,144,297,144,272,128,257,109,258" ';    $mapArray[17][0] = ' shape="rect" coords="147,321,188,355" ';  $mapArray[17][1] = ' shape="poly" coords="142,310,142,334,157,351,179,351,191,334,191,309,175,294,156,295" ';    $mapArray[18][0] = ' shape="rect" coords="189,374,230,408" ';  $mapArray[18][1] = ' shape="poly" coords="187,367,187,391,202,408,224,408,236,391,236,366,220,351,201,352" ';    $mapArray[19][0] = ' shape="rect" coords="304,379,345,413" ';  $mapArray[19][1] = ' shape="poly" coords="297,374,297,398,312,415,334,415,346,398,346,373,330,358,311,359" ';    $mapArray[20][0] = ' shape="rect" coords="423,383,464,417" ';  $mapArray[20][1] = ' shape="poly" coords="418,375,418,399,433,416,455,416,467,399,467,374,451,359,432,360" ';    $mapArray[21][0] = ' shape="rect" coords="514,394,555,428" ';  $mapArray[21][1] = ' shape="poly" coords="504,384,504,408,519,425,541,425,553,408,553,383,537,368,518,369" ';    $mapArray[22][0] = ' shape="rect" coords="574,367,615,401" ';  $mapArray[22][1] = ' shape="poly" coords="564,361,564,385,579,402,601,402,613,385,613,360,597,345,578,346" ';    $mapArray[23][0] = ' shape="rect" coords="654,346,695,380" ';  $mapArray[23][1] = ' shape="poly" coords="649,341,649,365,664,382,686,382,698,365,698,340,682,325,663,326" ';    $mapArray[24][0] = ' shape="rect" coords="245,420,286,454" ';  $mapArray[24][1] = ' shape="poly" coords="242,415,242,439,257,456,279,456,291,439,291,414,275,399,256,400" ';    $mapArray[25][0] = ' shape="rect" coords="388,442,454,514" ';  $mapArray[25][1] = ' shape="rect" coords="381,430,458,517" ';    $mapArray[26][0] = ' shape="rect" coords="491,444,552,514" ';  $mapArray[26][1] = ' shape="rect" coords="482,427,559,514" ';    $mapArray[27][0] = ' shape="rect" coords="711,270,753,337" ';  $mapArray[27][1] = ' shape="rect" coords="706,269,754,342" ';    $mapArray[28][0] = ' shape="rect" coords="42,275,89,331" ';  $mapArray[28][1] = ' shape="rect" coords="41,274,89,347" ';    $mapArray[29][0] = ' shape="poly" coords="380,504,382,480,353,469,331,462,309,457,290,460,279,472,263,471,227,448,81,349,79,360,101,383,116,407,152,428,184,446,203,469,229,485,248,493,282,500,296,482,318,480,330,490,341,499" ';  $mapArray[29][1] = ' shape="poly" coords="342,459,310,454,264,472,227,450,165,415,86,354,76,362,122,418,238,497,282,499,300,476,375,509,377,474" ';    $mapArray[30][0] = ' shape="poly" coords="558,491,558,461,706,377,726,349,736,351,732,367,703,404" ';  $mapArray[30][1] = ' shape="poly" coords="722,352,735,361,686,422,568,489,569,452,696,386,722,351" ';    $mapArray[31][0] = ' shape="poly" coords="720,265,728,260,711,218,695,203,673,180,652,171,602,146,608,169,652,193,674,210" ';  $mapArray[31][1] = ' shape="poly" coords="717,267,731,263,678,184,614,149,609,171,661,207" ';    $mapArray[32][0] = ' shape="rect" coords="477,146,590,189" ';  $mapArray[32][1] = ' shape="poly" coords="575,187,548,189,512,190,485,170,477,146,489,119,489,98,501,75,540,83,555,93,582,118,587,134,596,182" ';  ?>
<div class="mainImage">
<img id = "cbuild" src="img/all/f2.gif" alt="%s" class="i30s" onclick="SubmitForm(\'cbuilding\',\'kind\',\'%s\')" />
<?php  $list = $town->BuildingList();  if(count($list))  {   echo '<div id="buildInfo"><center><a href = "javascript:void(0);" onclick = "SBL();"><img src = "img/tow/b.gif"  class = "i30s" alt = "'.$lang['Show'].'"/></a></center><div id = "bDetail" style="display:none;">'.sprintf('<form id = "cbuilding" action="town.php?tid=%s" method="post"><input type="hidden" name="com" value = "cb" /><input type="hidden" name="kind" id = "kind" value="?"/><table>',$town->id);   foreach($list as $l)   {    $b = 'b'.$l->bid;    printf('<tr><td><img src="img/tow/sma/%s_0_%s.gif" alt="%s" class="i30"/></td><td style="width:80px;">%s</td><td><img id = "cbuild" src="img/all/f2.gif" alt="%s" class="i30s" onclick="SubmitForm(\'cbuilding\',\'kind\',\'%s\')" /></td></tr>',     $town->$b,$l->kind,$lang['b'.$town->$b],$form->Addtimer($l->modify,'town.php?tid='.$town->id),$lang['Cancel'],$l->id);   }   echo '</table></form></div></div>';  }  $list = $town->ElixirEffect();  if(!empty($list))  {   echo '<div id="elixirInfo"><center><a href = "javascript:void(0);" onclick = "SEL();"><img src = "img/eli/15.gif"  class = "i30s" alt = "'.$lang['Show'].'"/></a></center><div id = "eDetail" style="display:none;">';      $e1 = array();   $e2 = array();   $i = 0;   $i1=0;   $i2=0;   $link = sprintf('<br />%s<br />',$form->Ahref('/building.php?id=21',$lang['b21']),$form->Ahref('/plus.php?show=elixir',$lang['Plus']));   foreach($list as $l)   {    if($l->kind)    {     $e1[$i1] = sprintf('<img src="img/eli/%s.gif" alt="%s %s" class="i30s" onclick="modal.Show(\'m%d\');" />',      $l->eid,$l->name,DateToString($l->modify), $i).$form->Addtimer($l->modify,'town.php?tid='.$town->id);          $form->AddModal("m$i", $l->name, sprintf('<img src="img/eli/%s.gif" alt="%s" class="i57" />',$l->eid,$l->name). $l->desc.'<br />'.      sprintf($lang['EffectUntil'],DateToString($l->modify)), $link);     $i1++;     $i++;    }    else    {     $e2[$i2] = sprintf('<img src="img/eli/%s.gif" alt="%s %s" class="i30s" onclick="modal.Show(\'m%d\');" />',      $l->eid,$l->name,DateToString($l->modify), $i).$form->Addtimer($l->modify,'town.php?tid='.$town->id);           $form->AddModal("m$i", $l->name, sprintf('<img src="img/eli/%s.gif" alt="%s" class="i57" />',$l->eid,$l->name).$l->desc.'<br />'.      sprintf($lang['EffectUntil'],DateToString($l->modify)));     $i++;     $i2++;    }   }   if($i1)    echo '<center>'.$lang['Bad'].'</center>'.implode('<br />',$e1);   if($i2)    echo '<center>'.$lang['Good'].'</center>'.implode('<br />',$e2);   echo '</div></div>';  }  if($account->IsDeleting())  {      printf('<div class="training" style="width: 75px;">%s %s</div>',$lang['DelAccount'],          $form->Addtimer($account->IsDeleting()),'index.php');  }  elseif($account->training <24)  {   $t = $mission->GetTraining();   $form->AddModal('mission',$lang['mission'].' '.$t['id'],$t['com'],$t['reward']);   printf('<div class="training"><img class = "i24s" src="img/all/t.gif" onclick="modal.Show(\'mission\');" alt = "%s" /></div>',    $lang['mission']);  }  $list = $town->GetTroops();  if(count($list) or $town->IsBlockade())  {   echo '<div class="battleInfo">';      if($town->IsBlockade())          printf('<center><a href="building.php?id=19"><BLINK>%s</BLINK></a></center><br />',              $lang['Blockade']);      if(count($list))      {          if($list[0][0])              printf('<a href="building.php?id=19"><img src="img/troop/ap.gif" alt="%s" class="i30s"  /> %s %s</a><br />',                  $lang['Send'],$list[0][0],$form->Addtimer($list[1][0], 'town.php'));          if($list[0][1])              printf('<a href="building.php?id=19"><img src="img/troop/dp.gif" alt="%s" class="i30s"  /> %s %s</a><br />',                  $lang['Return'],$list[0][1],$form->Addtimer($list[1][1], 'town.php'));          if($list[0][2])              printf('<a href="building.php?id=19"><img src="img/troop/un.gif" alt="%s" class="i30s"  /> %s %s</a><br />',                  $lang['Attacks'],$list[0][2],$form->Addtimer($list[1][2], 'town.php'));      }         echo '</div>';  }  ?>
<a href="building.php?id=19"><img src="img/troop/ap.gif" alt="%s" class="i30s"  /></a><br />
<div style="z-index:0; width:780px;height:606px; position:absolute; top:0px; left:0px;">
<img src="img/tow/mainTown.jpg" />
<?php  $fix = $fix =  array(1,2,3,4,5,26,27);  $rArr = array(4,7,8,9,11,12,13,14,21,22,23,24);  $lArr = array(1,2,3,5,10,15,16,17,18,19,20,25);  $i =0;  $wonder = false;  $frozen = $town->Frozen();  foreach($rArr as $l)  {   $b = "b$l";   $u = "u$l";   if($town->won and ($l == 7 or $l == 8))   {    if($l == 7)    {     if($town->$b)      printf('<img id="tbi32" src="img/tow/sma/32_0_%d.gif" class="SocketWonder"  alt="%s"/>',       $l, $l, !$town->$u ? 1 : 0, $lang['b'.$town->$b]);     else      printf('<img id="tbi32" src="img/tow/sma/ewander.gif" class="SocketWonder"  alt="%s"/>',       $l, $l, $lang['Empty']);    }   }   elseif($town->$b)    printf('<img id="tbi%d" src="img/tow/sma/%s_0_%d.gif" class="Socket%d"  alt="%s"/>',     $l, $town->$b, $frozen or !$town->$u ? 1 : 0, $l, $lang['b'.$town->$b]);    else    printf('<img id="tbi%d" src="img/tow/sma/eb.gif" class="Socket%d"  alt="%s"/>',$l, $l, $lang['Empty']);  }  foreach($lArr as $l)  {   $b = "b$l";   $u = "u$l";   if($town->$b)    printf('<img id="tbi%d" src="img/tow/sma/%s_1_%d.gif" class="Socket%d"  alt="%s"/>',     $l, $town->$b, $frozen or !$town->$u ? 1 : 0, $l, $lang['b'.$town->$b]);    else    printf('<img id="tbi%d" src="img/tow/sma/eb.gif" class="Socket%d"  alt="%s"/>',$l, $l, $lang['Empty']);  }    if($town->b6)   printf('<img id="tbi6" src="img/tow/sma/6_0_%d.gif" class="Socket6"  alt="%s"/>',    $frozen or !$town->u6 ? 1 : 0, $lang['b6']);  else   printf('<img id="tbi6" src="img/tow/sma/eb.gif" class="Socket6"  alt="%s"/>',$lang['Empty']);    if($town->b26)   printf('<img id="tbi26" src="img/tow/sma/b26_%d.gif" class="Socket26"  alt="%s"/>',    $frozen or !$town->u26 ? 1 : 0, $lang['b26']);  else   printf('<img id="tbi6" src="img/tow/sma/ew.gif" class="SocketE26"  alt="%s"/>',$lang['Empty']);    if($town->b27)   printf('<img id="tbi27" src="img/tow/sma/b27_%d.gif" class="Socket27"  alt="%s"/>',    $frozen or !$town->u27 ? 1 : 0, $lang['b27']);  else   printf('<img id="tbi6" src="img/tow/sma/et.gif" class="SocketE27"  alt="%s"/>',$lang['Empty']);    ?>
</div>
<div style="z-index:30;width:780px;height:606px; position:absolute; top:0px; left:0px;"><img src="img/tow/fakeMainTown.png" usemap="#townBuilding" />
<map name="townBuilding" id="townBuilding">
<?php  for($i = 1; $i < 28 ;$i++)  {   $b = "b$i";   $u = "u$i";   if($town->won and ($i == 7 or $i == 8))   {    if($i== 7)    {     if($town->$b)     {      printf('<area id="bu%d" %s href="building.php?bid=%d" class="cord" alt="%s">', $i, $$mapArray[32][1], $lang['b32']);      $form->AddText("buw",sprintf($lang['BuildingInfo'],$lang['b32'],$town->$u));     }     else     {      printf('<area id="buw" %s href="build.php?sid=%d" class="cord">', $mapArray[32][0], $i);      if(!$form->IsAddedText("buw"))      $form->AddText("buw",$lang['NewWonder']);     }    }   }   elseif($i == 6)   {    if($town->$b)    {     printf('<area id="bu6" %s href="building.php?bid=%d" class="cord" alt="%s">', $mapArray[$i - 1][1], $i, $lang['b6']);     $form->AddText("bu6",sprintf($lang['BuildingInfo'], $lang['b6'], $town->$u));    }    else    {     printf('<area id = "bue6" %s href="build.php?sid=%d" class="cord" alt="%s">', $mapArray[$i - 1][0], $i, $lang['Eb6']);     $form->AddText("bue6", $lang['Eb6']);    }     }   elseif($i == 26)   {    if($town->$b)    {     printf('<area id="bu26" %s href="building.php?bid=%d" class="cord" alt="%s">', $mapArray[$i - 1][1], $i,$lang['b26']);     $form->AddText("bu26",sprintf($lang['BuildingInfo'],$lang['b26'],$town->$u));    }    else    {     printf('<area id = "bue26" %s href="build.php?sid=%d" class="cord" alt="%s">', $mapArray[$i - 1][0], $i, $lang['Eb26']);     $form->AddText("bue26", $lang['Eb27']);    }   }   elseif($i == 27)   {    if($town->$b)    {     printf('<area id="bu27" %s href="building.php?bid=%d" class="cord" alt="%s">', $mapArray[$i - 1][1], $i,$lang['b27']);     $form->AddText("bu27",sprintf($lang['BuildingInfo'],$lang['b27'],$town->$u));    }    else    {     printf('<area id = "bue27" %s href="build.php?sid=%d" class="cord" alt="%s">', $mapArray[$i - 1][0], $i, $lang['Eb27']);     $form->AddText("bue27", $lang['Eb26']);    }   }   elseif($town->$b)   {    printf('<area id="bu%d" %s href="building.php?bid=%d" class="cord" alt="%s">', $i, $mapArray[$i - 1][1], $i,$lang['b'.$town->$b]);    if(!$form->IsAddedText("bu$i"))     $form->AddText("bu$i",sprintf($lang['BuildingInfo'],$lang['b'.$town->$b],$town->$u));   }   else   {    if(in_array($i,$fix))     printf('<area id = "bue%d" %s href="build.php?sid=%d" class="cord" alt="%s">',$i, $mapArray[$i - 1][0], $i, $lang['NewBuilding'].' '.$lang['b'.$i]);    else    printf('<area id = "bue" %s href="build.php?sid=%d" class="cord" alt="%s">', $mapArray[$i - 1][0], $i, $lang['Empty']);    if(!$form->IsAddedText("bue"))     $form->AddText("bue",$lang['NewBuilding']);   }  }  ?>
</map>
</div>
	
</div>
<div class="armyInfo"><table width="760px"><tr>
<?php  $sql = $dbo->ExectueQuery(sprintf('SELECT SUM( `su`.`t1` ) AS `t1` , SUM( `su`.`t2` ) AS `t2` , SUM( `su`.`t3` ) AS `t3` , SUM( `su`.`t4` ) AS `t4` , SUM( `su`.`t5` ) AS `t5` , SUM( `su`.`t6` ) AS `t6` , SUM( `su`.`t7` ) AS `t7` , SUM( `su`.`t8` ) AS `t8` , SUM( `su`.`t9` ) AS `t9` , SUM( `su`.`t10` ) AS `t10` , SUM( `su`.`t11` ) AS `t11` , SUM( `su`.`t12` ) AS `t12` , SUM( `su`.`t13` ) AS `t13` , SUM( `su`.`t14` ) AS `t14` , SUM( `su`.`h` ) AS `h` ,`a`.`kind`  FROM `%1$stroop_su` AS `su`  LEFT JOIN `%1$saccount` AS `a` ON ( `su`.`pid1` = `a`.`id` )  WHERE `su`.`mid` = \'%2$s\' GROUP BY `a`.`kind`',DB_PERFIX,$town->mid));  $list = array();  while($row = $dbo->Read($sql))   $list[$row['kind']] = $row;  for($i = 1;$i<15;$i++)  {   $t = 't'.$i;   printf('<td><img src="img/troop/s/%s_%d.gif" class = "i24" alt = "%s"/>  %d</td>',$account->kind,$i,$troops[$account->kind][$i][6],    $town->$t + (isset($list[$account->kind]) ? $list[$account->kind][$t] : 0));  }  $dbo->Cancel($sql);  printf('<td><img src="img/troop/h.gif" class = "i24" alt = "%s"/>  %s</td></tr>',$lang['Hero'],$town->h);  foreach($list as $l)  {   if($l['kind'] == $account->kind)    continue;   echo '<tr>';   for($i = 1;$i<15;$i++)   {    $t = 't'.$i;    printf('<td><img src="img/troop/s/%s_%d.gif" class = "i24" alt = "%s"/>  %d</td>',$l['kind'],$i, $troops[$l['kind']][$i][6], $l[$t]);   }    printf('<td><img src="img/troop/h.gif" class = "i24" alt = "%s"/>  %s</td></tr>',$lang['Hero'],$l['h']);  }  ?></tr></table>
</div>
 
<?php  $form->Footer();  $session->Save();  ?>
