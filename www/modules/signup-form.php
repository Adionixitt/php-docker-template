<?php
    include("functions/db.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $phonenumber = $_POST["phone"];
        $password = $_POST["password"];
        $password_c = $_POST["password_c"];
        $email = $_POST["email"];

        if(!empty($username) &&
           !empty($email) &&
           !empty($phonenumber) &&
           !empty($password) &&
           !empty($password_c)
        ) {
            if($password === $password_c){
                // Захешируем пароль перед сохранением в БД (и добавим соли для безопасности)
                $password = hash('sha256','salt'.$password);
                // Юзер ввёл данные корректно, посмотрим если дб схавает нового пользователя (а не схавает только если номер телефона, почта и имя пользователя не уникальны)
                $query = "INSERT INTO users (name, email, phone, password) VALUES ('$username', '$email', '$phonenumber', '$password')";
                $result = mysqli_query($connection, $query);
                if($result){
                    // Регистрация прошла успешно, можно показать сообщение
                    $success = "You're successfuly created a new account. Go to the <a href='/login.php'>login page</a> to log in.";
                } else {
                    $error = "Registration failed: " . mysqli_error($connection);
                }
            } else {
                $error = "Passwords do not match.";
            }
        } else {
            $error = "Please fill in all fields.";
        }
    }

?>

<script>
      function captchaCallback(token) {
        // Разблокируем кнопку отправки формы после успешной проверки капчи
        document.querySelector('.button[type="submit"]').disabled = false;
      }
</script>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

<form action="signup.php" method="POST" class="form">
    <div class="title">
        <h1>Sign up</h1>
        <p>Create a new account</p>
    </div>

    <div class="input-container">
        <label for="name">Enter your name:</label>
        <input type="text" id="username" name="username" placeholder="Name" required>
    </div>

    <div class="input-container">
        <label for="phone">Enter your phone number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Phone number" required>
    </div>

    <div class="input-container">
        <label for="email">Enter your email adress:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
    </div>

    <div class="input-container">
        <label for="password">Create a new password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="input-container">
        <label for="password_c">Confirm you new password:</label>
        <input type="password" id="password_c" name="password_c" required>
    </div>

    <div
        class="smart-captcha"
        data-sitekey="ysc1_jvBRE2GOD0HmHuo1XlsJkDzY040ndQATkeU1bshYb625cf39"
        data-hl="en"
        data-callback="captchaCallback"
    ></div>

    <?php if(isset($error)){ echo
        '<div class="alert alert-error">
            <p>'.$error.'</p>
        </div>';}
    ?>
    <?php if(isset($success)){ echo
        '<div class="alert alert-success">
            <p>'.$success.'</p>
        </div>';}
    ?>

    <div class="form-actions-container vertical">
        <button type="submit" class="button" disabled>Create new account</button>
        <p class="separator">or</p>
        <a href="/login.php" class="button button-ghost">Log in existing account</a>
    </div>
</form>