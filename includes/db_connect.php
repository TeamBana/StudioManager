<?php 

$dsn = 'mysql:dbname=andrew_sysdev;host=localhost'; //PDO uses dsn to connect to DB, it has hotname and db name
$dbuser = 'chikuvistudio'; //user, duh
$password = '5BPKLHRf6D7QCpST'; // pass
$bdd = null;
        
try 
{
    $bdd = new PDO($dsn,$dbuser,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //prints errors associated with DB object
} 
catch (PDOException $e) 
{
    echo 'Could not connect to db: ' . $e->getMessage();
    exit;
}

