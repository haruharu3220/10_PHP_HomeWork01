<?php
session_start();
include('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];

// var_dump($username);
// var_dump($password);


$pdo = connect_to_db();

$sql = 'SELECT * FROM members WHERE name=:username AND password=:password AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=login.php>ログイン</a>";
  exit();
} else {
  
    // echo '<pre>';
    // var_dump($user);
    // echo '</pre>';

    
    $_SESSION['member_id'] = $user['id'];
    $_SESSION['house_id'] = $user['house_id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['position'] = $user['position'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['created_at'] = $user['created_at'];
    $_SESSION['updated_at'] = $user['updated_at'];
    
    header("Location:home.php");
    exit();
}