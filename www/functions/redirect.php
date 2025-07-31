<?php
session_start();
function session_redirect($redirectToProfile = false, $checkSession = true) {

    if ($redirectToProfile && isset($_SESSION["id"])) {
        header("Location: /profile.php");
        exit();
    }


    if ($checkSession && !isset($_SESSION["id"])) {
        header("Location: /login.php");
        exit();
    }
}
?>