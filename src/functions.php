<?php

function connect_to_db()
{
  $dbn = 'mysql:dbname=favorite_house;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}
function check_session_id()
{
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    header("Location:login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

/**
 * *
 * @return array
 */
function getHouseInfo(){
  $pdo = connect_to_db();
  //menmersテーブルとhousesテーブルのJOIN
  $sql = "SELECT * FROM members LEFT OUTER JOIN( SELECT id AS id2,house_name,scheduled_completion_date FROM houses)AS houses_name 
          ON members.house_id = houses_name.id2 WHERE id=1;";
  $stmt = $pdo->prepare($sql);
  
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
  }
  
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // echo ("<pre>");
  // var_dump($result);
  // echo ("</pre>");
  return $result;
}

/**
 * *
 * @param mixed $filename
 * @param mixed $save_path
 * @param mixed $caption
 * @return bool
 */
function fileSave($filename, $save_path, $caption)
{

  $pdo = connect_to_db();
  $result = getHouseInfo();
  echo "<pre>";
  var_dump($result);
  echo "</pre>";
  $sql = "INSERT INTO images(house_id,image_id,filename,filepath,category_id,created_at,updated_at,deleted_at) 
            VALUE(:house_id, :image_id, :filename, :file_path, :category_id, now(), now(), NULL)";


  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':house_id', $result[0]["house_id"], PDO::PARAM_STR);
    $stmt->bindValue(':image_id', 1, PDO::PARAM_STR);
    $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
    $stmt->bindValue(':file_path', $save_path, PDO::PARAM_STR);
    $stmt->bindValue(':category_id', 1, PDO::PARAM_STR);
    $result = $stmt->execute();

    echo ("画像をDBに保存しました。");
    return $result;
  } catch (\Exception $e) {
    exit($e->getMessage());
    return $result;
  }
}

  function getImagesInfo(){

    $pdo =connect_to_db();
    $sql = "SELECT * FROM images ORDER BY updated_at DESC";
    
    try{
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();

    }catch(\Exception $e){
        exit($e->getMessage());
        exit();
    }
    $images_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $images_info;
  }