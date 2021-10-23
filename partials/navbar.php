<nav class="navbar">
    <div class="container">
        <div class="navbar__content">
            <a href="/" class="navbar__brandlogo">
                <img src="./assets/images/logo.svg" alt="Logo">
            </a>

            <div class="navbar__links">
                <a href="tel:+919753313077" class="navbar__link">
                    <i class="fal fa-phone fa-flip-horizontal"></i>
                </a>
                <a href="tel:+919753313077" class="navbar__link">
                    <i class="fal fa-mobile"></i>
                </a>

                <?php
                    if (!isset($_SESSION['loggedin'])) {
                        echo '
                            <a href="/login.php" class="navbar__authbtn">
                                Log In / Sign up
                            </a>
                        ';
                    } else {
                        echo '
                            <a href="/logout.php" class="navbar__authbtn">
                                Logout
                            </a>
                        ';
                    }
                ?>
            </div>
        </div>

        <div class="searchbar">
            <div class="searchbar__heading"><strong>Book an SMSHotel</strong> - Choose from
                <?php
                    $DATABASE_HOST = 'localhost';
                    $DATABASE_USER = 'root';
                    $DATABASE_PASS = '';
                    $DATABASE_NAME = 'project';

                    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                    if(mysqli_connect_errno()) {
                        exit('Failed to connect to database: '.mysqli_connect_error());
                    }

                    if ($statement = $con->query('SELECT COUNT(id) AS count FROM Locations')) {
                        if ($statement->num_rows > 0) {
                            $row = $statement->fetch_assoc();
                            echo $row['count'];
                        }
                    }
                ?>+ Hotels in India
            </div>
            <form class="searchbar__form" action="/search.php" method="get" >
                <div class="searchbar__formgroup">
                    <i class="searchbar__icon far fa-search"></i>
                    <input type="text" class="searchbar__forminput" name="q" value="<?php
                            if (isset($_GET['q'])) {
                                echo $_GET['q'];
                            }
                        ?>">
                    <input type="submit" value="Search" class="searchbar__submitbtn">
                </div>
            </form>
        </div>
    </div>
</nav>