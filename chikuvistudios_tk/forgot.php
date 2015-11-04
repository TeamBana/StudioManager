<!DOCTYPE HTML>

<!--	
	Author: Brian Gamboc Javiniar 
	Date:   April 11, 2015
-->

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	
		<title>Chiku-vi Studio</title>
		<link href="assets/css/forgottenAccount.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<header>
			<div id="imgUnderText">
				<script type="text/javascript"> 
					var random = randInt(3);
					document.write("<img width='100%' height='100%' src='headers-colored" + random + ".png'/>");
				</script>
			</div>
			<div id="textOverImg">
				<center><h1>forgotten account information</h1></center>
			</div>
			<div id="homeButton">
				<a href="simple_html/login.htm"><img width="150%" height="150%" src="home.png" /></a>
			</div>
		</header>
		
		<div id="forgottenPassword">
			<table>
				<caption><h2>forgotten password</h2><br><br></caption>
				<tr>
					<td>password<br><br><br><br></td>
					<td><input type="text" id="oldpassword"></input><br><br><br><br></td>
				</tr>
				<tr>
					<td>new password<br><br></td>
					<td><input type="text" id="newpassword"> <br><br></td>
				</tr>
			</table>
		</div>
		
		<div id="forgottenUsername">
			<table>
				<caption><h2>username</h2><br><br></caption>
				<tr>
					<td>email</td>
					<td><input type="text" id="newpassword"><br></td>
				</tr>
			</table>
		</div>
	</body>
	
	<footer>
		<div id="logoFixed">
			<img src="rambo-logo-white.png" width="150" height="50" />
		</div>
	</footer>
</html>