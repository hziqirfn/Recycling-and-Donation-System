<?php

session_start();

include("../inc/connect.php");

$error = "";

if (isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $userId = $_SESSION['userid'];
    $item = $_POST['itemName'];
    $category = $_POST['category'];
    $condition = $_POST['condition'];
    $description = $_POST['description'];
    $image_url = "";

    if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] === 0)
    {
        $uploadDir = '../image-UserItem/';
        $originalName = basename($_FILES['itemImage']['name']);
        $newFileName = uniqid('img_') . '_' . $originalName;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['itemImage']['tmp_name'], $uploadPath))
        {
            $image_url = $uploadPath;
        }
    }

    $sql = "SELECT ItemName FROM item WHERE UserId = '$userId' AND ItemName = '$item'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        $_SESSION['error'] = "Item already exist";
        header("Location: addItem.php");
        exit();
    }

    $prefix = "ITM-";

    $sql2 = "SELECT ItemId FROM item WHERE ItemId
             LIKE '$prefix%' ORDER BY CAST(SUBSTRING(ItemId, " .(strlen($prefix) + 1). ") AS UNSIGNED)
             DESC LIMIT 1";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0)
    {
        $row = $result2->fetch_assoc();
        $lastNum = (int) preg_replace('/[^0-9]/', '', $row['ItemId']);
        $itemId = $prefix . ($lastNum + 1);
    }
    else
    {
        $itemId = $prefix . "1";
    }

    $sql2 = "INSERT INTO item (ItemId, ItemName, Category, `Condition`, Description, Image, UserId) 
             VALUES ('$itemId', '$item', '$category', '$condition', '$description', '$image_url', '$userId')";
    $result2 = $conn->query($sql2);

    if ($result2 === TRUE)
    {
        $_SESSION['error'] = "Your new item added";
    }
    else
    {
        $_SESSION['error'] = "Your new item failed to add";
    }
    header("Location: addItem.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTeM RecycleHub</title>

    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/addItem.css">
</head>

<body>
    <?php include("header.php"); ?>

    <div id="main">
        <?php include("sidebar.php"); ?>

        <label for="cb" id="overlay"></label>
        
        <div id="content">
            <div class="additem-container">

                <div class="additem-title">
                    <h2>Add New Item</h2>
                    <p>List an item and donate it to the community!</p>
                </div>

                <form class="additem-form" action="addItem.php" method="post" enctype="multipart/form-data">
                    <label for="itemName">Item Name</label>
                    <input type="text" name="itemName" id="itemName" required>

                    <label for="category">Category</label>
                    <select name="category" id="category" required>
                        <option selected disabled>Select Category</option>
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

                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4"></textarea>

                    <label>Image Item</label>
                    <input type="file" id="itemImage" name="itemImage" accept="image/*" required>

                    <div class="button-group">
                        <input type="submit" value="Add Item" class="submit-btn">
                        <input type="reset" value="Cancel" class="cancel-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php 
if ($error != "")
{
?>
    <div id="alert" class="alert">
        <div class="popup-box"><br>
            <p><?= $error; ?></p> <br><br>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
<?php 
}
?>
</body>

<script>
    function closePopup()
    {
        document.getElementById('alert').style.display = 'none';
    }
</script>

</html>