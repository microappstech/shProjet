<?php 
//All comment is documentation for you shyamae
$host="localhost";
$port=3307;
$socket="";
$user="root";
$password="Hamza@123";
$dbname="pmp";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

?>