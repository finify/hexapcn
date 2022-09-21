<?php
session_start();
if(!isset($_SESSION["fx_adminemail"])){
header("Location: ../index.php");
exit(); }
?>