<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['loggedin'])) {
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
    <?php
        if (isset($_GET['next'])) $link = '/controllers/authenticate.php?next=' . $_GET['next'];
        else $link = '/controllers/authenticate.php';

        echo '
            <form 
                action="'.$link.'" 
                class="form" 
                method="post"
                name="loginform"
                onsubmit="res=onLoginFormSubmit(); return res;"
                onreset="res=onFormReset(); return res"
                novalidate
            >
                <div class="form__head">Login</div>
        
                <div class="form__group">
                    <label for="email" class="form__label">Email</label>
                    <input type="email" name="email" id="email" class="form__input">
                </div>
        
                <div class="form__group">
                    <label for="password" class="form__label">Password</label>
                    <input type="password" name="password" id="password" class="form__input">
                </div>
        
                <div class="form__btnbox">
                    <input type="submit" value="Login" class="form__submitbtn">
                    <input type="reset" value="Reset" class="form__submitbtn">
                </div>
        
                <div class="form__p">
                    Don\'t have an account? &nbsp; <a href="/register.php">Register Now</a>
                </div>
            </form>
        ';
    ?>
</main>
<?php include 'partials/bottom.php'?>
</body>
</html>