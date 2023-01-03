<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');    $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');     $plus = $account->GetPlus();  $hero = $account->GetHero();  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  $union = new Union($account->uid);  $form->Header(array('profile'),array());  ?>
<div class="p_table">
<div>
<table class="p_d_right t_w_300">
<tr>
	<td></td>
	<td></td>
</tr>

</table>
</div>
<div>
<table class="p_d_left t_w_300">
  <tr>
    <td><?php    if(isset($list[1]))     echo $form->HeroItem($list[1],$power);    else     echo '&nbsp;';    ?></td>
    <td rowspan="4"><img id = "face" src="face.php"/></td>
    <td><?php    if(isset($list[7]))     echo $form->HeroItem($list[7],$power);    else     echo '&nbsp;';    ?></td>
  </tr>
  <tr>
    <td><?php    if(isset($list[2]))     echo $form->HeroItem($list[2],$power);    else     echo '&nbsp;';    ?></td>
	<td>
		<?php    if(isset($list[8]))     echo $form->HeroItem($list[8],$power);    else     echo '&nbsp;';   ?></td>
  </tr>
  <tr>
    <td><?php    if(isset($list[3]))     echo $form->HeroItem($list[3],$power);    else     echo '&nbsp;';   ?></td>
    <td><?php    if(isset($list[9]))     echo $form->HeroItem($list[9],$power);    else     echo '&nbsp;';   ?></td>
  </tr>
  <tr>
    <td><?php    if(isset($list[4]))     echo $form->HeroItem($list[4],$power);    else     echo '&nbsp;';   ?></td>
    <td><?php    if(isset($list[10]))     echo $form->HeroItem($list[10],$power);    else     echo '&nbsp;';   ?></td>
  </tr>
  <tr>
    <td><?php    if(isset($list[5]))     echo $form->HeroItem($list[5],$power);    else     echo '&nbsp;';   ?></td>
    <td class="center"></td>
    <td><?php    if(isset($list[6]))     echo $form->HeroItem($list[6],$power);    else     echo '&nbsp;';   ?></td>
  </tr>
</table>
</div>

<div style="clear:both"></div>

<div>
<table  class="p_d_right t_w_300">
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
</div>

<div>

<table class="p_d_left t_w_300">
<tr><td colspan="5"></td></tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>

</div>
<div style="clear:both"></div>

</div>

<?php  $form->Footer();  ?>