<?php 
//Login Get Hashed Pass and Salt

function login($bdd,$username,$password)
{
    $query = $bdd->prepare("SELECT  UserID,UserName,Password,Salt,userLvl FROM user WHERE UserName=:user"); // select salt and pass from db. :user is a placeholder to input variable. This way of querying checks for SQL injections
    $query->execute(array('user' => $username )); //variable with username
    
    if($query->rowCount() == 0) // if no rows are returned, user doesn't exist.
        return false;
    
    $userData = $query->fetch(PDO::FETCH_ASSOC); // creates associative array from row
    
    $hash = hash('sha256', $userData['Salt'] . hash('sha256', $password)); //hashing input pw to compare with hash in db
    
    if(strcmp($hash,$userData['Password']) != 0 || strcmp($username,$userData['UserName'])) // Incorrect password. Redirect to login form.
	    return array(false);
	else
	   return array(true,$userData['userLvl'],$userData['UserID']);
    
}

function getEzName($bdd,$user){
    $query = $bdd->prepare("SELECT Name FROM user WHERE UserName=:user"); // select salt and pass from db. :user is a placeholder to input variable. This way of querying checks for SQL injections
    $query->execute(array('user' => $user )); //variable with username

    if($query->rowCount() == 0) // if no rows are returned, user doesn't exist.
        return false;

    $userData = $query->fetch(PDO::FETCH_ASSOC); // creates associative array from row

        return array(true,$userData['Name']);
}

/*Creates Salt to hash password*/
function createSalt()
{
   	$text = md5(uniqid(rand(), true)); //generates random text
   	return substr($text, 0, 3); //get first 3 chars to make salt
}

function createUser($bdd,$name,$email,$user,$password)
{
    $query = $bdd->prepare("SELECT UserID FROM  user WHERE UserName = :uname");
    $query->execute(array('uname' => $user));

    if($query->rowCount() > 0) // user exists
        return 2;
    else
    {
        $hash = hash('sha256', $password);
        $salt = createSalt();
        $hashedpw = hash('sha256', $salt . $hash);

        $query = $bdd->prepare('INSERT INTO user (UserName,Password,Salt,Name,Email,userLvl) VALUES (:user, :pass, :salt,:name,:email,:usrlvl)');
        $query->execute(array('user' => $user ,
            'pass' => $hashedpw,
            'salt' => $salt,
            'name' => $name,
            'email' => $email,
            'usrlvl' => 1));
        if($query)
            return 1;
        else
            return 3;
    }
}

function deleteUser($bdd,$user)
{
    if(strcmp($user,"") == 0)
        return false;

	$query = $bdd->prepare("DELETE FROM user WHERE UserName = :uname LIMIT 1");
    $query->execute(array('uname' => $user));

	if($query)
		return true;
	else
		return false;
}

function userDropDownList($bdd,$formID)
{
	$query= $bdd->prepare("SELECT UserName FROM user ORDER BY UserName");
    $query->execute();

	if($query)
	{
		echo '<select class="form-control" name="userDelete" form="'.$formID.'">';
		while($userData = $query->fetch(PDO::FETCH_ASSOC)) // loops until all users have been printed. query->fetch returns 1 row at a time
		{
			if(strcmp($userData['UserName'],"admin") != 0)
				echo '<option value="'.$userData['UserName'].'">'.$userData['UserName'].'</option>';
		}
		echo '</select>';
	}
    else
        echo 'Canot get user list.<br/>';
}

function addItem($bdd,$name,$desc,$qty,$status,$mod)
{
    $query = $bdd->prepare('INSERT INTO inventory_item(Name, Description, Quantity, Status, lastModified, modifiedDate) VALUES (:name,:desc,:qty,:status,:mod,NOW())');
    $query->execute(array(
        "name"=>$name,
        "desc"=>$desc,
        "qty"=>$qty,
        "status"=>$status,
        "mod"=> $mod ));

    if($query)
        return true;
    else
        return false;
}

function getItems($bdd,$search,$order,$direction)
{
    $query = null;
    $queryStr = null;

    if(strcmp($search,"") == 0)
        $queryStr = 'SELECT * FROM inventory_item';
    else
    {
        $searchTerms = explode(' ', $search);
        $searchTermName = array();
        $searchTermDesc = array();
        foreach ($searchTerms as $term)
        {
            $term = trim($term);
            if (!empty($term))
            {
                $searchTermName[] = "Name LIKE '%$term%'";
                $searchTermDesc[] = "Description LIKE '%$term%'";
            }
        }

        $queryStr = 'SELECT * FROM inventory_item WHERE '.implode(' OR ', $searchTermName).' OR '.implode(' OR ', $searchTermDesc);

    }

    if(isset($order))
    {
        switch($order)
        {
            case "name":
                $queryStr = $queryStr.' ORDER BY Name';
                break;
            case "qty":
                $queryStr = $queryStr.' ORDER BY Quantity';
                break;
            case "status":
                $queryStr = $queryStr.' ORDER BY Status';
                break;
            case "mod":
                $queryStr = $queryStr.' ORDER BY lastModified';
                break;
            case "modDate":
                $queryStr = $queryStr.' ORDER BY modifiedDate';
                break;
            default:
                break;
        }

        if(strcmp($direction,"desc") == 0)
            $queryStr = $queryStr." DESC";
    }

    $query = $bdd->prepare($queryStr);
    $query->execute();

    $count = 0;

    while ($itemData = $query->fetch(PDO::FETCH_ASSOC)) // loops until all users have been printed. query->fetch returns 1 row at a time
    {
        echo '<tr>';
        echo '<td class="hidden-print"><form method="post" action=""> <input class="btn btn-danger" type="submit" name="deleteItem" value="delete" onClick="return confirm(\'Are you sure you want to delete?\');" /><input type="hidden" name="ID" value="' . $itemData['itemID'] . '"/></form></td>';
        echo '<td class="hidden-print"><button type="button" class="btn btn-primary disableAllOnClick" onClick="editRow(' . $count . ',' . $itemData['itemID'] . ')">Modify</button></td>';
        echo '<td>' . $itemData['Name'] . '</td>';
        echo '<td>' . $itemData['Quantity'] . '</td>';
        echo '<td>' . $itemData['Description'] . '</td>';
        echo '<td>' . $itemData['Status'] . '</td>';

        $nameQuery = $bdd->prepare('SELECT Name FROM user WHERE UserID = :id');
        $nameQuery->execute(array("id" => $itemData['lastModified']));
        $name = $nameQuery->fetch(PDO::FETCH_ASSOC)['Name'];
        echo '<td>' . $name . '</td>';

        echo '<td>' . $itemData['modifiedDate'] . '</td>';

        echo '</tr>';

        $count++;
    }


}

function deleteItem($bdd,$id)
{
    $query = $bdd->prepare('DELETE FROM inventory_item WHERE itemID = :id LIMIT 1');
    $query->execute(array("id" => $id));

    if($query)
        return true;
    else
        return false;
}

function updateItem($bdd,$id,$name,$desc,$qty,$status,$mod)
{
    $query = $bdd->prepare('UPDATE inventory_item
                                SET Name = :name,
                                Description=:desc,
                                Quantity=:qty,
                                Status=:status,
                                lastModified=:mod,
                                modifiedDate=NOW()
                            WHERE itemID = :id');

    $query->execute(array(
        "name"=>$name,
        "desc"=>$desc,
        "qty"=>$qty,
        "status"=>$status,
        "mod" => $mod,
        "id" => $id));

    if($query)
        return true;
    else
        return false;


}