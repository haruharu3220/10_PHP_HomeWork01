<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)

$pdo = connect_to_db();

//menmersテーブルとhousesテーブルのJOIN
// $sql = "SELECT * FROM members LEFT OUTER JOIN( SELECT id AS id2,house_name,scheduled_completion_date FROM houses)AS houses_name ON members.house_id = houses_name.id2 WHERE id=1;";
// $stmt = $pdo->prepare($sql);

// try {
//   $status = $stmt->execute();
// } catch (PDOException $e) {
//   echo json_encode(["sql error" => "{$e->getMessage()}"]);
//   exit();
// }

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result = getHouseInfo();

$scheduled_day = new DateTime($result[0]["scheduled_completion_date"] );
$scheduled_day_format = $scheduled_day->format('Y年m月d日');


$today = new DateTime('now');
$interval = $scheduled_day->diff($today);
$interval_format = $interval->format('%a日');

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
    <link rel="stylesheet" href="css/navibar.css">
    <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>
</head>


<!-- ナビバー　開始 -->
<div>
    <nav class=" dark:bg-gray-800  shadow ">
        <div class="px-8 mx-auto max-w-7xl">
            <div class="flex items-center justify-between h-16">
                <div class=" flex items-center">
                    <i class="fa-solid fa-door-open fa-2xl"></i>
                </div>
                <div class="flex">
                    <h1>HouseHouse</h1>
                </div>
                <a class="gohome hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                    <i class="fa-solid fa-house "></i>
                    <span class="gohome mx-4 text-lg font-normal">
                        Home
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="goschedul hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Schedule
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="gokanban hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Kanban
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="gogallery hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                    <i class="fa-regular fa-images"></i>
                    <span class="mx-4 text-lg font-normal">
                        Gallery
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>
                <div class="block">
                    <div class="flex items-center ml-4 md:ml-6">
                        <div class="relative ml-3">
                            <div class="relative inline-block text-left">
                                <div>
                                    <button type="button" class="  flex items-center justify-center w-full rounded-md  px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-50 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" id="options-menu">
                                        <i class="fa-solid fa-circle-user fa-2xl" id="icon"></i>
                                    </button>
                                </div>
                                <!-- <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                    <div class="py-1 " role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                        <a href="#" class="block block px-4 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-100 dark:hover:text-white dark:hover:bg-gray-600" role="menuitem">
                                            <span class="flex flex-col">
                                                <span>
                                                    Settings
                                                </span>
                                            </span>
                                        </a>
                                        <a href="#" class="block block px-4 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-100 dark:hover:text-white dark:hover:bg-gray-600" role="menuitem">
                                            <span class="flex flex-col">
                                                <span>
                                                    Account
                                                </span>
                                            </span>
                                        </a>
                                        <a href="#" class="block block px-4 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-100 dark:hover:text-white dark:hover:bg-gray-600" role="menuitem">
                                            <span class="flex flex-col">
                                                <span>
                                                    Logout
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="flex -mr-2 md:hidden">
                    <button class="text-gray-800 dark:text-white hover:text-gray-300 inline-flex items-center justify-center p-2 rounded-md focus:outline-none">
                        <svg width="20" height="20" fill="currentColor" class="w-8 h-8" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1664 1344v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45z">
                            </path>
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>

        <div class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a class="text-gray-300 hover:text-gray-800 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium" href="/#">
                    Home
                </a>
                <a class="text-gray-800 dark:text-white block px-3 py-2 rounded-md text-base font-medium" href="/#">
                    Gallery
                </a>
                <a class="text-gray-300 hover:text-gray-800 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium" href="/#">
                    Content
                </a>
                <a class="text-gray-300 hover:text-gray-800 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium" href="/#">
                    Contact
                </a>
            </div>
        </div>
    </nav>
</div>
<!-- ナビバー　終了 -->

<!-- サイドバー開始 -->
<div class="relative dark:bg-gray-800 flex flex-row bg-green-200">
    <div class="flex flex-col sm:flex-row sm:justify-around">
        <div class="h-screen w-72">
            <nav class="mt-10 px-6 ">

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg "
                    href="home.php">
                    <i class="fa-solid fa-house "></i>
                    <span class="mx-4 text-lg font-normal">
                        Home
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg "
                    href="schedule.php">
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Schedule
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg "
                    href="kanban.php">
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Kanban
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg "
                    href="gallery.php">
                    <i class="fa-regular fa-images"></i>
                    <span class="mx-4 text-lg font-normal">
                        Gallery
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>


            </nav>
        </div>
    </div>
    <!-- サイドバー終了 -->

    <!-- Body開始 -->
    <div class="main w-full">
        <div>
            <h1><?=$result[0]["house_name"]?>邸</h1>
        </div>
        <div>
            <h2>基本情報</h2>
        </div>
        <div>
            <h2>完成予定日：<?=$scheduled_day_format?></h2>
            <h2>完成まで、あと<?=$interval_format?></h2> 
        </div>

        <a href="logout.php">logout</a>

    </div>
    <!-- Body終了 -->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/navibar.js"></script>

</html>