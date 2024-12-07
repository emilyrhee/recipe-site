<?php
session_start();
?>
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
  <script src="../scripts/search.js" defer></script>
  <script src="scripts/pswd_strength.js" defer></script>
</head>

<body>
  <?php include "components/navbar.php" ?>
  
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <h2 class="text-center mb-4">Sign Up</h2>
        <form method="POST" action="/handlers/UserSignIn.php">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="false" onkeyup="passwordValidation()" required>
          </div>

          <p id="notifying_user" class="alert alert-warning mt-2 d-none">test</p>

          <?php if (!empty($_SESSION['myVariable'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
              <?php echo $_SESSION['myVariable']; ?>
            </div>
          <?php endif; ?>
          
          <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->

          <!-- <div class="mb-3">
            <label for="number" class="form-label">Phone Number</label>
            <input type="text" id="number" name="phone-number" class="form-control" placeholder="Enter your phone number">
          </div> -->

          <button type="submit" class="btn btn-primary mt-2 w-100">Register</button>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      </div>
    </div>
  </div>
</body>


</html>