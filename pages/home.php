<section class="home" id ="home">
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
<div class="container">
    <div class="slogan">
        <h1 class="slogan-heading">Enhance your life experience</h1>
        <h2 class="slogan-h2">At N House you can comfortably enjoy high-end amenities and exciting experiences
            right from the moment you enter.</h2>
        <div class="listFeatures">
            <div class="feature">
                <img src="..\images\security.png" class="slogan-logo">
                <p style="font-size: 18px; font-weight: bold;">Security 24/7 </p>
            </div>
            <div class="feature">
                <img src="..\images\wifi.png" class="slogan-logo">
                <p style="font-size: 18px; font-weight: bold;">High speed wifi</p>
            </div>
            <div class="feature">
                <img src="..\images\kitchen.png" class="slogan-logo">
                <p style="font-size: 18px; font-weight: bold;">Modern kitchen</p>
            </div>
            <div class="feature">
                <img src="..\images\laundry.png" class="slogan-logo">
                <p style="font-size: 18px; font-weight: bold;">Laundy room</p>
            </div>
            <div class="feature">
                <img src="..\images\housekeeping.png" class="slogan-logo">
                <p style="font-size: 18px; font-weight: bold;">Housekeeping service</p>
            </div>
        </div>
    </div>
    <div class="review">
        <h1 style="font-size: 50px; font-weight: bold;">CUSTOMER REVIEWS</h1>
        <div class="review-photos">
            <img src="..\images\review.jpg" class="review-photo">
            <img src="..\images\review.jpg" class="review-photo">
            <img src="..\images\review.jpg" class="review-photo">
            <img src="..\images\review.jpg" class="review-photo">
            <img src="..\images\review.jpg" class="review-photo">
            
        </div>
    </div>
</div>