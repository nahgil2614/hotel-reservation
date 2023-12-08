<!DOCTYPE html>
<html>
<head>
    <title>Sign up - N House</title>
    <link rel="stylesheet" href ="css/signUp.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body> 
    <div class="signup">
        <h1 class="signup-heading">Sign Up</h1>
        <form class="signup-form" autocomplete="off" method="POST" action="api/create-user">
            <label for="name" class="signup-label">Full Name</label>
            <input type="text" name="name" id ="name" class="signup-input" required>

            <label for="email" class="signup-label">Email</label>
            <input type="email" name="email" id ="email" class="signup-input" required>

            <label for="phone" class="signup-label">Phone</label>
            <input type="text" name="phone" id ="phone" class="signup-input" required>

            <label for="creditCard" class="signup-label">Credit Card Number</label>
            <input type="text" name="creditCard" id ="creditCard" class="signup-input" required>

            <label for="password"  class="signup-label">Password</label>
            <input type="password" name="password" id = "password" class="signup-input" required minlength="8" maxlength="26">
            
            <input type="submit" value="Sign Up" class="signup-submit">
        </form>
    </div>
</body>
</html>