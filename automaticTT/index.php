<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styl.css">
	<title>Student Login</title>
</head>

<body>
	<div class="container">
		<div class="gif">
			<lottie-player src="https://assets5.lottiefiles.com/packages/lf20_i7ooqm2q.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
		</div>
		<div class="formBx">
		<h1 class="h1" style="color: #219884; font-size: 36px; text-align: center; margin-top: 0px;">SamaySarathi</h1>
			<h1 class="h1" style="margin-top:40px">Student Login</h1>
			<form class="form" action="std_login.php" method="post" enctype="multipart/form-data">
				<input type="text" name="enrno" placeholder="Enrollment Number"/>
				<div class="input-field">
					<input type="password" name="psw" id="myInput" placeholder="Password"/>
					<span class="eye" onclick="myFun()">
						<ion-icon id="hide1" name="eye"></ion-icon>
						<ion-icon id="hide2" name="eye-off"></ion-icon>
					</span>
				</div>
				<input class="login" type="submit" value="Login" style="background: #219884;">
				<a class="alogin" href="admin/">Admin Login</a>
				<a class="flogin" href="faculty/">Faculty Login</a>
			</form>
		</div>
	</div>
</body>
</html>

</html>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
	function myFun() {
		var x = document.getElementById("myInput");
		var y = document.getElementById("hide1");
		var z = document.getElementById("hide2");

		if(x.type === 'password'){
			x.type = "text";
			y.style.display = "block";
			z.style.display = "none";
		}
		else{
			x.type = "password";
			y.style.display = "none";
			z.style.display = "block";
		}
	}
</script>