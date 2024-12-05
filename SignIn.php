<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <script src="../scripts/search.js"></script>
  <script src="../scripts/pswd_strength.js"></script>
</head>

<body>
  <?php include "components/navbar.php" ?>

  <div class="d-flex flex-column justify-content-center align-items-center pt-5">
    <h2>Sign Up</h2>
    <form method="POST" action="/handlers/UserSignIn.php">
      <div class="form-control">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
      </div>

      <div class="form-control">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email: " required>
      </div>

      <div class="form-control">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password: " onkeyup="passwordValidation()" required>
        <b id="notifying_user">Password must be at least 8 characters, include one uppercase letter, one lowercase letter, one number, and one special character.</b>
      </div>
      <div class="phone-number">
        <input type="text" id="number" name="phone-number" placeholder="Phone Number">
      </div>

      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</body>
</html>