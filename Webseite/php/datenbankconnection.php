
<?php
include("DBclass.php");
$HDB = new DB();
$HDB-> registerUser();
$referrer = $_SERVER['HTTP_REFERER']; 
header ("Refresh: 2;URL='$referrer'"); 
?>



