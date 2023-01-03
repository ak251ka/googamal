<?php  if(!defined('NEW_INCLUDE'))  {   $path = $_SERVER['DOCUMENT_ROOT'];   set_include_path(get_include_path() . PATH_SEPARATOR . $path);   define('NEW_INCLUDE', 1);  }  require_once('lib/defines.php');  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lng/per.php');  require_once('eng/sec/session.php');  require_once('lib/utility.php');  function IntStrNeg($value)  {   return "$value";  }  if($session->GetType() != LOG)  {   echo 'LogIn';   return;  }  $list = array();  $x = isset($_POST['x']) ? (int)$_POST['x'] : 0;  $y = isset($_POST['y']) ? (int)$_POST['y'] : 0;  $sql = $dbo->ExectueQuery(  sprintf('SELECT * FROM `%smap_t` WHERE (`y` BETWEEN %s and %s ) and (x between %s and %s )',  DB_PERFIX, $y - 3, $y + 3, $x - 3, $x + 3));  $i = 0;  $j = 0;  $map = array();  $info = array();  ?>
<div class="m_con">
<div class="num_sho" >
		<?php        for ($k = 3; $k >= -3; $k--){     $st_x = (($k + 3) * 57)+50;     $st_y = (3 - $k);          printf('<div style="position:absolute;left:%dpx;top:%dpx;width:57px;">%d</div>', $st_x,$st_y,$x+$k);    ?>
			
		<?php        }        for ($j = 3; $j >= -3; $j--){     $st_x = ($j + 3);     $st_y = 40 + (3 - $j) * 57;     printf('<div style="position:absolute;left:%dpx;top:%dpx;width:57px;">%d</div>', $st_x,$st_y,$y+$j);         }   ?>
</div>
<div class="img_sho">
<?php  $Texts = array();  $ty = 3;    while($row = $dbo->Read($sql))   $map[$row['x']][$row['y']] = $row;    for($j = $y + 3;$j>=$y - 3;$j--)  {  $tx = -3;   for($i =$x - 3;$i <= $x + 3; $i++)   {    if(!isset($map["$i"]["$j"]))    {     printf('<img id="m%s%s" alt="%s" src="img/map/e.gif" class = "map_i" />',IntStrNeg($i),IntStrNeg($j),$lang['Unknown']);     continue;    }    switch($map["$i"]["$j"]['kind'])    {     case MAP_GAP:      printf('<img id = "map_gap" alt="%s" src="img/map/1_%s.gif" class = "map_i" />',$lang['Gap'],$map["$i"]["$j"]['subkind']);      $Texts['c'.NegPos($ty).NegPos($tx)] = "<table style='color:black;' class='tooltipTable'><tr><td>".$lang['Gap']."</td></tr></table>";      break;     case MAP_CLOONEY:      if($map["$i"]["$j"]['cap'])      {       $temp = $dbo->ExectueRow(       sprintf('SELECT `c`.`id` ,`c`.`kind`, `c`.`pid` , `c`.`uid` , `t`.`name` AS `tname` , `t`.`pop` , `a`.`name` AS `aname` , `u`.`name` AS `uname` FROM `%sclooney` AS `c` LEFT JOIN `%stown` AS `t` ON ( `c`.`tid` = `t`.`id` ) LEFT JOIN `%saccount` AS `a` ON ( `c`.`pid` = `a`.`id` ) LEFT JOIN `%sunion_b` AS `u` ON ( `c`.`uid` = `u`.`id` ) WHERE `c`.`id` = \'%s\'',         DB_PERFIX,DB_PERFIX,DB_PERFIX,DB_PERFIX, $map["$i"]["$j"]['subid']));       printf('<img alt="%s" src="img/map/2_0.gif" class = "map_i"/>',$lang['ClooneyCapture']);       $Texts['c'.NegPos($ty).NegPos($tx)] = "<table style='color:black;' class='tooltipTable'><tr><td colspan='2'>".$lang['ClooneyCapture']."</td></tr><tr><td>".$lang['Player']."</td><td>".$temp['aname']."</td></tr><tr><td>".$lang['Town']."</td><td>".$temp['tname']."</td></tr><tr><td>".$lang['Union']."</td><td>".$temp['uname']."</td></tr><tr><td>".$lang['Pop']."</td><td>".$temp['pop']."</td></tr></table>";      }      else      {       printf('<img alt="%s" src="img/map/2_0.gif" class = "map_i"/>',$lang['Clooney']);       $Texts['c'.NegPos($ty).NegPos($tx)] = "<table style='color:black;' class='tooltipTable'><tr><td>".$lang['Clooney']."</td></tr></table>";      }      break;     case MAP_TOWN:      if($map["$i"]["$j"]['subid'])      {       $temp = $dbo->ExectueRow(        sprintf('SELECT `t`.`id` , `t`.`pid` , `t`.`uid` , `t`.`name` AS `tname` , `a`.`name` AS `aname` , `u`.`name` AS `uname` , `t`.`pop` , `a`.`kind` FROM `%stown` AS `t` LEFT JOIN `%saccount` AS `a` ON ( `t`.`pid` = `a`.`id` ) LEFT JOIN `%sunion_b` AS `u` ON ( `t`.`uid` = `u`.`id` ) WHERE `t`.`id` = \'%s\'',         DB_PERFIX,DB_PERFIX,DB_PERFIX, $map["$i"]["$j"]['subid']));                 $Texts['c'.NegPos($ty).NegPos($tx)] = "<table style='color:black;' class='tooltipTable'><tr><td>".$lang['Player']."</td><td>".$temp['aname']."</td></tr><tr><td>".$lang['Town']."</td><td>".$temp['tname']."</td></tr><tr><td>".$lang['Union']."</td><td>".$temp['uname']."</td></tr><tr><td>".$lang['Pop']."</td><td>".$temp['pop']."</td></tr></table>";       if($temp['pop'] < 100)        printf('<img alt="%s" src="img/map/3_4.gif" class = "map_i"/>', $temp['tname']);       elseif($temp['pop'] <= 300)        printf('<img alt="%s" src="img/map/3_5.gif" class = "map_i"/>', $temp['tname']);       else        printf('<img alt="%s" src="img/map/3_6.gif" class = "map_i"/>', $temp['tname']);      }      else      {       printf('<img alt="%s" src="img/map/3_%s.gif" class = "map_i"/>',$lang['EmptyLand'],$map["$i"]["$j"]['subkind']);       $Texts['c'.NegPos($ty).NegPos($tx)] = "<table style='color:black;' class='tooltipTable'><tr><td>".$lang['EmptyLand']."</td></tr></table>";      }      break;    }    $tx++;   }   printf('<br />');   $ty--;  }  $dbo->Cancel($sql);  $session->Save();  ?>
</div>
<div class="Map-Arrow">

        <img src="img/map/arrow.gif" border="0" usemap="#Map">
        <map name="Map" id="Map">
<?php    $i = 26;  for ($k = 3; $k >= -3; $k--)  {   for ($j = -3; $j <= 3; $j++)   {    if(abs($x+$j) > 400 or abs($y+$k) > 400)     continue;    $st_x = 127 + (($j + 3)*58);    $st_y = 123 + ((3 - $k)*58);    $coords = ($st_x  . ',' . $st_y . ','. $i);    switch($map[(string)($x+$j)][(string)($y+$k)]['kind'] )    {     case MAP_GAP:      printf('<area class="cmap" shape="circle" id="c%s%s" coords="%s">',NegPos($k),NegPos($j),$coords);      break;     case MAP_TOWN:      if($map[(string)($x+$j)][(string)($y+$k)]['subid'])       printf('<area class="cmap" shape="circle" id="c%s%s" coords="%s" href="detail.php?kind=town&amp;id=%s">',NegPos($k),NegPos($j),$coords,          $map[(string)($x+$j)][(string)($y+$k)]['subid']);      else       printf('<area class="cmap" shape="circle" id="c%s%s" coords="%s" href="detail.php?kind=empty&amp;id=%s">',NegPos($k),NegPos($j),$coords,          $map[(string)($x+$j)][(string)($y+$k)]['id']);      break;     case MAP_CLOONEY:      printf('<area class="cmap" shape="circle" id="c%s%s" coords="%s" href="detail.php?kind=clooney&amp;id=%s">',NegPos($k),NegPos($j),$coords,         $map[(string)($x+$j)][(string)($y+$k)]['subid']);      break;    }     }  }    ?>
 <area shape="rect" coords="288,4,325,69" href="javascript: Map.IncY();" class="cmap" id="cp4n1" <?php $Texts['cp4n1'] =$lang['North']; ?>>
 <area shape="rect" coords="288,533,328,600" href="javascript: Map.DecY();" class="cmap" id="cp4n2" <?php $Texts['cp4n2'] =$lang['South']; ?>>
 <area shape="rect" coords="526,260,596,301" href="javascript: Map.IncX();" class="cmap" id="cp4n3" <?php $Texts['cp4n3'] =$lang['East']; ?>>
 <area shape="rect" coords="5,260,73,299" href="javascript: Map.DecX();" class="cmap" id="cp4n4" <?php $Texts['cp4n4'] =$lang['West']; ?>>
 </map>
</div>
<div class="pos">
<table>
<tr>
	<td>X :</td><td>
				<input type="text" value="<?php echo $x;?>" name="tbX" id = "tbX"/></td>
	<td>Y :</td><td>
				<input type="text" value="<?php echo $y;?>" name="tbY" id = "tbY"/></td>
	<td class="center">
				<input type="submit" value="<?php echo $lang['Show'];?>" onclick="Map.Start();"/></td>
</tr>
</table>
</div>
</div>
<script type="text/javascript" language="javascript" id="runscript">
function setTextsValue(){
	<?php    foreach($Texts as $key =>$value)     printf('texts["%s"] = "%s";',$key, $value);   ?>
}
</script>