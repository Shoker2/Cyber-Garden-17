<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Окно авторизации</title>
    <link rel="stylesheet" href="./css/auth/login.css">
    <link rel="stylesheet" href="./css/auth/theme-light.css" id="theme-light">
    <link rel="stylesheet" href="./css/auth/theme-dark.css" id="theme-dark">
    <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap"
    rel="stylesheet"
    >
    <link rel="stylesheet" href="#" title="theme">
</head>
<body>
    <?php
      if (!(array_key_exists("login", $_COOKIE) && array_key_exists("password", $_COOKIE))) {
        setcookie("login", "-");
        setcookie("password", "-");
      } else {
        if ($_COOKIE['login'] != "-" || $_COOKIE['password'] != "-") {
            echo '<script type="text/JavaScript">  
            window.location.href = "./index.php"; 
                  </script>';
        }
      }
    ?>

    <div class="main_section">
        <div class="block_for_registarion">
            <div class="class_for_input">
                <input id="loginTxt" name="loginTxt" type="text" class="top_input" placeholder="Введите ваш логин">
                <br>
                <input id="passTxt" name="passTxt" type="password" class="bottom_input" placeholder="Введите ваш пароль">
                <br>
                <button onclick="login()" class="main_btn">Войти</button>
                <div id="error-mess" style="display: none; color: white;">
                    <br>
                    <p id="error-mess-txt"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="theme">
        <img src="https://cdn-icons-png.flaticon.com/512/7364/7364834.png" id="sun" alt="image солнце" style="display: none;" class="changeTheme" data-theme="light">
        <img src="https://cdn-icons-png.flaticon.com/512/4129/4129208.png" id="moon" alt="image луна" style="display: none;" class="changeTheme" data-theme="dark">
    </div>

    <script src="./js/auth.js"></script>
    <script src="./js/change-theme.js"></script>
</body>
</html>