<?php
$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_mancala.php';
require_once($mylib_path);
require_once ('session.php');
start_session();
 
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $hash = $_POST['password']; 
	
//	echo $username . " & " . $hash;
    if (try_to_login($username, $hash) == true) {
		header('Location: protected_page.php');
		if (check_login()) {
	//		echo $_SESSION['login_status'] . " / " . $_SESSION['username'] . " / " . $_SESSION['password'];
	//		echo "<h1>로그인 성공!</h1>";
			$uri = '/index.php';
			if(isset($_SESSION['request_uri'])){
				$uri = $_SESSION['request_uri'];
			}
			$header_path = sprintf("Location: " . $uri);
			header($header_path);

		} else {
			header("Location: error.php?error_code=3");
		}
		
		
    } else {
		// 이멜주소 또는 비번이 등록되지 않았거나 틀림
		header('Location: error.php?error_code=1');
    }
} else {
    echo '로그인 폼 에러';
?>
}