const logout = document.getElementById('logout_btn');

logout.addEventListener('click', (e) => {
    const isOk = confirm("You sure want to log out ?");
    if(!isOk){e.preventDefault();}
});