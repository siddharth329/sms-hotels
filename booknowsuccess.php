<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /index.php');
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/icons/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">

    <title>SMSHotels: Where fun begins</title>
</head>
<body>
<header class="header">
    <?php include 'partials/navbar.php' ?>
</header>

<main>
    <div class="booknowsuccess">
        <div>Your entry has been successfully stored</div>
        <div>You will receive call back shortly.</div>
    </div>
</main>
<?php include 'partials/bottom.php'?>
</body>
</html>