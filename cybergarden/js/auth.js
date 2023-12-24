function login() {
  let login = document.getElementById('loginTxt').value;
  let password = document.getElementById('passTxt').value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./login-req.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  var obj = new Object();
  obj.login = login;
  obj.password  = password;

  xhr.send(JSON.stringify(obj));

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == "OK") {
        window.location.href = './index.php';
      } else {
        document.getElementById('error-mess-txt').textContent = "Не правильный логин или пароль";
        document.getElementById('error-mess').style.display = "block";
      }
    }
  };
}

function logout() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./loginout-req.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == "OK") {
        window.location.href = './index.php';
      }
    }
  };
}

function registration() {
  let login = document.getElementById('loginTxt').value;
  let password = document.getElementById('passTxt').value;
  let password2 = document.getElementById('pass2Txt').value;

  console.log(login);
  console.log(password);
  console.log(password2);

  if (password != password2) {
    document.getElementById('error-mess-txt').textContent = "Пароли должны совпадать";
    document.getElementById('error-mess').style.display = "block";
    return;

  } else if (login.length <= 3 || login.length > 16) {
    document.getElementById('error-mess-txt').textContent = "Длина логина должна быть больше 3 и меньше 17";
    document.getElementById('error-mess').style.display = "block";
    return;

  } else if (password.length <= 8 || password.length > 32) {
    document.getElementById('error-mess-txt').textContent = "Длина пароля должна быть больше 8 и меньше 33";
    document.getElementById('error-mess').style.display = "block";
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./user-registration-req.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  var obj = new Object();
  obj.login = login;
  obj.password  = password;

  xhr.send(JSON.stringify(obj));

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == "OK") {
        window.location.href = './index.php';
      } else {
        document.getElementById('error-mess-txt').textContent = "Не удалось зарегистрировать пользователя";
        document.getElementById('error-mess').style.display = "block";
      }
    }
  };

}