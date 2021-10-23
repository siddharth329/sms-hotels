<!DOCTYPE html>
<?php
    session_start();

    if(!isset($_GET['location'], $_SESSION['loggedin'])) {
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
?>
<html lang="en">
<head>
    <?php include 'partials/head.php' ?>
    <title>Book Now Page</title>
</head>
<body>
    <header class="header">
        <?php include 'partials/navbar.php'?>
    </header>
    <main>
        <section class="booknow">
            <div class="container">
                <div class="booknow__wrapper">
                    <div class="booknow__location">
                        <?php

                            function return_stars($num) {
                                $arr = '';
                                for ($i=1; $i<=5; $i++) {
                                    if($num >= $i)  $arr = $arr.'<i class="fas fa-star color-yellow"></i>';
                                    else $arr = $arr.'<i class="fas fa-star"></i>';
                                }
                                return $arr;
                            }

                            function return_tag($tag) {
                                if (isset($tag)) return '<div class="result__tag">'.$tag.'</div>';
                                else return '&nbsp;';
                            }

                            $location_id = $_GET['location'];
                            if ($statement = $con->prepare('SELECT id, name, city, state, price, image, star, description, tag FROM Locations WHERE id=?')) {
                                $statement->bind_param('i', $location_id);
                                $statement->execute();
                                $statement->bind_result($id, $name, $city, $state, $price, $image, $star, $description, $tag);

                                if ($statement->fetch()) {
                                    echo '
                                        <div class="result">
                                        <div class="result__image" style="background-image: url(/assets/images/hotelcard-1.jpg)">' . return_tag($tag) . '</div>
                                        <div class="result__content">
                                            <div class="result__head">
                                                <div class="result__info">
                                                    <div class="result__name">' . $name . '</div>
                                                    <div class="result__location"><i class="fas fa-map-marker-alt"></i>' . $city . ', ' . $state . '</div>
                                                </div>
                                                <div class="result__price">
                                                    <span>₹' . $price . '</span>
                                                    <span>(Excl. taxes)</span>
                                                </div>
                                            </div>
                                            <div class="result__rating">
                                                <div class="result__rating--stars">' . return_stars($star) . '</div>
                                                <div class="result__rating--num">' . $star . '</div>
                                            </div>
                                            <div class="result__description">' . $description . '</div>
                                        </div>
                                    </div>
                                    ';
                                } else {
                                    echo 'Invalid location id: '.$location_id;
                                    exit();
                                }
                            }
                        ?>
                    </div>
                    <div class="booknow__form-container">
                        <?php
                            echo '
                                <form action="/controllers/booknow.php?location='.$_GET['location'].'" class="booknow__form" method="post">
                                    <div class="booknow__form-group">
                                        <label for="message" class="booknow__form-label">Message</label>
                                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                                    </div>
                                    <input type="submit" value="Request Callback">
                                    <div class="booknow__form-info">You will recieve call shortly on your registered mobile number.</div>
                                </form>
                            ';
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>