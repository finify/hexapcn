<?php
session_start();
if(!isset($_SESSION["useremail"])){
header("Location: ../index.php");
exit(); }
?>