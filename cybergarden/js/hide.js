function toggleMapIframe() {
  const mapIframe = document.querySelector(".map-iframe");
  if (mapIframe.style.display === "none") {
    mapIframe.style.display = "flex";
  } else {
    mapIframe.style.display = "none";
  }
}

function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function reloadPage() {
  location.reload();
}

window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
