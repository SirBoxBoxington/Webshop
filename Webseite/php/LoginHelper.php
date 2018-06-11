<?php
session_start();
include("DBclass.php");
$HDB = new DB();
$HDB-> checkLogin();
?>
