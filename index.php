<?php
	function getData($pname) {
		if (isset($_GET[$pname])) {
			return $_GET[$pname];
		} else {
			return "";
		}
	}
	function createButton($btname,$class,$func,$title) {
		?>
		<input class="btn <?=$class?>" onclick="<?=$func?>;" type="submit" value="<?=$btname;?>">
		<?php
	}
?>

<html>
	<head>
		<title>Personal Home Calc</title>
		<link rel="shortcut icon" href="favicon.png">
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="script.js"></script>
		<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(67775113, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/67775113" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
	</head>
	<body>
		<div class="calc">
			<div id="prompt">0</div>
			<div class="row">
				<?php
				createButton("AC",'clr',"clr()","Clear");
				?>
			</div>
			<div class="row">
				<?php
				for ($i=1;$i<=3;$i++) {
					createButton($i,'dig',"numb('".$i."')",$i);
				}
				createButton("+",'oper',"oper('+')","Add");
				?>
			</div>
			<div class="row">
				<?php
				for ($i=4;$i<=6;$i++) {
					createButton($i,'dig',"numb('".$i."')",$i);
				}
				createButton("-",'oper',"oper('-')","Substract");
				?>
			</div>
			<div class="row">
				<?php
				for ($i=7;$i<=9;$i++) {
					createButton($i,'dig',"numb('".$i."')",$i);
				}
				createButton("*",'oper',"oper('*')","Multiply");
				?>
			</div>
			<div class="row">
				<?php
				createButton("0",'dig',"numb('0')",0);
				createButton(".",'oper',"numb('.')",'Dot');
				createButton("=",'oper enter',"calc()","Calculate");
				createButton("/",'oper',"oper('/')","Divide");
				?>
			</div>
		</div>
	</body>
</html>
