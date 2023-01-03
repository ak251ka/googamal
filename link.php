<?php  require_once('eng/sec/session.php');  require_once('lib/form.php');  require_once('lib/object.php');  require_once('eng/conn/pm.php');  require_once('eng/main/account.php');  require_once('eng/main/town.php');  require_once('eng/main/plus.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/hero.php');  require_once('eng/main/union.php');  require_once('eng/main/report.php');  if(!$session->IsLoad() or $session->GetType() != LOG)   $session->Href('index.php');     $account = new Account($session->aid,true);  if(!$account->IsLoad())   $session->Href('index.php');  $account->UpdateTown($_SERVER['REQUEST_TIME']);  if(!$account->ac)      $session->Href('index.php');  $plus = $account->GetPlus();  $hero = $account->GetHero();  $town = $account->GetDefaultTown();  $pm = new PM($session->aid);  $form->Header(array('hero'),array('link'));  ?>
<div class="h56">
<img src="img/m0.png"  />
</div>
<div class="bgm1">
<center><?php echo $lang['Links'];?></center>
<?php  $form->AddText('trUp',$lang['Up']);  $form->AddText('trDown',$lang['Down']);  $form->AddText('trDel',$lang['Delete']);    $list = $account->GetLinks();  if(isset($_POST['com']))  {   $temp = array();   $i = 0;   $j = 0;   while(true)   {    $i++;    $t = "t$i";    $l = "l$i";    if(!array_key_exists($t,$_POST) or !array_key_exists($l,$_POST))     break;    if(!empty($_POST[$t]) and !empty($_POST[$l]))     $temp[$j++] = array('pid' =>$account->id,'titels' => $_POST[$t],'link' =>$_POST[$l]);   }   $account->SetLinks($temp);   $list = $account->GetLinks();  }  printf('<form action="link.php" method="post">');  ?>
<input type="hidden" name = "com" value="1" /><center>
<table id = "links" class ="h_table">
<tr><td><?php echo $lang['Name'];?></td><td><?php echo $lang['Link'];?></td><td colspan="3"><?php echo $lang['Action'];?></td></tr>
<?php  $i = 1;  foreach($list as &$l)   printf('<tr><td><input type="text" name = "t%1$d"  value = "%2$s"/></td><td><input type="text" name="l%1$d"  value = "%3$s" /></td><td><img id ="trDel" src="img/all/f2.gif" class="i24s"  onclick="DeleteTR(this);"/></td><td><img id ="trUp" src="img/all/h3.gif" class="i24s" onclick="ChangeTR(this,\'1\');"  /></td><td><img id ="trDown" src="img/all/h4.gif" class="i24s" onclick="ChangeTR(this,\'0\');"  /></td></tr>',$i++,$l->titels,$l->link,$lang['Delete']);  ?>
<tr><td colspan="2" class="center"><input type="button" value="<?php echo $lang['New'];?>" onclick="NewTr('links');"  /></td><td colspan="3" class="center"><input type="submit" value="<?php echo $lang['Save'];?>"  /></td></tr></table></center></div>
<div class="h56">
<img src="img/m2.png"  />
</div>
<?php  $form->Footer();  $session->Save();  ?>