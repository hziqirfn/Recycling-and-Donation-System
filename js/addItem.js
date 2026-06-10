document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("addItemForm");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let itemName = document.querySelector('input[name="itemName"]').value.trim();

            let items = JSON.parse(localStorage.getItem("items")) || [];

            items.push(itemName);

            localStorage.setItem("items", JSON.stringify(items));

            alert("Item added successfully!");

            form.reset();

            window.location.href = "pickup.php";
        });
    }

});