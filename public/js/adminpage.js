const delete_btn = document.querySelectorAll(".delete_btn");

delete_btn.forEach((i, _) => {
    i.addEventListener("click", (e) => {
        const isOk = confirm("You sure want to delete this data ?");
        if(!isOk){e.preventDefault();}
    });
});