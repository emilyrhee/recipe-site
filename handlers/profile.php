<?php 
include "../handlers/connect.php";

session_start();
$error_message = "";

if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}

if(isset($conn)){
    $db = "recipemanagementsystem";
    $user_id = $_SESSION['user_id']; // collect user_id 
    try{
        $pfp = "SELECT username, email, password, role, phone FROM Users WHERE id = :user_id";
        $pfp_statement = $conn->prepare($pfp);
        $pfp_statement->bindParam(':user_id', $user_id);
        $pfp_statement->execute();

        //check user actually exist 
        $user_checker = $pfp_statement->fetch(PDO::FETCH_ASSOC);
        if(!$user_checker){
            echo "User doesn't exist";
        }
    }catch(PDOException $e){
        $error_message = "Have error connecting to the database " . $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])){

    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));
    //$role = htmlspecialchars(trim($_POST['role'])); //we don't need this since it doesn't get updated.
    $phone = htmlspecialchars(trim($_POST['phone']));
    //$user_id = $_SESSION['user_id'];

    if(isset($conn)){
        $db = "recipemanagementsystem";

        try{
            $udpat_sql = "UPDATE Users SET username = :username, email = :email, phone = :phone";

            // check if the password is empty

            if(!empty($password)){
                $udpat_sql .= ", password = :password";
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            
            $udpat_sql .= " WHERE id = :user_id";

            $update_query = $conn->prepare($udpat_sql);

            $update_query->bindParam(":username", $username);
            $update_query->bindParam(":email", $email);
            $update_query->bindParam(":phone", $phone);
            $update_query->bindParam(":user_id", $user_id);

            if(!empty($password)){
                $update_query->bindParam(":password", $password);
            }
            // try to execute so that we let users know they updated successfully.

            if($update_query->execute()){
                echo "Successfully Updated your profile";
                $_SESSION['username'] = $username;

                header("Location: .././index.php " );
            }else{
                echo "Failed to update your code.";
            }


        }catch(PDOException $e){
            $error = "Error connecting to the database " . $e->getMessage();
            echo $error;
        }
    }

    ///echo "HHHHHHHHHHH";
    
    //var_dump($username);
}
?>
