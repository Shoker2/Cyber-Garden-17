<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Памятники Таганрога</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <div>
      <div class="header">
        <!-- TODO: картинка ломается, когда меняешь разрешение сайта (компатибилити) -->
        <div class="logo-container">
          <img src="icons/logo.png" class="logo" />
        </div>

        <div class="header-text">
          <h1>Монументы Таганрога</h1>
        </div>

        <div class="auth-container">
          <button class="register-button">Зарегистрироваться</button>
          <button class="login-button">Войти</button>
        </div>
      </div>

      <div class="main-container">
        <div class="text-parent">
          <h1 class="open-map-text">Карта</h1>
        </div>

        <div class="map-iframe">
        <iframe width="90%" height="700" frameborder="0" scrolling="no" src="https://widgets.scribblemaps.com/sm/?d&dv&cv&z&l&gc&af&mc&lat=47.22829529&lng=38.91035255&vz=13&type=road&ti&s&width=550&height=400&id=Z6QVuzEEBC" allowfullscreen allow="geolocation" loading="lazy"></iframe>
        </div>

        <form id="myForm">
          <label><input type="checkbox" name="checkbox" id="1"> Первый</label><br>
          <label><input type="checkbox" name="checkbox" id="2"> Second</label><br>
          <label><input type="checkbox" name="checkbox" id="3"> Teeest</label><br>
          <button type="button" onclick="sendData()">Отфильтровать</button>
        </form>

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
        
              // foreach ($elements as $id_tag) {
              //     echo get_tag_name($id_tag) . " ";
              // }

            }
            $results = get_attractions_id_by_tag_id($tags);

            // foreach ($results as $id) {
            //   echo "<li class=\"monument-container\">
            //       <img class=\"image-src\" src=\"" . get_attraction_img_by_id($id) . "\" />
            //       <div class=\"image-text\">
            //         <div class=\"text-container\">
            //           <h1 class=\"image-header\"> ". get_attraction_name_by_id($id) . " </h1>
            //           <a href=" . get_attraction_mapurl_by_id($id) . " class=\"map-link\">Открыть на карте</a>
            //         </div>
      
            //         <div class=\"image-description\">Lorem ipsum</div>
            //       </div>
            //     </li>";
            // }

            foreach ($results as $id) {
              echo "<li class=\"monument-container\">
              <div class=\"card\" style=\"width: 18rem;\">
                <img src=\"" . get_attraction_img_by_id($id) . "\" class=\"card-img-top image-src\" alt=\"...\">
                <div class=\"card-body\">
                  <h5 class=\"card-title image-title\">". get_attraction_name_by_id($id) . "</h5>  
                  <a href=\"" . get_attraction_mapurl_by_id($id) . "\" class=\"map-link\">Открыть на карте</a>
                </div>
              </div>
            </li>";
            }
          ?>
        
        </ul>
      </div>
    </div>

    <script src="filtering.js"></script>
  </body>
</html>
