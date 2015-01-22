<?php 

session_start();

if($_SESSION['name'] !== "admin")
{
	echo'You are not authorized to access this page.';
	echo'Click <a href="../../public_html/index.php">here</a> to login';
	exit;
}


//dbinfo
require '../db_connect.php';
//queries
include '../queries.php';

if($_GET["u"])
{
	$account = htmlspecialchars($_GET["u"]);
	
	switch($account)
	{
		case 1:
			echo'Account created!<br/>Successfully Updated Database<br/>';
			break;
		case 2:
			echo'Account could not be created!<br/>Database remains unchanged<br/>';
			break;
		case 3:
			echo'Account deleted!<br/>Successfully Updated Database<br/>';
			break;
		case 4:
			echo'Account could not be deleted!<br/>Database remains unchanged<br/>';
			break;
		default:
			echo 'Unknown Error.';
			break;
	}
}

?>

<html>
	<head>
		<script type="text/javascript" src="validate.js"></script>
		
		
	</head>

	<body>
		<h1>ADMINPANEL</h1>
		<table border="0px">
			<tr>
				<td>
					<h2>Add User</h2>
					<form action="actions.php" method="post" id="add">
					
						<table>
							<tr>
								<td>Username </td>
								<td> <input type="text" name="user" /> </td>
							</tr>
							
							<tr>
								<td>Password </td>
								<td> <input type="password" name="pass1" id="pass1"/> </td>
							</tr>
							
							<tr>
								<td>Confirm </td>
								<td> <input type="password" name="pass2" id="pass2"/> </td>
							</tr>
						</table>
					<input type="submit" name="add" value="add user"/>
					</form>
					
					
				</td>
			
				<td>
					<h2>Delete User</h2>
					<?php  userDropDownList($bdd,"deleteUser"); ?>
					<form action="actions.php" method="post" id="deleteUser">
						<input type="submit" name="delete" value="delete user"/>
					</form>
					
				</td>
			</tr>
		
		</table>
		
	</body>
	
</html>