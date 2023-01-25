<?php
session_start();
include("functions.php");
check_session_id(); //自作の関数(session_idが合っているか確認)

$pdo = connect_to_db();

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
// echo ("<pre>");
// var_dump($result);
// echo ("</pre>");




//画像をアップロードする関数
function fileSave($filename,$save_path,$caption)
{

    $pdo =connect_to_db();
    $result = false;


    $sql = "INSERT INTO images(house_id,image_id,filename,filepath,category_id,created_at,updated_at,deleted_at) 
            VALUE(:house_id, :image_id, :filename, :file_path, :category, now(), now(), NULL)";


try{
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':house_id',$result[0]["house_id"],PDO::PARAM_STR);
    $stmt->bindValue(':image_id',$save_path,PDO::PARAM_STR);
    $stmt->bindValue(':filename',$filename,PDO::PARAM_STR);
    $stmt->bindValue(':file_path',$save_path,PDO::PARAM_STR);
    $stmt->bindValue(':category',$filename,PDO::PARAM_STR);
    $result = $stmt->execute();

    echo ("画像をDBに保存しました。");
    return $result;
}catch(\Exception $e){
    exit($e->getMessage());
    return $result;
}



}





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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jkanban@1.3.1/dist/jkanban.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jkanban@1.3.1/dist/jkanban.min.js"></script>
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
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-house "></i>
                    <span class="mx-4 text-lg font-normal">
                        Home
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>
                
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                    Schedule
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Kanban
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>
                
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
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
                                        <i class="fa-solid fa-circle-user fa-2xl"></i>
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
                
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-house "></i>
                    <span class="mx-4 text-lg font-normal">
                        Home
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>
                
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                    Schedule
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>

                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
                    <i class="fa-solid fa-table-list"></i>
                    <span class="mx-4 text-lg font-normal">
                        Kanban
                    </span>
                    <span class="flex-grow text-right">
                    </span>
                </a>
                
                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">    
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

    <!-- Dropdown menu -->
    <div id="dropdownSearch" class="z-10  bg-white rounded shadow w-60 dark:bg-gray-700">
        <div class="p-3">
        <label for="input-group-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
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

    <!-- Body開始 -->
    <div class="main w-full" id="kanban"> 
    



        <script>
        const data = [
        {id:'board-0',title:'未検討'},
        {id:'board-1',title:'検討中'},
        {id:'board-2',title:'確定'}

        ];

            new jKanban({
                element:'#kanban',
                boards:data
            });
        </script>

    </div>
    <!-- Body終了 -->

    
</div>




</html>