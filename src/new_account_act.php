<?php
include('functions.php');
$pdo = connect_to_db();

if (
  !isset($_POST['username']) || $_POST['username'] === '' ||
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$username = $_POST["username"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$password = $_POST["password"];



$sql = 'SELECT COUNT(*) FROM members WHERE email=:email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


if ($stmt->fetchColumn() > 0) {
  echo "<p>すでに登録されているユーザです．</p>";
  echo '<a href="new_account.php">login</a>';
  exit();
}


$sql = 'INSERT INTO members(id, house_id, name, email, sex, password,created_at, updated_at, deleted_at) 
                    VALUES(NULL, 0,:username, :email,:sex, :password, now(), now(), NULL)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:index.php");
exit();
