<?php  if(isset($_POST['com']))  {   if($_POST['com'] == 'del')   {    foreach($_POST as $key => $value)    {     $value = ValidNumber($value,true);     if(NoNumbers($key) == 'cb')      $pm->SetFlag(RECIVER,$value, DEL_RECIVER);    }   }   elseif($_POST['com'] == 'arc')   {    foreach($_POST as $key => $value)    {     $value = ValidNumber($value,true);     if(NoNumbers($key) == 'cb')     {      $pm->SetFlag(RECIVER, $value, ARC_RECIVER);     }    }   }  }  $count = $pm->Counts(RECIVER, NO_FLAG, ARC_RECIVER | DEL_RECIVER);  $page = isset($_GET['page']) ? ValidNumber($_GET['page'],true) : 0;  $row = isset($_GET['row']) ? ValidNumber($_GET['row'],true) : 10;  if($row >100)   $row = 100;  if(!$plus->HavePlus('pb'))   $row = 10;    if($page * $row > $count)   $page = 0;    $list = $pm->GetList(RECIVER, NO_FLAG, ARC_RECIVER | DEL_RECIVER,$page,$row);  ?>
<div class="massageList">
<form action="pm.php?show=<?php echo INBOX;?>&amp;page=<?php echo $page;?>&amp;row=<?php echo $row?>" method="post" name="msg" id = "msg">
<input type="hidden" name="com" id="com" value="?" />
<table class="hovertable">
  <tr>
    <td colspan="5" class="center"><?php echo $lang['Inbox'];?></td>
  </tr>
  <tr>
    <td style="width:16px;text-align:center;">&nbsp;</td>
    <td style="width:16px;text-align:center;">&nbsp;</td>
    <td style="width:300px;text-align:center;"><?php echo $lang['Subject'];?></td>
    <td style="width:125px;text-align:center;"><?php echo $lang['Sender'];?></td>
    <td style="width:125px;text-align:center;"><?php echo $lang['InDate'];?></td>
  </tr>
<?php  if(empty($list))   printf('<tr><td colspan = "5" class = "center">%s</td></tr>',$lang['NoRecord']);  else  {     $i = 0;   foreach($list as &$l)   {    $read = $l['flag'] & NOT_READ;    printf('<tr><td><input type="checkbox" value="%u" name="cb%d" /></td>', $l['id'], $i++);    if($l['flag'] & SYS_INFO)     printf('<td><img class = "i30" src = "img/pm/s_%d.gif" alt="%s" /></td>',$read,$read ? $lang['NotRead']:$lang['Readed']);    elseif($l['flag'] & UNI_INFO)     printf('<td><img class = "i30" src = "img/pm/u_%d.gif" alt="%s" /></td>',$read,$read ? $lang['NotRead']:$lang['Readed']);    else     printf('<td><img class = "i30" src = "img/pm/p_%d.gif" alt="%s" /></td>',$read,$read ? $lang['NotRead']:$lang['Readed']);    printf('<td><a href="pm.php?show=%s&amp;id=%d">%s</a></td>',READ, $l['id'],$l['subject']);      printf('<td>%s</td>', $form->PlayerLink($l['se'], $l['name']));    printf('<td>%s</td></tr>',DateToString($l['modify']));   }  }  ?>

  <tr>
	<td colspan="2"><input type="checkbox" id = "all" onchange="SetAll('msg','all');" /> </td>
    <td colspan="3"><input type="button" onclick="SubmitForm('msg','com','del');" value = "<?php echo $lang['Delete'];?>"/>
					<input type="button" onclick="SubmitForm('msg','com','arc');" value = "<?php echo $lang['Archive'];?>"/>
	</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $lang['PageNumber'];?></td>
    <td colspan="3"><div class="pagination">
					<?php echo Paging($count,sprintf('pm.php?show=%s&amp;',INBOX), $row, $page);?>	</div>
	</td>
  </tr>
</table>
</form>
    <?php    if($plus->HavePlus('pb'))    {    ?>
				
		<div class="Pooling">
			<form action="pm.php" method="get" id="plus" name="plus">
			<input type="hidden" name = "show" value="<?php echo INBOX;?>"/>
			<input type="hidden" name="page" value="<?php echo $page;?>"/>
			<input type="text" id="row" name="row" value="<?php echo $row;?>" />
			<input type="submit" value="<?php echo $lang['Show'];?>" class="buttonClass" />
			</form>
		</div>
		<?php   }   ?>
 
</div>