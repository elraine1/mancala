<?php 
	// 초기화
	function init_cups(){
		if(!(isset($_SESSION['init']))){
			
			$p1_cups = array(4,4,4,4,4,4,0);
			$p2_cups = array(4,4,4,4,4,4,0);
			
			$cups = array($p1_cups, $p2_cups);
			$_SESSION['cups'] = $cups;
			$_SESSION['init'] = true;
			
			
//			$_SESSION['turn'] = $p1;
		}
	}



	// 턴 넘기기
	function turn_over($turn){
		if($turn == 'p1'){
			$turn = 'p2';
		}else{
			$turn = 'p1';
		}
		$_SESSION['turn'] = $turn;
		return $turn;
	}
	
	
	function is_gameset($cups){
		
		$player1_sum = array_sum(array_slice($cups[0], 0, 6));
		$player2_sum = array_sum(array_slice($cups[1], 0, 6));
		
		if($player1_sum === 0 || $player2_sum === 0){
			return true;		// gameset
		}else {
			return false;		// not yet
		}
	}
	
	
	
	function is_empty_cup($cups, $player_index, $cup_index){
		if($cups[$player_index][$cup_index] == 0){
			return true;	
		}else{
			return false;
		}
	}
	
		
/*
		if(!((index == -1) && (((player_index+1)%2) == curr_index))){

		// 내 빈 컵에서 턴이 끝났다면(통에 내가 넣은 돌만 있는 경우),  맞은편에 있는 상대방의 컵에 있는 돌을 내 만칼라 통으로 가져간다.
			var op_index = (player_index+1)%2;			// opponents player 
			var op_cup_index = length(cups_p1) - index - 2;
			if((player_index == curr_index) && (cups[player_index][index] == 1) && (cups[op_index][op_cup_index] > 0)){
				cups[curr_index][6] = parseInt(cups[curr_index][6]) + parseInt(cups[player_index][index]);
				cups[curr_index][6] = parseInt(cups[curr_index][6]) + parseInt(cups[op_index][op_cup_index]);
				
				cups[player_index][index] = 0;
				cups[op_index][op_cup_index] = 0;			
			}
			//$turn = turn_over($turn);
		}
*/	

	
?>