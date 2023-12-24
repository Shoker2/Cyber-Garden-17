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
  </head>

  <body>
    <?php
      if (!(array_key_exists("login", $_COOKIE) && array_key_exists("password", $_COOKIE))) {
        setcookie("login", "-");
        setcookie("password", "-");
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

    <div>
      <?php require_once "./templates/nav.php";?>  
    </div>

    <div class="main-container">
        <div class="text-parent">
          <h1 class="">Закладки</h1>
        </div>

        <br>

        <ul class="image-gallery">
          <?php
            require_once "../db-users.php";
            require_once "../db-attractions.php";

            $bookmarks = read_bookmarks($_COOKIE['login'], $_COOKIE['password']);

            foreach ($bookmarks as $id) {
                echo "<li class=\"monument-container\">
                <div class=\"card\" style=\"width: 18rem;\">
                  <img src=\"" . get_attraction_img_by_id($id) . "\" class=\"card-img-top image-src\" alt=\"...\">
                  <div class=\"card-body\">
                    <h5 class=\"card-title image-title\">". get_attraction_name_by_id($id) . "</h5>  
                    <a href=\"" . get_attraction_mapurl_by_id($id) . "\" class=\"map-link\">Открыть на карте</a>
                    <a onclick=\"removeBookMark(" . $id . ")\" class=\"map-link\">Удалить из закладок</a>
                  </div>
                </div>
              </li>";
            }
          ?>
        
        </ul>

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
