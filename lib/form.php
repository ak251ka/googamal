<?php  require_once('lib/utility.php');  require_once('lib/object.php');  require_once('.//eng/main/union.php');  require_once('.//eng/main/troop.php');  class Form  {   protected $_texts;   protected $_timers;   protected $_timer;   protected $_modal;      protected $day_bouo = false;   public function __construct()   {    $this->_texts = array();    $this->_timers= array();    $this->_timer = 0;   }   public function Header($css = NULL, $java = NULL)   {    global $lang;          global $session;          global $account;    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css" />
<meta name="author" content="<?php echo $lang['Googamal'];?>">
<meta name="keywords" content="<?php echo $lang['MetaK'];?>">
<meta name="Description" content="<?php echo $lang['MetaD'];?>">
<meta name="generator" content="<?php echo $lang['Googamal'];?>">
<meta name="publisher" content="<?php echo $lang['Googamal'];?>">
<meta name="designer" content="<?php echo $lang['Googamal'];?>">
<meta name="robots" content="INDEX, NOFOLLOW">
<script type="text/javascript" src="jav/main.js"></script>
<?php  if(is_array($css))  foreach($css as $c)   printf('<link href="css/%s.css" rel="stylesheet" type="text/css" />', $c);  if(is_array($java))  foreach($java as $j)   printf('<script type="text/javascript" src="jav/%s.js"></script>', $j);  $this->day_bouo = $session->FirstTime();  if($this->day_bouo)      $account->SetFields(array('t_b'=> 1));  ?>
<title><?php echo $lang['Googamal']; ?></title>
</head>
<body onload="main(); <?php      if($this->day_bouo)          printf($lang['DayBonus']);?>">
<?php     if($session->GetType() == LOG)    $this->ShowMenu();  }   protected function ShowMenu()   {        global $session;    global $town;    global $account;    global $union;    global $lang;    global $pm;    global $report;    $pro = $town->GetProduct();       ?>
<div class="main">
<div class="header">
 <div class="resource">
 <table class="resTable" cellpadding="0" cellspacing="0" border="0" dir="rtl">
  <tr>
    <td rowspan="3" class="br1"><img id = "r1" src="img/res/r1.gif" class = "i30" /></td>
    <td id = "thr1" class="br3"><?php echo round($town->r1);?></td>
    <td rowspan="3" class="br1"><img id = "r2" src="img/res/r2.gif" class = "i30" /></td>
    <td id = "thr2" class="br3"><?php echo round($town->r2);?></td>
    <td rowspan="3" class="br1"><img id = "r3" src="img/res/r3.gif" class = "i30"/></td>
    <td id = "thr3" class="br3"><?php echo round($town->r3);?></td>
  </tr>
  <tr>
    <td id = "pro1" class="br3"><?php echo round($pro['r1']);?></td>
    <td id = "pro2" class="br3"><?php echo round($pro['r2']);?></td>
    <td id = "pro3" class="br3"><?php echo round($pro['r3']);?></td>
  </tr>
  <tr>
    <td id = "lim1" class="br3"><?php echo $town->l1;?></td>
    <td id = "lim2" class="br3"><?php echo $town->l1;?></td>
    <td id = "lim3" class="br3"><?php echo $town->l1;?></td>
  </tr>
  <tr>
    <td rowspan="3" class="br2"><img id = "r4" src="img/res/r4.gif" class = "i30" /></td>
    <td id = "thr4" class="br4"><?php echo round($town->r4);?></td>
    <td rowspan="3" class="br2"><img id = "r5" src="img/res/r5.gif" class = "i30" /></td>
    <td id = "thr5" class="br4"><?php echo round($town->r5);?></td>
    <td rowspan="3" class="br2"><img id = "pop" src="img/res/pop.gif" class="i30"/></td>
    <td id = "used" class="br4"><?php echo round($town->GetUsed())?></td>
  </tr>
  <tr>
    <td id = "pro4" class="br4"><?php echo round($pro['r4']);?></td>
    <td id = "pro5" class="br4"><?php echo round($pro['r5']);?></td>
    <td id = "fWorker" class="br4"><?php echo $town->workers - ($town->w1 +$town->w2 +$town->w3 +$town->w4 +$town->w5);?></td>
  </tr>
  <tr>
    <td id = "lim4" class="br4"><?php echo $town->l1;?></td>
    <td id = "lim5" class="br4"><?php echo $town->l2;?></td>
    <td id = "wrks" class="br4"><?php printf("%s:%s:%s:%s:%s",$town->w1,$town->w2,$town->w3,$town->w4,$town->w5);?></td>
  </tr>
</table>

 </div>
 <div class="headImage">
 <img src="img/p1/bm1.png" />
 </div>
    <div class="headButtons">
       <div class="imageButton"><a href="map.php"><img src="img/map/m.gif" alt="<?php echo $lang['Map'];?>" class="i57"/></a></div>
       <div class="imageButton"><a href="statistics.php"><img src="img/amar.gif" alt="<?php echo $lang['Statistics'];?>" class="i57"/></a></div>
       <div class="imageButton"><a href="report.php">
       <?php      $notRead = $report->GetNotRead($account->id);      printf('<div class="headerBox2">%4s</div><div class ="headerBox"><img src="img/rep/r%s.gif" alt="%s" class="i57" /></div>',         $notRead >= 1000 ? '∞': $notRead, $notRead ? '1' : '0',$lang['Report']);      ?>
       </a></div>
       <div class="imageButton"><a href="pm.php"><?php      $notRead = $pm->GetNotRead();      printf('<div class="headerBox2">%4s</div><div class ="headerBox"><img src="img/pm/pm%s.gif" alt="%s" class="i57"/></div>',        $notRead >= 1000 ?'∞':$notRead,$notRead ? 'n' : 'r',$lang['Inbox']);      ?></a></div>
    </div>

  <div class="sysInfo">
	<table class="sysInfoTable" cellpadding="0" cellspacing="0" border="0">
	  <tr class="bl1">
	    <td colspan="2"><?php echo $this->AhrefImg('index.php','i24s','img/all/off.gif',$lang['Exit']);?><span class="counter"><?php echo date('H:i:s');?></span></td>
	  </tr>
      <tr class="bl2">
	    <td id = "idAcc" colspan="2" class = "alt" ><?php              $this->AddText('idAcc',$lang['Account']);              echo $this->PlayerLink($account->id,$account->name);              ?></td>
	  </tr>
	  <tr class="bl3">
	    <td width="87"><?php echo $account->money + $account->m_b;?></td>
	    <td width="87"><?php echo $this->AhrefImg('plus.php','i24','img/plus/m.gif',$lang['Money']);?></td>
	  </tr>
	  <tr class="bl4">
	    <td><?php echo $account->talant + $account->t_b;?></td>
	    <td><?php echo $this->AhrefImg('plus.php','i24','img/plus/t.gif',$lang['Talant']);?></td>
	  </tr>
	  <tr class="bl5">      
	    <td colspan="2"><?php              echo $this->AhrefImg('town.php?id='.$town->id,'i24','img/tow/'.$town->cap.'.gif',                  ($town->cap ? $lang['Capital']: $lang['Town']),                  $town->GetName($town->id));?></td>
	  </tr>
	  <tr class="bl6">
	    <td colspan="2"><?php     if(!$account->uid)     echo '&nbsp;';    else    {          if(!$union->IsMember($account->uid, $account->id))     {      if($account->Lock())       $account->SetUnion('0');      $account->UnLock();     }     else      echo $this->AhrefImg('union.php?id='.$account->uid,'i24','img/uni/0.gif',       $lang['Union'], $union->GetName($account->uid));    }?></td>
	  </tr>
	</table>
  </div>
 </div>
 <div class="contents">
  <div class="right">
   <div id="HeroFace" class="heroFace"><a href="hero.php"><img id = "hfImage" src="face.php" class = "alt" alt = "hero<?php             $text = '<center>'.$lang['Hero'].'</center>';             $life = round($account->life);             if($life < 1)                  $text .='<center>'.$lang['NotAvailable'].'</center>';             else                 $text .=sprintf('<center>%s %d %%</center>', $lang['Life'],$life);             $this->AddText('hfImage',$text);             ?>"/></a>
   </div>
   <?php if($account->pb >= (int)$_SERVER['REQUEST_TIME']){?>
   <div class="linksTop"><a href="link.php"><?php echo $lang['Link'];?></a></div>
   <div id="Links" class="links"><br />
   <?php     $list = $account->GetLinks();     foreach($list as $l)       printf('<a href="http://%s" target="_blank">%s</a><br />',$l->link,$l->titels);     ?>
   </div>
   <?php }?>
   <div id="villageListsTop" class="villageListsTop"></div>
   <div id="VillageLists" class="villageLists"><table>
   <?php  $list = $account->GetTownsList();  foreach($list as $l)  {   printf('<tr><td><img src = "img/tow/%s.gif" class ="i16" id= "tc%1$s"/></td>',$l['cap']);   if($l['loyalty'] == 100)    printf('<td><a id = "tid_%1$s" href="town.php?id=%1$s" class="tlink">%2$s</a></td></tr>',     $l['id'],$l['name']);   else    printf('<td><a id = "tid_%1$s" href="town.php?id=%s" class="tlink"><font color="#FF0000">%s</font></a>',        $l['id'],$l['name']);   $this->AddText('tid_'.$l['id'],    sprintf('<center>%s (%s,%s)</center><center>%s %d%%</center>',$lang['Peculiarities'],$l['x'],$l['y'],$lang['Loyalty'],$l['loyalty']));     }     unset($list);     gc_collect_cycles();     ?>
   
   </table></div>
   <div class="villageListsBelow">
   </div>
  </div>

  <div class="left">	
	<?php   }   public function Footer()   {    global $lang;    global $account;    global $town;   ?>
	</div>
	</div>
	<div style="clear:both"></div>
	<div class="footer"><?php require_once('.//temp/footer.php');?></div>
	<script language="javascript" type="text/javascript">
	var timer = Array();
	var texts = Array();
	var pro = Array();
	var res = Array();
	<?php   printf('texts["r1"] = "%s"; ',$lang['r1']);   printf('texts["r2"] = "%s"; ',$lang['r2']);   printf('texts["r3"] = "%s"; ',$lang['r3']);   printf('texts["r4"] = "%s"; ',$lang['r4']);   printf('texts["r5"] = "%s"; ',$lang['r5']);   printf('texts["rc"] = "%s"; ',$lang['Cost']);   printf('texts["t"] = "%s"; ',$lang['TimeProcess']);   printf('texts["pop"] = "%s"; ',$lang['Pop']);   printf('texts["Product"] = "%s"; ',$lang['Product']);   printf('texts["Have"] = "%s"; ',$lang['Have']);   printf('texts["Limits"] = "%s"; ',$lang['Limits']);   printf('texts["used"] = "%s"; ',$lang['Used']);   printf('texts["Worker"] = "%s"; ',$lang['Worker']);   printf('texts["fWorker"] = "%s"; ',$lang['FreeWorkers']);   printf('texts["tc0"] = "%s"; ',$lang['Town']);   printf('texts["tc1"] = "%s"; ',$lang['Capital']);   foreach($this->_texts as $t)    printf('texts["%s"] = "%s"; ', $t['id'], $t['text']);   foreach($this->_timers as $t)    printf('timer["%s"] = "%s"; ', $t['id'], $t['ref']);   if(count($this->_modal))   {    echo 'var modals = new Array();';    foreach ($this->_modal as $k =>$v)    printf('modals["%s"] = new Array(\'%s\',\'%s\',\'%s\');',$k, $v[0], $v[1], $v[2]);   }   $pro = $town->GetProduct();   for($i= 1;$i<5;$i++)   {    $r = 'r'.$i;    printf('pro[%1$d] = %2$s; res[%1$d] = %3$s; ',     $i, ($pro[$r] / ONE_TICK), $town->$r);   }   printf('pro[5] = %1$s; res[5] = %2$s; ',     ($pro['r5'] - $town->GetUsed())/ONE_TICK, $town->r5);   ?>
	</script>	
	</div>
</body>
</html>		
	<?php   }   public function Addtimer($length, $ref = '')   {    global $lang;    $this->_timers[$this->_timer]['id'] = 'tm'.$this->_timer;    $this->_timers[$this->_timer]['ref'] = $ref;    return Until($length,$this->_timers[$this->_timer++]['id']);   }   public function HeroItem(&$obj,&$pow)   {    global $lang;    $desc = '<b>'.$obj->name.'</b>'.$lang['HIPoint'];    $str = sprintf('<div id="hi_%s_%s" class="item">', $obj->id,$obj->t1);    $str .= sprintf('<img id = "hi_%s_%s_0" class = "h_i1" src="img/her/itm/%s_%s_%s.gif" alt="%s" />'     ,$obj->id,$obj->t1,$obj->t1,$obj->t2,$obj->t3,$lang['HeroItem']);    if($obj->t4)     $str .= sprintf('<img id = "hi_%s_%s_1" class = "h_i2" src="img/her/ski/%s.gif" alt="%s %s" />'      ,$obj->id,$obj->t1,$obj->t4,$lang['Property'],$obj->t4);    $str.= '</div>';    switch($obj->t1)    {     case 1:     case 2:     case 3:     case 4:      if($obj->t2 == 5)       $desc .= $lang['HeroPoint'.$obj->t1]. sprintf($lang['HTP'.$obj->t2], $obj->t3 * SPACIAL_HERO_ITEM_TRAIN);      else       $desc .= $lang['HeroPoint'.$obj->t1]. sprintf($lang['HTP'.$obj->t2], $obj->t3 * BASE_HERO_ITEM_TRAIN);      break;     case 5:      $desc .= sprintf($lang['HeroPoint5'],$obj->t2 * BASE_HERO_WEAPON_POINT);      break;     case 6:      $desc .= sprintf($lang['HeroPoint6'],$obj->t2 * BASE_HERO_WEAPON_POINT);      break;     case 7:     case 8:     case 9:     case 10:      $desc .= sprintf($lang['HeroPoint'.$obj->t1], round($obj->t2 * BASE_HERO_ITEM_POINT));      break;    }    if($obj->t4)     $desc .= sprintf('<center>%s</center>%s : %s %% %s',      $lang['Property'],$pow[$obj->t4]->name, round($obj->t3*HERO_ITEM_SPACIAL_POINT),$lang['Increase']);    $this->AddText(sprintf('hi_%s_%s', $obj->id, $obj->t1),$desc);    return $str;   }   public function AddText($id,$text)   {    global $lang;    $i = count($this->_texts);    $this->_texts[$i]['id'] = $id;    $this->_texts[$i]['text'] = $text;   }   public function IsAddedText($id)   {    for($i = 0;$i<count($this->_texts);$i++)     if($this->_texts[$i]['id'] == $id)      return true;    return false;   }   public function AhrefImg($link, $class, $img, $alt,$text = '')   {    $host  = $_SERVER['HTTP_HOST'];    return sprintf('<a href="http://%s/%s"><img class = "%s" src="%s" alt="%s" />%s</a>'     ,$host,$link, $class, $img, $alt,$text);   }   public function Ahref($link, $text)   {    $host  = $_SERVER['HTTP_HOST'];    return sprintf('<a href="http://%s">%s</a>', $host.$link, $text);   }   public function PlayerLink($id, $name)   {    if(!$id)     return '&nbsp;';    return $this->Ahref('/detail.php?kind=player&amp;id='.$id, $name);   }   public function TownLink($id,$name)   {    if(!$id)     return '&nbsp;';    return $this->Ahref('/detail.php?kind=town&amp;id='.$id, $name);   }   public function ClooneyLink($id,$tname)   {    global $lang;    if(empty($tname))     return $this->Ahref('/detail.php?kind=clooney&amp;id='.$id, $lang['Clooney']);    else     return $this->Ahref('/detail.php?kind=clooney&amp;id='.$id, $lang['ClooneyCapture'].' '.$tname);   }   public function UnionLink($id,$name)   {    return $this->Ahref('/union.php?id='.$id, $name);   }   public function MapLink($x,$y, $name)   {    return $this->Ahref('/map.php?x='.$x.'&amp;y='.$y, $name);   }   public function AddPagingForm($form,$show,$page,$row,$hidden = NULL)   {    global $lang;    if(empty($hidden))     return sprintf('<form action="%s.php" method="get"><input type="hidden" name = "show" value="%s"/><input type="hidden" name="page" value="%d"/><input type="text" id="row" name="row" value="%d" /><input type="submit" value="%s" class="buttonClass" /></form>',      $form,$show,$page,$row,$lang['Show']);    $str = '';    foreach($hidden as $key=>$value)    $str .= sprintf('<input type="hidden" id = "%s" name="%s" value="%s" />',     $key,$key,$value);    return sprintf('<form action="%s.php" method="get"><input type="hidden" name = "show" value="%s"/>%s<input type="hidden" name="page" value="%d"/><input type="text" id="row" name="row" value="%d" /><input type="submit" value="%s" class="buttonClass" /></form>',     $form,$show,$str,$page,$row,$lang['Show']);   }   public function Replace($str)   {    if(empty($str))     $str = '&nbsp;';    $str = nl2br($str);    $str = str_replace('[b]','<b>',$str);    $str = str_replace('[/b]','</b>',$str);    $str = str_replace('[u]','<u>',$str);    $str = str_replace('[/u]','</u>',$str);    $str = str_replace('[i]','<i>',$str);    $str = str_replace('[/i]','</i>',$str);    $str = str_replace('[bl]','<blink>',$str);    $str = str_replace('[/bl]','</blink>',$str);    $str = str_replace('O:-)','<img src="img/sm/angel.gif">',$str);    $str = str_replace('X(','<img src="img/sm/angry.gif">',$str);    $str = str_replace(';;)','<img src="img/sm/beyelashes.gif">',$str);    $str = str_replace(':D','<img src="img/sm/biggrin.gif">',$str);    $str = str_replace(':&gt;','<img src="img/sm/blushing.gif">',$str);    $str = str_replace('=((','<img src="img/sm/bheart.gif">',$str);    $str = str_replace(':O)','<img src="img/sm/clown.gif">',$str);    $str = str_replace(':-/','<img src="img/sm/confused.gif">',$str);    $str = str_replace('B-)','<img src="img/sm/cool.gif">',$str);    $str = str_replace(':((','<img src="img/sm/crying.gif">',$str);    $str = str_replace('&gt;|)','<img src="img/sm/devilish.gif">',$str);    $str = str_replace(':-B','<img src="img/sm/dork.gif">',$str);    $str = str_replace('=P~','<img src="img/sm/droling.gif">',$str);    $str = str_replace(':(','<img src="img/sm/frown.gif">',$str);    $str = str_replace(':-*','<img src="img/sm/kiss.gif">',$str);    $str = str_replace('|-)','<img src="img/sm/laughing.gif">',$str);    $str = str_replace(':x','<img src="img/sm/lstruck.gif">',$str);    $str = str_replace(':=(','<img src="img/sm/pouting.gif">',$str);    $str = str_replace(':-&amp;','<img src="img/sm/puke.gif">',$str);    $str = str_replace(':/)','<img src="img/sm/reyebrew.gif">',$str);    $str = str_replace('I-)','<img src="img/sm/sleepy.gif">',$str);    $str = str_replace(':=|','<img src="img/sm/silent.gif">',$str);    $str = str_replace(':)','<img src="img/sm/smile.gif">',$str);    $str = str_replace(';&gt;','<img src="img/sm/smug.gif">',$str);    $str = str_replace(':|','<img src="img/sm/sface.gif">',$str);    $str = str_replace(':-O','<img src="img/sm/surprise.gif">',$str);    $str = str_replace(':-(','<img src="img/sm/tired.gif">',$str);    $str = str_replace(':P','<img src="img/sm/tongue.gif">',$str);    $str = str_replace(';-)','<img src="img/sm/wink.gif">',$str);    $str = str_replace(':-S','<img src="img/sm/worried.gif">',$str);    $matches = array();    preg_match_all('/\[x\,y\](.*?)\[\/x\,y\]/', $str, $matches);    if($matches <> NULL){     $map = $matches[1];        $max = sizeof($map);     for($i = 0; $i < $max;$i++)      {            $mapPoint = explode(",", $map[$i]);         $map_url = '<a href ="map.php?x='.$mapPoint[0].'&y='.$mapPoint[1].'">('.$mapPoint[0].','.$mapPoint[1].')</a>';       $str = preg_replace('/\[x\,y\](.*?)\[\/x\,y\]/', $map_url, $str,1);      }    }    $str = str_replace('\'','\\\'',$str);    return $str;   }   public function EchoCost($r1, $r2, $r3, $r4,$r5, $t, $c)   {    global $lang;    if($c)     printf('<img id = "r1" src="img/res/r1.gif" alt="%s" class="i16" />%s<img id = "r2" src="img/res/r2.gif" alt="%s" class="i16" />%s<img id = "r3" src="img/res/r3.gif" alt="%s" class="i16" />%s<img id = "r4" src="img/res/r4.gif" alt="%s" class="i16" />%s<img id = "r5" src="img/res/r5.gif" alt="%s" class="i16" />%s<img id = "rt" src="img/res/t.gif" alt="%s" class="i16" />%s<img id = "rc" src="img/res/c.gif" alt="%s" class="i16" />%s',     $lang['r1'],$r1,$lang['r2'],$r2,$lang['r3'],$r3,$lang['r4'],$r4,$lang['r5'],$r5,$lang['TimeProcess'],$t,     $lang['Cost'],$c);    else     printf('<img id = "r1" src="img/res/r1.gif" alt="%s" class="i16" />%s<img id = "r2" src="img/res/r2.gif" alt="%s" class="i16" />%s<img id = "r3" src="img/res/r3.gif" alt="%s" class="i16" />%s<img id = "r4" src="img/res/r4.gif" alt="%s" class="i16" />%s<img id = "r5" src="img/res/r5.gif" alt="%s" class="i16" />%s<img id = "rt" src="img/res/t.gif" alt="%s" class="i16" />%s',     $lang['r1'],$r1,$lang['r2'],$r2,$lang['r3'],$r3,$lang['r4'],$r4,$lang['r5'],$r5,$lang['TimeProcess'],$t);       }   public function TroopInfo($r1, $r2, $r3, $r4,$r5, $t, $c,$ap, $dp1, $dp2, $dp3, $tcr, $sp)   {    global $lang;    return sprintf('<img id = "r1" src="img/res/r1.gif" alt="%s" class="i24" />%s<img id = "r2" src="img/res/r2.gif" alt="%s" class="i24" />%s<img id = "r3" src="img/res/r3.gif" alt="%s" class="i24" />%s<img id = "r4" src="img/res/r4.gif" alt="%s" class="i24" />%s<img id = "r5" src="img/res/r5.gif" alt="%s" class="i24" />%s<img id = "rt" src="img/res/t.gif" alt="%s" class="i24" />%s<img id = "rc" src="img/res/c.gif" alt="%s" class="i24" />%s<br /><img id = "ap1" src="img/troop/ap.gif" alt="%s" class="i24"  />%s<img id = "dp1" src="img/troop/dp1.gif" alt="%s" class="i24"  />%s<img id = "dp2" src="img/troop/dp2.gif" alt="%s" class="i24"  />%s<img id = "dp3" src="img/troop/dp3.gif" alt="%s" class="i24"  />%s<img id = "crt" src="img/troop/tcr.gif" alt="%s" class="i24"  />%s<img id = "tsp" src="img/troop/tsp.gif" alt="%s" class="i24"  />%s',    $lang['r1'],$r1,$lang['r2'],$r2,$lang['r3'],$r3,$lang['r4'],$r4,$lang['r5'],$r5,$lang['TimeProcess'],$t,$lang['Cost'],$c,    $lang['AP'],$ap,$lang['tdp1'],$dp1,$lang['tdp2'],$dp2,$lang['tdp3'],$dp3,    $lang['tcr'],$tcr, $lang['Speed'],$sp);   }   public function BlockPage($msg = NULL)   {    global $lang;    printf('<center><img src="img/all/ad.png" alt="http 403" /></center><center>%s</center>',     empty($msg) ? $lang['NoPermission'] : $msg);       }   public function AddModal($id,$head,$body,$footer = '')   {    $this->_modal[$id][0] = $head;    $this->_modal[$id][1] = $body;    $this->_modal[$id][2] = $footer;   }   public function ShowReportTroops($troop, $res = NULL, $elixir = NULL,$extera = NULL)   {    global $troops;    global $lang;          global $dbo;    echo  '<table class="rep_table_top" style="border: 1px solid black; margin-right:140px; width:530px;margin-top:10px; margin-bottom:0px;"><tr><td colspan="15">';          $pname = $dbo->ExectueScaler(sprintf('SELECT `name` FROM `%saccount` WHERE `id` = \'%s\' LIMIT 1;',DB_PERFIX,$troop[1]),'name');          $tmap = $dbo->ExectueScaler(sprintf('SELECT `name` FROM `%stown` WHERE `id` = \'%s\' LIMIT 1;',DB_PERFIX,$troop[2]),'name');    switch($troop[0])    {     case RE_ATTAKER_T:      echo $lang['Attacker'];      break;     case RE_DEFENDANT_T:      echo $lang['Defendant'];      break;     case RE_SUPPORT_T:      echo $lang['Support'];      break;              case RE_BLOCKAGE_T:                  echo $lang['RP_K_6'];                  break;    }    echo '</td></tr>';    if(!empty($pname))     printf('<tr><td colspan="15">%s</td></tr>',$this->PlayerLink($troop[1],$pname));    if(!empty($tmap))     printf('<tr><td colspan="15">%s</td></tr>',$this->TownLink($troop[2],$tmap));    printf('<tr>  <td><img src="img/troop/s/%1$s_1.gif" alt="%2$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_2.gif" alt="%3$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_3.gif" alt="%4$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_4.gif" alt="%5$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_5.gif" alt="%6$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_6.gif" alt="%7$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_7.gif" alt="%8$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_8.gif" alt="%9$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_9.gif" alt="%10$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_10.gif" alt="%11$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_11.gif" alt="%12$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_12.gif" alt="%13$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_13.gif" alt="%14$s" class = "i30"/></td>  <td><img src="img/troop/s/%1$s_14.gif" alt="%15$s" class = "i30"/></td>  <td><img src="img/troop/h.gif" alt="%16$s" class = "i30"/></td></tr>',     $troop[3],     $troops[$troop[3]][1][6],     $troops[$troop[3]][2][6],     $troops[$troop[3]][3][6],     $troops[$troop[3]][4][6],     $troops[$troop[3]][5][6],     $troops[$troop[3]][6][6],     $troops[$troop[3]][7][6],     $troops[$troop[3]][8][6],     $troops[$troop[3]][9][6],     $troops[$troop[3]][10][6],     $troops[$troop[3]][11][6],     $troops[$troop[3]][12][6],     $troops[$troop[3]][13][6],     $troops[$troop[3]][14][6],     $lang['Hero']);          echo '<tr>';    for($i =4; $i < 19; $i++)     printf('<td>%d</td>',$troop[$i]);    echo '</tr><tr>';    for($i =19; $i < 34; $i++)     printf('<td>%d</td>',$troop[$i]);    echo '</tr>';    if(count($res))    {     echo'<tr>';     for($i=1;$i<6;$i++)      printf('<td><img src="img/res/r%d.gif" id="r%d" class="i24"  /></td><td colspan="2">%d</td>',       $i, $i, $res[$i]);     echo '</tr>';              if(isset($res[6]))                  printf('<tr><td colspan="15"><img src = "/img/troop/tcr.gif" class = "i24" alt = "%s" />%s/%s</td></tr>',                      $lang['Capacity'], $res[6], $res[7]);    }          if(count($elixir))          {              foreach($elixir as &$e)                  printf('<tr><td colspan="15">%s</td></tr>',$e);          }          if(count($extera))          {              foreach($extera as &$e)                  printf('<tr><td colspan="15">%s</td></tr>',$e);          }    echo '</table>';   }      public function MapLinkID($id,$text)      {          return $this->Ahref('/map.php?id='.$id, $text);      }  }  $form = new Form;  ?>