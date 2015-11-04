<?php 
	session_start();

	if($_SESSION['name'] !== "admin")
	{
		echo'You are not authorized to access this page.';
		echo'Click <a href="../index.php">here</a> to login';
		exit;
	}
	
	//dbinfo
	require '../../includes/db_connect.php';
	//queries
	include '../../includes/queries.php';


	if(isset($_POST['add']))
	{
		$isCreated = createUser($bdd,$_POST['user'],$_POST['pass1']);
		
		if($isCreated)
			header("Location: adminpanel.php?u=1");
		else
			header("Location: adminpanel.php?u=2");	
	}

	if(isset($_POST['delete']))
	{
		$isDeleted = deleteUser($bdd,$_POST['selecteduser']);

		if($isDeleted)
			header("Location: adminpanel.php?u=3");
		else
			header("Location: adminpanel.php?u=4");
	}
	
	
?>