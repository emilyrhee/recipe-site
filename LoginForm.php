<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
$padding = 3;
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

    <div class="d-flex flex-column justify-content-center align-items-center pt-5">
      <h2 class="Login-txt pb-<?= $padding ?>">Login</h2>

      <form class="login-form" method="POST" action="handlers/UserLogin.php">
        <div class="email-container">
          <input class="email-txt" type="text" name="email" placeholder="Email" id="email" required>
        </div>

        <div class="psswd-container py-<?= $padding ?>">
          <input class="psswd-txt" type="password" name="password" placeholder="Password" id="password" required>
        </div>

        <input class="btn btn-primary" type="submit" placeholder="Submit" id="submit">
      </form>
    </div>
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger mt-3 mx-auto"><?= htmlspecialchars($error); ?></div>
      <?php endif; ?>
  </body>
</html>