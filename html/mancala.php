<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="styles/layout.css" type="text/css">

<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->

<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/jquery.countdown.js"></script>

<style type="text/css">
	#mancala_board {
		border: 2px solid gray;
		
	}
	
	.mancala{
		width: 50px;
		height: 100px;
		border-radius: 10px;
		font-weight: bold;
		font-size: 15px;
	}
	
	.cups{
		width: 50px;
		height: 50px;
		border-radius: 10px;
		
		font-weight: bold;
		font-size: 15px;
	}
	
	.p2{
		color: MidnightBlue ;
	}
	.p1{
		color: green;
	}
	
	input[type="button"]:disabled {
		background: darkgray;
	}
	
	
	@keyframes example {
		from {color: red;}
		to {color: black;}
	}

	.mytimer {
		animation-name: example; 
		animation-duration: 1.5s; 	
	}

	.timer_title{
		margin: 0 auto;
		text-align: center;
		font-size: 30px;
		color: black;
	}
	
	.timer {
		display: block; 
		width: 600px; 
		margin:0 auto; 
		margin-top: 10px; 
		margin-bottom: 20px;
		font-size:30px	;
		text-align: center;
	}

	.temp{
		font-size:40px;
	}

	fieldset { 
		display: block;
		margin-left: 2px;
		margin-right: 2px;
		padding-top: 0.35em;
		padding-bottom: 0.625em;
		padding-left: 0.75em;
		padding-right: 0.75em;
		border: 2px solid black;
		height: 80px;
	}
	
	legend{
		font-size:30px;
		color: black;
		margin: 10px;
	}
	
	
</style>

<script>
	var turn = '';					// 턴에 대한 변수를 jquery 에서 사용하기 위하여 전역변수로 선언.
	function test(myturn, index){
		
		turn = myturn;
		var cups_p1 = document.getElementsByClassName('cups p1');
		var cups_p2 = document.getElementsByClassName('cups p2');
	
		var all_cups = [cups_p1, cups_p2];
		var player_index = (turn=='p1' ? 0 : 1);			//  턴 주인
		var curr_index = (turn=='p1' ? 0 : 1);				//  컵 주인
		
		var className = 'cups ' + turn;
		var cups = document.getElementsByClassName(className);
		
		var stone = 0;
		if(turn == 'p1'){
			stone = all_cups[curr_index][index].value;
			all_cups[curr_index][index].value = 0;
			
			for(var i = 0; i < cups_p2.length; i++){
				cups_p1[i].disabled = false;
				cups_p2[i].disabled = true;
			}
		}else {
			//// 인덱스가 왼쪽에서부터 0 1 2 3 4 5 6 순서이므로 6 5 4 3 2 1 0 순서로 바꿔줘야 함.
			var arrSize = cups.length;
			stone = all_cups[curr_index][arrSize-index-1].value;
			all_cups[curr_index][arrSize-index-1].value = 0;
			
			for(var i = 0; i < cups_p1.length; i++){
				cups_p1[i].disabled = true;
				cups_p2[i].disabled = false;
			}
		}
		
		// 선택한 컵에서 돌을 하나씩 분배함. 
		while(stone > 0){		
		
			index += 1;
			if(index == 6){			//
				
				if(curr_index == player_index){
					var curr_cup = document.getElementById('p'+(curr_index+1)+index);		// 만칼라통 p16 or p26
					curr_cup.value = parseInt(curr_cup.value) + 1;
					stone--;
				}
				curr_index = (curr_index + 1) % 2;
				index = -1;
				
			} else{
				
				var curr_cup = document.getElementById('p'+(curr_index+1)+index);
				curr_cup.value = parseInt(curr_cup.value) + 1;
				stone--;
			}
		}
	
		// 돌을 모두 분배한 뒤, 
		if( (index == -1) && (((curr_index+1)%2) == player_index) ){		// 만칼라 통(index=6(-1)의 주인이 턴의 주인이라면 => 프리턴
			alert(turn + "'s Free Turn!");
			timer_start(turn);
			/// turn over.
				
		}else {																			// 프리턴이 아니라면,
		
			var op_index = (curr_index+1)%2;
			var op_cup_index = cups_p1.length - 1 - index;
			
			var curr_op_cup_id = 'p'+(op_index+1)+op_cup_index;
			var curr_op_cup = document.getElementById(curr_op_cup_id);		// 턴 종료된 시점의 맞은편에 위치한 컵

			var curr_cup_id = 'p'+(curr_index+1)+index;
			var curr_cup = document.getElementById(curr_cup_id);			// 턴 종료된 시점의 컵
		
			if((curr_index == player_index) && (curr_cup.value == 1) && (curr_op_cup.value > 0)){
				alert("[" + op_index + ", " + op_cup_index + "]: " + curr_op_cup.value + " gotcha!!");
				
				var mancala = document.getElementById('p'+(curr_index+1)+'6');		// 만칼라통 p16 or p26
				mancala.value = parseInt(mancala.value) + parseInt(curr_cup.value) + parseInt(curr_op_cup.value);
	
				curr_cup.value = 0;
				curr_op_cup.value = 0;
			}
			turnOver(turn);
		}
		

		if(isGameSet() == true){
			alert('Game Set!');
		}
	}
	
	
	function isGameSet(){
		
		var cups_p1 = document.getElementsByClassName('cups p1');
		var cups_p2 = document.getElementsByClassName('cups p2');
		
		var chkSum1 = 0;
		var chkSum2 = 0;
		for(var i = 0; i < cups_p1.length; i++){
			chkSum1 += parseInt(cups_p1[i].value);
			chkSum2 += parseInt(cups_p2[i].value);
		}
		
//		alert(chkSum1 + " " + chkSum2 );
		
		if(chkSum1 == 0 || chkSum2 == 0){
			
			var mancala_p1 = document.getElementById('p16');		// 만칼라통 p16 or p26
			var mancala_p2 = document.getElementById('p26');
			
			mancala_p1.value = parseInt(mancala_p1.value) + chkSum1;
			mancala_p2.value = parseInt(mancala_p2.value) + chkSum2;
			
			for(var i = 0; i<cups_p1.length; i++){
				
				cups_p1[i].value = 0;
				cups_p2[i].value = 0;
				
				cups_p1[i].disabled = true;
				cups_p2[i].disabled = true;
			}
			
			return true; 
		}else {
			return false;
		}
	}
	
	function turnOver(myturn){
		
		turn = myturn;
		var cups_p1 = document.getElementsByClassName('cups p1');
		var cups_p2 = document.getElementsByClassName('cups p2');
	
		if(turn == 'p1'){	// p1의 턴이 종료 
			for(var i = 0; i < cups_p1.length; i++){
				cups_p1[i].disabled = true;
				cups_p2[i].disabled = false;
			}
 			turn = 'p2';
		}else {				// p2의 턴이 종료
			for(var i = 0; i < cups_p2.length; i++){
				cups_p1[i].disabled = false;
				cups_p2[i].disabled = true;
			}
			turn = 'p1';
		}
		timer_start(turn);
	}

	function timer_start(myturn){
		
		turn = myturn;
		$('#timer').countdown(Date.now() + 20500, 
			function(event) { 
				if(event.type == 'update'){
					$(this).removeClass('temp');
					
					var remainingSecondsString =  event.strftime('%-S');
					var remainingSeconds = parseInt(remainingSecondsString)-1;
					$(this).text(remainingSeconds + " seconds left"); 
					
					if(remainingSeconds > 10) {
						$(this).css('color', 'black');
					}else if(remainingSeconds > 5) {
						$(this).css('color', 'orangeRed');
					}else {
						$(this).css('color', 'red');
						flick();
					}
					
				}else if(event.type == 'finish'){
					turnOver(turn);
					alert(turn + " Turn over!");
				}
			});
	}
	
	
	function flick() {			
		$('#timer').addClass('temp', 900, callBack());
	}
	
	function callBack(element){
		$('#timer').removeClass('temp');
	}
	

</script>

</head>
<body>
<?php
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DOCUMENT_ROOT . "/template/header_row.php");

?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Content -->
    <div id="homepage">	
		
		<div id="timer_div">
			<fieldset name="test">
				<legend> Time left </legend>	
				<span id="timer" class="timer">Not started yet</span>
			</fieldset>
		</div>


		<?php
		// 초기화 	
			$p1_cups = array(4,4,4,4,4,4,0);
			$p2_cups = array(4,4,4,4,4,4,0);		
			$cups = array($p1_cups, $p2_cups);
		
		?>
			
			<br>
			<table id="mancala_board">
			<tr>
				<?php
				
					printf("<td rowspan='2'><input type='button' value='%d' id='p26' class='mancala p2' disabled></td>", $cups[1][6]);
					for($i = 5; $i >= 0 ; $i--){
						if($cups[1][$i] == 0){
							printf("<td><input type='button' class='cups p2' id='p2%d' value='%d'></td>", $i, $cups[1][$i]);
						}else {
							printf("<td>");
							printf("<input type='button' class='cups p2' id='p2%d' value='%d' onclick=\"test('%s', %d);\" >", $i, $cups[1][$i], 'p2', $i);
							printf("</td>");
						}
						
					}
					printf("<td rowspan='2'><input type='button' value='%d' id='p16' class='mancala p1' disabled></td>", $cups[0][6]);
				?>
			</tr>
			<tr>
				<?php
					for($i = 0; $i <= 5 ; $i++){
						
						if($cups[0][$i] == 0){
							printf("<td><input type='button' class='cups p1' id='p1%d' value='%d'></td>", $i, $cups[0][$i]);
						}else {
							printf("<td><input type='button' class='cups p1' id='p1%d' value='%d' onclick=\"test('%s', %d);\" ></td>", $i, $cups[0][$i], 'p1', $i);
						}
					}
				?>
			</tr>
			</table>
			
			<br><br>
			<a href="index.php"><button>home</button></a>

		
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2012 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </footer>
</div>
</body>
</html>
