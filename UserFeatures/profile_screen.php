<?php
include "../handlers/profile.php";
// include "../handlers/profile_update.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <script src="../scripts/MyAccountScript.js"></script>
  <link rel="stylesheet" href="../styles/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "../components/navbar.php"; ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3 d-none d-md-block">
        <?php include "../components/sidebar.php" ?>
      </div>

      <div class="col-md-6 col-lg-6">

        <h2>User Profile</h2>
        <form class="form_container" method="post" action="../handlers/profile.php">
          <div class="mb-3">
            <label class="form-label">Username </label>
            <input class="form-control" placeholder="Username " type="text" name="username" id="username" value="<?= htmlspecialchars($user_checker['username']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" placeholder="Email " type="email" name="email" id="email" value="<?= htmlspecialchars($user_checker['email']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" placeholder="New Password " type="password" name="password" id="password">
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <input class="form-control" placeholder="Role " type="text" name="role" id="role" value="<?= htmlspecialchars($user_checker['role']) ?>" disabled>
          </div>

          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input class="form-control" placeholder="phone number " type="text" name="phone" id="phone" value="<?= htmlspecialchars($user_checker['phone']) ?>"> <!--user can still stick to default phone!-->
          </div>

          <button class="btn btn-primary mt-2 w-100" type="submit">Update Profile</button>
        </form>
      </div>
    <div class="col-md-3"></div>
    </div>

  </div>


  <?php include "../components/footer.php"; ?>
</body>

</html>