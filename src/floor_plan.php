<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)
$pdo = connect_to_db();


if (isset($_GET['facility_id'])) {
    $facility_id = $_GET['facility_id'];

    //いいねを押す
    $sql = 'SELECT COUNT(*) FROM members_facilities WHERE name_id=:name_id AND facility_id=:facility_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name_id', $_SESSION["member_id"] , PDO::PARAM_STR);
    $stmt->bindValue(':facility_id', $facility_id, PDO::PARAM_STR);
    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }

    $like_count = $stmt->fetchColumn();
    // var_dump($like_count);

    if ($like_count !== 0) {
        // いいねされている状態
        $sql = 'DELETE FROM members_facilities WHERE name_id=:name_id AND facility_id=:facility_id';
    } else {
        // いいねされていない状態
        $sql = 'INSERT INTO members_facilities (id, name_id, facility_id, created_at) VALUES (NULL, :name_id, :facility_id, now())';
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name_id', $_SESSION["member_id"], PDO::PARAM_STR);
    $stmt->bindValue(':facility_id', $facility_id, PDO::PARAM_STR);

    try {
        $status = $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(["sql error" => "{$e->getMessage()}"]);
        exit();
    }
}

//いいねされている設備を抽出する
$sql = 'SELECT facility_id FROM members_facilities WHERE name_id=:name_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name_id', $_SESSION["member_id"], PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$likes_count2 = $stmt->fetchAll();
// echo "<pre>";
// var_dump($likes_count2[2]);
// echo "</pre>";
$likes_number = array();;
foreach ($likes_count2 as $like) {
    array_push($likes_number, $like["facility_id"]);
    //var_dump($likes_number);
}

$result = getHouseInfo();
$id = $result[0]["id"];
$name = $result[0]["name"];
// $_SESSION['name'] =$name;
// $session_name =$_SESSION['name'];
// var_dump($id);
// var_dump($name);
// var_dump($session_name);




$scheduled_day = new DateTime($result[0]["scheduled_completion_date"]);
$scheduled_day_format = $scheduled_day->format('Y年m月d日');


$today = new DateTime('now');
$interval = $scheduled_day->diff($today);
$interval_format = $interval->format('%a日');




$sql = 'SELECT * FROM facilities';
$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$facilities_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($facilities_result);

$facilities = "<div class='facilities'>";
// var_dump($facilities);


// $test = "これはテストです";
// var_dump($test);


//HTML生成　お気に入りだとclassにlikeを付与。
$count = 0;
$like_facility = false;
foreach ($facilities_result as $facility) {
    $count++;

    foreach ($likes_number as $like_num) {
        $like_facility = $like_num === $count ? true : false; 
        if($like_facility === true) break;
    }        
    
    if($like_facility === true){   
        $facilities .= "

        <a class='facility facility{$count} like' href='home.php?facility_id={$facility["id"]}'>
        <div class='fac_title'>
            <p class='fac_title_text'>{$facility["category_name"]}</p>
        </div>
        <div class='fac_picture'>
            <img src='https://placehold.jp/150x150.png'>            
        </div>
        <div class='fac_intro'>
        
        </div>


        </a>
        ";
    }else{
        $facilities .= "
        <a class='facility facility{$count} none' href='home.php?facility_id={$facility["id"]}'>
        <div class='fac_title'>
            <p class='fac_title_text'>{$facility["category_name"]}</p>
        </div>
        <div class='fac_picture'>
            <img src='https://placehold.jp/150x150.png'>            
        </div>
            <div class='fac_intro'>
        </div>
        </a>
      ";
    }

}
$facilities .= "</div>";
// var_dump($count);

// var_dump($facilities);
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