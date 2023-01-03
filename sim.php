<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/object.php');  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/troop.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $plus = $account->GetPlus();  $hero = $account->GetHero();  $pm = new PM($session->aid);  $union = new Union($account->uid);  $town = $account->GetDefaultTown();  $form->Header(array('sim'),array('sim'));  ?>
<div class="bgTop"></div>
<div class="bgMain">
<form action="sim.php" method="post">
<table>
<tr><td colspan="6" class="center" style="background-color:#889E1E;"><?php echo $lang['dSimulator'];?></td></tr>
<tr><td colspan="6" class="center tdBg"><?php echo $lang['Attacker'];?></td></tr>
<tr><td><?php echo $lang['t1'];?></td><td><input name = "tak" type="radio" value="1" onChange="ShowAttaker(this);"/></td>
<td><?php echo $lang['t2'];?></td><td><input name = "tak" type="radio" value="2" onChange="ShowAttaker(this);"/></td>
<td><?php echo $lang['t3'];?></td><td><input name = "tak" type="radio" value="3" onChange="ShowAttaker(this);"/></td></tr>
</table>
<?php  for($i = 1;$i < 4;$i++)  {   printf('<table id = "atk_%d" border="1" style="display:none;"><tr>',$i);   for($j = 1;$j<15;$j++)    printf('<td><img id = "ita%1$d_%2$d" src = "img/troop/s/%1$d_%2$d.gif" alt = "%3$s" class ="i30"/></td>',$i,$j,$troops[$i][$j][6]);   echo '</tr><tr>';   for($j = 1;$j<15;$j++)    printf('<td><input type = "text" id = "at%1$d_%2$d" name = "at%1$d_%2$d" style="width:45px;"/></td>',$i,$j);      echo '</tr></table>';  }  ?>
<table>
<tr><td colspan="6" class="center tdBg"><?php echo $lang['Defendant'];?></td></tr>
<tr><td><?php echo $lang['t1'];?></td><td><input name = "tdk" type="radio" value="1" onChange="ShowBaseDefendant(this);"/></td>
<td><?php echo $lang['t2'];?></td><td><input name = "tdk" type="radio" value="2" onChange="ShowBaseDefendant(this);"/></td>
<td><?php echo $lang['t3'];?></td><td><input name = "tdk" type="radio" value="3" onChange="ShowBaseDefendant(this);"/></td></tr>
</table>
<?php  for($i = 1;$i < 4;$i++)  {   printf('<table id = "dbtk_%d" border="1" style="display:none;"><tr>',$i);   for($j = 1;$j<15;$j++)    printf('<td><img id = "ita%1$d_%2$d" src = "img/troop/s/%1$d_%2$d.gif" alt = "%3$s" class ="i30"/></td>',$i,$j,$troops[$i][$j][6]);   echo '</tr><tr>';   for($j = 1;$j<15;$j++)    printf('<td><input type = "text" id = "dt%1$d_%2$d" name = "dt%1$d_%2$d" style="width:45px;"/></td>',$i,$j);      echo '</tr></table>';  }  ?>
<table><tr><td colspan="14" class="center tdBg"><?php echo $lang['Support'];?></td></tr>
<tr>
<td><?php echo $lang['t1'];?></td><td><input name = "tdk1" type="checkbox" value="1" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t2'];?></td><td><input name = "tdk2" type="checkbox" value="2" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t3'];?></td><td><input name = "tdk3" type="checkbox" value="3" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t4'];?></td><td><input name = "tdk4" type="checkbox" value="4" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t5'];?></td><td><input name = "tdk5" type="checkbox" value="5" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t6'];?></td><td><input name = "tdk6" type="checkbox" value="6" onChange="ShowDefendant(this);"/></td>
<td><?php echo $lang['t7'];?></td><td><input name = "tdk7" type="checkbox" value="7" onChange="ShowDefendant(this);"/></td></tr>
</table>
<table>
<tr><td><?php echo $lang['b26'];?></td><td><input type="text" name="wall" id = "wall" style="width:50px;" /></td>
<td><?php echo $lang['b27'];?></td><td><input type="text" name="tower" id = "tower" style="width:50px;" /></td></tr>
</table>
<?php  for($i = 1;$i < 8;$i++)  {   printf('<table id = "dtk_%d" border="1" style="display:none;"><tr>',$i);   for($j = 1;$j<15;$j++)    printf('<td><img id = "itd%1$d_%2$d" src = "img/troop/s/%1$d_%2$d.gif" alt = "%3$s" class ="i30"/></td>',$i,$j,$troops[$i][$j][6]);   echo '</tr><tr>';   for($j = 1;$j<15;$j++)    printf('<td><input type = "text" id = "dts%1$d_%2$d" name = "dts%1$d_%2$d" style="width:45px;"/></td>',$i,$j);    echo '</tr></table>';  }  ?>
<table>
<tr><td colspan="4" class="center tdBg"><?php echo $lang['Kind'];?></td></tr>
<tr><td><?php echo $lang['Rapine'];?></td><td><input name = "kwar" type="radio" value="0" checked="checked"/></td>
<td><?php echo $lang['Attack'];?></td><td><input name = "kwar" type="radio" value="1" /></td></tr>
<tr><td colspan="4"><input type="submit" value="<?php echo $lang['Show'];?>" /></td></tr>
</table>
</form>
<?php  if(isset($_POST['tak']) and isset($_POST['tdk']))  {   $_POST['tak'] = ValidNumber($_POST['tak'], true);   $_POST['tdk'] = ValidNumber($_POST['tdk'], true);   $_POST['wall'] = isset($_POST['wall']) ? ValidNumber($_POST['wall'], true) : 0;   $_POST['tower'] = isset($_POST['tower']) ? ValidNumber($_POST['tower'], true) : 0;   $_POST['kwar'] =  isset($_POST['kwar']) ? ValidNumber($_POST['kwar'], true) : 0;   if($_POST['wall'] > 20)    $_POST['wall'] = 20;   $_POST['wall'] *=  1.25;   if($_POST['tower'] > 10)    $_POST['tower'] = 10;   $_POST['tower'] *=  1.25;   for($i = 1; $i<8;$i++)   {    $t = 'tdk'.$i;    $_POST[$t] = isset($_POST[$t]) ? ValidNumber($_POST[$t],true) : 0;          if($_POST[$t]> 7)              $_POST[$t] = 0;   }   if(!$_POST['tak'])    $_POST['tak'] = 1;   if(!$_POST['tdk'])    $_POST['tdk'] = 1;      if($_POST['tdk'] > 3)          $_POST['tdk'] = 3;      if($_POST['tak'] > 3)          $_POST['tak'] = 3;      $bt1 = new BattelTroop($_POST['tak']);      $bt2 = new BattelTroop($_POST['tdk']);      $temp = array('t1' => 0,'t2' => 0,'t3' => 0,'t4' => 0,'t5' => 0,'t6' => 0,'t7' => 0,          't8' => 0,'t9' => 0,'t10' => 0,'t11' => 0,'t12' => 0,'t13' => 0,'t14' => 0,'h' => 0);      $up = array('up1' => 0,'up2' => 0,'up3' => 0,'up4' => 0,'up5' => 0,'up6' => 0,          'up7' => 0,'up8' => 0,'up9' => 0,'up10' => 0,'up11' => 0);      $tro = array();      $tro[-1] = $temp;      $tro[0] = $temp;      for($i = 1; $i < 8; $i++)      {          $t = 'tdk'.$i;          if($_POST[$t])          {              $tro[$i]['c'] = 0;              $tro[$i]['t'] = $temp;          }          else              $tro[$i]['c'] = 1;      }      for($i = 1;$i < 15; $i++)      {          $t = 't'.$i;          $tro[-1][$t] = (isset($_POST['at'.$_POST['tak'].'_'.$i]) ? ValidNumber($_POST['at'.$_POST['tak'].'_'.$i],true) : 0);          $tro[0][$t] = (isset($_POST['dt'.$_POST['tdk'].'_'.$i]) ? ValidNumber($_POST['dt'.$_POST['tdk'].'_'.$i],true) : 0);          for($j = 1; $j < 8; $j++)          {              $t2 = 'tdk'.$j;              if(!$_POST[$t2])                  continue;              $tro[$j]['t'][$t] = (isset($_POST['dts'.$j.'_'.$i]) ? ValidNumber($_POST['dts'.$j.'_'.$i],true) : 0);          }      }      $bt1->LoadRow($tro[-1],$up);      $attack = $bt1->AttackPoints(0,0,0,1);      $bt2->LoadRow($tro[0],$up);      $InWar = $bt1->GetUsed();      $defence = $bt2->DefensePoints($_POST['wall'],0,0,0,$attack,1);      $InWar = $bt2->GetUsed();      $tdp = $bt2->GetPoints();      for($i=1;$i<8;$i++)      {          if($tro[$i]['c'])              continue;          $tro[$i]['bt'] = new BattelTroop($i);          $tro[$i]['bt']->LoadRow($tro[$i]['t'], $up);          $InWar += $tro[$i]['bt']->GetUsed();          $defence = $defence | $tro[$i]['bt']->DefensePoints($_POST['wall'],0,0,0,$attack,1);          $t = $tro[$i]['bt']->GetPoints();          $tdp['all'] += $t['all'];          $tdp[1] += $t[1];          $tdp[2] += $t[2];          $tdp[3] += $t[3];      }      $atp = $bt1->GetPoints();  ?>
<table border="1">
    <tr>
        <td><img src="img/troop/ap.gif"  class="i30" alt = "<?php echo $lang['AP'];?>"/></td>
        <td><img src="img/troop/ap1.gif"  class="i30" alt = "<?php echo $lang['tap1'];?>"/></td>
        <td><img src="img/troop/ap2.gif"  class="i30" alt = "<?php echo $lang['tap2'];?>"/></td>
        <td><img src="img/troop/ap3.gif"  class="i30" alt = "<?php echo $lang['tap3'];?>"/></td>
        <td><img src="img/troop/dp.gif"  class="i30" alt = "<?php echo $lang['DP'];?>"/></td>
        <td><img src="img/troop/dp1.gif"  class="i30" alt = "<?php echo $lang['tdp1'];?>"/></td>
        <td><img src="img/troop/dp2.gif"  class="i30" alt = "<?php echo $lang['tdp2'];?>"/></td>
        <td><img src="img/troop/dp3.gif"  class="i30" alt = "<?php echo $lang['tdp3'];?>"/></td>
    </tr>
    <tr>
        <td><?php echo round($atp['all']);?></td>
        <td><?php echo round($atp[1]);?></td>
        <td><?php echo round($atp[2]);?></td>
        <td><?php echo round($atp[3]);?></td>
        <td><?php echo round($tdp['all']);?></td>
        <td><?php echo round($tdp[1]);?></td>
        <td><?php echo round($tdp[2]);?></td>
        <td><?php echo round($tdp[3]);?></td>
    </tr>
</table>
<?php        $loseA = 1;      $loseD = 1;      if($atp['all'])      {          $win = ($atp['all'] > $tdp['all']);          if($_POST['kwar'])          {              $loseA = ($atp['all'] - $tdp['all'])/($atp['all'] + $tdp['all']);              $loseD = ($tdp['all'] - $atp['all'])/($atp['all'] + $tdp['all']);            }          else          {              $loseA = ($atp['all'] / ( $atp['all'] + $tdp['all']));              $loseD = ($tdp['all'] / ( $atp['all'] + $tdp['all']));          }      }      $bt1->Battle($loseA,false);      $bt2->Battle($loseD, false);      $form->ShowReportTroops(explode(':',RE_ATTAKER_T.':0:0:'.implode(':',$bt1->GetReprot())));      $form->ShowReportTroops(explode(':',RE_DEFENDANT_T.':0:0:'.implode(':',$bt2->GetReprot())));      for($i=1;$i<8;$i++)      {          if($tro[$i]['c'])              continue;          $tro[$i]['bt']->Battle($loseD,false);          $form->ShowReportTroops(explode(':',RE_SUPPORT_T.':0:0:'.implode(':',$tro[$i]['bt']->GetReprot())));      }  }  ?>
</div>
<div class="bgBelow"></div>
<?php  $form->Footer();  $session->Save();  ?>