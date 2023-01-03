<div class="b_troop">
<?php  define('CHANGE_WORKER','cwor');  if(isset($_POST['com']) and $_POST['com'] == CHANGE_WORKER)  {   if(isset($_POST['kind']) and isset($_POST['subkind']))   {    if($town->Lock() )    {    $_POST['subkind'] = ValidNumber($_POST['subkind'],true);    $freeW = $town->workers - ($town->w1 +$town->w2 +$town->w3 +$town->w4 +$town->w5);    if($_POST['kind'] == 'w1')    {     if($freeW + $town->w1 >= $_POST['subkind'])     {      $town->w1 = $_POST['subkind'];      $town->SetField(array('w1' => $town->w1));     }     $town->SetProduct();    }    }    $town->UnLock();   }  }  $pro = $dbo->ExectueScaler(   sprintf('SELECT `func` FROM `%sbuilding_d` WHERE `bid` =\'%s\' AND `lvl` = \'%s\'',DB_PERFIX,$town->$b, $town->$u + 1),'func');  printf('<table><tr><td>'.$lang['LevelPoint'].'</td>','<td>'.$town->p1.'</td></tr></table>');  if($town->$u != $info['mb'])   printf('<table><tr><td>'.$lang['NextPoint'].'</td>','<td>'.$pro.'</td></tr></table>');  if($town->GetLevel(28) == -1){   echo '<center>'.$lang['NoRequirement'].'</center>';   printf('<center><b>%s %s</b></center>',$lang['Requirement'],$lang['b28']);   return;  }    $freeWorker = $town->workers -($town->w1 + $town->w2 + $town->w3 + $town->w4 + $town->w5);  $pb = $plus->HavePlus('r1')? PLUS_RESOURCE_POINT: 1;  $a = $pb * $town->p1 * WORKER_POINT + $town->p1 * WORKER_POINT * $town->pclo/100;  $b = $pb * $town->p1;  ?>

<form action="<?php printf('building.php?bid=%s&amp;tid=%s',$bid,$town->id);?>" method="post">
<input type="hidden" name = "com" value="<?php echo CHANGE_WORKER;?>"/>
<input type="hidden" name = "kind" value="w1" />
<input type="hidden" name="subkind" id = "subkind" value="<?php echo $town->w1;?>"/>
<table class="t200">
<tr><td colspan="2"><?php printf('<center><b>%s</b></center>',$lang['Worker']);?> </td></tr>
<tr><td><?php echo $lang['Product'];?></td><td width="50px" id = "producted"><?php echo ceil($town->w1 * $a + $b); ?></td></tr>
<tr><td colspan="2" style="text-align:center;height:45px;"><div id="wor" style="direction:ltr;margin-left:auto;margin-right:auto;width:150px;"></div></td></tr>
<tr><td colspan="2" class="center"><input type="submit" value="<?php echo $lang['Save'];?>"/></td></tr>
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
var setWorker = function () {
$("subkind").value = worker.values.mid;
$("producted").innerHTML = Math.ceil($("subkind").value * <?php echo $a .' + '.$b;?>);
}
var worker = new slider();
worker.init({id:"wor",style:{backgroundColor:"red",width:"150px"},pointer:{backgroundColor:"#6699cc"},
values:{min:0,max:<?php echo $town->w1 + $freeWorker;?>,mid:<?php echo $town->w1;?>,fontSize:"10px"},fire:setWorker})
</script>