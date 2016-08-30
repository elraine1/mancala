<?php
$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_mancala.php';
require_once($mylib_path);
require_once ('session.php');
start_session();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $hash = $_POST['password']; 
	
    if (try_to_login($username, $hash) == true) {
		// 로그인 성공
		echo 'success';
    } else {
		// 이멜주소 또는 비번이 등록되지 않았거나 틀림
		echo 'failed';
    }
} else {
    echo '로그인 폼 에러: ' . $_POST['username'], $_POST['password'];
}
?>