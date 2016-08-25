<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Basic 76</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->


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

	.timer {
		display: block; 
		width: 800px; 
		margin:0 auto; 
		margin-top: 100px; 
		font-size:50px	;
		text-align: center;
	}

	.temp{
		font-size:150px;
	}

	
	
</style>
<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/jquery.countdown.js"></script>
<script>

$(document).ready(function(){
	/*
	window.onbeforeunload = function() {
		return "게임을 마치지 않고 나가면 징계를 먹습니다.";
	};
	
	window.onunload = function() {
		// 만약 게임중이면 징계먹이기
		return;
	};
	
	// disable F5 key
	function disableF5(e) { 
		if ((e.which || e.keyCode) == 116) {
			e.preventDefault(); 
		}
	}
	$(document).on("keydown", disableF5);
	*/
	
	
	$('#timer').countdown(Date.now() + 20000, function(event) { 
		var remainingSecondsString =  event.strftime('%-S');
		$(this).text(remainingSecondsString); 
		if (parseInt(remainingSecondsString) == 0) {
			$(this).text('Time Over');
		} else if (parseInt(remainingSecondsString) % 2 == 0) {
			$(this).css('color', 'red');
		} else {
			$(this).css('color', 'blue');
		}
	});
	
	/*
	$('#dummy').countdown(Date.now() + 30000, function(event) { 
		flick();
	});
	
	function flick() {			*/
		/*
		var els = document.getElementsByClassName('mytimer');
		var flash = els[0];		
		var newNode = flash.cloneNode(true);
		newNode.id = flash.id + '1';
		flash.parentNode.replaceChild(newNode, flash);
		newNode.className = 'timer mytimer';
		*/
//		$('#flash').addClass('temp', 900, callBack());
		/*
		$('#flash').animate({font-size:200px;
							     color:red;    }, 1000);
								 */
		//flash.style.color = 'red';
		//setTimeout(function() { flash.style.color = 'black'; }, 100);	
//	}
	
/*	
	function callBack(element){
		$('#flash').removeClass('temp');
	}
*/

});
</script>

<script>

	function test(turn, index){
		
		var cups_p1 = document.getElementsByClassName('cups p1');
		var cups_p2 = document.getElementsByClassName('cups p2');
	
		var all_cups = [cups_p1, cups_p2];
		var player_index = (turn=='p1' ? 0 : 1);			//  턴 주인
		var curr_index = (turn=='p1' ? 0 : 1);				//  컵 주인
		
		var className = 'cups ' + turn;
		var cups = document.getElementsByClassName(className);
		
		var stone = 0;
		if(turn == 'p2'){
			//// 인덱스가 왼쪽에서부터 0 1 2 3 4 5 6 순서이므로 6 5 4 3 2 1 0 순서로 바꿔줘야 함.
			var arrSize = cups.length;
			stone = all_cups[curr_index][arrSize-index-1].value;
			all_cups[curr_index][arrSize-index-1].value = 0;
			
			for(var i = 0; i < cups_p1.length; i++){
				cups_p1[i].disabled = true;
				cups_p2[i].disabled = false;
			}
			
			
		}else {
			stone = all_cups[curr_index][index].value;
			all_cups[curr_index][index].value = 0;
			
			for(var i = 0; i < cups_p2.length; i++){
				cups_p1[i].disabled = false;
				cups_p2[i].disabled = true;
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
			//alert("player:" + (curr_index+1) + " cup_index: " + index + " stone: " + curr_cup.value);
		}
	
		// 돌을 모두 분배한 뒤, 
		if( (index == -1) && (((curr_index+1)%2) == player_index) ){		// 만칼라 통(index=6(-1)의 주인이 턴의 주인이라면 => 프리턴
			alert(turn + "'s Free Turn!");
			/// turn over.
				
		}else {																			// 프리턴이 아니라면,
		
			var op_index = (curr_index+1)%2;
			var op_cup_index = cups_p1.length - 1 - index;
			
			var curr_op_cup_id = 'p'+(op_index+1)+op_cup_index;
			var curr_op_cup = document.getElementById(curr_op_cup_id);		// 턴 종료된 시점의 맞은편에 위치한 컵

			var curr_cup_id = 'p'+(curr_index+1)+index;
			var curr_cup = document.getElementById(curr_cup_id);			// 턴 종료된 시점의 컵
	
//			alert("curr_cup[" + curr_index + ", " + index + "]: " + curr_cup.value + " / op_cup[" + op_index + ", " + op_cup_index + "]: " + curr_op_cup.value);
			
			if((curr_index == player_index) && (curr_cup.value == 1) && (curr_op_cup.value > 0)){
				alert("[" + op_index + ", " + op_cup_index + "]: " + curr_op_cup.value + " gotcha!!");
				
				var mancala = document.getElementById('p'+(curr_index+1)+'6');		// 만칼라통 p16 or p26
				mancala.value = parseInt(mancala.value) + parseInt(curr_cup.value) + parseInt(curr_op_cup.value);
	
				curr_cup.value = 0;
				curr_op_cup.value = 0;
			}
			
//			alert(turn + ' turn Over');
			turnOver(turn);
		}
		

		if(isGameSet() == true){
			alert('Game Set!');
		}
	
		// 1. 타이머.       
		
	
	}
	
	function turnOver(turn){
		
		var cups_p1 = document.getElementsByClassName('cups p1');
		var cups_p2 = document.getElementsByClassName('cups p2');
	
		if(turn == 'p1'){	// p1의 턴이 종료 
			for(var i = 0; i < cups_p1.length; i++){
				cups_p1[i].disabled = true;
				cups_p2[i].disabled = false;
			}

		}else {				// p2의 턴이 종료
			for(var i = 0; i < cups_p2.length; i++){
				cups_p1[i].disabled = false;
				cups_p2[i].disabled = true;
			}
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


		<h2> - Mancala! - </h2>
		
		<div id="timer_div">
			<span id="timer" class="timer">Timer not started yet</span>
			<!-- <span id="flash" class="timer mytimer">Flash</span>  -->
			<span id="dummy"></span>
			<br><br>
		</div>


		<?php
			require_once ('mancala_lib.php');
		//	require_once ('./user/session.php');
		//	start_session();

			init_cups();
			
		// 초기화 	

			
			if($_SERVER['REQUEST_METHOD'] == "GET"){
				$turn = $_GET['turn'];
				$cup_index = $_GET['cup_index'];
			}

			$cups = $_SESSION['cups'];

		?>

			<h3><?php echo "$turn's Turn!"; ?></h3>
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
