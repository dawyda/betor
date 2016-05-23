// JavaScript Document
///BET TABLE LOGIC AND THE REST

///FIRST WE SHALL DEFINE OUR BET OBJECT

function Bet(fix_id, side_picked, odds, id) {
	this.fix_id = fix_id;
	this.side_picked = side_picked;
	this.odds = odds;
	this.id = id;
}

////NOW EVERYTHING ELSE BEGINS

var bets = new Array(); // will hold bets.
var net_bets = new Array(); // will hold final bets to be sent to the server after user clicks on makebet.
var multi_bet = false; //if true then it is a multiple bet else it is a single bet.
var onstart = true;
var sidePick_DOM = document.getElementById("ulpicks");
var maxbets = 12;
var total_odds = 0.0;
var win_amt = 0;

function calc_todds(){
	if(bets.length < 1){ total_odds = 0.0; return;}
	if(bets.length == 1){ total_odds = bets[0].odds; return;}
	var t = 1;
	if(bets.length > 1){
		for(var i = 0; i < bets.length; i ++){
			t *= bets[i].odds;
		}
		
		total_odds = Math.round((t + 0.00001) * 100) / 100;
	}
}

function calc_win(){
	if(total_odds <= 0.0){ win_amt = 0.0; return;}
	var stake = isNaN(parseFloat(document.getElementById("stakes").value)) ? "Bad Stake" : parseFloat(document.getElementById("stakes").value);
	logger(stake);
	win_amt = stake * total_odds;
	win_amt = Math.round((win_amt + 0.00001) * 1000) / 1000;
}

function bet(event, dom, side_picked, team_picked, fix_id, fixture, odd, side_id) { // called when user clicks on bet tablet.
	event.preventDefault();
	//alert(team_picked); return;
	var cname = dom.className;
	var excludes = document.getElementsByClassName(cname);
	
	if(!onstart){
		onstart = true;
		var jom = document.getElementsByClassName("better");
		for(var i = 0; i < jom.length; i ++) {
			if(jom.item(i).hasAttribute("style")){
				otherStyleRemover("better");
			}
		}
	}
	
	for(var j = 0; j < excludes.length; j ++){
		if(excludes.item(j) === dom) continue;
		if(excludes.item(j).hasAttribute("style")){
			//remove from sidepick
			if(document.getElementById(side_id)){
				removeFromsidePick(side_id);
				removeFrombets(side_id);
			}
			
			
			otherStyleRemover(cname);
		}
	}
	
	if(dom.hasAttribute("style")){
		dom.style.cssText = "";
		dom.removeAttribute("style");
		
		removeFromsidePick(side_id);
		removeFrombets(side_id);
	}
	else{
		if(maxbets < 1){
			alert("You have reached the maximum bets limit!");
		}
		dom.style.cssText = "background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #1c63ff),color-stop(1, #074dff));background-image: -o-linear-gradient(bottom, #1c63ff 0%, #074dff 100%);background-image: -moz-linear-gradient(bottom, #1c63ff 0%, #074dff 100%);background-image: -webkit-linear-gradient(bottom, #1c63ff 0%, #074dff 100%);background-image: -ms-linear-gradient(bottom, #1c63ff 0%, #074dff 100%);background-image: linear-gradient(to bottom, #1c63ff 0%, #074dff 100%);color:#FFF; text-decoration:none;";
		logger(dom.className.toString());
		addTosidePick(team_picked, fix_id, fixture, odd, side_picked, dom.className.toString(), side_id);
		addTobets(fix_id, side_picked, odd, side_id);
	}
	updateBetCalc();
}

function updateBetCalc(){
	calc_todds();
	calc_win();
	document.getElementById("odds").value = total_odds;
	document.getElementById("win_amt").value = win_amt;
	document.getElementById("betTotal").value = bets.length;
}

function unbet(){ //unbets
	
}

function addTobets(fix_id, side_picked, odds, id){ //adds new bet to bets array.
	bets.push(new Bet(fix_id, side_picked, odds, id));
	maxbets --;
	changeBetStatus();
}

function removeFrombets(id){ //removes a bet form the bets array.
	if(bets.length == 0) return;
	
	for(var i = 0; i < bets.length; i ++) {
		if(bets[i].id == id){
			bets.splice(i, 1);
			logger("bet with matching id removed");
			maxbets ++;
			break;
		}
	}
		
	changeBetStatus();
}

function sendBetstoServer(){ //this is the function that send all bets to server after user confirms bets.
	
}

function addTosidePick(team_picked, fix_id, fixture, odd, side_picked, classn, side_id){ //adds picked bet to side pick for user display.
	var str = '<li id="' + side_id + '"><a href="#" class="betCancel" onclick="cancelBet(event, this,' + fix_id + ', \'' + side_picked + '\', \'' + classn + '\', \'' + side_id + '\')">x</a>' + fixture + ' <span style="display:block; color:yellow; font-weight:800;">pick: ' + team_picked + '&nbsp; (x' + odd + ')</span></li>';
	if(sidePick_DOM){
		sidePick_DOM.insertAdjacentHTML("beforeend", str);
	}
}

function removeFromsidePick(str){ //does the opposite of setToside pick...will also call removeFrombets.
	document.getElementById(str).removeNode;
	var elem = document.getElementById(str);
	elem.parentNode.removeChild(elem);	
}

function cancelBet(event, dom, fix_id, side_picked, classn, side_pick){ //cancels bet from sidepick....removeFromsidePick() will be called from here.
	event.preventDefault();
	removeFrombets(side_pick);
	
	removeFromsidePick(dom.parentNode.id);
	
	otherStyleRemover(classn);
	updateBetCalc();
}

function otherStyleRemover(classn){
	var excludes = document.getElementsByClassName(classn);
	logger(excludes.length);
	
	for(var j = 0; j < excludes.length; j ++){
		if(excludes.item(j).hasAttribute("style")){
			logger("yup found on pos " + j);
			excludes.item(j).style.cssText = "";
			excludes.item(j).removeAttribute("style");
			break;
		}
	}
}

function changeBetStatus(){ //if bets selected get below 2 then single bet mode is restored or multibet set. called by both remove & add to bets()s
	if(bets.length > 1){
		multi_bet = true;
		document.getElementById("bettype").value = "Multibet bet";
	}
	else{
		multi_bet = false;
		document.getElementById("bettype").value = "Single bet";
	}
	
	//logger("multibet is now: " + multi_bet.toString() + " with " + bets.length + " bets");
}

function logger(str){
	console.log(str);
}

function initiateBet(event){
	event.preventDefault();
	
	if(bets.length < 1){
		alert("Please make a selection from the table before you continue!");
		return;
	}
	
	var logged = document.getElementById("ndevo");
	
	if(logged){
		alert("Please sign in to complete your bet!");
		return;
	}
	
	var confirm2bet = window.confirm("You are about to place your bet, do you wish to continue?");
	
	if(confirm2bet){
		createBet2send();
	}
}

function createBet2send(){
	for(var i = 0; i < bets.length; i ++){
		net_bets.push({fix_id: bets[i].fix_id, side_picked: bets[i].side_picked, odds: bets[i].odds});
	}
	
	var ajax = new XMLHttpRequest() || new ActiveXObject("Microsoft.XMLHTTP");
	ajax.onreadystatechange = function(){
		if(ajax.readyState === 4){
			if(ajax.status === 200){
				net_bets.splice(0, net_bets.length); //empties the net_bets array on ajax response.
				if(ajax.responseText == '1'){
					alert('bet added: To view your bets click mybets on the menu. And account updated.');
					resetAll();
				}
				else if(ajax.responseText == '-1'){
					alert('Your Account balance is below the stake amount. Upload funds to continue.');
				}
				else if(ajax.responseText == '5'){
					alert('You have already placed this bet. Select another match to bet on!');
				}
				else{
					//alert(ajax.responseText);
					alert('Error: Refresh page and try again! :' + ajax.responseText);
				}
			}
			else{
				alert("error");
			}
		}
	}
	ajax.open("POST", "bet_scripts/makebet.php", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send("bet_submit=1&is_multi=" + multi_bet + "&stake=" + (isNaN(parseFloat(document.getElementById("stakes").value)) ? "Bad Stake" : parseFloat(document.getElementById("stakes").value)) + "&bets=" + JSON.stringify(net_bets));
}

//after bet has been sent successfully, we reset everything using this.
function resetAll(){
	sidePick_DOM.innerHTML = "";
	document.getElementById("odds").value = 0;
	document.getElementById("win_amt").value = 0;
	document.getElementById("betTotal").value = "Bet Made";
	document.getElementById("stakes").value = 100;
	maxbets = 12;
	total_odds = 0.0;
	win_amt = 0;
	multi_bet = false;
	if(bets.length > 0) bets.splice(0, bets.length);
	onstart = false;
}