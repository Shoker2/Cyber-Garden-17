function openIndex() {
  window.location.href = './index.php';
}

$(document).click(function (event) {
  const target = $(event.target);
  if (!target.closest(".checkbox-dropdown").length) {
    $(".checkbox-dropdown").removeClass("is-active");
  }
});

$(".checkbox-dropdown").click(function (event) {
  event.stopPropagation();
  $(this).toggleClass("is-active");
});

function addBookMark(id) {
  console.log(id);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./add-bookmark-req.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  var obj = new Object();
  obj.id = id;

  xhr.send(JSON.stringify(obj));
}

function removeBookMark(id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./remove-bookmark-req.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  var obj = new Object();
  obj.id = id;

  xhr.send(JSON.stringify(obj));

  xhr.onreadystatechange = function () {
    location.reload();
  };
}
