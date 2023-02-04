<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)

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
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/facilities.css">
    <link rel="stylesheet" href="css/body.css">
    <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>
</head>


<?php include('parts/header.html'); ?>

<!-- Body開始 -->
<div class="main">
    <div>
        <h1><?= $result[0]["house_name"] ?>邸</h1>
    </div>
    <div>
        <h2>基本情報</h2>
    </div>
    <div>
        <h2>完成予定日：<?= $scheduled_day_format ?></h2>
        <h2>完成まで、あと<?= $interval_format ?></h2>
    </div>
    <a href="logout.php">logout</a>
    <br>

    <input type="checkbox">お気に入りのみ

    <!-- <form action="test.php" method="POST">
            <div class="facilities">
      
                    <a class="facility facility01" href='test.php?id=<?= $id ?>'>テスト4</a>

                <div class="facility facility02">テスト２</div>
                <div class="facility facility03">テスト３</div>
            </div>
    
        </form> -->

    <?= $facilities ?>
</div>
<!-- Body終了 -->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/facilities.js"></script>
<script src="js/navibar.js"></script>

</html>
