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

    if (!isset($_POST['email'], $_POST['password'])) {
        exit('Please fill email password as required');
    }

    if ($statement = $con->prepare('SELECT id, pass FROM accounts WHERE email=?')) {
        $statement->bind_param('s', $_POST['email']);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows > 0) {
            $statement->bind_result($id, $pass);
            $statement->fetch();

            if (password_verify($_POST['password'], $pass)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $id;
                if (isset($_GET['next'])) {
                    header("Location: /{$_GET['next']}");
                } else {
                    header('Location: /index.php');
                }
            } else {
                echo 'Incorrect username or password';
            }
        } else {
            echo 'Incorrect username or password';
        }

        $statement->close();
    }