<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)
$pdo = connect_to_db();

// echo ("<pre>");
// var_dump($_FILES);
// echo ("</pre>");

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


$images = getImagesInfo();


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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/box.css">
    <link rel="stylesheet" href="css/gallery.css">

    <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include('parts/header.html'); ?>
    <div class="main">

        <!-- Dropdown menu -->
        <div id="dropdownSearch" class="gallery_selection bg-white rounded shadow w-60 dark:bg-gray-700">
            <p>選んでね</p>
            <div class="p-3">
                <label for="input-group-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="input-group-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search user">
                </div>
            </div>
            <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-11" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">リビング</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input checked id="checkbox-item-12" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-12" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">キッチン</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-13" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-13" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">お風呂</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-14" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-14" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">外構</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-15" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-15" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">窓・建具</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-16" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-16" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">照明</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="checkbox-item-17" type="checkbox" value="" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox-item-17" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">トイレ</label>
                    </div>
                </li>
            </ul>

        </div>

        <!-- サイドバー終了 -->
        <div class="gallery_mian">
            <div class="gallery_registration">
                <!-- <div id="modal-bg"></div> -->
                <!-- <div id="modal-container"> -->
                    <form enctype="multipart/form-data" action="./gallery.php" method="POST">
                        <div class="file-up">
                            <!-- UPする画像が1MB以上なら拒否する -->
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                            <input name="img" type="file" accept="image/*" />
                        </div>
                        <div>
                            <textarea name="caption" placeholder="キャプション（140文字以下）" id="caption"></textarea>
                        </div>
                        <div class="submit">
                            <input type="submit" value="送信" class="btn" />
                        </div>
                    </form>


                <!-- </div> -->

                <!-- <div id="menu-modal-container">
                    <p>颯斗</p>
                    <p class="logout">ログアウト</p>
                </div> -->
            </div>

            <div class="gallery_list">

                <?php foreach ($images as $image) { ?>
                    <div class="box">
                        <a href="gallery.php"><img src="../images/<?php echo $image['filename']; ?>" alt="投稿画像"></a>
                    </div>
                <?php }; ?>
            </div>

        </div>

    </div>
    <?php include('parts/footer.html'); ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/modal.js"></script>
<script src="js/box.js"></script>

</html>