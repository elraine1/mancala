<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>

<?php 

//$mylib_path = $_SERVER['DOCUMENT_ROOT'] . '/../includes/mylib_mancala.php';
//require_once($mylib_path);
?>

login test
<form action="/user/login.php" method="POST">
	<fieldset>
		<legend>로그인창</legend>
		username: <input type="text" name="username"><br>
		password: <input type="password" name="hash"><br>
		<input type="submit" value="로그인">
	</fieldset>
</form>

<form action="/user/register.php" method="POST">
	<fieldset>
		<legend>회원가입</legend>
		username: <input type="text" name="username"><br>
		password: <input type="password" name="hash"><br>
		password 확인: <input type="password" name="hash_chk"><br>
		<input type="submit" value="회원가입">
	</fieldset>
</form>


</body>
	

</html>
	