<?php
session_start();
include("DBclass.php");
$HDB = new DB();
if($HDB-> checkLogin())
{
	if(isset($_POST['login_remember']) && 
   $_POST['login_remember'] == 'on') 
	{
   $_COOKIE['name']= $_SESSION['name'];
   $_COOKIE['rank']=$_SESSION['rank'];
   echo "Cookie gesetzt!";
	}
}
?>

