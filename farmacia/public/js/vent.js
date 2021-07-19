var nu=1, LINES=0;
function add(PROi,PROn,input,PROp){
	var T = document.getElementById('TB');
	var X  = T.insertRow();
	var PROc = document.getElementById('in.'+input).value;
	if(!PROc){ alert('No se puede Agregar sin una CANTIDAD');}
	else{
		X.setAttribute('id',nu);
		X.setAttribute('class',PROi);//idp
		X.setAttribute('onclick','del('+nu+')');
		var d0 = X.insertCell(0); d0.style.width='3%'; d0.style.fontSize='11px';
		var d1 = X.insertCell(1); d1.style.width='69%'; d1.style.textAlign='left'; d1.style.paddingLeft='6px';
		var d2 = X.insertCell(2); d2.style.width='8%';
		var d3 = X.insertCell(3); d3.style.width='8%';
		var d4 = X.insertCell(4); d4.style.width='12%';

		d0.appendChild(document.createTextNode(nu++));
		d1.appendChild(document.createTextNode(PROn));
		d2.appendChild(document.createTextNode(PROc));
		d3.appendChild(document.createTextNode(PROp));
		upd();
	}
}

function upd(){
	var l = document.getElementById('TB').rows.length;
	var suma = 0.0;
	var canti=0;preci=0.0,subi=0.0
	var idpro,venta='';
	for(var k=0;k<l;k++){
		document.getElementById('TB').rows[k].cells[0].innerHTML=(k+1); //upd rows numeracion
		idpro=document.getElementById('TB').rows[k].getAttribute('class');
		canti=parseInt(document.getElementById('TB').rows[k].cells[2].innerHTML);
		preci=parseFloat(document.getElementById('TB').rows[k].cells[3].innerHTML);
		subi=Math.round(canti*preci*100)/100;
		document.getElementById('TB').rows[k].cells[4].innerHTML=subi;
		suma+=subi;

		if(k+1<l)venta=venta+idpro+','+canti+','+preci+',';
		else venta=venta+idpro+','+canti+','+preci;
	}
	suma=Math.round(suma*100)/100;
	document.getElementById('S').innerHTML=suma;
	document.getElementById('L').innerHTML=l;

	document.getElementById('lot').value=l;
	document.getElementById('array').value=venta;
}

function del(rid){
	var row = document.getElementById(rid);
	row.parentElement.removeChild(row);
	upd();
}

function cancel(ex){
	LINES=0;
	document.getElementById('TB').innerHTML='';
	document.getElementById('S').innerHTML='0.0';
	document.getElementById('L').innerHTML='0';
}

function ti(){
	var v = document.getElementById('c0').value;
	switch(v){
        case '1':
			document.getElementById('c1').innerHTML='N° DNI';
			document.getElementById('c2').innerHTML='Nombres';
			break;
		case '6': 
			document.getElementById('c1').innerHTML='N° RUC';
			document.getElementById('c2').innerHTML='Raz&oacute;n Social';
			break;
    }
}

function fo(v){
	document.getElementById('formato').value=v;
}