let changeThemeButtons = document.querySelectorAll('.changeTheme');

changeThemeButtons.forEach(button => {
    button.addEventListener('click', function () {
        let theme = this.dataset.theme;
        applyTheme(theme);
    });
});

function applyTheme(themeName) {
    if (themeName == "light") {
        document.getElementById('theme-light').disabled  = false;
        document.getElementById('theme-dark').disabled = true;
        document.getElementById('sun').style.display = 'none';
        document.getElementById('moon').style.display = 'block';
    } else {
        document.getElementById('theme-dark').disabled  = false;
        document.getElementById('theme-light').disabled = true;
        document.getElementById('moon').style.display = 'none';
        document.getElementById('sun').style.display = 'block';
    }
    localStorage.setItem('theme', themeName);
}
window.onload = function() {
    let activeTheme = localStorage.getItem('theme');
    applyTheme(activeTheme);
  };
  
