var p1='0';
var tp='';
var p2='0';
var sol='0';
var pmt='0';
var allow=true;
function calc() {
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
function oper(op) {
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
function clr() {
	p1='0';
	tp='';
	p2='0';
	sol='0';
	pmt='0';
	allow=true;
	numb(0);
}