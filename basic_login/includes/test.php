<?php 

include'db_connect.php';

echo'

	<form action="" method="post" id="userdelete">
	
		<input type="submit" name="delete" value="DELETE NIGGA"/>
	</form>

';

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

?>

