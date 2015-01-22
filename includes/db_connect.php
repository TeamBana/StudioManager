<?php 

$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'alizeti';

$bdd = mysqli_connect($host,$user,$pass,$db);	

if(!$bdd)
{
	die("Could not connect to db");
}

?>