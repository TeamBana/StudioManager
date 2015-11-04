<?php
//error_reporting(0); // no errors printed
error_reporting(0);

$myPage = 'admin';

session_start(); // Starts session. If it has been started, session variable will be there

require $_SERVER['DOCUMENT_ROOT'].'/../includes/db_connect.php';
require $_SERVER['DOCUMENT_ROOT'].'/../includes/queries.php';
?>

<html>
	<head>
        <?php include_once '../head.php'; ?>
        <link href="../assets/css/panel.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
    include_once  $_SERVER['DOCUMENT_ROOT'].'/header.php';
    if(strcmp($_SESSION['name'],"admin") != 0) // if not admin, fuck you
    {
        include_once '../forbidden.php';
        exit;
    }
    //getting update information from url
    //isset checks to see if it has been set. You can use this for alot of things in PHP, such as checking if a submit button has been pressed
    if(isset($_GET["u"]))
    {
        $account = htmlspecialchars($_GET["u"]);

        switch($account)
        {
            case 1:
                bootAlert('Account created!<br/>Successfully Updated Database<br/>','success');
                break;
            case 2:
                bootAlert('User already exists. Please chose a different username.<br/>Database remains unchanged<br/>','warning');
                break;
            case 3:
                bootAlert('Account could not be created! Contact system administrator.<br/>Database remains unchanged<br/>','danger');
                break;
            case 4:
                bootAlert('Account deleted!<br/>Successfully Updated Database<br/>','success');
                break;
            case 5:
                bootAlert('Account could not be deleted!<br/>Database remains unchanged<br/>','danger');
                break;
            default:
                bootAlert('Unknown Error.','info');
                break;
        }
    }

    ?>
	<body>
		<p>Admin Panel</p>
		<div class="row">
			<div class="col-md-6" id="addUser">
				<!-- Add User-->
                <h2>Add User</h2>
					<form action="actions.php" method="post" id="add">
                        <div class="input-group margin-bottom-sm" id="title">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input class="form-control" type="text" placeholder="Name" id="name" name="name" required>
                        </div>
                        <div class="input-group margin-bottom-sm" id="title">
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                            <input class="form-control" type="email" placeholder="Email" id="email" name="email" required>
                        </div>
                        <div class="input-group margin-bottom-sm" id="title">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input class="form-control" type="text" placeholder="Username" id="user" name="user" required>
                        </div>
                        <div class="input-group margin-bottom-sm" id="title">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                            <input class="form-control" type="password" placeholder="Password" id="pass1" name="pass1" required>
                        </div>
                        <div class="input-group margin-bottom-sm" id="title">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                            <input class="form-control" type="password" placeholder="Confirm Password" id="pass2" name="pass2" required>
                        </div>

					<input class="btn btn-default" type="submit" name="add" value="add user" id="createUser"/>
					</form>

                    <script type="text/javascript" src="validate.js"></script>
                </div>
				<!-- Delete User-->			
				<div class="col-md-6 action" id="deleteUser">
					<h2>Delete User</h2>
                    <br/>
                    <?php  userDropDownList($bdd,"deleteUserForm"); // will create a select list. method takes formID param to associate select list to form submit button ?>
                    <br/>
					<form action="actions.php" method="post" id="deleteUserForm">

						<input class="btn btn-danger" type="submit" name="delete" value="Delete User" onclick="return confirm('Are you sure you want to delete?');"/>
					</form>
					
				</div>
			</div>
	</body>
	
</html>