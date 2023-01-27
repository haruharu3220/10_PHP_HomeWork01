<?php
include("functions.php");
$pdo = connect_to_db();


//画像が送信されたら
if (isset($_FILES) && !empty($_FILES)) {
    //ファイル関連の取得
    $file = $_FILES['img'];
    $filename = basename($file['name']);
    $tmp_path = $file['tmp_name'];
    $file_err = $file['error'];
    $filesize = $file['size'];
    $upload_dir = dirname(__FILE__, 2) . '/images/';
    // var_dump($upload_dir);

    $save_filename = date('YmdHis') . $filename;
    // var_dump($save_filename );
    
    $err_msgs = array();
    $save_path = $upload_dir . $save_filename; 



    if (is_uploaded_file($tmp_path)) {
        
        if (move_uploaded_file($tmp_path, $save_path)) {
            echo $save_filename . 'を' . $upload_dir . 'にアップしました。';
            //DBに保存(ファイル名、ファイルが存在するファイルパス、キャプション)
            $result = fileSave($save_filename, $save_path, 1);
        } else {
            echo '<br>$tmp_path＝'.$tmp_path . 'を<br>' .'$save_path='. $save_path . 'ファイルの移動に失敗しました。';
        }
    } else {
        echo 'ファイルが選択されていません。';
        echo '<br>';
    }

}



//menmersテーブルとhousesテーブルのJOIN
$sql = "SELECT * FROM members LEFT OUTER JOIN( SELECT id AS id2,house_name,scheduled_completion_date FROM houses)AS houses_name ON members.house_id = houses_name.id2 WHERE id=1;";
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$images = aaa();
?>






<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h2>あなたはどっち</h2>
<p>デザイナー</p>
<p>施主</p>
</body>
</html>