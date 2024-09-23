<?php

$servername="localhost";
$username="root";
$dbpwd="";
$dbname="loginsync";

$conn =mysqli_connect($servername,$username,$dbpwd,$dbname);

if (!$conn) {
    die("Connection Failed".mysqli_connect_error());
}