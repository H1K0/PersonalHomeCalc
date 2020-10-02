var n1='0';
var tp='';
var n2='0';
var sol='0';
var out='0';
var allow=true;
function calc() {
	out+='=';
	document.getElementById('prompt').innerHTML=out;
	var number1=n1;
	var oper=tp;
	var number2=n2;
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
					if (sol.includes('.')) {sol=sol.substr(0,Math.max(14-out.length,sol.indexOf('.')+2));
					} else {
						alert('Too large number to display!');
						clr()
						return;
					}
				}
				out+=sol;
				document.getElementById('prompt').innerHTML=out;
				allow=false;
				n1='0';
				tp='';
				n2='0';
			}
		}
	});
}
function numb(num) {
	if (num=='.') {
		if (out[out.length-1]=='.') {return}
		if (tp=='') {n1+='.';} else {n2+='.';}
		out+='.';
		document.getElementById('prompt').innerHTML=out;
	} else if (n1=='0' && (tp=='')) {
		if (!allow) {clr();}
		n1=num;
		out=String(n1);
		document.getElementById('prompt').innerHTML=out;
	} else if ((n1!='0') && (tp=='')) {
		n1+=num;
		out=String(n1);
		document.getElementById('prompt').innerHTML=out;
	} else if (n2=='0' && tp!='') {
		n2=num;
		out=String(n1)+tp+String(n2);
		document.getElementById('prompt').innerHTML=out;
	} else if (n2!='0' && tp!='') {
		n2+=num;
		out=String(n1)+tp+String(n2);
		document.getElementById('prompt').innerHTML=out;
	}
}
function oper(op) {
	if (tp!='') {alert('За раз можно использовать только одну операцию!');return;}
	if (!allow) {
		n1=Number(sol);
		out=sol;
		allow=true;
	}
	// if (n1=='0' && n2=='0' && tp=='' && Number(document.getElementById('prompt').value)>0) {
	// 	n1=document.getElementById('prompt').innerHTML
	// }
	tp=op;
	out+=tp;
	document.getElementById('prompt').innerHTML=out;
}
function clr() {
	n1='0';
	tp='';
	n2='0';
	sol='0';
	out='0';
	allow=true;
	numb(0);
}