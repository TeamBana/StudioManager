<?php
//PUTT INCLUDE FILES IN INCLUDE FOLDER OUTSIDE OF PUBLIC_HTML!!!!!!!!
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//dbinfo
include '../includes/db_connect.php';
//queries
include '../includes/queries.php';

if(isset($_POST['login']))
{ 
	$login = login($bdd,$_POST['user'],$_POST['pass']);
	
	if($login)
	{   // Redirect to home page after successful login.
		session_start();
		$_SESSION['name'] = $_POST['user'];
		
		if(strcmp($_POST['user'],"admin") == 0)
		{
			header('Location: admin/adminpanel.php');
		}
		
		echo'SUCCESS!';
		exit;
	}

	else
	{	// Incorrect password. Redirect to login form.
		header('Location: ../public_html/index.php?error=1');
		exit;
	}
}
else
{
	exit;
}