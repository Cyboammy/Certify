<?php
$server="localhost";
$username="root";
$password="";
$database="dbase";
$conn=mysqli_connect($server,$username,$password,$database);
error_reporting(0);
if(!$conn){
    echo "connection failed";
    exit();
}
?>