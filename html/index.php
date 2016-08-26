<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Basic 76</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->

<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery-ui.js"></script>
<script type="text/javascript" src="./jquery/jquery.countdown.js"></script>

<script>

$(document).ready(function(){
	
	
	
	$("#login_btn").click(function(){
		var action = $("#login_form").attr("action");
		var form_data{
			username: $("#username").val(),
			password: $("#password").val(),	
		};
		
		$.ajax({
			
			type:"POST",
			url: action,
			data: form_data,
			success: function(response){
				
				if(response == 'success'){
					alert('로그인 성공');
					
				}else {
					alert('로그인 실패');
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
	require_once($DOCUMENT_ROOT . "/template/header_row.php");
?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <section id="slider" class="clear">
      <figure><img src="images/mancala.jpg" alt="">
        <figcaption>
			<form action="/user/login.php" id="login_form" method="POST">
				<fieldset>
					<legend>로그인창</legend>
					username: <input type="text" name="username"><br>
					password: <input type="password" name="password"><br>
					<input type="button" id="login_btn" value="로그인">
					<a href="user/register_page.php">아직도 회원이 아니세요?</a>
				</fieldset>
			</form>
        </figcaption>
      </figure>
    </section>
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
