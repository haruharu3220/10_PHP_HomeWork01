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
            echo '<br>$tmp_path＝' . $tmp_path . 'を<br>' . '$save_path=' . $save_path . 'ファイルの移動に失敗しました。';
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/navigation.css">
</head>

<body>
    <div class="navigation">
        <nav>
            <div class="px-8 mx-auto max-w-7xl">
                <div class="flex items-center justify-between h-16">
                    <div class=" flex items-center">
                        <i class="fa-solid fa-door-open fa-2xl"></i>
                    </div>
                    <div class="flex">
                        <h1>HouseHouse</h1>
                    </div>
                    <a href="login.php">
                        <div class="block">
                            <div class="flex items-center ml-4 md:ml-6">
                                <div class="relative ml-3">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button" class="flex items-center justify-center w-full rounded-md  px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-50 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" id="options-menu">
                                                <i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- ナビバー　終了 -->
    <div class="m-10">

        <form action="new_account_act.php" method="POST">
            <fieldset>
                <legend>ユーザ登録画面</legend>
                <div>
                    username: <input type="text" name="username">
                </div>
                <div>
                    e-mail: <input type="text" name="email">
                </div>
                <div>
                    password: <input type="text" name="password">
                </div>
                <div>
                    
                </div>
                <a href="new_account_act.php"><button>Register</button></a>
            </fieldset>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/login-form.js"></script>
</body>

</html>