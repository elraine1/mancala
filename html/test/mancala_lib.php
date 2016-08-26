<?php 
	// 초기화
	function init_cups(){
	
		$p1_cups = array(4,4,4,4,4,4,0);
		$p2_cups = array(4,4,4,4,4,4,0);		
		$cups = array($p1_cups, $p2_cups);
		return $cups;
		/*
		if(!(isset($_SESSION['init']))){
			
			$p1_cups = array(4,4,4,4,4,4,0);
			$p2_cups = array(4,4,4,4,4,4,0);
			
			$cups = array($p1_cups, $p2_cups);
			$_SESSION['cups'] = $cups;
			$_SESSION['init'] = true;
			
			
//			$_SESSION['turn'] = $p1;
		}
		*/
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
	


	
?>