<div class="container">
    <div class="container-heading">
        <h1>My reservation</h1>
        
    </div>
    <div class="container-forms" id="listRooms">
        
    </div>
</div>

<?php
$user = json_decode($_COOKIE['user']);

echo "<script>
const userId = $user->id;
const userLevel = $user->level;
</script>";
?>
<script src="js/res.js"></script>