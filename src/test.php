<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)

$user_id = $_GET['id'];
$user_name = $_GET['name'];

// $password = $_GET['password'];
echo "<pre>";
var_dump($user_id);
var_dump($user_name);
echo "</pre>";
?>