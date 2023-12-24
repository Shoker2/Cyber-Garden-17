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

      <div class="main-container">
        <div class="text-parent">
          <h1 class="map-text" onclick="toggleMapIframe()">Карта</h1>
        </div>

        <div class="map-iframe">
          <iframe width="90%" height="700" frameborder="0" scrolling="no" src="https://widgets.scribblemaps.com/sm/?d&dv&cv&z&l&gc&af&mc&dfe&lat=47.21380764&lng=38.92494768&vz=13&type=custom_style&s&width=550&height=400&id=Z6QVuzEEBC" allowfullscreen allow="geolocation" loading="lazy"></iframe>
        </div>

        <div class="checkbox-dropdown">
          Выбери фильтры
          <ul style="background-color: white;" class="checkbox-dropdown-list">

            <?php
              require_once "../db-attractions.php";
              $ids = get_tag_list();

              foreach ($ids as $id) {
                echo "
                <li>
                  <label> <input type=\"checkbox\" name=\"checkbox\" id=\"" . $id . "\"/> " . get_tag_name($id) . " </label>
                </li>
                ";
              }
            ?>

          </ul>
        </div>
        <button class="filter-button" type="button" style="margin: 0 auto; display: block;" onclick="sendData()">Отфильтровать</button>

        <div class="text-parent">
          <h1 class="info-text">Достопримечательности</h1>
        </div>

        <ul class="image-gallery">
          <?php
            require_once "../db-attractions.php";

            $tags = array();
            if(isset($_GET['tags']))
            {
              $newStr = explode(",", $_GET['tags']);
              foreach ($newStr as $value) {
                $tags[] = $value;
              }

            }
            $results = get_attractions_id_by_tag_id($tags);

            foreach ($results as $id) {
              echo "<li class=\"monument-container\">
              <div class=\"card\" style=\"width: 18rem;\">
                <img src=\"" . get_attraction_img_by_id($id) . "\" class=\"card-img-top image-src\" alt=\"...\">
                <div class=\"card-body\">
                  <a href=\"./fullpost.php?id=" . $id . "\" class=\"card-title image-title\">". get_attraction_name_by_id($id) . "</a>  
                  <a href=\"" . get_attraction_mapurl_by_id($id) . "\" class=\"map-link\">Открыть на карте</a>
                  <a onclick=\"addBookMark(" . $id . ")\" class=\"map-link\">Добавить в закладки</a>
                </div>
              </div>
            </li>";
            }
          ?>
        
        </ul>
      </div>
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
