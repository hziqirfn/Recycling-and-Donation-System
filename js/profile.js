function editbtn() 
{
    const fields = document.querySelectorAll(".edit");
    const bottom = document.getElementById("bottomBtn");
    bottom.classList.toggle("show");

    fields.forEach(field => {
        field.readOnly = !field.readOnly;
    });
}

function cancelbtn()
{
    showConfirm("Are you sure you want to discard changes?", function () {

    const fields = document.querySelectorAll(".edit");

    fields.forEach(field => {
        field.value = field.defaultValue;
        field.readOnly = true;
    });

    document.getElementById("bottomBtn").classList.remove("show");
    });
}

function showConfirm(message, yesCallback)
{
    document.getElementById("confirmText").innerText = message;
    document.getElementById("alert").style.display = "flex";

    document.getElementById("yesBtn").onclick = function () {
        yesCallback();
        closePopup();
    };
}

function closePopup()
{
    document.getElementById('alert').style.display = 'none';
}