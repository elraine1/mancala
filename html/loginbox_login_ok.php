
<div id="login_box">
	<form action="/user/login.php" id="login_form" method="POST">
		<fieldset>
			<legend>Login</legend>
			<table>
			<tr><td><?php echo $_SESSION['userinfo']->username?>님 환영합니다.</td></tr>
			<tr><td> </td></tr>
			<tr><td>
				<input type="button" value="로그아웃">
				<input type="button" value="내정보보기">
			</td></tr>
			
			</table>
			
		</fieldset>
	</form>
	<br>
	<!-- 네이버아이디로로그인 버튼 노출 영역 -->
	<div id="naver_id_login"></div>
	<!-- //네이버아이디로로그인 버튼 노출 영역 -->
</div>