<?php 

	if(session_start())
	{
		session_destroy();
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alizeti Microtechnologies</title>

<link type="text/css" rel="stylesheet" href="loginstyle.css"/>
</head>
<body>
	<div id="wrapper">
		
		<h2>Alizeti</h2>
	
		<form name="loginform" id="login" method="post" action="../includes/login.php">
		
		<table>
			<tr>
				<td class="title"><label for="username">Username</label></td>
				<td class="field"><input type="text" id ="username" name="user" required/></td>
			</tr>
			<tr>
				<td class="title"><label for="passwd">Password</label></td>
				<td class="field"><input type="password" id="passwd" name="pass" required/></td>
			</tr>
			
			<tr><td><input type="submit" name="login" value="Go"/></td></tr>
		</table>
		
		
		
		</form>
	
		<div id="error">
			<?php 
				$error = htmlspecialchars($_GET["error"]);
	
				if($error == 1)
				{
					echo 'Invalid Username or Password';
				}
				
				$logout = htmlspecialchars($_GET["l"]);
				
				if($logout == 1)
				{
					echo 'Logout Successful';
				}	

			?>	
		</div>
	
	</div>
</body>
</html>