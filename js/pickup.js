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

document.getElementById("dropdown-header").addEventListener("click", function () {
    this.classList.toggle("active");
});

function toggleDropdown()
{
    let dropdown = document.querySelector(".dropdown-container");
    let header = document.querySelector(".dropdown-header");

    dropdown.classList.toggle("show");
    header.classList.toggle("active");
}

const checkboxes = document.querySelectorAll("input[name='itemId[]']");
const text = document.getElementById("dropdown-text");

function updateSelectedText() {
    let checked = document.querySelectorAll("input[name='itemId[]']:checked").length;

    text.textContent = checked === 0
        ? "Select items..."
        : `${checked} item(s) selected`;
}

checkboxes.forEach(cb => {
    cb.addEventListener("change", updateSelectedText);
});