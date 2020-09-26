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
		<div class="btn <?=$class?>" onclick="<?=$func?>;" title="<?=$title?>"><?=$btname?></div>
		<!-- <input name="stack" type="submit" value="<?=$btname;?>" class="btn <?=$class?>" onclick="<?=$func?>;"> -->
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
	</head>
	<body>
		<div class="calc">
			<div id="prompt">0</div>
			<div class="row">
			<?php
			for ($i=1;$i<=3;$i++) {
				createButton($i,'dig',"numb('".$i."')",$i);
			}
			createButton("+",'oper',"oper('+')","Сложение");
			?>
			</div>
			<div class="row">
			<?php
			for ($i=4;$i<=6;$i++) {
				createButton($i,'dig',"numb('".$i."')",$i);
			}
			createButton("-",'oper',"oper('-')","Вычитание");
			?>
			</div>
			<div class="row">
			<?php
			for ($i=7;$i<=9;$i++) {
				createButton($i,'dig',"numb('".$i."')",$i);
			}
			createButton("*",'oper',"oper('*')","Умножение");
			?>
			</div>
			<div class="row">
			<?php
			createButton("AC",'clr',"clr()","Очистить");
			createButton("0",'dig',"numb('0')",0);
			createButton("=",'oper enter',"calc()","Считать");
			createButton("/",'oper',"oper('/')","Деление");
			?>
			</div>
		</div>
	</body>
</html>
