<!DOCTYPE html>
<html>
<head>
    <title>Sign in - N House</title>
    <link rel="stylesheet" href ="css/signIn.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body> 
    <div class="login">
        <h1 class="login-heading">Sign in to your account</h1>
        <button class="login-google">
            <i class="fa fa-google login-google-icon"></i>
            <span class="login-google-text">Sign in with Google</span>
        </button>
        <div class="login-or"><span>or</span></div>
        <form class="login-form" autocomplete="off" method="post" action="/api/verify-user">
            <label for="email" class="login-label">Email</label>
            <input type="email" name="email" id ="email" class="login-input" required>

            <label for="password" class="login-label">Password</label>
            <input type="password" name="password" id = "password" class="login-input"  required minlength="8" maxlength="26">

            <button class="login-submit">Sign in</button>
        </form>
        <p class="login-new-account">
            <span>Don't have an account?</span>
            <a href="sign-up" class="signup-link">Sign up</a>
        </p>
    

</body>
</html>