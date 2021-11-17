<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "kos_pth";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
