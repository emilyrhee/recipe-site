<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
</head>
<body>
<div class="form-container">
    <h2>Sign Up</h2>
    <form method="POST" action="../components/UserSignIn.php" >
        <div class="form-control">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="form-control">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email: " required>
        </div>

        <div class="form-control">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password: " required>
        </div>
        <div class="phone-number">
            <input type="text" id="number" name="phone-number" placeholder="Phone Number">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>