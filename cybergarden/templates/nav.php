<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="./css/index.css" />

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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>