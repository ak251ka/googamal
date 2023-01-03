<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  require_once('.//lib/defines.php');  require_once('.//lib/utility.php');  ?>
<table class="h_table" style="float:right;margin-right:60px;width:320px;direction:rtl;">

<?php  printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$lang['Index'],$lang['Name'],$lang['Peculiarities'],$lang['Pop']);  $sql = $dbo->ExectueQuery(sprintf('SELECT `t`.`id`,`t`.`name`,`t`.`pop`,`t`.`mid`,`m`.`x`,`m`.`y` FROM `%stown` AS `t` LEFT JOIN `%smap_t` AS `m` ON (`t`.`mid` = `m`.`id`) WHERE `t`.`pid` = \'%s\'',DB_PERFIX,DB_PERFIX,$_GET['id']));  $i = 1;  while($row = $dbo->Read($sql))  {   printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$i++,$form->TownLink($row['id'],$row['name']),    $form->MapLink($row['x'],$row['y'], sprintf('(%s , %s)', $row['x'], $row['y'])) , $row['pop']);  }  $dbo->Cancel($sql);  $text = $dbo->ExectueScaler(sprintf('SELECT `statement` FROM `%sprofile` WHERE `owner` = \'%s\' AND `kind` = \'%s\'',   DB_PERFIX,$_GET['id'],PLAYER_KIND),'statement');  $medal = $account->GetMedal($_GET['id']);  ?>
</table>
<table class="h_table" style="float:left;margin-left:60px;width:320px;">
  <tr>
    <td>
		<?php echo $lang['Medals'];?>
	</td>
      <?php        if(count($medal))        {            $i =0;            foreach($medal as &$m)            {                if($i % 5 == 0)                    echo '</tr><tr>';                $i++;                printf('<td><img id = "med_%d" src="img/medal/%s.gif" class="i57" alt="M"/></td>',$i,$m->medal);                $form->AddText("med_$i",$m->text);            }            while($i % 5)            {                echo '<td>&nbsp;</td>';                $i++;            }        }        else            printf('</tr><tr><td colspan="5">%s</td></tr>',$lang['NoRecord']);        ?>
  </tr>
</table>
<div style="clear:both"></div>
<?php  printf('<center>%s</center><div class = "tprofile">%s</div>',$lang['Description'],$form->Replace($text));  ?>