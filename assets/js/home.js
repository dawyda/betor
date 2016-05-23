// JavaScript Document
//clockwork
function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
	var day = (today.getDate() < 10) ? "0"+today.getDate(): today.getDate();
    var month = ((today.getMonth()+ 1) < 10) ? "0"+(today.getMonth() + 1): today.getMonth()+1;
    var year = today.getFullYear();
    m = checkTime(m);
    s = checkTime(s);
var A = (h > 11) ? " PM":" AM";
h = to12hrformat(h);
    document.getElementById('time_holder').innerHTML = "Time: " + h+":"+m+":"+s+A+"<br />" + day + "-" + month + "-" + year;
    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function to12hrformat(h){
	if(h == 0) return h+12;
	if(h < 10) return "0" + h;
	if(h > 9 && h < 13) return h;
	h = h - 12;
	h = to12hrformat(h);
	return h;
}

//bet calc and bet stuffs

function initiateBet(event){
	event.preventDefault();
	alert("making bet!");
}

function calc_amount(){
	
}


//slide show code