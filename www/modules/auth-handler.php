<?php
    session_start();
    include("functions/db.php");


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = $_POST["login"];
        $password = $_POST["password"];

        if(!empty($login) &&
           !empty($password)
        ) {
            // Захешируем пароль перед запросом в БД (и добавим соли для безопасности)
            $password = hash('sha256','salt'.$password);
            // Юзер ввёл данные корректно, посмотрим если дб схавает нового пользователя (а не схавает только если номер телефона, почта и имя пользователя не уникальны)
            $query = "SELECT * FROM users WHERE ((email = '$login' OR phone = '$login') AND password = '$password')";
            $result = mysqli_query($connection, $query);
            if($result && mysqli_num_rows($result) > 0) {
                // Открываем основную страницу
                $user = mysqli_fetch_assoc($result);
                $_SESSION['id'] = $user['id'];
                header("Location: /index.php");
                exit();
            } else {
                $error = "Authentication failed. Please check your login and password.";
            }
        } else {
            $error = "Please fill in all fields.";
        }
    }

?>