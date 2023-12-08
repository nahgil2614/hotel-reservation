<section class="home" id="home">
    <div class="head_container">
        <div class="box">
            <div class="text">
                <h1>Hello from N House</h1>

            </div>
        </div>
        <div class="image">
            <img src="../images/home1.jpg" class="slide">
        </div>
        <div class="image_item">
            <img src="../images/home1.jpg" alt="" class="slide" onclick="img('../images/home1.jpg')">
            <img src="../images/home2.jpg" alt="" class="slide" onclick="img('../images/home2.jpg')">
            <img src="../images/home3.jpg" alt="" class="slide" onclick="img('../images/home3.jpg')">
            <img src="../images/home4.jpg" alt="" class="slide" onclick="img('../images/home4.jpg')">
        </div>
    </div>
</section>
<script>
    function img(anything) {
        document.querySelector('.slide').src = anything;
    }

    function change(change) {
        const line = document.querySelector('./images');
        line.style.background = change;
    }
</script>
<section class="book">
    <div class="container flex">
        <div class="input grid">
            <div class="box">
                <label>Check-in:</label>
                <input type="date" placeholder="Check-in-Date" id="checkInDate">
            </div>
            <div class="box">
                <label>Check-out:</label>
                <input type="date" placeholder="Check-out-Date" id="checkOutDate">
            </div>
        </div>
        <div class="search">
            <input type="submit" value="SEARCH" onclick="getRooms()">
        </div>
    </div>
</section>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("checkInDate").setAttribute("min", today);
    document.getElementById("checkOutDate").setAttribute("min", today);
</script>
<div class="list" id="listRooms">
    
</div>
<div class="proceed">
    <input type="submit" value="PROCEED">
</div>

<?php
$user = json_decode($_COOKIE['user']);

echo "<script>
const userId = $user->id;
const userLevel = $user->level;
</script>";
?>
<script src="js/booking.js"></script>