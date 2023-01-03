<?php  require_once('.//lib/dbo.php');  require_once('.//lib/form.php');  $list = array();  $i = 1;  $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%stroop_info` WHERE `kind` = \'%s\'',DB_PERFIX,$account->kind));  while($row = $dbo->Read($sql))  {   $list[$i] = new Object($row);   $form->AddModal('mo'.$i,$row['name'],sprintf('<img src="img/troop/b/%d_%d.gif" class="bigimg" alt="%s"/>%s',    $account->kind,$i,$row['name'],$row['desc']),$form->TroopInfo(    $row['r1'],$row['r2'],$row['r3'],$row['r4'],$row['r5'],    SecToString($row['times']),$row['used'],    $troops[$account->kind][$i][0],$troops[$account->kind][$i][1],$troops[$account->kind][$i][2],    $troops[$account->kind][$i][3],$troops[$account->kind][$i][4],$troops[$account->kind][$i][5]));   $i++;  }  $sitter = $session->aid != $session->pid;  ?>
<div>
<form action="attack.php" method="post">
<input type="hidden" name="com" value="<?php echo SELECT_TROOP;?>"/>
<div>
<table class="table1" style="border: 1px solid black;">
<tr>
	<td><img id = "mo1" alt="<?php echo $list[1]->name;?>" class = "i30s" onClick = "modal.Show('mo1');" src="img/troop/s/<?php echo $account->kind;?>_1.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t1',this.innerHTML);"><?php echo $town->t1;?></a></td>
	<td><input type="text" id = "t1" name = "t1" value="<?php if(isset($_GET['t1'])) echo (int)$_GET['t1'];?>" /></td>
	<td><img id = "mo8" alt="<?php echo $list[8]->name;?>" class = "i30s" onClick = "modal.Show('mo8');" src="img/troop/s/<?php echo $account->kind;?>_8.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t8',this.innerHTML);"><?php echo $town->t8;?></a></td>
	<td><input type="text" id = "t8" name = "t8" value="<?php if(isset($_GET['t8'])) echo (int)$_GET['t8'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo2" alt="<?php echo $list[2]->name;?>" class = "i30s" onClick = "modal.Show('mo2');" src="img/troop/s/<?php echo $account->kind;?>_2.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t2',this.innerHTML);"><?php echo $town->t2;?></a></td>
	<td><input type="text" id = "t2" name = "t2" value="<?php if(isset($_GET['t2'])) echo (int)$_GET['t2'];?>" /></td>
	<td><img id = "mo9" alt="<?php echo $list[9]->name;?>" class = "i30s" onClick = "modal.Show('mo9');" src="img/troop/s/<?php echo $account->kind;?>_9.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t9',this.innerHTML);"><?php echo $town->t9;?></a></td>
	<td><input type="text" id = "t9" name = "t9" value="<?php if(isset($_GET['t9'])) echo (int)$_GET['t9'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo3" alt="<?php echo $list[3]->name;?>" class = "i30s" onClick = "modal.Show('mo3');" src="img/troop/s/<?php echo $account->kind;?>_3.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t3',this.innerHTML);"><?php echo $town->t3;?></a></td>
	<td><input type="text" id = "t3" name = "t3" value="<?php if(isset($_GET['t3'])) echo (int)$_GET['t3'];?>" /></td>
	<td><img id = "mo10" alt="<?php echo $list[10]->name;?>" class = "i30s" onClick = "modal.Show('mo10');" src="img/troop/s/<?php echo $account->kind;?>_10.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t10',this.innerHTML);"><?php echo $town->t10;?></a></td>
	<td><input type="text" id = "t10" name = "t10" value="<?php if(isset($_GET['t10'])) echo (int)$_GET['t10'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo4" alt="<?php echo $list[4]->name;?>" class = "i30s" onClick = "modal.Show('mo4');" src="img/troop/s/<?php echo $account->kind;?>_4.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t4',this.innerHTML);"><?php echo $town->t4;?></a></td>
	<td><input type="text" id = "t4" name = "t4" value="<?php if(isset($_GET['t4'])) echo (int)$_GET['t4'];?>" /></td>
	<td><img id = "mo11" alt="<?php echo $list[11]->name;?>" class = "i30s" onClick = "modal.Show('mo11');" src="img/troop/s/<?php echo $account->kind;?>_11.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t11',this.innerHTML);"><?php echo $town->t11;?></a></td>
	<td><input type="text" id = "t11" name = "t11" value="<?php if(isset($_GET['t11'])) echo (int)$_GET['t11'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo5" alt="<?php echo $list[5]->name;?>" class = "i30s" onClick = "modal.Show('mo5');" src="img/troop/s/<?php echo $account->kind;?>_5.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t5',this.innerHTML);"><?php echo $town->t5;?></a></td>
	<td><input type="text" id = "t5" name = "t5" value="<?php if(isset($_GET['t5'])) echo (int)$_GET['t5'];?>" /></td>
	<td><img id = "mo12" alt="<?php echo $list[12]->name;?>" class = "i30s" onClick = "modal.Show('mo12');" src="img/troop/s/<?php echo $account->kind;?>_12.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t12',this.innerHTML);"><?php echo $town->t12;?></a></td>
	<td><input type="text" id = "t12" name = "t12" value="<?php if(isset($_GET['t12'])) echo (int)$_GET['t12'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo6" alt="<?php echo $list[6]->name;?>" class = "i30s" onClick = "modal.Show('mo6');" src="img/troop/s/<?php echo $account->kind;?>_6.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t6',this.innerHTML);"><?php echo $town->t6;?></a></td>
	<td><input type="text" id = "t6" name = "t6" value="<?php if(isset($_GET['t6'])) echo (int)$_GET['t6'];?>" /></td>
	<td><img id = "mo13" alt="<?php echo $list[13]->name;?>" class = "i30s" onClick = "modal.Show('mo13');" src="img/troop/s/<?php echo $account->kind;?>_13.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t13',this.innerHTML);"><?php echo $town->t13;?></a></td>
	<td><input type="text" id = "t13" name = "t13" value="<?php if(isset($_GET['t13'])) echo (int)$_GET['t13'];?>" /></td>
</tr>
<tr>
	<td><img id = "mo7" alt="<?php echo $list[7]->name;?>" class = "i30s" onClick = "modal.Show('mo7');" src="img/troop/s/<?php echo $account->kind;?>_7.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t7',this.innerHTML);"><?php echo $town->t7;?></a></td>
	<td><input type="text" id = "t7" name = "t7" value="<?php if(isset($_GET['t7'])) echo (int)$_GET['t7'];?>" /></td>
	<td><img id = "mo14" alt="<?php echo $list[14]->name;?>" class = "i30s" onClick = "modal.Show('mo14');" src="img/troop/s/<?php echo $account->kind;?>_14.gif"/></td>
	<td><a href="javascript:void(0);" onClick="SetValues('t14',this.innerHTML);"><?php echo $town->t14;?></a></td>
	<td><input type="text" id = "t14" name = "t14" value="<?php if(isset($_GET['t14'])) echo (int)$_GET['t14'];?>" /></td>
</tr>
</table>
</div>
<div>
<table class="table2" style="border: 1px solid black;">
<tr><td><?php echo $lang['Kind'];?></td><td><select name="kind" id="kind" onchange="ShowElixir(this.value);">
<option value="<?php echo A_RAPINE; ?>"><?php echo $lang['Rapine'];?></option>
<option value="<?php echo A_ESPIAL; ?>"><?php echo $lang['Espial'];?></option>
<option value="<?php echo A_SUPPORT; ?>"><?php echo $lang['Support'];?></option>
<option value="<?php echo A_ATTACK; ?>" <?php if($sitter) echo 'disabled = "disabled"'; ?>><?php echo $lang['Attack'];?></option>
<option value="<?php echo A_BLOCKADE; ?>" <?php if($sitter) echo 'disabled = "disabled"';?>><?php echo $lang['Blockade'];?></option>
<option value="<?php echo A_MERGER; ?>" <?php if($sitter) echo 'disabled = "disabled"';?>><?php echo $lang['Merger'];?></option>
</select></td></tr>
<?php  $x = '0';  $y = '0';  if(isset($_GET['id']))  {   $row = $dbo->ExectueRow(sprintf('SELECT `x`,`y` FROM `%smap_t` WHERE `id` = \'%s\'',DB_PERFIX,    $_GET['id']));   if(!empty($row))   {    $x = $row['x'];    $y = $row['y'];   }  }  if($account->htid == $town->id)  printf('<tr><td colspan="2">%s<input type="checkbox" name="h" value="1" %s/></td></tr>',$lang['SendHero'],   $town->h?'':'disabled="disabled" '  );  ?>
<tr><td>X</td><td><input type="text" value="<?php echo $x;?>" name="tbX" id = "tbX"/></td></tr>
<tr><td>Y</td><td><input type="text" value="<?php echo $y;?>" name="tbY" id = "tbY"/></td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Send'];?>"/></td></tr>
</table>
</div>
<div id = "elixir">
<?php  $list = $town->GetCanUseElixir(E_KIND_ATTACK);  ?>
<table class="table2" style="border: 1px solid black;">
<tr id = "elixir1" style="display:none;">
<td><?php echo $lang['Elixir'] ?></td><td><select id = "e1" name="e1" onchange="ElixirChange('1');">
<option value="0"><?php echo $lang['Select'];?></option><?php  foreach($list as &$l)   printf('<option value="%s">%s</option>',$l->id,$l->name);  ?></select></td>
<td><img src="img/eli/0.gif" class ="i30" alt="e0" id="ie1" /></td>
<td><input type="text" id = "en1" name="en1" value="0"/></td>
<td><a id ="ea1" href="javascript:void(0);" onclick="SetValues('en1',this.innerHTML);">0</a></td>
</tr>

<tr id = "elixir2" style="display:none;">
<td><?php echo $lang['Elixir'] ?></td>
<td><select id = "e2" name="e2" onchange="ElixirChange('2');"><option value="0"><?php echo $lang['Select'];?></option><?php  foreach($list as &$l)   if($l->id != '15')    printf('<option value="%s">%s</option>',$l->id,$l->name);  ?></select></td>
<td><img src="img/eli/0.gif" class ="i30" alt="e0" id="ie2" /></td>
<td><input type="text" id = "en2" name="en2" value="0"/></td>
<td><a id ="ea2" href="javascript:void(0);" onclick="SetValues('en2',this.innerHTML);">0</a></td>
</tr>

<tr id = "elixir3" style="display:none;">
<td><?php echo $lang['Elixir'] ?></td>
<td><select id = "e3" name="e3" onchange="ElixirChange('3');"><option value="0"><?php echo $lang['Select'];?></option><?php  foreach($list as &$l)   if($l->id != '15')    printf('<option value="%s">%s</option>',$l->id,$l->name);  ?></select></td>
<td><img src="img/eli/0.gif" class ="i30" alt="e0" id="ie3" /></td>
<td><input type="text" id = "en3" name="en3" value="0"/></td>
<td><a id ="ea3" href="javascript:void(0);" onclick="SetValues('en3',this.innerHTML);">0</a></td>
</tr>
</table>
</div>
<div class="clear:both;"></div>
<script language="javascript" type="text/javascript">
var elixir =Array();
elixir[0] = new ElixirInfo('0',"<?php echo $lang['Select'];?>",'0');
<?php  foreach($list as &$l)   printf('elixir[%s] =  new ElixirInfo(\'%s\',\'%s\',\'%s\');',$l->id,$l->id,$l->desc,$l->num);  ?>
SetElixirInfo('1','0');
SetElixirInfo('2','0');
SetElixirInfo('3','0');
</script>
</form>
</div>
<div id="info" style="display:none;">
<img src="img/all/c1.gif" alt="<?php echo $lang['Close'];?>" class ="i30s" onclick="ShowHide('info');"/>
<p>
<span id="textInfo"></span>
<img id ="imgInfo" src="" alt="" />
</p>
</div>