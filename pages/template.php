<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = explode('/', $uri)[1];
$title = explode("-", $path);
foreach ($title as $key => $word) {
    $title[$key] = ucfirst($word);
}
$title = join(" ", $title);

$fileName = '';
switch ($path) {
    case 'home':
        $fileName = 'home';
        break;
    case 'about-us':
        $fileName = 'aboutUs';
        break;
    case 'booking':
        $fileName = 'booking';
        break;
    case 'booking-info':
        $fileName = 'formInput';
        break;
    case 'reservations':
        $fileName = 'reservations';
        break;
}

$userLevel = 0;
if (isset($_COOKIE["user"])) {
    $user = json_decode($_COOKIE["user"]);
    $userLevel = $user->level;
}

$homeCond = $path === "home" ? 'class="inpage"' : "";
$bookingCond = ($path === "booking" || $path === "booking-info") ? 'class="inpage"' : "";
$resCond = $path === "reservations" ? 'class="inpage"' : "";
$aboutCond = $path === "about-us" ? 'class="inpage"' : "";
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?> - N House</title>

    <link rel="stylesheet" href="css/<?php echo $fileName; ?>.css">
</head>

<body>
    <?php
    if ($userLevel === 0) {
    echo "<!-- guest -->
    <div class='header'>
        <img src='../images/favi.png' class='logo'>
        <nav>
            <ul>
                <li><a href='home' $homeCond>Home</a></li>
                <li><a href='booking' $bookingCond>Booking</a></li>
                <li><a href='about-us' $aboutCond>About us</a></li>
                <li><a href='sign-in' class='log'>Sign in</a></li>
                <li><a href='sign-up' class='res'>Sign up</a></li>
            </ul>
        </nav>
    </div>";
    }
    elseif ($userLevel === 1) {
    echo "<!-- traveller -->
    <div class='header'>
        <img src='../images/favi.png' class='logo'>
        <p style='margin-left: 10px;'>Hello, $user->name</p>
        
        <nav>
            <ul>
                <li><a href='home' $homeCond>Home</a></li>
                <li><a href='booking' $bookingCond>Booking</a></li>
                <li><a href='reservations' $resCond>My Reservations</a></li>
                <li><a href='about-us' $aboutCond>About us</a></li>
                <li><a href='api/log-out-user' class='log'>Log out</a></li>
            </ul>
        </nav>
    </div>";
    }
    elseif ($userLevel === 2) {
    echo "<!-- header admin -->
    <div class='header'>
        <img src='../images/favi.png' class='logo'>
        <p style='margin-left: 10px;'>Hello, $user->name (admin)</p>
        

        <nav>
            <ul>
                <li><a href='home' $homeCond>Home</a></li>
                <li><a href='reservations' $resCond>Reservations</a></li>
                <li><a href='about-us' $aboutCond>About us</a></li>
                <li><a href='api/log-out-user' class='log'>Log out</a></li>            
            </ul>
        </nav>
    </div>";
    }
    ?>
    
    <!-- content -->
    <div class="content">
        <?php include PROJECT_ROOT_PATH . '/pages/' . $fileName . '.php'; ?>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="sections">
            <div class="section">
                <img src="..\images\favi.png" class="logo-footer">
                <p style="font-size: 25px; font-weight: bold;">N House</p>
                <p>Address: 268 Ly Thuong Kiet Street District 10, Ho Chi Minh city</p>
                <p>Phone: (+84) 0909212345</p>
                <p>Email: nHouse@nHouse.vn</p>

            </div>
            <div class="section" style="width:410px; margin-right:50px;">
                <h2>Useful Link</h2>
                <ul class="column1">
                    <li><i class="fa fa-angles-right"></i><a href="about-us">About us</a></li>
                    <li><i class="fa fa-angles-right"></i><a href="#">Customer Content</a></li>

                </ul>

            </div>
            <div class="section" style="margin-right:0px;">
                <h2>Subscribe</h2>
                <p style="padding-top:20px;">Sign up for our mailing list to get latest updates and offers.</p>



            </div>
        </div>
    </div>
</body>

</html>