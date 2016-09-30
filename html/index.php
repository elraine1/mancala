<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Basic 76</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->

<style type="text/css">
	#row1_left_div{
		display:inline-block;
		float:left;
		
	}
	
	#mancala_img{
		 width: 600px;
		 height: 300px;
		 margin: 20px;
	}
	
	#login_container{
		margin: 0 auto;
		margin-top: 20px;
		margin-left: 20px;
		width: 300px;
		height: 300px;
		background-color: #333333;
		display: inline-block;
		float:left;
		align:center;
		
		border-radius: 20px;
	}
	
	#login_box{
		margin: 20px;
	}
	
	#inner_container_row1 a{
		outline:none; 
		text-decoration:none;
		background-color: #333333;
		
		
	}
	
	
	fieldset { 
		display: block;
		margin-left: 2px;
		margin-right: 2px;
		padding-top: 0.35em;
		padding-bottom: 0.625em;
		padding-left: 0.75em;
		padding-right: 0.75em;
		border: 2px solid #222222;
		height: 90px;
		
		border-radius: 10px;
	}
	
</style>



<!-- <script language="javascript" src="check_form.js"></script> -->
<script language="javascript" src="/user/sha512.js"></script>

<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/jquery.countdown.js"></script>

<script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>

<script>

function checkLoginForm(form, id, password) { 
	
    if (id.value == '' || 
          password.value == '' ) {
        alert('아이디와 비밀번호는 빈칸 안됨');
        return false;
    }
	 
    // 해쉬 값을 포함할 요소 생성
    var hash = hex_sha512(password.value);
	return hash;
}


</script>

<script>

$(document).ready(function(){
	
	
	
	$("#login_btn").click(function(){
		var hash = checkLoginForm(this.form, this.form.username, this.form.password);
		var action = $("#login_form").attr("action");
		var form_data = {
			"username": $("#username").val(),
			"password": hash,	
		};
		
		$.ajax({
			
			type: "POST",
			url: action,
			data: form_data,
			success: function(response){
				
				
				if(response == 'success'){
				//	alert(response + '로그인 성공');
					alert('야호');
					$("#login_container").load("loginbox_login_ok.php");
				}else {
					alert(response + ' 아이디 또는 비밀번호가 일치하지 않습니다.');
				}
			}
		});
	});
	
	$("#logout_btn").click(function(){
		var hash = checkLoginForm(this.form, this.form.username, this.form.password);
		var action = $("#login_form").attr("action");
		var form_data = {
			"username": $("#username").val(),
			"password": hash,	
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response){
				
				alert(response);
				if(response == 'success'){
				//	alert(response + '로그인 성공');
					alert('야호');
				}else {
					alert('아이디 또는 비밀번호가 일치하지 않습니다.');
				}
			}
		});
	});
	
});

</script>



</head>
<body>
<?php


	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once('user/session.php');
	start_session();
	
	require_once($DOCUMENT_ROOT . "/template/header_row.php");  

//	echo $_SESSION['login_status'] . '<br>';
//	echo $_SESSION['userinfo']->username . '<br>';
	
?>

<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">

	<div id="inner_container_row1">
		<div id="row1_left_div">
			<img id="mancala_img" src="images/mancala.jpg" alt="">	
		</div>

		<div id="login_container">
			<?php 
				if(isset($_SESSION['login_status']) && ($_SESSION['login_status'] == true)){
					$userinfo = $_SESSION['userinfo'];
					require_once('loginbox_login_ok.php');
				}else {
					require_once('loginbox_login_no.php');
				}
			?>
		</div>
	</div>
	
    <!-- Content -->
    <div id="homepage">
      <!-- ########################################################################################## -->
      <section class="clear">
        <article class="two_third">
          <a href="index.php"><h2>Mancala</h2></a>
          <p>This is a W3C compliant free website template from <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a>. For full terms of use of this template please read our <a href="http://www.os-templates.com/template-terms">website template licence</a>.</p>
          <p>You can use and modify the template for both personal and commercial use. You must keep all copyright information and credit links in the template and associated files. For more HTML5 templates visit <a href="http://www.os-templates.com/">free website templates</a>.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
        <article class="one_third lastbox">
          <h2>Lorum ipsum dolor</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non diam erat. In fringilla massa ut nisi ullamcorper pellentesque. Quisque non luctus sem.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
      </section>
      <!-- / Two Third -->
      <!-- ########################################################################################## -->
      <!-- ########################################################################################## -->
      <!-- ########################################################################################## -->
      <!-- ########################################################################################## -->
      <!-- One Third -->
      <section class="services clear">
        <article class="one_third">
          <h2>Lorum ipsum dolor</h2>
          <img src="images/demo/80x80.gif" alt="">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non diam erat. In fringilla massa ut nisi ullamcorper.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
        <article class="one_third">
          <h2>Lorum ipsum dolor</h2>
          <img src="images/demo/80x80.gif" alt="">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non diam erat. In fringilla massa ut nisi ullamcorper.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
        <article class="one_third lastbox">
          <h2>Lorum ipsum dolor</h2>
          <img src="images/demo/80x80.gif" alt="">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non diam erat. In fringilla massa ut nisi ullamcorper.</p>
          <footer class="more"><a href="#">Read More &raquo;</a></footer>
        </article>
        <div class="spacer"></div>
      </section>
      <!-- ########################################################################################## -->
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




<!-- 네이버아디디로로그인 초기화 Script -->
<script type="text/javascript">
//	var naver_id_login = new naver_id_login("kwh_3pTmE1e7s3ktK1Oy", "http://mancala.phplove.net");
	var naver_id_login = new naver_id_login("kwh_3pTmE1e7s3ktK1Oy", "http://127.0.0.1:8083/");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 3,40);
	naver_id_login.setDomain("mancala.phplove.net");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();
	
<!-- // 네이버아이디로로그인 초기화 Script -->


<!-- 네이버아디디로로그인 Callback페이지 처리 Script -->

	// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		alert(naver_id_login.getProfileData('email'));
		alert(naver_id_login.getProfileData('nickname'));
		alert(naver_id_login.getProfileData('age'));
	}

	// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");
</script>


