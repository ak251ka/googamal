<div class="error"><?php   $Available = $hero->Available();  if($Available)    echo '&nbsp;';   else  {   if($account->life == '0')   {    $Available = true;    echo $lang['DeadHero'];   }   else    echo $lang['NotAvailable'];  }  ?></div>
<div>
<form action="hero.php?show=<?php echo P_WEAPON;?>" method="post">
<input type="hidden" name = "com" id = "com" value="<?php echo P_WEAPON;?>"/>
<?php  $ns = 0;  $list = $hero->GetItems();  ?>
<div class="h_f_right">
<table class="h_table">
  <tr>
    <td id = "b_1_1" class="box">
    <?php  if(isset($list[1]))   echo $form->HeroItem($list[1],$power);  else   echo '&nbsp;';?>
    </td>
    <td colspan="2" rowspan="3"><img id = "face" src="face.php"/></td>
    <td id = "b_7_7" class="box"><?php  if(isset($list[7]))   echo $form->HeroItem($list[7],$power);  else   echo '&nbsp;';?>
    </td>
  </tr>
  <tr>
    <td id = "b_2_2" class="box"><?php  if(isset($list[2]))   echo $form->HeroItem($list[2],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_8_8" class="box"><?php  if(isset($list[8]))   echo $form->HeroItem($list[8],$power);  else   echo '&nbsp;';?>
    </td>
  </tr>
  <tr>
    <td id = "b_3_3" class="box"><?php  if(isset($list[3]))   echo $form->HeroItem($list[3],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_9_9" class="box"><?php  if(isset($list[9]))   echo $form->HeroItem($list[9],$power);  else   echo '&nbsp;';?>
   </td>
  </tr>
  <tr>
    <td id = "b_4_4" class="box"><?php  if(isset($list[4]))   echo $form->HeroItem($list[4],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_5_5" class="box"><?php  if(isset($list[5]))   echo $form->HeroItem($list[5],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_6_6" class="box"><?php  if(isset($list[6]))   echo $form->HeroItem($list[6],$power);  else   echo '&nbsp;';?>
    </td>
    <td id = "b_10_10" class="box"><?php  if(isset($list[10]))   echo $form->HeroItem($list[10],$power);  else   echo '&nbsp;';?>
   </td>
  </tr>
</table>
</div>

<div class="h_f_left">
<table class="h_table">
<?php  $maxItem = 0;  if(count($list)==0)   $maxItem = 14;  else  {   $temp = end($list);   $maxItem = (int)$temp->box;   if($maxItem <=10)    $maxItem = 26;   else    $maxItem += (4 - ( ($maxItem - 10) % 4));   if(($maxItem-10) <= count($list) - 4)    $maxItem += 4;  }    for($i = 11; $i <= $maxItem;$i++)  {   if(($i - 10)%4 ==1)    echo '<tr>';   printf('<td id = "b_%d_A" class="box">', $i);   if(isset($list[$i]))    echo $form->HeroItem($list[$i],$power);   else    echo '&nbsp;';   echo '</td>';   if(($i - 9)%4 ==1)    echo '</tr>';  }    ?>
</table>
</div>
<div style="clear:both"></div>
<?php  for($i= 1; $i<= $maxItem; $i++)   printf('<input type="hidden" id="hv_%d" name="hv_%d" value="%s"/>',    $i,$i,isset($list[$i])?$list[$i]->id:'?');  ?>
<div class="center"><input type="submit" value="<?php echo $lang['Save'];?>" <?php if(!$Available) echo 'disabled="disabled"';?> /></div>
</form>
</div>
<script type="text/javascript">HeroItem.Setup();</script>