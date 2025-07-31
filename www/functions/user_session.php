<?php
    include "functions/db.php";
    function check_session($connection){
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $query = "SELECT * FROM users WHERE id = '$id' limit 1";
            
            $result = mysqli_query($connection, $query);
            if($result && mysqli_num_rows($result) > 0){
                // Возвращаем данные пользователя
                return mysqli_fetch_assoc($result);
            }
        }
    }

    function logout_user(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login.php");
        exit();
    }
?>