<?php  require_once('lib/config.php');  class CDatabase   {   protected $_Connection = NULL;    protected $_DbHost;    protected $_Database;    protected $_DbUser;    protected $_DbPass;       public function __construct($aDbHost, $aDbUser, $aDbPass, $aDatabase)   {    $this->_DbHost = $aDbHost;    $this->_Database = $aDatabase;    $this->_DbUser = $aDbUser;    $this->_DbPass = $aDbPass;   }   function __destruct()   {    $this->Close();   }   public function Connect()   {      $this->_Connection = mysql_connect($this->_DbHost, $this->_DbUser, $this->_DbPass);    @mysql_query("SET NAMES 'utf8'", $this->_Connection);    if(!$this->_Connection)    {     echo mysql_error();     die();     return false;    }    if(!mysql_select_db($this->_Database,$this->_Connection))    {     echo mysql_error($this->_Connection);     die();     return;    }    return true;   }   public function Close()   {    if($this->_Connection)     mysql_close($this->_Connection);   }   public function ValidData()   {    $_POST = array_map('mysql_real_escape_string', $_POST);    $_POST = array_map('htmlspecialchars', $_POST);    $_GET = array_map('mysql_real_escape_string', $_GET);    $_GET = array_map('htmlspecialchars', $_GET);    $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);    $_COOKIE = array_map('htmlspecialchars', $_COOKIE);   }   public function EscapeString($str)   {    return mysql_real_escape_string($str,$this->_Connection);   }   public function InsertRow($aINTO,&$aParams)   {    $values = array_values($aParams);       $keys = array_keys($aParams);    $sql = 'insert into `'.$aINTO.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')';    $result = mysql_query($sql ,$this->_Connection);    if($result === false)     $this->show_error($sql);    return $result;   }   public function ReplaceRow($aINTO, &$aParams)   {        $set = '';    $b = false;    foreach ($aParams as $key => $value)    {     if($b)      $set .= ' , ';     $b = true;     if(isset($value))      $set .= '`'.$key.'` = \''.$value.'\'';     else      $set .= '`'.$key.'` = NULL';         }    $result = mysql_query('REPLACE INTO `'.$aINTO.'` SET '.$set     ,$this->_Connection);    if($result === false)     $this->show_error();    return $result;   }   public function InsertedID()   {    return $this->ExectueScaler('SELECT LAST_INSERT_ID() as `ins`;','ins');   }    public function UpdateRow($aUpdate, &$aParams, $aID)   {    $set = '';    $b = false;    foreach ($aParams as $key => $value)    {     if($b)      $set .= ' , ';     $b = true;     if(is_null($value))      $set .= '`'.$key.'` = NULL';     else      $set .= '`'.$key.'` = \''.$value.'\'';         }    $result = mysql_query('UPDATE `'.$aUpdate.'` SET '.$set.sprintf(' WHERE `id` = \'%u\'  LIMIT 1;',$aID)     ,$this->_Connection);    if($result === false)     $this->show_error('UPDATE `'.$aUpdate.'` SET '.$set.sprintf(' WHERE `id` = \'%u\'  LIMIT 1;',$aID));    return mysql_affected_rows();    }   public function &ExectueQuery($aSql)   {    $lResult = mysql_query($aSql,$this->_Connection);    if($lResult=== false)    {     $this->show_error($aSql);    }    return $lResult;   }    public function ExectueScaler($aSql,$aParam)   {    $lResult = mysql_query($aSql,$this->_Connection);    if($lResult=== false)    {     $this->show_error($aSql);    }    $r = mysql_fetch_assoc($lResult);    mysql_free_result($lResult);    return $r[$aParam];   }    public function ExectueRow($aSql)   {    $lResult = mysql_query($aSql.' LIMIT 1;',$this->_Connection);    if($lResult=== false)    {     $this->show_error($aSql);    }    $r = mysql_fetch_assoc($lResult);    mysql_free_result($lResult);    return $r;   }    public function RowsNumber(&$aResult)   {    return mysql_num_rows($aResult);   }      public function AffectedRows(&$aResult = NULL)   {    if(is_null($aResult))     return mysql_affected_rows();    else     return mysql_affected_rows($aResult);   }   public function TruncateTable($aName)   {    return mysql_query('TRUNCATE TABLE `'.$aName.'`', $this->_Connection);   }   public function Cancel(&$aResult)   {    mysql_free_result($aResult);   }    public function &Read(&$aResult)   {    $temp = mysql_fetch_assoc($aResult);    return $temp;   }   public function show_error($aSql = NULL)   {    debug_print_backtrace();    if(isset($sql))     echo '<p> query = '.$aSql.'<p>';    echo mysql_error($this->_Connection);    die();   }    public function DeleteRecord($aName,$aId)   {    $this->ExectueQuery(sprintf('DELETE FROM `%s` WHERE `id` = \'%s\' LIMIT 1;', $aName, $aId));    return $this->AffectedRows();   }  }      $dbo = new CDatabase(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);  $dbo->Connect();  $dbo->ValidData();  ?>