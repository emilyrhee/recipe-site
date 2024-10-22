<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    <?php include "styles/styles.css"?>
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>    
    <div class="login-container">
        <h2 class="Login-txt">Login</h2>

        <form class="login-form" method="POST" action="LoginForm.php">
            <div class="email-container">
                <input class="email-txt" type="email" placeholder="Email" id="email" required>
            </div>

            <div class="psswd-container">
                <input class="psswd-txt" type="password" placeholder="Password" id="password" required>
            </div>

            <input class="submitBtt" type="submit" placeholder="Submit" id="submit">
        </form>
    </div>
</body>
</html>
