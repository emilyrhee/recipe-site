<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <script src="../scripts/search.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php
  include "components/navbar.php";
  ?>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">

        <h2 class="text-center mb-4">Login</h2>

        <form class="login-form" method="POST" action="handlers/UserLogin.php">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="false" onkeyup="passwordValidation()" required>
          </div>

          <input class="btn btn-primary mt-2 w-100" type="submit" id="submit" value="Login">
        </form>
        <?php if (!empty($error)) : ?>
          <div class="alert alert-danger mt-3 w-100"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>