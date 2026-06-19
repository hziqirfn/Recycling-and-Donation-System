function editbtn() 
{
    const fields = document.querySelectorAll(".edit");
    const bottom = document.getElementById("bottomBtn");
    bottom.classList.toggle("show");

    fields.forEach(field => {
        if (field.disabled) {
            field.disabled = false;
        } else {
            field.disabled = false;
        }

        if (field.hasAttribute("readonly")) {
            field.removeAttribute("readonly");
        } else {
            field.setAttribute("readonly", true);
        }
    });


}