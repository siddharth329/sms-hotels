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
  <?php include 'partials/head.php' ?>
  <title>SMSHotels: Where fun begins</title>
</head>
<body>
  <header class="header">
      <?php include 'partials/navbar.php'?>
  </header>

  <main>
    <form
            class="form"
            method="post"
            name="registerform"
            action="/controllers/register.php"
            onsubmit="res=onRegisterFormSubmit(); return res;"
            onreset="res=onFormReset(); return res"
            novalidate
    >
      <div class="form__head">Register</div>

      <div class="form__group">
        <label for="name" class="form__label">Name</label>
        <input type="text" name="name" id="name" class="form__input">
      </div>
      
      <div class="form__group">
        <label for="email" class="form__label">Email</label>
        <input type="email" name="email" id="email" class="form__input">
      </div>

      <div class="form__group">
        <label for="mobilenumber" class="form__label">Mobile Number</label>
        <input type="text" name="mobilenumber" id="mobilenumber" class="form__input">
      </div>

      <div class="form__group">
        <label for="password" class="form__label">Password</label>
        <input type="password" name="password" id="password" class="form__input">
      </div>

      <div class="form__group">
          <label for="cnfppassword" class="form__label">Confirm Password</label>
          <input type="cnfppassword" name="cnfppassword" id="cnfppassword" class="form__input">
      </div>

        <div class="form__btnbox">
            <input type="submit" value="Register" class="form__submitbtn">
            <input type="reset" value="Reset" class="form__submitbtn">
        </div>

      <div class="form__p">
        Already have an account? &nbsp; <a href="/login.php">Login Now</a>
      </div>
    </form>

  </main>
  <?php include 'partials/bottom.php'?>
</body>
</html>