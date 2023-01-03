<?php  require_once('.//lib/form.php');  if(!$session->Permission(SEND_PM))  {      echo '<div class="massageList">';      $form->BlockPage();      echo '</div>';      return;  }  $pname = '';  $subject = '';  if(!empty($_POST) and $_GET['show'] == WRITE)  {   if(isset($_POST['com']) and $_POST['com'] == 'nw')   {    if(isset($_POST['pid']))     $pname = $user->GetName($_POST['pid']);    if(isset($_POST['sub']))    {     $subject = 're:'.$_POST['sub'];     $subject = mb_substr($subject,0, 32,'UTF-8');    }   }  }  elseif(empty($_POST) and $_GET['show'] == WRITE)  {       if(isset($_GET['pid']))           $pname = $user->GetName($_GET['pid']);  }  ?>
<div class="massageList">
<form action="pm.php?show=<?php echo WRITE;?>" method="post">
<input type="hidden" name="com" value="sv" />
<table class="hovertable">
<tr><td colspan="2" class="center"><?php echo $lang['Write'];?></td></tr>
<tr><td colspan="2" class="center"><span class="error"><?php echo $error == E_USER_NOT_FIND? $lang['NoRecordFind'] :'&nbsp;';?></span></td></tr>
<tr><td><?php echo $lang['Reciver'];?></td><td><input type="text" name="to" value="<?php echo $pname;?>"/></td></tr>
<tr><td><?php echo $lang['Subject'];?></td><td><input type="text" name="sub" value="<?php echo $subject;?>"/></td></tr>
<tr><td colspan="2">
<div id="Editor">

<div>
<div class="editorButtons">
<img class="textImage" src="img/ed/bold.gif" onClick=" Editor.InsertText('1');"/>
<img class="textImage" src="img/ed/blink.gif" onClick=" Editor.InsertText('2');"/>
<img class="textImage" src="img/ed/italic.gif" onClick=" Editor.InsertText('3');"/>
<img class="textImage" src="img/ed/underline.gif" onClick="Editor.InsertText('4');"/>
<img class="textImage" src="img/ed/x_y.gif" onClick="Editor.InsertText('5');"/>
<img id="smilies" class="textImage" width="25" height="24" title="Insert Smily" alt="Smily" src="img/ed/sm.gif"/>
		<div class="smiliesPallete" id="smiliesPallete">
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
</div>

<div id="area">
</div>

<script language="javascript" type="text/javascript">
Editor.Inital('area');
</script>
</div>
</td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Send'];?>" /></td></tr>
</table>
</form>
</div>