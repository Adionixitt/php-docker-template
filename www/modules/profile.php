<?php
    $user = check_session($connection);
?>

<div class="content-container">
    <div class="profile-container">
        <div class="avatar-container">
            <img src="<?= $user["avatar"] ?>" alt="Profile picture">
        </div>
        <div class="profile-details">
            <p id="user_name-text"><?= $user["name"] ?><span id="user_id-text" class="badge" title="user id"><?= $user["id"] ?></span></p>
            <p id="user_email-text"><?= $user["email"] ?></p>
            <p id="user_phone-text"><?= $user["phone"] ?></p>
            <a href="/profile-edit.php" class="button button-ghost">Edit profile info</a>
        </div>
    </div>
</div>