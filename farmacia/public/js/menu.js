function check_size(){
	  var w = document.documentElement.clientWidth;
	  var x = document.getElementById("menumin");
	  if (w>660 && x.style.display === "block"){
		x.style.display = "none";
		document.getElementById('menubutton').style.color = 'black';
		document.getElementById('menubutton').style.borderColor = 'black';
	  }
    }
    window.addEventListener("resize",check_size);
	
function open_menu() {	
	var x = document.getElementById("menumin");
	if (x.style.display === "block"){
	x.style.display = "none";
	document.getElementById('menubutton').style.color = 'black';
	document.getElementById('menubutton').style.borderColor = 'black';
	}else{
	x.style.display = "block";
	document.getElementById('menubutton').style.color = '#0e8faa';
	document.getElementById('menubutton').style.borderColor = '#0e8faa';
	}
}