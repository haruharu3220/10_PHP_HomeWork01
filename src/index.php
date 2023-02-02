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
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/navigation.css">
    <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>
</head>


<!-- ナビバー　開始 -->
<div class="navigation">
    <nav >
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
                                    <div >
                                        <button type="button" class="flex items-center justify-center w-full rounded-md  px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-50 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" id="options-menu" >
                                        <i class="fa-solid fa-arrow-right-to-bracket fa-2xl"></i>
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


<!-- Body開始 -->
    <div class=" w-full h-1/2 md:h-screen"> 


        <div id="modal-open">詳しくはこちら</div>        
        <div id="modal-bg"></div>
        <div id="modal-container">
            <p>ダミーダミーダミー</p>
            <div id="modal-close">閉じる</div>
        </div>

    </div>
<!-- Body終了 -->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/modal.js"></script>

</html>