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
            <div class="box">
                <label>Number of People:</label> <br>
                <input type="number" id="noPeople" placeholder="0" required min='0'>
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
<div class="list">
    <div class="room">
        <h1 class="room-heading">STANDARD</h1>
        <div class="room-detail">
            <img src="../images/room.jpg">
            <div class="room-description">

                <p style="font-size: 25px; font-weight: bold;">Standard Room</p>


                <p style="font-size: 20px; font-weight: 500;">2 guests</p>
                <ul style="font-size: 20px; font-weight: normal; margin-left: -20px;">
                    <li>
                        <p>Free wifi and NetFlix</p>
                    </li>
                    <li>
                        <p>Hot tub</p>
                    </li>
                    <li>
                        <p>1 18m2 bed</p>
                    </li>
                </ul>
                <div class="booking">
                    <!-- <div class="num-room">
                        <label>Choose number of room:</label> <br>
                        <input type="number" placeholder="0" required min='0' max='8'>
                    </div> -->
                    <div class="price">
                        <input type ="submit" value = "500.000 VND">
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="proceed">
        <input type="submit" value="PROCEED">
    </div>

</div>

<script src="js/booking.js"></script>