<?php 
	session_start();

	if($_SESSION['name'] !== "admin")
	{
		echo'You are not authorized to access this page.';
		echo'Click <a href="../index.php">here</a> to login';
		exit;
	}

    require $_SERVER['DOCUMENT_ROOT'].'/../includes/queries.php';
    require $_SERVER['DOCUMENT_ROOT'].'/../includes/db_connect.php';


	if(isset($_POST['add']))
	{
		$isCreated = createUser($bdd,$_POST['name'],$_POST['email'],$_POST['user'],$_POST['pass1']);
		
		if($isCreated == 1)
			header("Location: adminpanel.php?u=1"); // PHP redirect
		else if($isCreated == 2)
			header("Location: adminpanel.php?u=2");
        else
            header("Location: adminpanel.php?u=3");
	}

	else if(isset($_POST['delete']))
	{
		$isDeleted = deleteUser($bdd,$_POST['userDelete']);

		if($isDeleted)
            header("Location: adminpanel.php?u=4");

		else
            header("Location: adminpanel.php?u=5");
	}
