<script>
      function captchaCallback(token) {
        // Разблокируем кнопку отправки формы после успешной проверки капчи
        document.querySelector('.button[type="submit"]').disabled = false;
      }
</script>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

<form action="login.php" method="POST" class="form">
    <div class="title">
        <h1>Log in</h1>
        <p>Sign in your account</p>
    </div>

    <div class="input-container">
        <label for="login">Enter your email adress or phone number:</label>
        <input type="text" id="login" name="login" placeholder="Login" required>
    </div>

    <div class="input-container">
        <label for="password">Enter your password:</label>
        <input type="password" id="password" name="password" required>
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

    <div class="form-actions-container vertical">
        <button type="submit" class="button" disabled>Log in your account</button>
        <p class="separator">or</p>
        <a href="/signup.php" class="button button-ghost">Create new account</a>
    </div>
</form>