<?php
    $user = check_session($connection);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $password_c = $_POST["password_c"];

    if(!empty($name) &&
        !empty($email) &&
        !empty($phone)
    ) {
        $query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = " . $user["id"];
        $result = mysqli_query($connection, $query);
        if($result){
            // Обновление данных прошло успешно, можно показать сообщение
            $user = check_session($connection);
            $profile_success = "You're successfuly updated your profile information.";
        } else {
            $error = "Changes are not applied. Details: " . mysqli_error($connection);
        }
        if(!empty($_POST["password"]) || !empty($_POST["password_c"])){
            if($password === $password_c){
                $password = hash('sha256','salt'.$password);

                $query = "UPDATE users SET password = '$password' WHERE id = " . $user["id"];
                $result = mysqli_query($connection, $query);
                if($result){
                    // Обновление данных прошло успешно, можно показать сообщение
                    $success = "You're successfuly updated your password.";
                } else {
                    $error = "Password was not updated. Details: " . mysqli_error($connection);
                }
            } else {
                $error = "Passwords did not match and was not updated.";
            }
        }
    } else {
        $error = "Please fill in all fields with profile information. You can not just left them empty, bruh😒.";
    }
}
?>

<div class="content-container">
    <div class="profile-container">
        <div class="avatar-container">
            <img src="<?= $user["avatar"] ?>" alt="Profile picture">
        </div>
        <form action="/profile-edit.php" class="profile-details" method="POST">
            <div class="input-container">
                <label for="name">Your name:</label>
                <input type="text" name="name" id="name" value="<?= $user["name"] ?>" placeholder="Your name" required>
            </div>
            <div class="input-container">
                <label for="email">Your email:</label>
                <input type="email" name="email" id="email" value="<?= $user["email"] ?>" placeholder="Your email" required>
            </div>
            <div class="input-container">
                <label for="phone">Your phone number:</label>
                <input type="text" name="phone" id="phone" value="<?= $user["phone"] ?>" placeholder="Your phone number" required>
            </div>

            <details>
                <summary>Password change</summary>
                <div>
                    <div class="alert alert-warning">We want to warn you that as soon as you change your password there's going to be no way to log in with the old password, so be cautious and remember your new one.</div>
                    <div class="input-container">
                        <label for="password">Your new password:</label>
                        <input type="password" name="password" id="password" placeholder="Enter your new password">
                    </div>
                    <div class="input-container">
                        <label for="password_c">Your new password confirmation:</label>
                        <input type="password" name="password_c" id="password_c" placeholder="Confirm your new password">
                    </div>
                </div>
            </details>

            <?php if(isset($error)){ echo
                '<div class="alert alert-error">
                    <p>'.$error.'</p>
                </div>';}
            ?>
            <?php if(isset($profile_success)){ echo
                '<div class="alert alert-success">
                    <p>'.$profile_success.'</p>
                </div>';}
            ?>
            <?php if(isset($success)){ echo
                '<div class="alert alert-success">
                    <p>'.$success.'</p>
                </div>';}
            ?>
            
            <div class="form-actions-container">
                <button type="submit" class="button primary">Save changes</button>
                <p class="separator">or</p>
                <a href="/profile.php" class="button button-ghost">Back to profile</a>
            </div>
        </form>
    </div>
</div>