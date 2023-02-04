<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)
$pdo = connect_to_db();


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

<body>

    <div class="main ">

    </div>

</body>

<?php include('parts/footer.html'); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/facilities.js"></script>
<script src="js/navibar.js"></script>

</html>