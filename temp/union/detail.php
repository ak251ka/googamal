<?php  require_once('.//eng/main/union.php');  require_once('.//lib/form.php');  require_once('.//lib/dbo.php');  $officer = $union->GetOfficer($uid);  $member = $union->GetMemberInfo($uid);  $medal = $union->GetMedal($uid);  $isOfficer = $union->IsOfficer($uid,$account->id);  if(isset($_POST['com']) and $_POST['com'] == EDIT_PROFILE)  {   if($isOfficer)   {    $_POST['msg'] = isset($_POST['msg']) ? mb_substr($_POST['msg'],0, 1024,'UTF-8') : '';    $dbo->ExectueQuery(sprintf('UPDATE `%sprofile` SET `statement` = \'%s\' WHERE `owner` = \'%s\' AND `kind` = \'%s\' LIMIT 1',     DB_PERFIX, $_POST['msg'], $account->uid, UNION_KIND));    $info->statement = $_POST['msg'];   }  }  ?>
<div>
<table class="u_d_right t_w_300">
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $info->name;?></td></tr>
<tr><td><?php echo $lang['Rank'];?></td><td><?php echo $union->GetRank($uid);?></td></tr>
<tr><td><?php echo $lang['Members'];?></td><td><?php echo $info->members;?></td></tr>
<tr><td><?php echo $lang['Slogan'];?></td><td><?php echo $info->slogan;?></td></tr>
<tr><td><?php echo $lang['Pop'];?></td><td><?php echo $info->pop;?></td></tr>
<tr><td><?php echo $lang['AP']?></td><td><?php echo $info->ap;?></td></tr>
<tr><td><?php echo $lang['DP']?></td><td><?php echo $info->dp;?></td></tr>
<tr><td><?php echo $lang['Forum']?></td><td><?php echo $form->Ahref('/forum.php?uid='.$uid,$lang['Forum']);?></td></tr>
</table>
</div>
<div>
<table class="u_d_left t_w_300">
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $lang['Post'];?></td></tr>
<?php  foreach ($officer as &$o)   printf('<tr><td>%s</td><td>%s</td></tr>',    $form->PlayerLink($o->pid,$o->name), $o->job);  ?>
</table>
</div>
<div style="clear:both"></div>
<div>
<table  class="u_d_right t_w_300">
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $lang['U_Rank'];?></td><td>
<img src="img/point/ap.gif" alt="<?php printf('%s %s',$lang['AP'],$lang['Union']); ?>" class="i30"/><td><img src="img/point/dp.gif" alt="<?php printf('%s %s',$lang['DP'],$lang['Union']); ?>" class="i30"/></td></tr>
<?php  foreach ($member as &$m)   printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$form->PlayerLink($m->pid,$m->name), $lang['U_R_'.$m->rank],$m->ap,$m->dp);  ?>
</table>
</div>

<div>
<table class="u_d_left t_w_300">
<tr><td colspan="5"><?php echo $lang['Medals'];?></td>
<?php  if(count($medal))  {   $i =0;   foreach($medal as &$m)   {    if($i % 5 == 0)     echo '</tr><tr>';    $i++;    printf('<td><img id = "med_%d" src="img/medal/%s.gif" class="i57" alt="M"/></td>',$i,$m->medal);    $form->AddText("med_$i",$m->text);   }   while($i % 5)   {    echo '<td>&nbsp;</td>';    $i++;   }  }  else   printf('</tr><tr><td colspan="5">%s</td></tr>',$lang['NoRecord']);  $textnew =  $info->statement;  ?>
</table>
</div>
<div style="clear:both"></div>
<?php  if(!$isOfficer)  {      printf('<center>%s</center><div class = "tprofile">%s</div>',$lang['Description'],$form->Replace($textnew));   return;  }  ?>
<div>
<form action="union.php?show=<?php echo P_DETAIL;?>" method="post">
<input name = "com" type="hidden" value="<?php echo EDIT_PROFILE;?>"  />
<a href="javascript:void(0);" onClick="ShowHide('ddB');ShowHide('eddB');"><?php echo $lang['Edit']; ?></a>
<div id="ddB" style="background-color:#ffffff;"></div>
<div id="eddB" style="text-align:right;display:none;">
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
Editor.Inital('area','<?php echo $textnew;?>');
</script>
<center><input type="submit" value="<?php echo $lang['Send'];?>" /></center>
</div>
</form>
</div>
