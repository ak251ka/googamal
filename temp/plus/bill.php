<?php  require_once('RSAProcessor.class.php');    $processor = new RSAProcessor($_SERVER['DOCUMENT_ROOT'].'/temp/plus/key.xml',RSAKeyType::XMLFile);  $merchantCode = 569101;  $terminalCode = 569831;  $arr = array();  $amount = $arr['amount'] = $prices[$_POST['bp']]['price'];  $redirectAddress = SERVER_NAME.'/payment.php';  $arr['pid'] = $session->aid;  $arr['modify'] = $_SERVER['REQUEST_TIME'];  $arr['amount'] = $prices[$_POST['bp']]['price'];  $arr['talant'] = $prices[$_POST['bp']]['talant'];  $dbo->InsertRow(DB_PERFIX.'payment',$arr);  $invoiceNumber = $dbo->InsertedID();  $timeStamp = date('Y/m/d H:i:s');  $date = getdate($_SERVER['REQUEST_TIME']);  $day = MiladiToShamsi($date['year'], $date['mon'], $date['mday']);  $invoiceDate = sprintf('%d/%d/%d %d:%d:%d',$day[0],$day[1],$day[2],      $date['hours'],$date['minutes'],$date['seconds']);    $action = '1003';  $data = '#'. $merchantCode .'#'. $terminalCode .'#'. $invoiceNumber .'#'. $invoiceDate .'#'. $amount .'#'. $redirectAddress .'#'. $action .'#'. $timeStamp .'#';  $data = sha1($data,true);  $data =  $processor->sign($data);  $result =  base64_encode($data);  ?>
<div class="p_main">
    <center><img src = "img/pep.gif" alt="pep" style="width: 50px;height: 50px;"/> </center>
    <?php printf($lang['BillValidating'],$prices[$_POST['bp']]['talant'],number_format($prices[$_POST['bp']]['price']));?>
    <form action="https://pep.shaparak.ir/gateway.aspx" method="post">
        <input type="hidden" name="invoiceNumber" value="<?php echo $invoiceNumber ?>" />
        <input type="hidden" name="invoiceDate" value="<?php echo $invoiceDate ?>" />
        <input type="hidden" name="amount" value="<?php echo $amount ?>" />
        <input type="hidden" name="terminalCode" value="<?php echo $terminalCode ?>" />
        <input type="hidden" name="merchantCode" value="<?php echo $merchantCode ?>" />
        <input type="hidden" name="redirectAddress" value="<?php echo $redirectAddress ?>" />
        <input type="hidden" name="timeStamp" value="<?php echo $timeStamp ?>" />
        <input type="hidden" name="action" value="<?php echo $action ?>" />
        <input type="hidden" name="Sign" value="<?php echo $result ?>" />
    <center><input type="submit" value="<?php echo $lang['Buy'];?>"></center>
    </form>
</div>