<?php
    session_start();

    if(!isset($_SESSION['loggedin'], $_POST['message'], $_GET['location'])) {
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

    if ($statement = $con->prepare('INSERT INTO Enquiries (userid, locationid, message) VALUES (?, ?, ?)')) {
        $statement->bind_param('iis', $_SESSION['id'], $_GET['location'],$_POST['message']);
        $statement->execute();
        $statement->fetch();

        header('Location: /booknowsuccess.php');
        echo "Enquiry created";
        $statement->close();
    }