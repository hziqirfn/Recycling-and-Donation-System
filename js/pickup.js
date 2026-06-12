let items = JSON.parse(localStorage.getItem("items")) || [];

let dropdown = document.getElementById("itemList");

items.forEach(function(item) {
    let option = document.createElement("option");
    option.value = item;
    option.textContent = item;

    dropdown.appendChild(option);
});