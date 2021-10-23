<?php
    session_start();

    if (isset($_SESSION['loggedin'])) {
        header('Location: /index.php');
        exit();
    }

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'project';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if(mysqli_connect_errno()) {
        exit('Failed to connect to database: '.mysqli_connect_error());
    }

    if (!isset($_POST['email'], $_POST['password'], $_POST['mobilenumber'], $_POST['password'])) {
        exit('Please fill email name mobilenumber password as required');
    }

    if ($statement = $con->prepare('SELECT id, pass FROM accounts WHERE email=?')) {
        $statement->bind_param('s', $_POST['email']);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            echo 'User with email already exists';
            exit();
        }
        $statement->close();
    }

    if (strlen($_POST['password']) < 8) {
        echo 'Password length should be greater than or equals to 8';
        exit();
    }

    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    if ($statement = $con->prepare('INSERT INTO Accounts (email, pass, name, mobilenumber) VALUES (?, ?, ?, ?)')) {
        $statement->bind_param('ssss', $_POST['email'], $hashed_password, $_POST['name'], $_POST['mobilenumber']);
        $statement->execute();
        $statement->fetch();

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = $statement->insert_id;
        header('Location: /index.php');

        echo "Account created";
        $statement->close();
    }