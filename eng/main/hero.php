<?php  require_once('lib/config.php');  require_once('lib/dbo.php');  require_once('lib/object.php');  require_once('lib/defines.php');  require_once('lib/utility.php');  require_once('eng/main/account.php');  require_once('eng/main/plus.php');  require_once('lng/per.php');  class Hero  {   protected $_parrent;   protected $_ap;   protected $_dp;   protected $_hp1;   protected $_hp2;   protected $_hp3;   protected $_hp4;   public function __construct(&$acc)   {    $this->_parrent = $acc;    if(!isset($_SESSION['hfa']))     $this->SetFace();   }   public function LevelPoint($lvl)   {    $a = 100;    for($i = 0; $i < $lvl; $i++)     $a += $i * 50;    return $a;   }   public function SetFace()   {    $_SESSION['hfa'] = $this->_parrent->hfa;    $_SESSION['hfb'] = $this->_parrent->hfb;    $_SESSION['hfc'] = $this->_parrent->hfc;    $_SESSION['hfd'] = $this->_parrent->hfd;    $_SESSION['hff'] = $this->_parrent->hff;    $_SESSION['hfm'] = $this->_parrent->hfm;    $_SESSION['hfr'] = $this->_parrent->hfr;    $_SESSION['hfs'] = $this->_parrent->hfs;   }   public function SetPoints()   {    $point = array('hap'=> 0,'hdp'=> 0,     'hhp1'=> 0,'hhp2'=> 0,'hhp3'=> 0,'hhp4'=> 0,     'hp1'=> 0,'hp2'=> 0,'hp3'=> 0,'hp4'=> 0,'hp5'=> 0,'hp6'=> 0,'hp7'=> 0,     'hp8'=> 0,'hp9'=> 0,'hp10'=> 0,'hp11'=> 0,'hp12'=> 0,'hp13'=> 0,'hp14'=> 0,     'khp1'=> 0, 'khp2'=> 0, 'khp3' => '0', 'khp4' => '0',     'php1' => '0', 'php2' => '0', 'php3' => '0','php4' => '0');        $point['hap'] = $this->_parrent->lvl * 100;    $point['hdp'] = $this->_parrent->lvl * 100;    $items = $this->GetItems();    for($i = 1;$i< 11;$i++)    {     if(!isset($items[$i]))      continue;     switch($i)     {      case 1:      case 2:      case 3:      case 4:       $point['khp'.$i] = $items[$i]->t2;       $point['php'.$i] = $items[$i]->t3;       if($items[$i]->t4)        $point['hp'.$items[$i]->t4] += round($items[$i]->t3 * HERO_ITEM_SPACIAL_POINT);       break;      case 5:       $point['hap'] += $items[$i]->t2 * BASE_HERO_WEAPON_POINT;       break;      case 6:       $point['hdp'] += $items[$i]->t2 * BASE_HERO_WEAPON_POINT;       break;      case 7:       $point['hhp1'] += $items[$i]->t2 * BASE_HERO_ITEM_POINT;       break;      case 8:       $point['hhp2'] += $items[$i]->t2 * BASE_HERO_ITEM_POINT;       break;      case 9:       $point['hhp3'] += $items[$i]->t2 * BASE_HERO_ITEM_POINT;       break;      case 10:       $point['hhp4'] += $items[$i]->t2 * BASE_HERO_ITEM_POINT;       break;     }    }    if($this->_parrent->pow1)     $point['hp'.$this->_parrent->pow1] += $this->_parrent->p1;    if($this->_parrent->pow2)     $point['hp'.$this->_parrent->pow2] += $this->_parrent->p2;    if($this->_parrent->pow3)     $point['hp'.$this->_parrent->pow3] += $this->_parrent->p3;    if($this->_parrent->pow4)     $point['hp'.$this->_parrent->pow4] += $this->_parrent->p4;         if($point['hp1'])    {     $point['hap'] += $point['hp1'] * BASE_HERO_POWER_POINT;     $point['hdp'] += $point['hp1'] * BASE_HERO_POWER_POINT;    }    for($i =2;$i < 15;$i++)    {     $t = 'hp'.$i;     if( $point[$t] > 100)      $point[$t] = '100';    }    $point['hp2'] *= 2;    $point['hp3'] *= 2;    $point['hp4'] *=  0.4;    $point['hp5'] *=  0.4;    $point['hp6'] *=  0.2;    $point['hp7'] *=  0.2;    $point['hp8'] *=  0.2;    $point['hp9'] *=  2;    $point['hp10'] +=  3;    if(!$point['hp10'])     $point['hp10'] = 3;    if($this->_parrent->golden)     $point['hp10'] += 5;    $point['hp11'] *=  0.5;    $point['hp12'] *=  50;    $point['hp13'] *=  0.3;    $point['hp14'] *=  2;    $this->_parrent->SetFields($point);   }   public function GetPoint($id)   {    if(is_numeric($id))    {     $t = 'hp'.$id;     return $this->_parrent->$t;    }    switch($id)    {     case 'AP' :      return $this->_parrent->hap;     case 'DP' :      return $this->_parrent->hdp;     case 'HP1':      return $this->_parrent->hhp1;     case 'HP2':      return $this->_parrent->hhp2;     case 'HP3':      return $this->_parrent->hhp3 + $this->_parrent->hp14;     case 'HP4':      return $this->_parrent->hhp4;     case 'SPEED':      return 10 + ($this->_parrent->lvl / 10);    }   }   public function &GetItems()   {    $arr = array();    $max = 11;    global $dbo;    $sql = $dbo->ExectueQuery(sprintf('SELECT `hi`.*, `i`.`name`,`i`.`t1`,`i`.`t2`,`i`.`t3`,`i`.`t4` FROM `%1$shero_hi` AS `hi` LEFT JOIN `%1$shero_i` AS `i` ON ( `hi`.`hid` = `i`.`id` ) WHERE `hi`.`pid` = \'%2$s\' AND `hi`.`sel` = \'0\' ORDER BY `hi`.`box`',     DB_PERFIX, $this->_parrent->id));    while($row = $dbo->Read($sql))    {     if(isset($arr[$row['box']]) or !$row['box'])     {      $arr[$max] = new Object($row);      $arr[$max]->box = $max;      $this->SaveItems($row['id'], $max);      $max++;     }     elseif($row['box'] <= 10 and $row['t1'] != $row['box'])     {      $arr[$max] = new Object($row);      $arr[$max]->box = $max;      $this->SaveItems($row['id'], $max);      $max++;     }     else     {      $arr[$row['box']] = new Object($row);      if($max <= $row['box'])       $max = $row['box'] + 1;     }    }    $dbo->Cancel($sql);    gc_collect_cycles();    return $arr;   }   protected function SaveItems($id,$box,$sell = false)   {    global $dbo;    if($sell)     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hi` SET `box`= \'%s\', `sel` = \'0\' WHERE `id` = \'%s\' AND `pid` = \'%s\'',       DB_PERFIX, $box, $id, $this->_parrent->id));    else     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hi` SET `box`= \'%s\' WHERE `id` = \'%s\' AND `pid` = \'%s\'',       DB_PERFIX, $box, $id, $this->_parrent->id));   }   public function UpdateSell($up)   {    if(!$this->_parrent->Lock())     return;    global $dbo;    global $plus;    $sql = $dbo->ExectueQuery(     sprintf('SELECT * FROM `%shero_hs` WHERE (`p1` = \'%s\' OR `p2` = \'%s\') AND `modify` <= \'%s\' AND `sol` = \'0\'',      DB_PERFIX, $this->_parrent->id,$this->_parrent->id, $up));    $arr = array();    $other  = 0;    $plus = &$this->_parrent->GetPlus();    while($row = $dbo->Read($sql))    {     $other = ($row['p1'] == $this->_parrent->id ? $row['p2'] : $row['p1']);     if($other)     {      $dbo->ExectueQuery(sprintf('UPDATE `%saccount` SET `locks` = \'1\' WHERE `id` = \'%s\' AND `locks` = \'0\' LIMIT 1',       DB_PERFIX, $other));      if(!$dbo->AffectedRows())       continue;     }     if($row['p1'])     {      $dbo->ExectueQuery(sprintf('UPDATE `%saccount` SET `m_b` = `m_b` + \'%s\' WHERE `id` = \'%s\' LIMIT 1',        DB_PERFIX, $row['nb'], $row['p1']));      $plus->UseMoney($row['nb'], BUY_ITEM_H, INCOMMING, $row['p1']);     }     if($row['p2'])     {      $dbo->ExectueQuery(sprintf('UPDATE `%saccount` SET `m_b` = `m_b` + \'%s\' WHERE `id` = \'%s\' LIMIT 1',        DB_PERFIX, $row['mb'] - $row['nb'], $row['p1']));      $plus->UseMoney($row['mb'] - $row['nb'], CANCEL_ITEM_H, INCOMMING, $row['p2']);     }     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hi` SET `pid` = \'%s\',`box` = \'0\',`sel` = \'0\' WHERE `id` = \'%s\' LIMIT 1',      DB_PERFIX, $row['p2'], $row['item']));     $dbo->ExectueQuery(sprintf('UPDATE `%shero_ms` SET `m1` = \'%s\' WHERE `id` = \'%s\' AND (`m1` = \'0\' OR `m1` > \'%s\')',       DB_PERFIX,$row['nb'], $row['mid'],$row['nb']));     $dbo->ExectueQuery(sprintf('UPDATE `%shero_ms` SET `m2` = \'%s\' WHERE `id` = \'%s\' AND `m2` < \'%s\'',       DB_PERFIX,$row['nb'], $row['mid'],$row['nb']));     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hs` SET `sol` = \'1\' WHERE `id` = \'%s\' LIMIT 1',       DB_PERFIX, $row['id']));     if($other)      $dbo->ExectueQuery(sprintf('UPDATE `%saccount` SET `locks` = \'0\' WHERE `id` = \'%s\' LIMIT 1',       DB_PERFIX, $other));     gc_collect_cycles();    }    $this->_parrent->Unlock();    $dbo->Cancel($sql);   }   public function SetList($arr)   {        $temp = $this->GetItems();    foreach ($arr as $key =>$value)    {     if(!$value)      continue;     if(isset($this->_items[$key]))     {      if($this->_items[$key]->id != $value)       $this->SaveItems($value, $key);     }     else      $this->SaveItems($value, $key);    }    $this->SetPoints();   }   public function GetPowerDesc()   {    global $dbo;    $arr = array();    $sql = $dbo->ExectueQuery(sprintf('SELECT * FROM `%shero_pow`',DB_PERFIX));    while($row = $dbo->Read($sql))     $arr[$row['id']] = new Object($row);    $dbo->Cancel($sql);    return $arr;   }   public function SellItem($id)   {    global $dbo;    $id = ValidNumber($id, true);    if(!$id)     return;    $row = $dbo->ExectueRow(sprintf('SELECT `hi`.*,`i`.`t1`,`i`.`t4` FROM `%shero_hi` AS `hi` LEFT JOIN `%shero_i` AS `i` ON (`hi`.`hid` = `i`.`id`) WHERE `hi`.`id` = \'%s\' AND `hi`.`pid` = \'%s\' AND `hi`.`sel` = \'0\'',     DB_PERFIX,DB_PERFIX,$id,$this->_parrent->id));     if(empty($row))     return;    if($row['box'] >=1 and $row['box'] <=10)     return;    $tick = $_SERVER['REQUEST_TIME'] + (24 * ONE_TICK);          $today = Today($tick);    $arr = array();    $arr['item'] = $id;    $arr['hid'] = $row['hid'];          $dbo->ExectueQuery(sprintf('INSERT INTO `%1$shero_ms` (`hid`, `modify`) SELECT * FROM (SELECT \'%2$s\', \'%3$s\') AS `tmp` WHERE NOT EXISTS ( SELECT `id` FROM `%1$shero_ms` WHERE `hid` = \'%2$s\' AND `modify` = \'%3$s\') LIMIT 1;',DB_PERFIX,$row['hid'],$today));          $id = $dbo->ExectueScaler(sprintf('SELECT `id` FROM `%shero_ms` WHERE `hid` = \'%s\' and `modify` = \'%s\' LIMIT 1;',              DB_PERFIX,$row['hid'],$today),'id');    $brr = array('sel'=>'1');    $dbo->UpdateRow(DB_PERFIX.'hero_hi', $brr, $arr['item']);    $arr['t1'] = $row['t1'];    $arr['mid'] = $id;    $arr['p1'] = $this->_parrent->id;    $arr['nb'] = $row['t4'] ? EXCHANGE_T: EXCHANGE_M;    $arr['mb'] = $arr['nb'];    $arr['modify'] = $tick;    $dbo->InsertRow(DB_PERFIX.'hero_hs', $arr);    gc_collect_cycles();   }   public function CancelSell($id)   {    global $dbo;    $id = ValidNumber($id, true);    $iid = $dbo->ExectueScaler(sprintf('SELECT `item` FROM `%shero_hs` WHERE `id` = \'%s\' LIMIT 1',DB_PERFIX,$id),'item');    $dbo->ExectueQuery(sprintf('DELETE FROM `%shero_hs` WHERE `id` = \'%s\' AND `p2` =\'0\' AND `p1` = \'%s\' AND `locks` = \'0\'',      DB_PERFIX, $id, $this->_parrent->id));    if($dbo->AffectedRows())    {     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hi` SET `box` = \'0\', `sel` = \'0\' WHERE `id` = \'%s\'', DB_PERFIX, $iid));    }   }   public function DelSold($id, $Buyer = true)   {    global $dbo;    if($Buyer)     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hs` SET `s1` = \'0\' WHERE `p1`=\'%s\' AND `id` =\'%s\' LIMIT 1',      DB_PERFIX,$this->_parrent->id,$id));    else     $dbo->ExectueQuery(sprintf('UPDATE `%shero_hs` SET `s2` = \'0\' WHERE `p2`=\'%s\' AND `id` =\'%s\' LIMIT 1',      DB_PERFIX,$this->_parrent->id,$id));   }   public function CountMarket($type, $filter = NO_FILTER)   {    global $dbo;    $filter = ($filter > 10? NO_FILTER : $filter);    $sql= sprintf('SELECT COUNT(*) AS `c` FROM `%shero_hs` WHERE ',DB_PERFIX);    switch($type)    {     case MARKET_BUY:      $sql .= sprintf('`p1` != \'%s\' AND `sol` = \'0\'',$this->_parrent->id);      break;     case MARKET_SELL:      $sql .= sprintf('`p1` = \'%s\' AND `sol` = \'0\'',$this->_parrent->id);      break;     case MARKET_SOLD:      $sql .= sprintf('`p1` = \'%s\' AND `sol` = \'1\'',$this->_parrent->id);      break;     case MARKET_BOUGHT:      $sql .= sprintf('`p2` = \'%s\' AND `sol` = \'1\'',$this->_parrent->id);      break;    }    if($filter)     $sql .= sprintf(' AND `t1` = \'%s\'', $filter);    return $dbo->ExectueScaler($sql, 'c');   }   public function GetMarketList($type, $filter = NO_FILTER, $p = 0, $r = 30)   {    global $dbo;    $filter = $filter > 10? NO_FILTER : $filter;    $text= sprintf('SELECT `hs` . * , `i`.`name` , `i`.`t2` , `i`.`t3` , `i`.`t4` , `ms`.`m1` , `ms`.`m2` FROM `%1$shero_hs` AS `hs` LEFT JOIN `%1$shero_i` AS `i` ON ( `hs`.`hid` = `i`.`id` ) LEFT JOIN `%1$shero_ms` AS `ms` ON ( `hs`.`mid` = `ms`.`id` ) WHERE '     ,DB_PERFIX);    switch($type)    {     case MARKET_BUY:      $text .= sprintf('`hs`.`p1` != \'%s\' AND `hs`.`sol` = \'0\'',$this->_parrent->id);      break;     case MARKET_SELL:      $text .= sprintf('`hs`.`p1` = \'%s\' AND `hs`.`sol` = \'0\'',$this->_parrent->id);      break;     case MARKET_SOLD:      $text .= sprintf('`hs`.`p1` = \'%s\' AND `hs`.`s1` = \'1\' AND `hs`.`sol` = \'1\'',$this->_parrent->id);      break;     case MARKET_BOUGHT:      $text .= sprintf('`hs`.`p2` = \'%s\' AND `hs`.`sol` = \'1\'',$this->_parrent->id);      break;    }    if($filter)     $text .= sprintf(' AND `hs`.`t1` = \'%s\'', $filter);    $text .= sprintf(' ORDER BY `hs`.`modify` DESC LIMIT %s, %s',$p* $r, $r);    $sql = $dbo->ExectueQuery($text);    $arr = array();    $i = 0;    while($row = $dbo->Read($sql))     $arr[$i++] = new Object($row);    $dbo->Cancel($sql);    return $arr;   }   public function Available()   {    global $dbo;    if($this->_parrent->life <= 1)     return false;    if($dbo->ExectueScaler(sprintf('SELECT `h` FROM `%stown` WHERE `id` = \'%s\'',DB_PERFIX,$this->_parrent->htid),'h'))     return true;    return false;   }   public function SendToAdventure()   {    global $dbo;    global $town;    if(!$town->Lock())     return;    if($town->id != $this->_parrent->htid)    {     $town->UnLock();     return;    }    $this->_parrent->SetFields(array('adv' => $_SERVER['REQUEST_TIME'] + ONE_TICK * 24));    $arr = array();    $arr['pid1'] = $this->_parrent->id;    $arr['tid1'] = $this->_parrent->htid;    $arr['kind'] = A_ADVENTURE;    $arr['h'] = '1';    $arr['len'] =  ceil(ONE_TICK / 4);    $arr['modify'] = $_SERVER['REQUEST_TIME'] + $arr['len'];    $dbo->InsertRow(DB_PERFIX.'troop_s',$arr);    $dbo->ExectueQuery(sprintf('UPDATE `%stown` SET `h` = \'0\',`locks` = \'0\' WHERE `id` = \'%s\' LIMIT 1',DB_PERFIX,$town->id));    gc_collect_cycles();   }   public function FindTreasure($id)   {    global $dbo;    global $town;    if(!$town->Lock())     return;    if($town->id != $this->_parrent->htid  or !$town->h)    {     $town->UnLock();     return;    }    $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%shero_tm` WHERE `id` = \'%s\' AND `pid` = \'%s\' AND `modify` IS NULL',     DB_PERFIX, $id, $this->_parrent->id));    if(empty($row))    {     $town->UnLock();     return;    }    $nSend = false;    $arr = array('h' => -1);    $brr = array();    $brr['pid1'] = $this->_parrent->id;    $brr['tid1'] = $town->id;    $brr['mid1'] = $town->mid;    $brr['kind'] = A_TREASURE;    $brr['h'] = '1';    for($i =1;$i<13;$i++)    {     $t = "t$i";     if(empty($row[$t]))      continue;     if($town->$t < $row[$t])     {      $nSend = true;      break;     }     else     {      $arr[$t] = -$row[$t];      $brr[$t] = $row[$t];     }    }    if($nSend)    {     $town->UnLock();     return;    }    if(!empty($row['e']))    {     $t = 'e'.$row['e'];     if($town->$t < $row['en'])     {      $town->UnLock();      return;     }     $arr[$t] = -$row['en'];     $brr['e1'] = $row['e'];     $brr['ne1'] = $row['en'];    }    if(!$town->HaveEnough($row['r'], $row['r'], $row['r'], $row['r'], $row['r']))    {     $town->UnLock();     return;    }    else     $town->SubResource($row['r'], $row['r'], $row['r'], $row['r'], $row['r']);    $town->AddFields($arr);    $dbo->ExectueQuery(sprintf('UPDATE `%shero_tm` SET `ac` = \'1\', `modify` = \'%u\' WHERE `id` = \'%s\' LIMIT 1',     DB_PERFIX, ($_SERVER['REQUEST_TIME'] + (ONE_TICK * 8)), $row['id']));    $brr['len'] =  (ONE_TICK * 8);    $brr['mid2'] = $id;    $brr['modify'] = ($_SERVER['REQUEST_TIME'] + (ONE_TICK * 8));    $dbo->InsertRow(DB_PERFIX.'troop_s', $brr);    gc_collect_cycles();    $town->UnLock();   }   public function GoTreasure($tid)      {    global $dbo;    global $town;          $row = $dbo->ExectueRow(sprintf('SELECT * FROM `%shero_tm` WHERE `id` = \'%s\'  AND `modify` IS NOT NULL',              DB_PERFIX, $tid));          if(!($id = $dbo->ExectueScaler(sprintf('SELECT `id` FROM `%shero_ti` WHERE `itid` = \'%s\' AND `pid` = \'%s\'',              DB_PERFIX, $tid, $this->_parrent->id),'id')))              return;          if(empty($row))              return;          if($row['modify'] - (ONE_TICK * 4) <= $_SERVER['REQUEST_TIME'])              return;    if(!$town->Lock())     return;    if($town->id != $this->_parrent->htid or !$town->h)    {     $town->UnLock();     return;    }    $nSend = false;    $arr = array('h' => '-1');    $brr = array();    $brr['pid1'] = $this->_parrent->id;    $brr['tid1'] = $town->id;    $brr['mid1'] = $town->mid;    $brr['kind'] = A_TREASURE;    $brr['h'] = '1';    for($i =1;$i<13;$i++)    {     $t = "t$i";     if(empty($row[$t]))      continue;     if($town->$t < $row[$t])     {      $nSend = true;      break;     }     else     {      $arr[$t] = -$row[$t];      $brr[$t] = $row[$t];     }    }    if($nSend)    {     $town->UnLock();     return;    }    if(!empty($row['e']))    {     $t = 'e'.$row['e'];     if($town->$t < $row['en'])     {      $town->UnLock();      return;     }     $arr[$t] = -$row['en'];     $brr['e1'] = $row['e'];     $brr['ne1'] = $row['en'];    }    if(!$town->HaveEnough($row['r'],$row['r'],$row['r'],$row['r'],$row['r']))    {     $town->UnLock();     return;    }    else     $town->SubResource($row['r'],$row['r'],$row['r'],$row['r'],$row['r']);    if(count($arr))     $town->AddFields($arr);    $dbo->ExectueQuery(sprintf('UPDATE `%shero_tm` SET `ac` = `ac` + \'1\' WHERE `id` = \'%s\' LIMIT 1',     DB_PERFIX, $row['id']));    $brr['mid2'] = $row['id'];    $brr['len'] =  ONE_TICK * 4;    $brr['modify'] = $row['modify'];    $dbo->InsertRow(DB_PERFIX.'troop_s', $brr);    $dbo->DeleteRecord(DB_PERFIX.'hero_ti',$id);    $town->UnLock();    gc_collect_cycles();   }   public function InviteTreasure($id,$pid)   {    global $dbo;    if(!($lvl = $dbo->ExectueScaler(sprintf('SELECT `lvl` FROM `%shero_tm` WHERE `id` = \'%s\' AND `pid` = \'%s\'',     DB_PERFIX,$id,$this->_parrent->id),'lvl')))     return;    if($dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%shero_ti` WHERE `itid` = \'%s\' AND `pid` = \'%s\'',     DB_PERFIX,$id,$pid),'c'))     return;          $c = $dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%shero_ti` WHERE `itid` = \'%s\'',              DB_PERFIX,$id),'c');    if($c >= ($lvl - 1))     return;    $arr = array();    $arr['itid'] = $id;    $arr['pid'] = $pid;    $dbo->InsertRow(DB_PERFIX.'hero_ti',$arr);    $arr = array();    $arr['se'] = $this->_parrent->id;    $arr['re'] = $pid;    $arr['subject'] = $GLOBALS['lang']['Invitation'];    $arr['flag'] = NOT_READ | UNI_INFO;    $arr['message'] = sprintf('tis:%s:%s',$this->_parrent->id, $id);    $arr['modify'] = $_SERVER['REQUEST_TIME'];    $dbo->InsertRow(DB_PERFIX.'pm',$arr);   }   public function SpeedTroop($kind, $tid)   {    if($this->_parrent->life <=0)     return 0;          if($this->_parrent->htid != $tid)              return 0;    $point = $this->GetPoint(2);    if($this->_parrent->khp4 == P_ON_ALL_TROOP)     $point += $this->_parrent->php4 * SPACIAL_HERO_ITEM_TRAIN;    elseif($this->_parrent->khp4 == $kind)     $point += $this->_parrent->khp4 * BASE_HERO_ITEM_TRAIN;    return $point/100;   }    public function HaveInvitation($id)   {    global $dbo;    if(!$dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%shero_ti` WHERE `itid` = \'%s\' AND `pid` = \'%s\'',     DB_PERFIX,$id,$this->_parrent->id),'c'))     return false;    if($dbo->ExectueScaler(sprintf('SELECT COUNT(*) AS `c` FROM `%shero_tm` WHERE `id` = \'%s\' AND `modify` < \'%u\'',     DB_PERFIX,$id, (ONE_TICK * 4) + $_SERVER['REQUEST_TIME']),'c'))     return false;    return true;   }  }  ?>