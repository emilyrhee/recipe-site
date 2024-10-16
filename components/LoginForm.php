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

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loginformtrial";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connection Successfully";
    /** I have to reformat the entire database now that I know what to do in order to connect to it.
     * 
     * first create a databased for teh RecipeSite.
     * Tables for USER( he provide that)
     * Table for bookmarks of recipe
     * Ig table for comments
     * we Might need to make a table for the recipes too along with it images(lord!!!!)
     * 
     * ==== ======== ===== ==== =====
     * 
     * this is me literally after reading the instruction for the 2nd since he assigned. :(
     * afterward we need to create a php code for the POST for the LOGIN
     * POST for also the sign up( idk if we going to do those sign up that automatically sign in the user or then  bring them to the login page) I think I'm to try to do the entire SQL part of this
     * GET might usefull....idk yet
     * 
     * for sign in we use the hashing stuff for password
     */
    ?>
    
    <div class="login-container">
        <h2 class="Login-txt">Login</h2>

        <form class="login-form" method="POST" action="LoginForm.php">
            <div class="email-container">
                <input class="email-txt" type="text" placeholder="Email" id="email" required>
            </div>

            <div class="psswd-container">
                <input class="psswd-txt" type="password" placeholder="Password" id="password" required>
            </div>

            <input class="submitBtt" type="submit" placeholder="Submit" id="submit">
        </form>
    </div>
</body>
</html>
