<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Окно регистрации</title>
    <link rel="stylesheet" href="./css/auth/registration.css">
    <link rel="stylesheet" href="./css/auth/theme-light.css" id="theme-light">
    <link rel="stylesheet" href="./css/auth/theme-dark.css" id="theme-dark">
    <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap"
    rel="stylesheet"
    >
    <link rel="shortcut icon" href="../../images/icon.png">
    <link rel="stylesheet" href="#" title="theme">
    <link rel="stylesheet" href="../../css/media_for_style.css  ">
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
        <div class="block_for_registration">
            <div class="class_for_input">
                <input id="loginTxt" type="text" class="top_input" placeholder="Логин">
                <br>
                <input id="passTxt" type="password" class="top_input" placeholder="Пароль">
                <br>
                <input id="pass2Txt" type="password" class="bottom_input" placeholder="Повторите Пароль">
                <br>
                <button onclick="registration()" class="main_btn">Зарегистрироваться</button>
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