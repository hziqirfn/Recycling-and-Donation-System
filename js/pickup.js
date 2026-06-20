function closePopup()
{
    document.getElementById('alert').style.display = 'none';
}

document.querySelector(".date").addEventListener("click", () => {
    document.getElementById("openDate").showPicker();
});

document.querySelector(".time").addEventListener("click", () => {
    document.getElementById("openTime").showPicker();
});