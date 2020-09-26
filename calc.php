<?php
	function getData($pname) {
		if (isset($_GET[$pname])) {
			return $_GET[$pname];
		} else {
			return "";
		}
	}
	$number1=getData('number1');
	$oper=getData('oper');
	$number2=getData('number2');
	if ($oper=="+") {
		$res=['rcode'=>'1','result'=>(float)$number1+(float)$number2];
	} else if ($oper == "-") {
		$res=['rcode'=>'1','result'=>(float)$number1-(float)$number2];
	} else if ($oper=="*") {
		$res=['rcode'=>'1','result'=>(float)$number1*(float)$number2];
	} else if ($oper=="/") {
		if ((float)$number2 == 0) {
			$res=['rcode'=>'0','result'=>"Division by zero!"];
		} else {
			$res=['rcode'=>'1','result'=>(float)$number1/(float)$number2];
		}
	} else {
		$res=['rcode'=>'0','result'=>"Unknown operation!"];
	}
	$data=$res;
	header('Content-type: application/json');
	echo json_encode($data);
?>