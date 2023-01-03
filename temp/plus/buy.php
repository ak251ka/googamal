<?php  if(isset($_POST['bp']))  {   if($account->Lock())   {   switch($_POST['bp'])   {    case 'r1':    case 'r2':    case 'r3':    case 'r4':    case 'r5':     $plus->AddPlusResource($_POST['bp']);     break;    case 'golden':     $plus->BuyGolden();     break;    case 'pb':     $plus->AddPlusBuild();     break;    case 'er';     $plus->BuyExtera();     break;    case 'fb':              if($town->CanFastBuild())         $plus->FastBuild();     break;    case 'ce':              if($town->CanClearElixir())         $plus->CleanElixir();     break;   }   }   $account->UnLock();  }  ?>

<div class="p_main">
<form action="plus.php?show=<?php echo P_BUY_PLUS;?>" method="post">
<input name = "bp" id = "bp" type="hidden" value="?" />
<table class="p_table"><tr><td colspan="5" class="center"><?php echo $lang['PlusPossible'];?></td></tr>
<tr><td colspan="2" class="center"><?php echo $lang['Description'];?></td>
<td class="center"><?php echo $lang['TimeProcess'];?></td>
<td class="center"><?php echo $lang['Talant'];?></td>
<td class="center"><?php echo $lang['Action'];?></td>
</tr>

<tr>
<td style="width:104px;"><img class = "" src = "img/plus/r1.gif" alt="<?php printf($lang['PlusR'], $lang['r1']);?>" /></td>
<td style="width:430px;padding:5px;"><?php printf($lang['PlusResource'],$lang['r1'],$lang['r1'],$lang['b1'],$lang['r1']);?></td>
<td style="width:48px;text-align:center;"><?php echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="width:33px;text-align:center;"><?php echo RES_TALANT;?></td>
<td style="width:100px;text-align:center;">
<?php   if($plus->HavePlus('r1'))    echo Until($account->r1).'<br />';   if($plus->HaveTalant(RES_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'r1\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/r2.gif" alt="<?php printf($lang['PlusR'], $lang['r2']);?>" /></td>
<td style="padding:5px;"><?php printf($lang['PlusResource'],$lang['r2'],$lang['r2'],$lang['b2'],$lang['r2']);?></td>
<td style="text-align:center;"><?php echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="text-align:center;"><?php echo RES_TALANT;?></td>
<td style="text-align:center;">
<?php   if($plus->HavePlus('r2'))    echo Until($account->r2).'<br />';   if($plus->HaveTalant(RES_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'r2\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/r3.gif" alt="<?php printf($lang['PlusR'], $lang['r3']);?>" /></td>
<td style="padding:5px;"><?php printf($lang['PlusResource'],$lang['r3'],$lang['r3'],$lang['b3'],$lang['r3']);?></td>
<td style="text-align:center;"><?php echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="text-align:center;"><?php echo RES_TALANT;?></td>
<td style="text-align:center;">
<?php   if($plus->HavePlus('r3'))    echo Until($account->r3).'<br />';   if($plus->HaveTalant(RES_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'r3\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/r4.gif" alt="<?php printf($lang['PlusR'], $lang['r4']);?>" /></td>
<td style="padding:5px;"><?php printf($lang['PlusResource'],$lang['r4'],$lang['r4'],$lang['b4'],$lang['r4']);?></td>
<td style="text-align:center;"><?php echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="text-align:center;"><?php echo RES_TALANT;?></td>
<td style="text-align:center;">
<?php   if($plus->HavePlus('r4'))    echo Until($account->r4).'<br />';   if($plus->HaveTalant(RES_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'r4\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/r5.gif" alt="<?php printf($lang['PlusR'], $lang['r5']);?>" /></td>
<td style="padding:5px;"><?php printf($lang['PlusResource'],$lang['r5'],$lang['r2'],$lang['b2'],$lang['r5']);?></td>
<td style="text-align:center;"><?php echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="text-align:center;"><?php echo RES_TALANT;?></td>
<td style="text-align:center;">
<?php   if($plus->HavePlus('r5'))    echo Until($account->r5).'<br />';   if($plus->HaveTalant(RES_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'r5\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<?php  $pro = $town->GetProduct();  foreach ($pro as &$p)   $p = $p * EXTERA_RESOURCE;    ?>
<tr>
<td><img class = "" src = "img/plus/er.gif" alt="<?php echo $lang['ExteraResource'];?>" /></td>
<td style="padding:5px;"><?php printf($lang['PlusExtera'], EXTERA_RESOURCE, $lang['r1'],$pro['r1'],$lang['r2'],$pro['r2'],$lang['r3'],$pro['r3'],   $lang['r4'],$pro['r4'],$lang['r5'],$pro['r5']);?></td>
<td style="text-align:center;"><?php echo $lang['Immediate'];?></td>
<td style="text-align:center;"><?php echo EXTERA_TALANT;?></td>
<td style="text-align:center;">
<?php   if($town->br < $_SERVER['REQUEST_TIME'])   {    if($plus->HaveTalant(EXTERA_TALANT))     printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'er\');" />', $lang['Buy']);    else     printf($lang['NotEnough'] , $lang['Talant']);   }   else    echo Until($town->br).'<br />';     ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/gl.gif" alt="<?php echo $lang['PlusGolden'];?>" /></td>
<td style="padding:5px;"><?php printf($lang['GoldenClub']);?></td>
<td style="text-align:center;"><?php echo $lang['Immediate'];?></td>
<td style="text-align:center;"><?php echo GOLDEN_CLUB;?></td>
<td style="text-align:center;">
<?php   if($account->golden)    echo $lang['Active'];   elseif($plus->HaveTalant(GOLDEN_CLUB))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'golden\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>

<tr>
<td><img class = "" src = "img/plus/tb.gif" alt="<?php echo $lang['Plus'];?>" /></td>
<td style="padding:5px;"><?php printf($lang['TwoBuild']);?></td>
<td style="text-align:center;"><?php  echo SecToDay(7 * 24 * ONE_TICK).' '.$lang['Day'];?></td>
<td style="text-align:center;"><?php echo BUILD_TALANT;?></td>
<td style="text-align:center;">
<?php   if($plus->HavePlus('pb'))    echo Until($account->pb).'<br />';   if($plus->HaveTalant(BUILD_TALANT))    printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'pb\');" />', $lang['Buy']);   else    printf($lang['NotEnough'] , $lang['Talant']);  ?>
</td>
</tr>
<tr>
<td><img class = "" src = "img/plus/bf.gif" alt="<?php echo $lang['FBuild'];?>" /></td>
<td style="padding:5px;"><?php printf($lang['FastBuild']);?></td>
<td style="text-align:center;"><?php echo $lang['Immediate'];?></td>
<td style="text-align:center;"><?php echo RES_TALANT;?></td>
<td style="text-align:center;">
<?php  if($town->CanFastBuild())  {      if($plus->HaveTalant(RES_TALANT))          printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'fb\');" />', $lang['Buy']);      else          printf($lang['NotEnough'] , $lang['Talant']);  }  else      echo '-';  ?>
</td>
</tr>

<tr>
<td><img class = "" src = "img/plus/ee.gif" alt="<?php echo $lang['Elixir'];?>" /></td>
<td style="padding:5px;"><?php printf($lang['CleanElixir']);?></td>
<td style="text-align:center;"><?php echo $lang['Immediate'];?></td>
<td style="text-align:center;"><?php echo BUILD_TALANT * 2;?></td>
<td style="text-align:center;">
<?php  if($town->CanClearElixir())  {      if($plus->HaveTalant(BUILD_TALANT * 2))          printf('<input type="submit" value="%s" onClick="SetValues(\'bp\',\'ce\');" />', $lang['Buy']);      else          printf($lang['NotEnough'] , $lang['Talant']);  }  else      echo '-';    ?>
</td>
</tr>
</table>
</form>
</div>