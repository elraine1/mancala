
<div id="login_box">
	<form action="/user/login.php" id="login_form" method="POST">
		<fieldset>
			<legend>Login</legend>
			<table>
			<tr><td>username: </td><td> <input type="text" id="username" name="username"></td></tr>
			<tr><td>password: </td><td> <input type="password" id="password" name="password"></td></tr>
			<tr><td colspan="2"><input type="button" id="login_btn" value="로그인"> <a href="user/register_page.php"> 아직도 회원이 아니세요? </a></td></tr>
			
			</table>
		</fieldset>
	</form>
	<br>
	<!-- 네이버아이디로로그인 버튼 노출 영역 -->
	<div id="naver_id_login"></div>
	<!-- //네이버아이디로로그인 버튼 노출 영역 -->
</div>