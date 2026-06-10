<?php

$imgPath = "../image/";
$profilePath = "profile.php";

if (isset($admin)) {
    $imgPath = "../../image/";
    $profilePath = "../profile.php";
}

?>

<div id="head">

    <div class="side">

        <div class="hamburger">

            <input type="checkbox" name="cb" id="cb" hidden>

            <label for="cb">
                <img src="<?= $imgPath ?>hamburger.png" alt="hamburger">
            </label>

        </div>

        <div class="logo">
            <img src="<?= $imgPath ?>logo.png" alt="logo">
        </div>

        <div class="text">
            <h2>UTeM RecycleHub</h2>
            <p>Recycling & Donation</p>
        </div>

    </div>

    <div class="profile">

        <a href="<?= $profilePath ?>">

            <img src="<?= $imgPath ?>profile.png" alt="profile">

        </a>

    </div>

</div>