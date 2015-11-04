<?php

if(isset($_POST['login'])) // if login button is pressed
{ 
	$login = login($bdd,$_POST['user'],$_POST['pass']); // login form in queries. db_connect and queries do not have to be included because they are included in connect.php
	$name = getEzName($bdd,$_POST['user']);
	if($login[0])
	{   // Redirect to home page after successful login.
		session_start();
		$_SESSION['name'] = $_POST['user'];
        $_SESSION['ezName'] = $name[1];
		$_SESSION['userLvl'] = $login[1];
        $_SESSION['id'] = $login[2];

		header('Location: /main.php'); //other user => main page
	}
	else
	{	// Incorrect password. Redirect to login form.
		header('Location: /index.php?error=1');
		exit;
	}
}
else
	exit;