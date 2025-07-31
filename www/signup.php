<?php
    include("functions/redirect.php");
    session_redirect(true, false);
    include 'modules/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndieWEB</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php include 'modules/signup-form.php'; ?>
</body>
</html>