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
		$res=['rcode'=>'1','result'=>(int)$number1+(int)$number2];
	} else if ($oper == "-") {
		$res=['rcode'=>'1','result'=>(int)$number1-(int)$number2];
	} else if ($oper=="*") {
		$res=['rcode'=>'1','result'=>(int)$number1*(int)$number2];
	} else if ($oper=="/") {
		if ((int)$number2 == 0) {
			$res=['rcode'=>'0','result'=>"division by zero"];
		} else {
			$res=['rcode'=>'1','result'=>(int)$number1/(int)$number2];
		}
	} else {
		$res=['rcode'=>'0','result'=>"unknown operation"];
	}
	$data=$res;
	header('Content-type: application/json');
	echo json_encode($data);
?>