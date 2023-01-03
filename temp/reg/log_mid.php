<form action="index.php" method="post">
				<table>
					<tr>
						<td colspan="2">
							<?php         switch($nERROR)         {          case E_CAPTCHA:           printf($lang['CaptchaError']);           break;          case E_MAXTRY:           printf($lang['MaxTryError']);           break;          case E_USER_NOT_FIND:           if(isset($_POST['tbName']))           printf($lang['MaxTryError'], $_POST['tbName']);          break;         }         if((int)$session->tried > 1 and $session->tried <= LOG_TRY)          printf($lang['MaxTry'], $session->tried, LOG_TRY);         ?>
						</td>
					</tr>
						<?php if($CanLog){?>
					<tr>
						<td colspan="2">
							<?php echo $lang['Enter'];?>
						</td>
						
					</tr>
					<tr>
						<td style="width:200px;">
							<?php echo $lang['PlayerName'];?>
						</td>
						<td>
							<input type="text" name="tbName" id = "tbName"  value="<?php if(isset($_POST['tbName'])) echo $_POST['tbName'];?>"/> 
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $lang['Password'];?>
						</td>
						<td>
							<input type="password" name="tbPassword" id = "tbPassword"  value=""/> 
						</td>
					</tr>
						<?php         if((int)$session->tried > 1)         {          $session->Captcha();        ?>
					<tr>
						<td><img src="captcha.php"></td>
						<td><input type="text" id = "captcha" name="captcha" value="" /></td>
					</tr>
						<?php                                  printf('<tr><td colspan="2"><a target="_blank" href="reset.php">%s</a></td></tr>',$lang['ChangePassword']);         }          ?>
					<tr>
						<td class = "centers" colspan="2"><input type="submit" value = "<?php echo $lang['Enter'];?>"/></td>
					</tr>
						<?php }?>
				</table>
			</form>