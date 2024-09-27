const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text"),
    usernameTag = body.querySelector(".username"),
    correoTag = body.querySelector(".correo"),
    desplegables = body.querySelectorAll(".desplegable-btn");

window.addEventListener('load', function () {
    if (sessionStorage.getItem('mode') == 'dark') body.classList.add("dark"); else body.classList.remove("dark");
    if (sessionStorage.getItem('menu') == 'close') sidebar.classList.add("close"); else sidebar.classList.remove("close");
    showUsername();
});


toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        sessionStorage.setItem('menu', 'close');
        console.log('close');
    } else {
        sessionStorage.setItem('menu', 'open');
        console.log('open');
    }
})



modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
        sessionStorage.setItem('mode', 'dark');
    } else {
        modeText.innerText = "Dark mode";
        sessionStorage.setItem('mode', 'white');
    }



});

desplegables.forEach(element => {
    element.addEventListener('click', () => {

        let height = 0;
        let menuDesplegable = element.nextElementSibling;
        console.log(menuDesplegable);
        if (menuDesplegable.clientHeight == '0') {
            height = menuDesplegable.scrollHeight;
        }
        menuDesplegable.style.height = `${height}px`;
    });
});


function showUsername() {
    const url = base_url + "Usuarios/returnDataUser";
    const options = { method: 'GET' };
    fetch(url, options)
        .then(response => response.ok ? response.json() : '')
        .then(res => {
            usernameTag.innerText = res.user;
            correoTag.innerText = res.correo;
        })

}