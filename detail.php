<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('lib/dbo.php');  require_once('lib/object.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/town.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  require_once('eng/main/troop.php');  require_once('eng/main/rank.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  $show = isset($_GET['kind']) ? $_GET['kind'] : 'town';  $id = isset($_GET['id'])  ? $_GET['id'] : 0;  $form->Header(array('detail','hero','editor'),array('hero','editor'));  ?>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="m_d_cont">
<?php  if(!$id)  {   $form->BlockPage();   echo '</div><img src="img/m2.png"  />';   $form->Footer();   $session->Save();     return;  }  switch($show)  {   case 'town':    $info = $dbo->ExectueRow(sprintf('SELECT `t` . * , `a`.`name` AS `aname`, `a`.`kind` AS `akind`, `u`.`name` AS `uname` , `m`.`x` , `m`.`y` FROM `%1$stown` AS `t` LEFT JOIN `%1$saccount` AS `a` ON ( `t`.`pid` = `a`.`id` ) LEFT JOIN `%1$sunion_b` AS `u` ON ( `t`.`uid` = `u`.`id` ) LEFT JOIN `%1$smap_t` AS `m` ON ( `t`.`mid` = `m`.`id` ) WHERE `t`.`id` = \'%2$s\'', DB_PERFIX, $id));     break;   case 'clooney':    $info = $dbo->ExectueRow(sprintf('SELECT `c`.*,`a`.`name` AS `aname`,`a`.`kind` AS `akind`, `t`.`name` AS `tname`, `u`.`name` AS `uname`,`m`.`x`,`m`.`y` FROM `%1$sclooney` AS `c` LEFT JOIN `%1$saccount` AS `a` ON (`c`.`pid` = `a`.`id`) LEFT JOIN `%1$stown` AS `t` ON (`c`.`tid` = `t`.`id`) LEFT JOIN `%1$sunion_b` AS `u` ON (`c`.`uid` = `u`.`id`) LEFT JOIN `%1$smap_t` AS `m` ON (`c`.`mid` = `m`.`id`) WHERE `c`.`id` = \'%2$s\'',DB_PERFIX, $id));    break;   case 'player':    $info = $dbo->ExectueRow(sprintf('SELECT `a`.*, `u`.`name` AS `uname` , (SELECT COUNT( * ) FROM `%1$stown` WHERE `pid` = \'%2$s\' ) AS `towns` FROM `%1$saccount` AS `a` LEFT JOIN `%1$sunion_b` AS `u` ON ( `a`.`uid` = `u`.`id` ) WHERE `a`.`id` = \'%2$s\'',     DB_PERFIX, $id));    $power = $hero->GetPowerDesc();    $list = array();    $sql = $dbo->ExectueQuery(sprintf('SELECT `hi`.*,`i`.`name`,`i`.`t1`,`i`.`t2`,`i`.`t3`,`i`.`t4` FROM `%1$shero_hi` AS `hi` LEFT JOIN `%1$shero_i` AS `i` ON (`hi`.`hid` = `i`.`id`) WHERE `pid` = \'%2$s\' AND `box` < \'11\'',DB_PERFIX,$id));    while($row = $dbo->Read($sql))     $list[$row['box']] = new Object($row);    $dbo->Cancel($sql);    gc_collect_cycles();    break;   case 'empty':    $info = array();    $info = $dbo->ExectueRow(sprintf('SELECT * FROM `%smap_t` WHERE `id` = \'%s\'',     DB_PERFIX, $id));          }  if(empty($info))  {   $form->BlockPage($lang['NoRecord']);   echo '</div><img src="img/m2.png"  />';   $form->Footer();   $session->Save();   return;  }  ?>
<div class="m_d_cont_right"><?php   switch($show)  {   case 'empty':    echo '<img src="img/tow/te.png" alt ="pic" class ="img12" />';    break;   case 'town' :    printf('<img src="img/tow/t%s.png" alt ="pic" class ="img12" />', empty($info['akind']) ? '4': $info['akind']);    break;   case 'clooney':    printf('<img src="img/tow/t%s_c.png" alt ="pic" class ="img12" />', empty($info['akind']) ? '4': $info['akind']);    break;   case 'player':  ?>
<table class="h_table">
  <tr>
    <td id = "b_1_1" class="box">
    <?php  if(isset($list[1]))   echo $form->HeroItem($list[1],$power);  else   echo '&nbsp;';?>
    </td>
    <td colspan="2" rowspan="3"><img id = "face" src="<?php     printf('face.php?hfa=%s&amp;hfb=%s&amp;hfc=%s&amp;hfd=%s&amp;hff=%s&amp;hfr=%s&amp;hfm=%s&amp;hfs=%s',    $info['hfa'],$info['hfb'],$info['hfc'],$info['hfd'],    $info['hff'],$info['hfr'],$info['hfm'],$info['hfs']);?>" /></td>
    <td id = "b_7_7" class="box"><?php  if(isset($list[7]))   echo $form->HeroItem($list[7],$power);  else   echo '&nbsp;';?>
    </td>
  </tr>
  <tr>
    <td id = "b_2_2" class="box"><?php  if(isset($list[2]))   echo $form->HeroItem($list[2],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_8_8" class="box"><?php  if(isset($list[8]))   echo $form->HeroItem($list[8],$power);  else   echo '&nbsp;';?>
    </td>
  </tr>
  <tr>
    <td id = "b_3_3" class="box"><?php  if(isset($list[3]))   echo $form->HeroItem($list[3],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_9_9" class="box"><?php  if(isset($list[9]))   echo $form->HeroItem($list[9],$power);  else   echo '&nbsp;';?>
   </td>
  </tr>
  <tr>
    <td id = "b_4_4" class="box"><?php  if(isset($list[4]))   echo $form->HeroItem($list[4],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_5_5" class="box"><?php  if(isset($list[5]))   echo $form->HeroItem($list[5],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_6_6" class="box"><?php  if(isset($list[6]))   echo $form->HeroItem($list[6],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_10_10" class="box"><?php  if(isset($list[10]))   echo $form->HeroItem($list[10],$power);  else   echo '&nbsp;';?>
   </td>
  </tr>
</table>
<?php    break;  }  ?></div>

<div class="m_d_cont_left">
<?php  switch($show)  {   case 'empty':        printf('%s<br />%s<br />',$lang['EmptyLand'],     $form->MapLink($info['x'], $info['y'], sprintf('%s (%s,%s)',$lang['Peculiarities'],$info['x'],$info['y'])));    printf('<a href="attack.php?id=%s">%s</a>',$info['id'],$lang['SendTroops']);    break;   case 'town':    printf('%s<br />',     $form->MapLink($info['x'], $info['y'], sprintf('%s (%s,%s)',$lang['Peculiarities'],$info['x'],$info['y'])));    printf('<a href="attack.php?id=%s">%s</a><br />',$info['mid'],$lang['SendTroops']);          printf('<a href="building.php?id=9&amp;mid=%s">%s %s</a>',$info['mid'],$lang['Send'],$lang['Resource']);    printf('<table><tr><td>%s</td><td>%s</td></tr><tr><td>%s</td><td>%s</td></tr><tr><td>%s</td><td>%s</td></tr><tr><td>%s</td><td>%s</td></tr></table>',     $lang['Name'],$info['name'],$lang['Player'],      $form->PlayerLink($info['pid'],$info['aname']),$lang['Union'],      $form->UnionLink($info['uid'],$info['uname']),      $lang['Pop'],$info['pop']);    break;   case 'clooney':    printf('%s<br />',     $form->MapLink($info['x'], $info['y'], sprintf('%s (%s,%s)',$lang['Peculiarities'],$info['x'],$info['y'])));    printf('<a href="attack.php?id=%s">%s</a>',$info['mid'],$lang['SendTroops']);    echo '<table>';    if($info['tid'])    {     printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Name'], $form->TownLink($info['pid'],$info['aname']));     printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Town'], $form->TownLink($info['tid'],$info['tname']));     if(!empty($info['uname']))      printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Union'], $form->TownLink($info['uid'],$info['uname']));         }    else    {     printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Troops'],$lang['Number']);     for($i = 1; $i <= 14; $i++)     {      if($info['t'.$i])       printf('<tr><td><img src="img/troop/s/4_%d.gif" alt="%s" class="i24" /></td><td>%s</td></tr>',        $i, $troops[4][$i][6],$info['t'.$i]);     }    }    echo '</table>';   break;   case 'player':    echo '<table>';    if($account->id != $id)     printf('<tr><td>%s</td><td><a href="pm.php?show=nw&amp;pid=%s">%s</a></td></tr>',      $lang['NewPm'], $id, $lang['Send']);    printf('<tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    <tr><td>%s</td><td>%s</td></tr>    </table>',      $lang['Player'],$info['name'],      $lang['Union'], $form->UnionLink($info['uid'],$info['uname']),      $lang['Rank'], $rank->GetRank(DB_PERFIX.'account','pop',$id),      $lang['AP'], $info['ap'],      $lang['DP'], $info['dp'],      $lang['Town'], $info['towns'],      $lang['Pop'], $info['pop']);    break;  }  ?>
</div>
<div class="m_d_cont_left">
<?php  if($show == 'clooney' or $show == 'town')  {      $sql = $dbo->ExectueQuery(sprintf('SELECT `id`,`kind`, `l`, `modify` FROM `%sreports` WHERE `pid` = \'%s\' AND `mid` = \'%s\' AND `kind` != \'%s\' ORDER BY `modify` DESC LIMIT 0,5',    DB_PERFIX, $account->id, $info['mid'],RE_TRADE));   if($dbo->RowsNumber($sql))   {    printf ('<table><tr><td>%s</td></tr>',$lang['AttackHistory']);    while($row = $dbo->Read($sql))    {     $id = sprintf('rp%s0%s',$row['kind'],$row['l']);     if(!$form->IsAddedText($id))      $form->AddText($id, sprintf('%s %s %s',$lang['Report'],$lang['RP_K_'.$row['kind']],$lang['RP_L_'.$row['l']]));      printf('<tr><td><a href="report.php?id=%s"><img src="img/rep/%s0%s.gif" id = "%s" alt = "rp" class = "i24s" /> %s </a></td></tr>',        $row['id'],$row['kind'],$row['l'],$id,DateToString($row['modify']));    }    echo '</table>';    $dbo->Cancel($sql);    gc_collect_cycles();   }     }  ?>

</div>
<div style="clear:both;"></div>
<?php  if($show == 'player')  {   echo '<div>';      if($session->pid < 4)          require_once('temp/detail/admin.php');   elseif($session->pid == $_GET['id'])          require_once('temp/detail/owner.php');   else    require_once('temp/detail/player.php');   echo '</div>';  }  ?>
</div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>