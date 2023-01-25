<?php

require_once "functions.php";
// require_once "dbc.php";


//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = dirname(__FILE__,2 ). '/img/';
// $display_dir = 'images/';

// var_dump(dirname(__FILE__,3 ));
// echo "</br>";
// var_dump($upload_dir);
// echo "</br>";
// $upload_dir = $tmp_path;

$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename; 
// var_dump($save_path);


// var_dump($save_filename);
// echo '<pre>';
// var_dump('$file='.$file);
// var_dump($filename);
// var_dump($tmp_path);
// var_dump($file_err);
// var_dump($filesize);
// var_dump($upload_dir);
// echo '</pre>';

//キャプションの取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

//キャプションのバリデーション
//未入力
if(empty($caption)){
    echo 'キャプションを入力してください。';
    echo '<br>';
}

//140文字以下か
if(strlen($caption)>140){
    echo 'キャプションは140文字以内で入力してください。';
    echo '<br>';
}

//ファイルのバリデーション
//ファイルサイズが1MB未満か
if($filesize>1048576 || $file_err == 2){
    echo 'ファイルサイズは1MB以下にしてください。';
    echo '<br>';
}

//拡張は画像形式か
$allow_ext = array('jpeg', 'jpg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

// echo '<pre>';
// var_dump($allow_ext);
// var_dump($file_ext);
// echo '</pre>';

if(!in_array(strtolower($file_ext),$allow_ext)){
    echo '画像を添付してください。';
    echo '<br>';
}

var_dump("<br>★★★tmp_path=".$tmp_path);
echo "<br/>";
var_dump("<br>★★★save_path=".$save_path);


if (count($err_msgs) === 0) {
    //ファイルはあるかどうか？


    if (is_uploaded_file($tmp_path)) {
        
        if (move_uploaded_file($tmp_path, $save_path)) {
            echo $filename . 'を' . $upload_dir . 'にアップしました。';
            //DBに保存(ファイル名、ファイルが存在するファイルパス、キャプション)
            $result = fileSave($filename, $save_path, $caption);
        } else {
            echo '<br>$tmp_path＝'.$tmp_path . 'を<br>' .'$save_path='. $save_path . 'ファイルの移動に失敗しました。';
        }
    } else {
        echo 'ファイルが選択されていません。';
        echo '<br>';
    }

}



?>
 <button type="button" class="btn btn-light" onclick="location.href='gallery_top.php'">Homeへ</button>
