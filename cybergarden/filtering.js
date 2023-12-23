function sendData() {
    var checkboxes = document.getElementsByName('checkbox');
    var selectedItems = [];
  
    // Перебираем чекбоксы
    for (var i = 0; i < checkboxes.length; i++) {
      // Проверяем, отмечен ли чекбокс
      if (checkboxes[i].checked) {
        // Добавляем значение и id в массив
        selectedItems.push({
          id: checkboxes[i].id
        });
      }
    }
  
    // Выводим результат в консоль (вместо этого вы можете использовать данные как вам нужно)
    console.log(selectedItems);

    // Используем AJAX для отправки данных на сервер
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "filtering.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Преобразуем массив в JSON и отправляем на сервер
    xhr.send(JSON.stringify(selectedItems));

    // Обработка ответа от сервера (если необходимо)
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          let url;
          if ( window.location.href.split('?').length > 1 ){
              url = window.location.href.split('?')[0];
          } else {
              url = window.location.href;
          }
          
          console.log(xhr.responseText);
          url += "?tags=" + xhr.responseText;
          window.location.href = url;
        
        }
    };

  }
  