<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
<?php
    include "../handlers/profile.php";
    include "../handlers/profile_update.php";
    ?>
    <div class="container">
        <h2> User Profile</h2>
        <form class="form_container" method="post" action="../handlers/profile_update.php">
        <div class="form_group">
            <label>Username: </label>
            <input placeholder="Username: " type="text" name="username" id="username" value="<?= htmlspecialchars($user_checker['username']) ?>" required>
        </div>
        <div class="form_group">
            <label>Email: </label>
            <input placeholder="Email: " type="email" name="email" id="email" value="<?= htmlspecialchars($user_checker['email']) ?>" required>
        </div>

        <div class="form_group">
        <label>Password: </label>
            <input placeholder="New Password: " type="password" name="password" id="password" >
        </div>

        <div class="form_group">
        <label>Role: </label>
            <input placeholder="Role: " type="text" name="role" id="role" value="<?= htmlspecialchars($user_checker['role']) ?>" disabled>
        </div>

        <div class="form_group">
        <label>Phone: </label>
            <input placeholder="phone number: " type="text" name="phone" id="phone" value="<?= htmlspecialchars($user_checker['phone']) ?>"> <!--user can still stick to default phone!-->
        </div>

        <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>