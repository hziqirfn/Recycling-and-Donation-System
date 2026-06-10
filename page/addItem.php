<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub - Add Item</title>

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/addItem1.css">
</head>

<body>

    <?php include("header.php"); ?>

    <div id="main">

        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>

        <div id="content">

            <div class="additem-container">

                <div class="additem-title">
                    <h1>Add New Item</h1>
                    <p>List an item and donate it to the community!</p>
                </div>

                <form id="addItemForm" class="additem-form" action="addItem.php" method="post" enctype="multipart/form-data">

                    <label>Item Name</label>
                    <input type="text" name="itemName" required>

                    <label>Category</label>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Books">Books</option>
                        <option value="Other">Other</option>
                    </select>

                    <label>Condition</label>

                    <div class="condition-group">

                        <input type="radio" id="new" name="condition" value="New" required>
                        <label for="new" class="condition-btn">New</label>

                        <input type="radio" id="used" name="condition" value="Used">
                        <label for="used" class="condition-btn">Used</label>

                        <input type="radio" id="broken" name="condition" value="Broken">
                        <label for="broken" class="condition-btn">Broken</label>

                    </div>

                    <label>Description</label>
                    <textarea name="description" rows="4" required></textarea>

                    <label>Image Item</label>
                    <input type="file" id="itemImage" name="itemImage" accept="image/*" required>

                    <div class="button-group">
                        <input type="reset" value="Cancel" class="cancel-btn">
                        <input type="submit" value="Add Item" class="submit-btn">
                    </div>

                </form>

            </div>

        </div>

    </div>
    <script src="../js/addItem.js"></script>
</body>

</html>