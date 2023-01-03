<?php  require_once('lib/dbo.php');  require_once('lng/per.php');  require_once('eng/sec/session.php');  require_once('eng/sec/user.php');  require_once('lib/defines.php');  require_once('lib/object.php');  if($session->GetType() == LOG)   $session->Close(LOG);  $CanLog = true;  $nERROR = NO_ERROR;  $logStart = $dbo->ExectueScaler(sprintf('SELECT `kind` FROM `%sserver_info` WHERE `com` = \'%s\' AND `kind` >= \'%s\'',   DB_PERFIX, LOG_IN_START, $_SERVER['REQUEST_TIME']),'kind');  $repiar = $dbo->ExectueScaler(sprintf('SELECT `kind` FROM `%sserver_info` WHERE `com` = \'%s\' AND `kind` >= \'%s\'',   DB_PERFIX,REPAIR_SERVER,$_SERVER['REQUEST_TIME']),'kind');  if($session->GetType() != LOG_IN)   $session->NewSession(LOG_IN);  if((int)$session->tried > LOG_TRY)  {   $CanLog = false;   $nERROR = E_MAXTRY;  }  if((int)$session->tried > 2 and !$nERROR)  {   if(!$session->CheckCaptcha())    $nERROR = E_CAPTCHA;   else    $session->ClearCaptcha();  }  if(!$nERROR and isset($_POST['tbName']) and isset($_POST['tbPassword']))  {   $user->Load($_POST['tbName'],$_POST['tbPassword']);   $nERROR = $user->GetError();   if($nERROR == NO_ERROR)   {    $session->Close();    $session->NewRow();    $session->aid = $user->aid;    $session->pid = $user->pid;    $session->NewSession(LOG);    $session->Save();    header('Location: town.php');    die();   }  }  printf('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');  ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jav/main.js"></script>
</head>
<body onload="main();">
	<div class="mainCon">
		<div class="left">
			<?php require_once('temp/ind/left.php'); ?>
		</div>
	
		<div class="middle" style="">
		<div class="log_top">
       
		</div>
		<div class="log_mid" style="text-align:right;">
		<table style="width:430px;text-align:right;margin-right:45px;"><tr><td style="text-align:right;padding:10px;text-align:justify;">
<p>
	<span>قوانین و مقررات بازی</span><span><o:p></o:p></span>
</p>
<ul type="disc">
	<li>
	<span>بازیکنان در هر سرور فقط می توانند یک اکانت 
	داشته باشند. در صورت کشف چند اکانت، اکانت یا اکانت هایی که بزرگتر و قویتر 
	باشند حذف خواهد شد.
	</span>
	<span><o:p></o:p></span></li>
	<li>
	<span>هر گونه مراوده مالی بین بازیکنان غیر قانونی می 
	باشد.</span><span><o:p></o:p></span></li>
	<li>
	<span>با بازیکنانی که از سخنان رکیک، زشت و بی ادبانه 
	در هر قسمت از بازی استفاده نمایند برخورد قانونی خواهد شد.</span><span><o:p></o:p></span></li>
	<li>
	<span>هر گونه بحث و صحبت سیاسی در فروم ها و پیام های 
	بازیکنان ممنوع است</span><span><o:p></o:p></span></li>
	<li>
	<span>با هر گونه نوشتاری که بیانگر توهین به دیگر 
	اشخاص باشد برخورد قانونی می شود.</span><span><o:p></o:p></span></li>
	<li>
	<span>گذاشتن هر گونه اسم مذهبی و سیاسی بر روی اتحاد، 
	شهر، نام بازیکن و غیره ممنوع است.</span><span><o:p></o:p></span></li>
	<li>
	<span>همه کاربران موظف به بیان اشکالات بازی به تیم 
	پشتیبانی بازی هستند و هر گونه <span>&nbsp;</span>استفاده 
	از اشکالات و باگ های بازی ممنوع است و استفاده از آنها باعث جریمه اکانت می 
	شود.<o:p></o:p></span></li>
</ul>
<p>
<span>
<br />
</span>
<span>قوانین زیر ضمیمه ای بر 
قوانین عمومی گوگامال می‌باشند. همگان باید با قوانین عمومی آشنا باشند تا بدانند 
که چه کارهایی مجاز بوده و انجام چه کارهایی خلاف محسوب می‌شود، مخصوصاً در مواردی 
که بخاطر نقض قانونی بازداشت یا جریمه شده باشند</span><span>.
<o:p></o:p></span></p>
<ul type="disc">
	<li>
	<span>همکاری و یا حمایت از سایرین برای نقض قوانین، 
	تحریک یا تشویق بازیکن‌ها جهت نقض قوانین، مجاز نبوده و جریمه در پی خواهد داشت</span><span>.
	</span>
	<span><o:p></o:p></span></li>
	<li>
	<span>بازیکنان اجازه ندارند به صورت یک طرفه منابع 
	ارسال نمایند</span><span>. </span>
	<span><o:p></o:p></span>
	</li>
	<li>
	<span>بازیکنان اجازه ندارند نیروهای خود را برای مدت 
	نامحدود در شهر بازیکن دیگر قرار دهند</span><span>.</span><span><o:p></o:p></span></li>
</ul>
<p>
<span>
<br />
</span>
<span>قوانین ثبت نام و مالکیت
</span>
<span><o:p></o:p></span></p>
<ul type="disc">
	<li>
	<span>ایمیلی که برای ثبت نام 
	استفاده می‌شود باید یک ایمیل شخصی بوده و ثبت نام کننده باید دسترسی کامل و 
	کنترل کامل این ایمیل را داشته باشد. مالک ایمیل ثبت نام بدون هیچ قید و شرطی 
	صاحب اکانت به حساب می‌آید و صاحب اکانت مسئول تمامی اتفاقاتی است که در رابطه 
	با اکانت رخ می‌دهد</span><span>. <o:p></o:p></span></li>
	<li>
	<span>صاحب اکانت نمی‌تواند رمز خود را به دیگر 
	بازیکنان در همان سرور بازی بدهد. بعلاوه انتخاب آگاهانه رمز یکسان با سایرین 
	خلاف است. هر یک از این اعمال مذکور مولتی اکانت به حساب آمده و تابع جریمه 
	مولتی اکانت که در همین قوانین آمده است، خواهد بود</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>دادن رمز اکانت به بازیکنی که در همان سرور بازی 
	نمی‌کند و در سروری دیگر مشغول بازی است و یا کسی که کلاً بازی نمی‌کند ایرادی 
	ندارد و می‌توانید با هم بر روی یک اکانت بازی کنید</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>تیم گوگامال هیچ گونه مسئولیتی در قبال خسارات 
	وارده بر اکانت توسط شخص یا اشخاصی که رمز اکانت را در اختیار دارد نمی‌پذیرد و 
	در صورت هرگونه نقض قوانین توسط فردی که رمز اکانت را در اختیار دارد مطابق 
	قوانین برخورد خواهد شد</span><span>. <o:p></o:p></span>
	</li>
</ul>
<p>
<span>
<br />
</span>
<span>جانشینی <o:p></o:p></span>
</p>
<ul type="disc">
	<li>
	<span>هر بازیکنی حق داشتن جانشین برای اکانت خود را 
	دارد که در زمان غیبتش به جای وی بازی کند. <o:p></o:p></span></li>
	<li>
	<span>جانشین باید کاملاً به نفع اکانت بازی کند و هر 
	گونه سوءاستفاده از جانشینی خلاف بوده و می‌تواند جریمه برای جانشین در پی 
	داشته باشد. <o:p></o:p></span></li>
	<li>
	<span>جانشین باید از طریق جانشینی وارد اکانت کسی که 
	جانشینش است بشود</span><span>. </span>
	<span><o:p></o:p></span>
	</li>
	<li>
	<span>جانشین مجاز به داشتن رمز اکانت و ورود به اکانت 
	با رمز خود صاحب اکانت را ندارد و در صورت رعایت نکردن این امر هر دو اکانت 
	مشمول جریمه ای که در همین قوانین ذکر شده است خواهند بود. <o:p></o:p></span>
	</li>
	<li>
	<span>صاحب اکانت مسئول اعمال انجام شده توسط جانشین 
	خود خواهد بود. در صورتی که جانشین‌ قوانین بازی گوگامال را نقض کنند، صاحب 
	اکانت و جانشین هر دو ممکن است مشمول جریمه شوند</span><span>. <o:p></o:p></span>
	</li>
</ul>
<p>
<span><br />
<br />
</span>
<span>استفاده از یک کامپیوتر <o:p></o:p>
</span></p>
<ul type="disc">
	<li>
	<span>اگر بازیکن‌هایی که از یک کامپیوتر استفاده 
	می‌کنند، بخواهند به اکانت یکدیگر دسترسی داشته باشند، این عمل حتماً باید از 
	طریق جانشینی باشد</span><span>.
	<br/>
	<![if !supportLineBreakNewLine]>
	<br/>
	<![endif]></span>
	<span><o:p></o:p></span>
	</li>
</ul>
<p>
<span><br />
</span>
<span>استفاده از برنامه های خارجی <o:p></o:p>
</span></p>
<ul type="disc">
	<li>
	<span>بازی باید با مرورگرهای دستکاری نشده و معمولی 
	انجام شود. استفاده از هرگونه اسکریپت و بات که اتوماتیک عمل می‌کنند، خلاف 
	قوانین بازی است</span><span>. <o:p></o:p></span></li>
</ul>
<p>
<span><br />
<br />
</span>
<span>خطاهای برنامه <o:p></o:p>
</span></p>
<ul type="disc">
	<li>
	<span>از خطاهای برنامه نویسی(که به آنها باگ نیز گفته 
	می‌شود) نباید جهت نفع شخصی یا گروهی استفاده شود. سوءاستفاده از این امر 
	می‌تواند باعث جریمه اکانت شود</span><span>.
	<br/>
	<![if !supportLineBreakNewLine]>
	<br/>
	<![endif]></span>
	<span><o:p></o:p></span>
	</li>
</ul>
<p>
<span>
تبادلات مالی <o:p></o:p></span></p>
<ul type="disc">
	<li>
	<span>هر گونه خرید و فروشی که در آن پول واقعی رد و 
	بدل شود حال در مورد اکانت، نیرو، شهر، منابع، ارائه خدمات و یا هر مورد مربوط 
	به بازی گوگامال باشد خلاف است. <o:p></o:p></span></li>
</ul>
<p><![if !supportLists]>
<span><span>·<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span>واگذاری اکانت بدون دریافت پول و یا بعنوان هدیه، به 
هر صورت غیر مجاز است</span><span>. <o:p></o:p></span></p>
<p>
<span>
<br />
<br />
</span>
<span>رفتار در مقابل دیگر کاربران <o:p></o:p>
</span></p>
<p><![if !supportLists]>
<span><span>·<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]>
<span><br />
</span>
<span>تمامی افراد باید با لفظی 
مودبانه با همدیگر برخورد کنند. مسئولان بازی می‌توانند پروفایل‌ها و نام شهرها و 
... را که مناسب نباشند بدون هشدار تغییر دهند</span><span>. </span>
<span><o:p></o:p></span></p>
<p>
<span>
<br />
</span>
<span>اعمال زیر خلاف بوده و ممکن 
است جریمه در پی داشته باشد و شامل تمامی قسمت‌های بازی از قبیل نام اکانت، نام 
اتحاد، قسمت توضیحات پروفایل، نام شهر و پیام‌ها می‌شود</span><span>: </span>
<span><o:p></o:p></span></p>
<ul type="disc">
	<li>
	<span>شرکت در هرگونه مسائلی که توهین آمیز بوده، جنبه 
	سوءاستفاده داشته، نژادپرستانه بوده و یا بی‌حرمتی محسوب شود و همچنین مطالبی 
	که جنس خاصی<span>&nbsp; </span>را مورد توهین یا تمسخر 
	قرار دهد. همچنین هرگونه بحثی که برای دین و مذهب، نژاد، ملیت، جنسیت، گروه سنی 
	خاصی توهین آمیز تلقی شود. <o:p></o:p></span></li>
	<li>
	<span>تهدید کسی در زندگی واقعی</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>ارسال متن یا هر چیزی که برای گروه سنی پایین 
	نادرست باشد</span><span>. <o:p></o:p>
	</span></li>
	<li>
	<span>تهدید بازیکن‌ها بطوری که باعث نقض قوانین بازی 
	و یا قوانین عمومی بازی گوگامال شود</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>نمایش گزارش جنگ یا پیام کسی بدون اجازه کتبی از 
	هر دو طرف گزارش یا پیام</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>استفاده از نام سیاست‌مداران واقعی در نام شهر، 
	اکانت، پروفایل، و</span><span>... <o:p></o:p></span></li>
	<li>
	<span>جعل هویت هرگونه مقامات رسمی</span><span>. <o:p></o:p></span>
	</li>
	<li>
	<span>جعل هویت ادمین، مسئولان، پشتیبانی و کلا هر 
	مقام رسمی در بازی</span><span>. <o:p></o:p></span></li>
	<li>
	<span>هرگونه تبلیغ غیر مجاز است</span><span>. <o:p></o:p></span>
	</li>
</ul>
<p>
<span><o:p>
&nbsp;</o:p></span></p>
<p>
<span>
<br />
</span>
<span>جرائم <o:p></o:p></span>
</p>
<p>
<span>
<br />
</span>
<span>اگر خلافی در مورد قوانین 
ذکر شده در بالا صورت بگیرد، مسئولان بازی، در صورت نیاز اکانت یا اکانت‌ها را 
بازداشت خواهند کرد و در مورد میزان جریمه تصمیم گیری خواهند کرد. جریمه همواره از 
سود حاصل از تخلف به مراتب بیشتر خواهد بود. منابع، ساختمان‌ها، شهر‌ها و نیروهای 
از دست رفته در دوران بازداشت جزء جریمه به حساب نمی‌آیند و تیم گوگامال خسارت وارد 
را جبران نخواهد کرد. هیچ بازیکنی حق درخواست امتیازات فعال شده یا سکه‌ی تالانت یا 
دیرینگ و یا پول از دست رفته خود در زمان بازداشت یا بدلیل جریمه را ندارد</span><span>.
</span>
<span>
تیم گوگامال هیچ تمایزی بین بازیکن‌هایی که از سکه‌ی تالانت و امتیازات استفاده می 
کنند و سایر بازیکن‌ها قائل نخواهد شد.چه در زمان بررسی تخلف و چه به هنگام جریمه 
کردن</span><span>. </span>
<span>بازیکن‌ها می‌توانند با 
مسئول بازی که آنها را بازداشت کرده است و یا با ادمین از طریق پیام داخل بازی و یا 
ایمیل تماس بگیرد. در مورد جریمه و یا حذف اکانت نباید در مکان‌های عمومی بحث شود 
(برای مثال در فروم، چت، پیام داخل بازی و...). نامه‌های نوشته شده برای مسئول بازی 
باید دارای موضوع مناسب بوده و به زبان فارسی و با حروف فارسی نوشته شود، مسئول 
بازی یا ادمین یا پشتیبانی می‌تواند از خواندن و پاسخگویی به نامه‌هایی که فاقد 
شرایط فوق باشند، امتناع کند. بعلاوه تیم گوگامال به هیچ عنوان هیچ اطلاعاتی در 
اختیار کسی جز صاحب اکانت قرار نخواهد داد (در مورد دلیل بازداشت، میزان جریمه و 
غیره).<o:p></o:p></span></p>
<p>
<span>
بازیکنان تنها باید راجع به هر موضوعی که با پشتیبانی یا ادمین بازی مطرح میکنند 
،در هر 24 ساعت یک نامه بدهند.به نامه های دیگر کاربر که تکراری باشند یا موضوعی را 
دوباره مطرح کرده باشند رسیدگی نخواهد شد</span><span>. <br />
</span>
<span>استفاده از تصائیری که حاوی 
عکس های سیاسی، توهین آمیز و غیر اخلاقی باشند مجاز نمی باشند و بسته به نوع تصویر 
در مورد مجازات شخص خاطی تصمیم گیری خواهد شد</span><span>. <br />
<br />
</span>
<span>تغییر و تصحیح قوانین </span>
<span><br />
</span>
<span>حق تغییر در قوانین در هر 
زمان برای تیم گوگامال محفوظ است</span><span>. <br />
</span>
<span>اگر قانونی حذف شود و یا 
تغییر کند، تاثیری بر اعتبار سایر قوانین نخواهد داشت و سایر قوانین بقوت خود باقی 
خواهند ماند. مدیر سایت خود را موظف می‌داند که به هنگام تغییر/ حذف/اضافه شدن 
قانونی سریعاً آن را اعمال کند</span><span>. <br />
<br />
</span>
<span>در صورت تغییر قوانین صرف 
نظر از اینکه بازیکن چه زمانی تخلف کرده است و یا بازداشت شده است (حتی اگر قبل از 
تغییر قوانین باشد) جریمه با قوانین جدید اعمال خواهد شد </span>
<span><br/>
<![if !supportLineBreakNewLine]><br/>
<![endif]><o:p></o:p></span></p>
<p><span dir="LTR"><o:p>&nbsp;</o:p></span></p>
</td></tr></table>
</div>
<div class="log_but" style="margin-top:-15px">

</div>		
</div>
<div class="right"><?php require_once('temp/ind/rigth.php'); ?></div>
</div>
<div style="clear:both"></div>
<script language="javascript" type="text/javascript">
var timer = Array();
</script>
</body>
</html>
<?php  $session->Save();  ?>