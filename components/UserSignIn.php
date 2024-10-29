<?php 
include "../components/connect.php";

session_start();

$errorMessage = " ";

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{

        $conn->exec("USE $db");

    }catch(PDOException $e){
        
        $errorMessage = "Difficulties connecting to the Database: " + $e ->getMessage();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        if($username != null){
            $username = stripslashes($username);
        }
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
        $role = "client"; // this is the default, we might need to find a way to switch it to chef or admin.
        $phone = "999-999-999";

        //I want to check if email or username already exist

        $stmtsql =("SELECT COUNT(*) FROM Users WHERE email = :email OR username = :username");
        $smtmt = $conn->prepare($stmtsql);
        $smtmt->bindParam(':email' , $email, PDO::PARAM_STR);
        $smtmt->bindParam(':username' , $username, PDO::PARAM_STR);
        $smtmt->execute();

        $count = $smtmt->fetchColumn();
        if($count > 0){
            echo "Username or email already exists!";
        }else{
            try{

                $smtmt = $conn -> prepare("INSERT INTO users (username, email, password, role, phone) VALUES (:username, :email, :password, :role, :phone) ");

                $smtmt->bindParam(':username', $username);
                $smtmt->bindParam(':email', $email);
                $smtmt->bindParam(':password', $password);
                $smtmt->bindParam(':role', $role);
                $smtmt->bindParam(':phone', $phone);
                $smtmt->execute();
                echo "User registered successfully. ATE THAT UP!!!!!!!!!";

                header("Location: ./LoginForm.php");
            }catch(PDOException $e){
                $errorMessage = "Database error: " + $e->getMessage();
            }
        }

    }else{
        $errorMessage = "Error connecting to the database.";
    }


}

?>
