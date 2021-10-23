<!DOCTYPE html>
<?php
    session_start();

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'project';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if(mysqli_connect_errno()) {
        exit('Failed to connect to database: '.mysqli_connect_error());
    }

    if(!isset($_GET['q'])) {
        header('Location: /index.php');
        exit();
    }
?>
<html lang="en">
<head>
    <?php include 'partials/head.php' ?>
    <title>Search Page</title>
</head>
<body>
    <header class="header">
        <?php include 'partials/navbar.php'?>
    </header>

    <section class="search">
<!--        <form class="search__form" method="get">-->
<!--            <div class="container">-->
<!--                <div class="search__form-wrapper">-->
<!--                    <input type="text" name="q" id="q" value="--><?php //echo $_GET['q'] ;?><!--" class="search__form-input">-->
<!--                    <input type="submit" value="Search" class="search__form-submit">-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
        <div class="container">
            <div class="search__term">Search term: <span><?php echo $_GET['q'] ;?></span></div>

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

                function return_booknow_link($id) {
                    $link = 'booknow.php?location='.$id;
                    if (isset($_SESSION['loggedin'])) return $link;
                    else return '/login?next='.$link;
                }

                $search_term = strtolower($_GET['q']);
                $search_term = "%$search_term%";

                $query2 = 'SELECT COUNT(id) AS row_count FROM Locations WHERE LOWER(city) LIKE ? OR LOWER(name) LIKE ? OR LOWER(state) LIKE ? LIMIT 12';
                if ($statement2 = $con->prepare($query2)) {
                    $statement2->bind_param('sss', $search_term, $search_term, $search_term);
                    $statement2->execute();
                    $statement2->bind_result($row_count);
                    $statement2->fetch();

                    if ($row_count == 0) {
                       echo '<div class="search__noresult">No results found!</div>';
                    }
                    $statement2->close();
                }

                $query = 'SELECT id, name, city, state, price, image, star, description, tag FROM Locations WHERE LOWER(city) LIKE ? OR LOWER(name) LIKE ? OR LOWER(state) LIKE ? LIMIT 12';
                if ($statement = $con->prepare($query)) {
                    $statement->bind_param('sss', $search_term, $search_term, $search_term);
                    $statement->execute();
                    $statement->bind_result($id, $name, $city, $state, $price, $image, $star, $description, $tag);

                    echo '<div class="search__content">';
                    while ($statement->fetch()) {
                        echo '
                            <div class="result">
                                <div class="result__image" style="background-image: url(/assets/images/hotelcard-1.jpg)">'.return_tag($tag).'</div>
                                <div class="result__content">
                                    <div class="result__head">
                                        <div class="result__info">
                                            <div class="result__name">'.$name.'</div>
                                            <div class="result__location"><i class="fas fa-map-marker-alt"></i>'.$city.', '.$state.'</div>
                                        </div>
                                        <div class="result__price">
                                            <span>₹'.$price.'</span>
                                            <span>(Excl. taxes)</span>
                                        </div>
                                    </div>
                                    <div class="result__rating">
                                        <div class="result__rating--stars">'.return_stars($star).'</div>
                                        <div class="result__rating--num">'.$star.'</div>
                                    </div>
                                    <div class="result__description">'.$description.'</div>
                                    <a href="'.return_booknow_link($id).'" class="result__booknow">Book Now</a>
                                </div>
                            </div>
                        ';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </section>
    <?php include 'partials/bottom.php'?>
</body>
</html>