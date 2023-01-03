<?php  $list = $hero->GetItems();  ?>
<div class="h_f_left">
<form action="hero.php?show=<?php echo P_FACE;?>" method="post">
<input type="hidden" name = "com"  value="<?php echo P_FACE;?>" />
<input type="hidden" name = "kind" value="<?php echo S_FACE;?>" />
<input type="hidden" name = "hfa" id = "hfa" value="<?php echo $account->hfa;?>" />
<input type="hidden" name = "hfb" id = "hfb" value="<?php echo $account->hfb;?>" />
<input type="hidden" name = "hfc" id = "hfc" value="<?php echo $account->hfc;?>" />
<input type="hidden" name = "hfd" id = "hfd" value="<?php echo $account->hfd;?>" />
<input type="hidden" name = "hff" id = "hff" value="<?php echo $account->hff;?>" />
<input type="hidden" name = "hfr" id = "hfr" value="<?php echo $account->hfr;?>" />
<input type="hidden" name = "hfs" id = "hfs" value="<?php echo $account->hfs;?>" />
<input type="hidden" name = "hfm" id = "hfm" value="<?php echo $account->hfm;?>" />

<table class="h_table">
  <tr>
    <td class="box"><?php  if(isset($list[1]))   echo $form->HeroItem($list[1],$power);  else   echo '&nbsp;';  ?></td>
    <td>
    <div class="box1">
    <img src="img/all/h1.gif" onClick="Sub('hfm',0,4 );" alt="<?php echo $lang['hfm'];?>" class = "ar1" />
    <img src="img/all/h1.gif" onClick="Sub('hfa',1,4 );" alt="<?php echo $lang['hfa'];?>" class = "ar2" />
    </div>
    </td>
    <td rowspan="4"><img id = "face" src="face.php"/></td>
    <td><div class="box1">
    <img src="img/all/h2.gif" onClick="Add('hfm',0,4 );" alt="<?php echo $lang['hfm'];?>" class = "ar1" />
    <img src="img/all/h2.gif" onClick="Add('hfa',1,4 );" alt="<?php echo $lang['hfa'];?>" class = "ar2" />
    </div></td>
    <td class="box"><?php  if(isset($list[7]))   echo $form->HeroItem($list[7],$power);  else   echo '&nbsp;';  ?></td>
  </tr>
  <tr>
    <td class="box"><?php  if(isset($list[2]))   echo $form->HeroItem($list[2],$power);  else   echo '&nbsp;';  ?></td>
    <td>
    <div class="box1">
    <img src="img/all/h1.gif" onClick="Sub('hfc',1,4 );" alt="<?php echo $lang['hfc'];?>" class = "ar1" />
    <img src="img/all/h1.gif" onClick="Sub('hfb',1,4 );" alt="<?php echo $lang['hfb'];?>" class = "ar2" />
    </div></td>
    <td><div class="box1">
    <img src="img/all/h2.gif" onClick="Add('hfc',1,4 );" alt="<?php echo $lang['hfc'];?>" class = "ar1" />
    <img src="img/all/h2.gif" onClick="Add('hfb',1,4 );" alt="<?php echo $lang['hfb'];?>" class = "ar2" />
    </div></td>
    <td class="box"><?php  if(isset($list[8]))   echo $form->HeroItem($list[8],$power);  else   echo '&nbsp;';  ?></td>
  </tr>
  <tr>
    <td class="box"><?php  if(isset($list[3]))   echo $form->HeroItem($list[3],$power);  else   echo '&nbsp;';  ?></td>
    <td>
    <div class="box1">
    <img src="img/all/h1.gif" onClick="Sub('hfs',0,4 );" alt="<?php echo $lang['hfs'];?>" class = "ar1" />
    <img src="img/all/h1.gif" onClick="Sub('hfd',1,4 );" alt="<?php echo $lang['hfd'];?>" class = "ar2" />
    </div>
    </td>
    <td><div class="box1">
    <img src="img/all/h2.gif" onClick="Add('hfs',0,4 );" alt="<?php echo $lang['hfs'];?>" class = "ar1" />
    <img src="img/all/h2.gif" onClick="Add('hfd',1,4 );" alt="<?php echo $lang['hfd'];?>" class = "ar2" />
    </div></td>
    <td class="box"><?php  if(isset($list[9]))   echo $form->HeroItem($list[9],$power);  else   echo '&nbsp;';  ?></td>
  </tr>
  <tr>
    <td class="box"><?php  if(isset($list[4]))   echo $form->HeroItem($list[4],$power);  else   echo '&nbsp;';  ?></td>
    <td>
    <div class="box1">
    <img src="img/all/h1.gif" onClick="Sub('hfr',0,4 );" alt="<?php echo $lang['hfr'];?>" class = "ar1" />
    <img src="img/all/h1.gif" onClick="Sub('hff',1,4 );" alt="<?php echo $lang['hff'];?>" class = "ar2" />
    </div>
    </td>
    <td><div class="box1">
    <img src="img/all/h2.gif" onClick="Add('hfr',0,4 );" alt="<?php echo $lang['hfr'];?>" class = "ar1" />
    <img src="img/all/h2.gif" onClick="Add('hff',1,4 );" alt="<?php echo $lang['hff'];?>" class = "ar2" />
    </div></td>
    <td class="box"><?php  if(isset($list[10]))   echo $form->HeroItem($list[10],$power);  else   echo '&nbsp;';  ?></td>
  </tr>
  <tr>
    <td class="box"><?php  if(isset($list[5]))   echo $form->HeroItem($list[5],$power);  else   echo '&nbsp;';  ?></td>
    <td colspan="3" class="center"><input type="submit" value="<?php echo $lang['Save'];?>" /></td>
    <td class="box"><?php  if(isset($list[6]))   echo $form->HeroItem($list[6],$power);  else   echo '&nbsp;';  ?></td>
  </tr>
</table>


</form>
</div>

<div class="h_f_right">
<form  id = "<?php echo H_REBIRTH; ?>" action="hero.php?show=<?php echo P_FACE;?>" method="post">
<input type="hidden" name = "com"  value="<?php echo P_FACE;?>" />
<input type="hidden" name = "kind" value="<?php echo H_REBIRTH;?>" />
<input type="hidden" name = "subkind" id = "subkind1" value="?" />
<table class="h_table">
<?php  printf('<tr><td>%s</td><td>%s</td></tr>',$lang['Level'],$account->lvl);  $a = 100;  for($i = 0; $i < ($account->lvl < 100 ? $account->lvl + 1 : 100); $i++)      $a += $i * 200;  printf('<tr><td>%s</td><td>%s / %s</td></tr>',$lang['Exp'], $a, $account->exp);  if($account->life <1)  {   echo '<tr><td colspan="2" class="center">';   if(is_null($account->rebirth))   {    $r = $account->lvl > 24 ? 24000 : $account->lvl * 1000;    printf($lang['RebirthHero'], REBIRTH_HERO);    if($plus->HaveTalant(REBIRTH_HERO))     printf ('<img class = "i30s" src="img/plus/h.gif" alt="%s" onclick="SubmitForm(\'%s\',\'%s\',\'%s\');" /><br />',      $lang['Rebirth'],'rbh','subkind1', H_REBIRTH_T);    else    {     printf ('<img class = "i30" src="img/plus/n.gif" alt="%s" /><br />',      sprintf($lang['NotEnough'],$lang['Talant']));    }    $tick = ($account->lvl > 23 ? 24 * ONE_TICK : ($account->lvl + 1) * ONE_TICK);    $form->EchoCost($r,$r,$r,$r,$r, SecToString($tick),0);    printf('<br /><input type="button" value="%s" onclick="SubmitForm(\'%s\',\'%s\',\'%s\');" %s />',     $lang['Rebirth'],'rbh','subkind1', H_REBIRTH_R, $town->HaveEnough($r,$r,$r,$r,$r)? '':'disabled="disabled"');    if(!$town->HaveEnough($r,$r,$r,$r,$r))     printf('<br />'.$lang['NotEnough'],$lang['Resource']);   }   else    printf($lang['RebirthingHero'], $form->Addtimer($account->rebirth,'hero.php') );     echo '</td></tr>';  }  else   printf('<tr><td class="h_c_1">%s</td><td class="h_c_2">%d</td></tr>',$lang['Life'], floor($account->life));  printf('<tr><td>%s</td><td>%s</td></tr>',$lang['AP'],$hero->GetPoint('AP'));  printf('<tr><td>%s</td><td>%s</td></tr>',$lang['DP'],$hero->GetPoint('DP'));  for($i = 1;$i<15;$i++)  {   if($hero->GetPoint($i) > 0.00 and $i!= 12)    printf('<tr><td>%s</td><td>%s %%</td></tr>',$power[$i]->name, $hero->GetPoint($i));   elseif($hero->GetPoint($i)  > 0.00 and $i== 12)    printf('<tr><td>%s</td><td>%s</td></tr>',$power[$i]->name, round($hero->GetPoint($i)));  }  printf('<tr><td>%s</td><td>%s %%</td></tr>',$lang['HP1'], $hero->GetPoint('HP1'));  printf('<tr><td>%s</td><td>%s %%</td></tr>',$lang['HP2'], $hero->GetPoint('HP2'));  printf('<tr><td>%s</td><td>%s %%</td></tr>',$lang['HP3'], $hero->GetPoint('HP3'));  printf('<tr><td>%s</td><td>%s %%</td></tr>',$lang['HP4'], $hero->GetPoint('HP4'));    ?>
</table>
</form>
</div>
<div style="clear:both"></div>
<br />
<div class="h_f_p_c">
<div class="h_m_back"><a href="javascript:void(0);" onclick="ShowHide('shp');"><?php echo $lang['shp']; ?></a></div>
<div id = "shp" <?php if($account->pow1 and $account->pow2 and $account->pow3 and $account->pow4) echo 'style="display:none"';?>>
<form id = "<?php echo SET_H_P;?>" action="hero.php?show=<?php echo P_FACE;?>" method="post">
<input type="hidden" name = "com"  value="<?php echo P_FACE;?>" />
<input type="hidden" name = "kind" id = "kind1" value="<?php echo SET_H_P;?>" />
<input type="hidden" name = "subkind" id = "subkind2" value="?" />
<center>
<?php  if($account->pow1 or $account->pow2 or $account->pow3 or $account->pow4)  {   if($plus->HaveTalant(RESET_HERO))    printf ('<div>%s <img class = "i30s" src="img/plus/h.gif" alt="%s" onclick="SubmitForm(\'%s\',\'kind1\',\'%s\');" /></div>',     sprintf($lang['ResetHero'],RESET_HERO),$lang['Buy'], SET_H_P, RESET_H_P);   else   {    printf ('<div>%s <img class = "i30" src="img/plus/n.gif" alt="%s" /></div>',     sprintf($lang['ResetHero'],RESET_HERO),sprintf($lang['NotEnough'],$lang['Talant']));   }  }  ?>
<table class="h_table">
<?php  if(!$account->pow1 or !$account->pow2 or !$account->pow3 or !$account->pow4)  {   foreach($power as &$p)   if($account->pow1 != $p->id and $account->pow2 != $p->id and $account->pow3 != $p->id and $account->pow4 != $p->id)    printf('<tr><td><img class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td>%s</td><td><input type="submit" value="%s" onClick = "SetValues(\'subkind2\', \'%s\');" /></td></tr>',     $p->id,$p->name,$p->desc,$lang['Active'],$p->id);  }  else   printf('<tr><td class="center">%s</td></tr>', $lang['NoRecord']);  ?>
</table>
</center>
</form>
</div>
</div>
<br />
<div class="h_f_p">
<div class="h_m_back"><a href="javascript:void(0);" onclick="ShowHide('hp');"><?php echo $lang['hp']; ?></a></div>
<div id = "hp" <?php if(!$account->point) echo 'style="display:none"';?>>
<form  action="hero.php?show=<?php echo P_FACE;?>" method="post">
<input type="hidden" name = "com"  value="<?php echo P_FACE;?>" />
<input type="hidden" name = "kind"  value="<?php echo SET_POINT;?>" />
<center>
<table class="h_table">
<?php   if($account->point)   printf('<tr><td>%s</td><td><span id = "HavePoint">%s</span></td></tr>',    $lang['Point'],$account->point);  ?>

<?php  $noSubmit = 0;  if($account->pow1 or $account->pow2 or $account->pow3 or $account->pow4)  {   if($account->pow1)   {    $max1 = ($account->p1 + $account->point) <= 100 ? ($account->p1 + $account->point) :100;    $min1 = $account->p1;    if($account->p1 < 100)     printf('<tr><td><img id = "pows1" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td style="width:170px;"><input type="hidden" name = "pow1" id = "pow1" value = "%s" /><div style="direction:ltr;padding:5px;" id="d_pow1"></div></td></tr>',      $account->pow1,$power[$account->pow1]->name, $account->p1);    else    {     printf('<tr><td><img id = "pows1" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td>%s</td></tr>',      $account->pow1,$power[$account->pow1]->name,sprintf($lang['MaxPower'],$power[$account->pow1]->name));     $noSubmit++;    }    $form->AddText('pows1',$power[$account->pow1]->desc);   }   if($account->pow2)   {    $max2 = ($account->p2 + $account->point) <= 100 ? ($account->p2 + $account->point) :100;    $min2 = $account->p2;    if($account->p2 < 100)     printf('<tr><td><img id = "pows2" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td><input type="hidden" name = "pow2" id = "pow2" value = "%s" /><div style="direction:ltr;padding:5px;" id="d_pow2"></div></td></tr>',      $account->pow2,$power[$account->pow2]->name, $account->p2);    else    {     printf('<tr><td><img id = "pows2" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td>%s</td></tr>',      $account->pow2,$power[$account->pow2]->name,sprintf($lang['MaxPower'],$power[$account->pow2]->name));     $noSubmit++;    }    $form->AddText('pows2',$power[$account->pow2]->desc);   }   if($account->pow3)   {    $max3 = ($account->p3 + $account->point) <= 100 ? ($account->p3 + $account->point) :100;    $min3 = $account->p3;    if($account->p3 < 100)     printf('<tr><td><img id = "pows3" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td><input type="hidden" name = "pow3" id = "pow3" value = "%s" /><div style="direction:ltr;padding:5px;" id="d_pow3"></div></td></tr>',      $account->pow3,$power[$account->pow3]->name, $account->p3);    else    {     printf('<tr><td><img id = "pows3" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td>%s</td></tr>',      $account->pow3,$power[$account->pow3]->name,sprintf($lang['MaxPower'],$power[$account->pow3]->name));     $noSubmit++;    }    $form->AddText('pows3',$power[$account->pow3]->desc);   }   if($account->pow4)   {    $max4 = ($account->p4 + $account->point) <= 100 ? ($account->p4 + $account->point) :100;    $min4 = $account->p4;    if($account->p4 < 100)     printf('<tr><td><img id = "pows4" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td><input type="hidden" name = "pow4" id = "pow4" value = "%s" /><div style="direction:ltr;padding:5px;" id="d_pow4"></div></td></tr>',      $account->pow4,$power[$account->pow4]->name, $account->p4);    else    {     printf('<tr><td><img id = "pows4" class = "i57" src="img/her/ski/%s.gif" alt="%s"/></td><td>%s</td></tr>',      $account->pow4,$power[$account->pow4]->name,sprintf($lang['MaxPower'],$power[$account->pow4]->name));     $noSubmit++;    }    $form->AddText('pows4',$power[$account->pow4]->desc);   }   if($noSubmit != 4)    printf('<tr><td colspan="2" class = "center"><input type="submit" value="%s" /></td></tr>',     $lang['Save']);  }  else   printf('<tr><td colspan="2" class="center">%s</td></tr>', $lang['NoRecord']);  ?>

</table>
</center>
</form>
</div>
</div>
<script type="text/javascript">
<?php   if($account->pow1 and $account->p1 < 100){  ?>
var pow1f = function () {
$("pow1").value = pow1s.values.mid;
}
var pow1s = new slider();
pow1s.init({id:"d_pow1",style:{backgroundColor:"red",width:"150px"},pointer:{backgroundColor:"#6699cc"},values:{min:0,max:<?php echo $max1;?>,mid:<?php echo $min1;?>,fontSize:"10px"},fire:pow1f})
<?php  }  if($account->pow2 and $account->p2 < 100){  ?>
//***********************
var pow2f = function () {
$("pow2").value = pow2s.values.mid;
}
var pow2s = new slider();
pow2s.init({id:"d_pow2",style:{backgroundColor:"red",width:"150px"},pointer:{backgroundColor:"#6699cc"},values:{min:0,max:<?php echo $max2;?>,mid:<?php echo $min2;?>,fontSize:"10px"},fire:pow2f})
<?php  }  if($account->pow3 and $account->p3 < 100){  ?>
//************************
var pow3f = function () {
$("pow3").value = pow3s.values.mid;
}
var pow3s = new slider();
pow3s.init({id:"d_pow3",style:{backgroundColor:"red",width:"150px"},pointer:{backgroundColor:"#6699cc"},values:{min:0,max:<?php echo $max3;?>,mid:<?php echo $min3;?>,fontSize:"10px"},fire:pow3f})
<?php  }  if($account->pow4 and $account->p4 < 100){  ?>
//******************************
var pow4f = function () {
$("pow4").value = pow4s.values.mid;
}
var pow4s = new slider();
pow4s.init({id:"d_pow4",style:{backgroundColor:"red",width:"150px"},pointer:{backgroundColor:"#6699cc"},values:{min:0,max:<?php echo $max4;?>,mid:<?php echo $min4;?>,fontSize:"10px"},fire:pow4f})
<?php  }  ?>
</script>