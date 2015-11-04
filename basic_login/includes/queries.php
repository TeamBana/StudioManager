<?php 
//Login Get Hashed Pass and Salt

function login($bdd,$username,$password)
{
	$username = strip_tags($username);
	$password = strip_tags($password);
	
	$sanitized_user = mysqli_real_escape_string($bdd, $username);
	$sanitized_pass = mysqli_real_escape_string($bdd, $password);

	$query = "SELECT hashpass, salt FROM users WHERE user = '".$sanitized_user."' ";

	$response = mysqli_query($bdd,$query);
 
	if(mysqli_num_rows($response) == 0) // User not found. So, redirect to login form again.
	{
	    return false;
	}
 
	$userData = mysqli_fetch_assoc($response);

	$hash = hash('sha256', $userData['salt'] . hash('sha256', $sanitized_pass) );
	
 
	if(strcmp($hash,$userData['hashpass']) !== 0) // Incorrect password. Redirect to login form.
	{
	    return false;
	}
	
	return true;
}

function getUsers($bdd)
{
	$query = "SELECT user FROM users";
	
	$response = mysqli_query($bdd,$query);
	
	if(!$response)
	{
		echo 'Query Fail. Cannot get users';
		exit;
	}
	
	return mysqli_fetch_array($response);
}


function getIdByUsername($username,$bdd)
{
	$query = "SELECT id FROM users WHERE user='".$username."'";
	
	$response = mysqli_query($bdd, $query);
		
	if(!$response)
	{
		echo 'Could Not Get User ID';
		exit;
	}
		
	$data = mysqli_fetch_array($response);
	
	return $data[0];
}

function createUser($bdd,$user,$password)
{
	$query = "SELECT user FROM users";
	
	$users = mysqli_query($bdd,$query);
	
	if(!$users)
	{
		die("CANNOT GET USERS : ".mysqli_error($bdd));
	}
			
	while($check = mysqli_fetch_row($users))
	{
		if(strcmp($check[0],$user) == 0)
		{
			return false;
		}
	}
	
	//hash password
	$hash = hash('sha256', $password);
	$salt = createSalt();
	$hashedpw = hash('sha256', $salt . $hash);
 
	//sanitize username
	$username = mysqli_real_escape_string($bdd, $user);
	
	//Insert User,password and salt into db
	$query = "INSERT INTO users ( user, hashpass, salt ) VALUES  ( '".$username."', '".$hashedpw."', '".$salt."' )";
	$response = mysqli_query($bdd,$query);
	
	if (!$response) 
	{
	    return false;
	}
	
	return true;
}

function createSalt()
{
   	$text = md5(uniqid(rand(), true));
   	return substr($text, 0, 3);
}


function deleteUser($bdd,$user)
{
	$query = "DELETE FROM users WHERE user = '".$user."' LIMIT 1";

	$response = mysqli_query($bdd,$query);
	
	if($response)
		return true;
	else
		return false;
}

function userDropDownList($bdd,$formID)
{
	$query="SELECT user FROM users ORDER BY user"; 
	$response = mysqli_query($bdd,$query);

	if($response)
	{
		echo '<select name="selecteduser" form="'.$formID.'">';
	
		while($row = mysqli_fetch_row($response))
		{
			if(strcmp($row[0],"admin") != 0)
				echo '<option value="'.$row[0].'">'.$row[0].'</option>';
		}
		
		echo '</select>';
	}
}

?>