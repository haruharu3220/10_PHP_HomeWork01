<!DOCTYPE html>
<html lang="ja">

<head>


    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ユーザ新規作成画面</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <link href="../dist/output.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/092628cd4c.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/navigation.css">
        <link rel="stylesheet" href="css/register_form.css">
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
    <div class="register_form">
        <form action="new_account_act.php" method="POST">
            <fieldset>
                <div class="form_header">
                    <legend>ユーザ登録画面</legend>
                </div>
                <div class="form_content">
                    <div>
                        username: <input class="username" type="text" name="username">
                    </div>
                    <div>
                        <input type="radio" name="sex" value="male">男性
                        <input type="radio" name="sex" value="female">女性
                    </div>
                    <div>
                        e-mail: <input class="e-mail" type="text" name="email">
                    </div>
                    <div>
                        password: <input class="password" type="text" name="password">
                    </div>
                </div>

                <div class="form_footer">
                    <a href="new_account_act.php"><button>Register</button></a>
                </div>
            </fieldset>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/login-form.js"></script>
</body>


</html>