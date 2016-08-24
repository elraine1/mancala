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
	
</style>


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
		}else {
			stone = all_cups[curr_index][index].value;
			all_cups[curr_index][index].value = 0;
		}
		
		
		while(stone > 0){		
		
			index += 1;
			if(index == 6){			//
				
				if(curr_index == player_index){
					var curr_cup = document.getElementById('p'+(curr_index+1)+index);
					curr_cup.value = parseInt(curr_cup.value) + 1;
					stone--;
				}
				curr_index = parseInt(curr_index + 1) % 2;
				index = -1;
				
			} else{
				
				var curr_cup = document.getElementById('p'+(curr_index+1)+index);
				curr_cup.value = parseInt(curr_cup.value) + 1;
				stone--;
			}
			//alert("player:" + (curr_index+1) + " cup_index: " + index + " stone: " + curr_cup.value);
		}
	
		// 1. 타이머.
		// 2. 턴.
		// 3. 게임 셋.

		if((index == -1) && (((player_index+1)%2) == curr_index)){
			
			alert('free turn!');
			
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
	<h2>INTRODUTION</h2>
    <div id="homepage">	

	
	
<!--
<span id="timer" class="timer">Timer not started yet</span>
<span id="flash" class="timer mytimer">Flash</span>
<span id="dummy"></span>
-->
<h2> - Mancala! - </h2>
<?php
	require_once ('mancala_lib.php');
	require_once ('./user/session.php');
	start_session();

	init_cups();
	
// 초기화 	

	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$turn = $_GET['turn'];
		$cup_index = $_GET['cup_index'];
	}

	$cups = $_SESSION['cups'];
/*	
	if($turn == 'p1'){
		$curr_player = 0;
		$player_index = 0;
	}else if($turn == 'p2'){
		$curr_player = 1;
		$player_index = 1;
	}
	
	$stone = $cups[$player_index][$cup_index];
	$cups[$player_index][$cup_index] = 0;
		
	while($stone > 0){		
		
		$cup_index += 1;
		if($cup_index == 6){			//
			
			if($player_index === $curr_player){
				$stone--;
				$cups[$player_index][$cup_index] += 1;
			}
				
			$player_index = ($player_index + 1) % 2;
			$cup_index = -1;
			
		} else{
	
			$stone--;
			$cups[$player_index][$cup_index] += 1;

		}
	}
	
	if(!(($cup_index === -1) && ((($player_index+1)%2) === $curr_player))){

	// 내 빈 컵에서 턴이 끝났다면(통에 내가 넣은 돌만 있는 경우),  맞은편에 있는 상대방의 컵에 있는 돌을 내 만칼라 통으로 가져간다.
		$op_index = ($player_index+1)%2;			// opponents player 
		$op_cup_index = count($cups[0]) - $cup_index - 2;
		if($player_index === $curr_player && $cups[$player_index][$cup_index] == 1 && $cups[$op_index][$op_cup_index] > 0){
			$cups[$curr_player][6] += $cups[$player_index][$cup_index];
			$cups[$curr_player][6] += $cups[$op_index][$op_cup_index];
			
			$cups[$player_index][$cup_index] = 0;
			$cups[$op_index][$op_cup_index] = 0;			
		}
	
		$turn = turn_over($turn);
	}
	
	
	if(is_gameset($cups)){
		$b_gameset = true;
		
		$cups[0][6] = array_sum(array_slice($cups[0], 0, 6));
		$cups[1][6] = array_sum(array_slice($cups[1], 0, 6));
		
		for($i=0; $i<6; $i++){
			$cups[0][$i] = 0;
			$cups[1][$i] = 0;
		}
	
		echo "<h2>경기 종료!</h2>";
	}
	
	
	$_SESSION['cups'] = $cups;	
	
	*/
	
//	var_dump(is_empty_cup($cups, $player_index, $cup_index));
	// href test.php
	
?>

	<h3><?php echo "$turn's Turn!"; ?></h3>
	<table id="mancala_board">
	<tr>
		<?php
		
			printf("<td rowspan='2'><input type='button' value='%d' id='p26' class='mancala p2' disabled></td>", $cups[1][6]);
			for($i = 5; $i >= 0 ; $i--){
				if($cups[1][$i] == 0){
					printf("<td><input type='button' class='cups p2' value='%d'></td>", $cups[1][$i]);
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
					printf("<td><input type='button' class='cups p1' id='p1%d' value='%d'></td>", $cups[0][$i]);
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
