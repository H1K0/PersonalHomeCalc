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
		<style>
			html,body{
				margin: 0;
				padding: 0;
				background: #111;
				font-family: "Comic Sans MS";
				overflow: hidden;
			}
			#prompt{
				display: flex;
				justify-content: center;
				align-items: center;
				width: 100%;
				height: 18%;
				margin-bottom: 5vh;
				background: #222;
				border: 0;
				box-shadow: 0 2vh 2vh #060606;
				font-size: 50px;
				color: #eee;
				text-shadow: 0 0 5px white;
				text-align: center;
			}
			.hidd{
				display: none;
			}
			.row{
				margin: 3% 0;
				display: flex;
				justify-content: space-around;
			}
			.btn{
				display: flex;
				justify-content: center;
				align-items: center;
				width: 20%;
				height: 20%;
				margin-bottom: 2px;
				border: 0;
				border-radius: 10px;
				font-size: 60px;
				color: #eee;
				cursor: pointer;
			}
			.btn:hover{
				box-shadow: 0 0 10px white;
			}
			.btn1{
				background: #EF3038;
			}
			.btn2{
				background: #0047AB;
			}
			.btn1:active{
				background: #77181C;
				color: #aaa;
			}
			.btn2:active{
				background: #002456;
				color: #aaa;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script>
			var p1='0';
			var tp='';
			var p2='0';
			var sol='0';
			var pmt='0';
			var allow=true;
			function zap() {
				pmt+='=';
				document.getElementById('prompt').innerHTML=pmt;
				var number1=p1;
				var oper=tp;
				var number2=p2;
				$.ajax({
					url: "calc.php",
					type: "GET",
					data: {'number1': number1, 'oper': oper, 'number2': number2},
					dataType: "json",
					success: function(response) {
						if (response.rcode=="0") {
							alert(response.result)
							cle()
						} else {
							sol=response.result;
							pmt+=sol;
							document.getElementById('prompt').innerHTML=pmt;
							allow=false;
							p1='0';
							tp='';
							p2='0';
						}
					}
				});
			}
			function numb(num) {
				if (Number(p1)==0 && (tp=='')) {
					p1=num;
					pmt=String(p1);
					document.getElementById('prompt').innerHTML=pmt;
				} else if ((Number(p1)>0) && (tp=='')) {
					p1+=num;
					pmt=String(p1);
					document.getElementById('prompt').innerHTML=pmt;
				} else if (Number(p2)==0 && tp!='') {
					p2=num;
					pmt=String(p1)+tp+String(p2);
					document.getElementById('prompt').innerHTML=pmt;
				} else if (Number(p2)>0 && tp!='') {
					p2+=num;
					pmt=String(p1)+tp+String(p2);
					document.getElementById('prompt').innerHTML=pmt;
				}
			}
			function operation(op) {
				if (tp!='') {alert('За раз можно использовать только одну операцию!');return;}
				if (!allow) {
					p1=Number(sol);
					pmt=sol;
					allow=true;
				}
				// if (p1=='0' && p2=='0' && tp=='' && Number(document.getElementById('prompt').value)>0) {
				// 	p1=document.getElementById('prompt').innerHTML
				// }
				tp=op;
				pmt+=tp;
				document.getElementById('prompt').innerHTML=pmt;
			}
			function cle() {
				p1='0';
				tp='';
				p2='0';
				sol='0';
				pmt='0';
				allow=true;
				numb(0);
			}
		</script>
	</head>
	<body>
			<div id="prompt">0</div>
			<div class="row">
			<?php
			for ($i=1;$i<=3;$i++) {
				createButton($i,'btn1',"numb('".$i."')",$i);
			}
			createButton("+",'btn2',"operation('+')","Сложение");
			?>
			</div>
			<div class="row">
			<?php
			for ($i=4;$i<=6;$i++) {
				createButton($i,'btn1',"numb('".$i."')",$i);
			}
			createButton("-",'btn2',"operation('-')","Вычитание");
			?>
			</div>
			<div class="row">
			<?php
			for ($i=7;$i<=9;$i++) {
				createButton($i,'btn1',"numb('".$i."')",$i);
			}
			createButton("*",'btn2',"operation('*')","Умножение");
			?>
			</div>
			<div class="row">
			<?php 
			createButton("0",'btn1',"numb('0')",0);
			createButton("AC",'btn2',"cle()","Очистить");
			createButton("=",'btn2',"zap()","Считать");
			createButton("/",'btn2',"operation('/')","Деление");
			?>
			</div>
	</body>
</html>
