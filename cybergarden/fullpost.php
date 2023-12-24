<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Памятники Таганрога</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="icons/logo.png" type="image/png" />
  </head>

  <body>
    <?php
      if (!(array_key_exists("login", $_COOKIE) && array_key_exists("password", $_COOKIE))) {
        setcookie("login", "-");
        setcookie("password", "-");
        echo "<script>location.reload();</script>";
      } else {
        require_once "../db-users.php";
        if (!chech_login_password($_COOKIE['login'], $_COOKIE['password'])) {
          setcookie("login", "-");
          setcookie("password", "-");
        }
      }
    ?>

    <?php
      if(isset($_POST['logout'])) { 
        setcookie("login", "-");
        setcookie("password", "-");
      }
    ?>

<nav class="navbar navbar-expand-lg header">
      <div class="container-fluid">

      <a class="navbar-brand" href="./index.php">
        <img src="icons/logo.png" alt="Bootstrap" width="70" height="70">
      </a>

      <div class="header-text">
        <h1 onclick="openIndex()">Монументы Таганрога</h1>
      </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

          <ul class="nav navbar-nav">
            <?php
            
            if ($_COOKIE['login'] == '-') {
              echo "<li class=\"d-flex nav-item\">
                      <a href=\"./registration.php\" class=\"register-button\">Зарегистрироваться</a>
                      <a href=\"./login.php\" class=\"login-button\">Войти</a>
                      </li>
                      ";
            } else {
              echo "<li class=\"d-flex nav-item\">
              <a href=\"./bookmarks.php\" class=\"register-button\">Закладки</a>
              <a href=\"./\" class=\"register-button\">" . $_COOKIE['login'] . "</a>
              <button name=\"logout\" onclick=\"logout()\" class=\"login-button\">Выйти</button>
              </li>
              ";
            }
            ?>
          </ul>

        </div>
      </div>
    </nav>

      <script>
        function addRew(id) {
          let text = document.getElementById('rew').value;

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "./add-rew-req.php", true);
          xhr.setRequestHeader("Content-Type", "application/json");

          let obj = new Object();
          obj.id = id;
          obj.text = text;

          xhr.send(JSON.stringify(obj));

          xhr.onreadystatechange = function () {
            console.log(xhr.responseText);
            location.reload();
          };
        }
      </script>

    <div class="main-container">
        <?php
            require_once "../db-users.php";
            require_once "../db-attractions.php";

            if(!isset($_GET['id']))
            {
              echo "<script>window.location.href = './index.php';</script>";
              exit();
            }

            $id = $_GET['id'];

            echo "<div class=\"text-parent\">
        <h1>" . get_attraction_name_by_id($id) . "</h1>
      </div>
      
      <div style=\"display: flex; justify-content: center;\">
        <img src=\"" . get_attraction_img_by_id($id) . "\" class=\" \" style=\"max-width: 50%;\" alt=\"...\">
      </div>";

echo "<div class=\"text-parent\">
        <h1>Отзывы</h1>
      </div>";

$rews = get_reviews_by_id($id);

    if (count(array_keys(json_decode(json_encode($rews), true))) > 0) {
      foreach ($rews->{'rews'} as $value) {
        echo "<div class=\"review-box\">";
        echo "<span class=\"name\">" . $value->{'name'} . "</span>";
        echo "<br>";
        echo $value->{'text'};
        echo "</div><br>";
      }
    }

    echo "<div class=\"input-container\">
    <input id=\"rew\" name=\"rew\" type=\"tex\" class=\"top_input\" placeholder=\"Введите отзыв\">
    <button onclick=\"addRew(" . $id . ")\" class=\"main_btn\">Оставить отзыв</button>
  </div>";
          ?>

    </div>


    <div>
      <?php require_once "./templates/footer.php";?>  
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/filtering.js"></script>
    <script src="./js/hide.js"></script>
    <script src="./js/auth.js"></script>
    <script src="./js/tools.js"></script>
  </body>
</html>
