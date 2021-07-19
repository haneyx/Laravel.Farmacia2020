function float(txt)
{
	if(event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46)
	{
		var amount = document.getElementById(txt).value;
		var present=0,count=0;
		do{
			present=amount.indexOf(".",present);
			if(present!=-1){count++;present++;}
		}while(present!=-1);
		if(present==-1 && amount.length==0 && event.keyCode == 46){event.keyCode=0;return false;}
		if(count>=1 && event.keyCode == 46){event.keyCode=0;return false;}
		if(count==1){
			var lastdigits=amount.substring(amount.indexOf(".")+1,amount.length);
			if(lastdigits.length>=2){event.keyCode=0;return false;}
		}
		return true;
	}else{
		event.keyCode=0;
		return false;
	}
}

function int(txt)
{
	if(event.keyCode > 47 && event.keyCode < 58){return true;}
	else{event.keyCode=0;return false;}
}

function info(){
	var search=document.getElementById("info").style.opacity = 0;
}