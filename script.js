var p1='0';
var tp='';
var p2='0';
var sol='0';
var out='0';
var allow=true;
function calc() {
	out+='=';
	document.getElementById('prompt').innerHTML=out;
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
				clr()
			} else {
				sol=response.result.toString()
				if ((out+sol).length>14) {
					if (sol.includes('.')) {sol=sol.substr(0,14-out.length);
					} else {
						alert('Too large number to display!');
						clr()
						return;
					}
				}
				out+=sol;
				document.getElementById('prompt').innerHTML=out;
				allow=false;
				p1='0';
				tp='';
				p2='0';
			}
		}
	});
}
function numb(num) {
	if (num=='.') {
		if (tp=='') {p1+='.';} else {p2+='.';}
		out+='.';
		document.getElementById('prompt').innerHTML=out;
	} else if (Number(p1)==0 && (tp=='')) {
		p1=num;
		out=String(p1);
		document.getElementById('prompt').innerHTML=out;
	} else if ((Number(p1)>0) && (tp=='')) {
		p1+=num;
		out=String(p1);
		document.getElementById('prompt').innerHTML=out;
	} else if (Number(p2)==0 && tp!='') {
		p2=num;
		out=String(p1)+tp+String(p2);
		document.getElementById('prompt').innerHTML=out;
	} else if (Number(p2)>0 && tp!='') {
		p2+=num;
		out=String(p1)+tp+String(p2);
		document.getElementById('prompt').innerHTML=out;
	}
}
function oper(op) {
	if (tp!='') {alert('За раз можно использовать только одну операцию!');return;}
	if (!allow) {
		p1=Number(sol);
		out=sol;
		allow=true;
	}
	// if (p1=='0' && p2=='0' && tp=='' && Number(document.getElementById('prompt').value)>0) {
	// 	p1=document.getElementById('prompt').innerHTML
	// }
	tp=op;
	out+=tp;
	document.getElementById('prompt').innerHTML=out;
}
function clr() {
	p1='0';
	tp='';
	p2='0';
	sol='0';
	out='0';
	allow=true;
	numb(0);
}