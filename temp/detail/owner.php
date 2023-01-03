<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  require_once('.//lib/defines.php');  require_once('.//lib/utility.php');  if(isset($_POST['com']))  {   if($_POST['com'] == 'ep')   {    $_POST['msg'] = isset($_POST['msg']) ? mb_substr($_POST['msg'],0, 1024,'UTF-8') : '';    $dbo->ExectueQuery(sprintf('UPDATE `%sprofile` SET `statement` = \'%s\' WHERE `owner` = \'%s\' AND `kind` = \'%s\' LIMIT 1',     DB_PERFIX, $_POST['msg'], $account->id, PLAYER_KIND));   }   if($_POST['com'] == 'tn')   {        foreach($_POST as $key=>$value)    {     if(NoNumbers($key) == 'tid')     {      if(isset($_POST['tn'.$value]))      {       $_POST['tn'.$value] = mb_substr($_POST['tn'.$value],0, 32,'UTF-8');       if(mb_strlen($_POST['tn'.$value]))        $dbo->ExectueQuery(sprintf('UPDATE `%stown` SET `name` = \'%s\' WHERE `id` = \'%s\'',         DB_PERFIX,$_POST['tn'.$value],$value));      }           }    }   }  }  ?>
<div>
<form action="detail.php?kind=player&id=<?php echo $account->id;?>"  method="post">
<input type="hidden" name = "com" value="tn" >
<?php  $sql = $dbo->ExectueQuery(sprintf('SELECT `t`.`id`,`t`.`name`,`t`.`pop`,`t`.`mid`,`m`.`x`,`m`.`y` FROM `%stown` AS `t` LEFT JOIN `%smap_t` AS `m` ON (`t`.`mid` = `m`.`id`) WHERE `t`.`pid` = \'%s\'',DB_PERFIX,DB_PERFIX,$account->id));  ?>
<table class="h_table" style="float:right;margin-right:60px;width:320px;direction:rtl;">

<?php  printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$lang['Index'],$lang['Name'],$lang['Peculiarities'],$lang['Pop']);  $i = 1;  while($row = $dbo->Read($sql))  {   printf('<tr><td>%d<input type="hidden" name = "tid%d" value="%d" /></td><td><input type="text" name="tn%s" value="%s" /></td>    <td>%s</td><td>%s</td></tr>',    $i,$i,$row['id'],$row['id'],$row['name'],$form->MapLink($row['x'],$row['y'], sprintf('(%s , %s)', $row['x'], $row['y'])),$row['pop']);   $i++;  }  $dbo->Cancel($sql);  $text = $dbo->ExectueScaler(sprintf('SELECT `statement` FROM `%sprofile` WHERE `owner` = \'%s\' AND `kind` = \'%s\'',   DB_PERFIX,$account->id,PLAYER_KIND),'statement');  $medal = $account->GetMedal($account->id);  ?>
<tr><td colspan="4"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr>
</table>
</form>
<table class="h_table" style="float:left;margin-left:60px;width:320px;">
    <tr><td colspan="5"><?php echo $lang['Medals'];?></td>
<?php  if(count($medal))  {      $i =0;      foreach($medal as &$m)      {          if($i % 5 == 0)              echo '</tr><tr>';          $i++;          printf('<td><img id = "med_%d" src="img/medal/%s.gif" class="i57" alt="M"/></td>',$i,$m->medal);          $form->AddText("med_$i",$m->text);      }      while($i % 5)      {          echo '<td>&nbsp;</td>';          $i++;      }  }  else      printf('</tr><tr><td colspan="5">%s</td></tr>',$lang['NoRecord']);  ?>
</table>
</div>
<div style="clear:both"></div>
<div>
    <center><a href="setting.php"><?php echo $lang['Setting'];?></a></center>
<form action="detail.php?kind=player&id=<?php echo $account->id;?>" method="post">
<input name = "com" type="hidden" value="ep"  />
<a href="javascript:void(0);" onClick="ShowHide('ddB');ShowHide('eddB');"><?php echo $lang['Edit']; ?></a>
<div id="ddB" style="background-color:#ffffff;"></div>
<div id="eddB" style="text-align:right;display:none;margin-right:120px;">
<div class="editorButtons">
<img class="textImage" src="img/ed/bold.gif" onClick=" Editor.InsertText('1');"/>
<img class="textImage" src="img/ed/blink.gif" onClick=" Editor.InsertText('2');"/>
<img class="textImage" src="img/ed/italic.gif" onClick=" Editor.InsertText('3');"/>
<img class="textImage" src="img/ed/underline.gif" onClick="Editor.InsertText('4');"/>
<img class="textImage" src="img/ed/x_y.gif" onClick="Editor.InsertText('5');"/>
<img id="smilies" class="textImage" width="25" height="24" title="Insert Smily" alt="Smily" src="img/ed/sm.gif"/>
		<div class="sample_attach" id="smiliesPallete">
			<img  src="img/ed/smiles-img.png" usemap="#smilies_pallete" border="0" />
			<map name="smilies_pallete" id="smilies_pallete">
				<area shape="rect" id="O:-)"  coords="4,8,33,31" href="javascript:void(0);" alt="Angel" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="X("  coords="36,9,71,31" href="javascript:void(0);" alt="Angry" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=";;)"  coords="77,6,105,32" href="javascript:void(0);" alt="Batting Eyelashes" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":D"  coords="111,6,144,34" href="javascript:void(0);" alt="Big Grin" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":>"  coords="147,6,180,34" href="javascript:void(0);" alt="Blushing" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="=(("  coords="184,6,212,34" href="javascript:void(0);" alt="Broken Heart" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-B"  coords="184,38,214,63" href="javascript:void(0);" alt="Dork" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=">|)"  coords="149,41,179,64" href="javascript:void(0);" alt="Devil" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":(("  coords="111,40,141,64" href="javascript:void(0);" alt="Crying" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="B-)"  coords="77,38,105,67" href="javascript:void(0);" alt="Cool" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-/"  coords="41,38,69,67" href="javascript:void(0);" alt="Cofused" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":O)"  coords="7,41,32,64" href="javascript:void(0);" alt="Clown" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="=P~"  coords="5,71,36,100" href="javascript:void(0);" alt="Droling" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":("  coords="41,73,70,103" href="javascript:void(0);" alt="Frown" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-*"  coords="76,72,105,101" href="javascript:void(0);" alt="Kiss" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="|-)"  coords="113,70,141,100" href="javascript:void(0);" alt="Laughing" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":x"  coords="150,71,177,97" href="javascript:void(0);" alt="Love Struck" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":=("  coords="185,71,215,98" href="javascript:void(0);" alt="Pouting" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-&"  coords="6,108,32,132" href="javascript:void(0);" alt="Puke" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":/)"  coords="41,109,68,133" href="javascript:void(0);" alt="Rised eyeBrew" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id="I-)"  coords="80,108,106,129" href="javascript:void(0);" alt="Sleep" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":=|"  coords="116,107,142,131" href="javascript:void(0);" alt="Silent" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":)"  coords="151,106,180,129" href="javascript:void(0);" alt="Smille" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":>"  coords="188,105,215,129" href="javascript:void(0);" alt="Smug" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":|"  coords="6,143,34,166" href="javascript:void(0);" alt="StraightFace" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-O"  coords="42,140,68,162" href="javascript:void(0);" alt="Surprise" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-("  coords="77,137,106,163" href="javascript:void(0);" alt="Tired" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":P"  coords="116,140,147,161" href="javascript:void(0);" alt="Tongue" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=";-)"  coords="154,136,182,159" href="javascript:void(0);" alt="Winke" onclick="Editor.InsertText('6',this.id);" />
				<area shape="rect" id=":-S"  coords="189,137,215,158" href="javascript:void(0);" alt="Worried" onclick="Editor.InsertText('6',this.id);" />
			</map>
		</div>
		<script type="text/javascript">
			at_attach("smilies", "smiliesPallete", "click", "x", "pointer");
		</script>
<a href="javascript:void(0);" onclick ="Editor.SetText();" class="preBut"><?php echo $lang['ShowPreview'];?></a>

</div>
<div id="area"></div>

<script language="javascript" type="text/javascript">
Editor.Inital('area',<?php echo json_encode($text);?>);
</script>
<input type="submit" value="<?php echo $lang['Send'];?>" style="margin-right:250px; margin-top:10px;" />
</div>
</form>
</div>