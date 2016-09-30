<div id="login_box">
	<form action="/user/login.php" id="login_form" method="POST">
	<input type="hidden" id="hdnSession" data-value="@Request.RequestContext.HttpContext.Session['username']" />
		<fieldset>
			<legend>Login</legend>
			<table>
			<tr><td><span id="username"></span>님 환영합니다.</td></tr>
			<tr><td> </td></tr>
			<tr><td>
				<a href="user/logout.php" ><input type="button" value="로그아웃"></a>
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
<script>
	var username = document.getElementById('username');
//	var usernameInSession = "@Request.RequestContext.HttpContext.Session['username']";
	var usernameInSession = 'admin';
	
	username.innerHTML = usernameInSession;

</script>