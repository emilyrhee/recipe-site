<?php 

include "connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_role'])){
    $user_id = $_POST['userId'];
    $new_role = $_POST['role'];

    $applicable_role = ['client', 'chef', 'admin'];
    if(!in_array($new_role, $applicable_role)){
        echo "Invalid role selected";
        exit();
    }else{
        try{
            $updating_table = ("UPDATE Users SET role = :role WHERE id = :user_id");
            $stamt = $conn->prepare($updating_table);
            $stamt->bindParam(":user_id", $user_id);
            $stamt->bindParam(":role", $new_role);
            
            if($stamt->execute()){
                echo "Role have been successfully updated! ";
                header("Location ../Admin/Admin.php");
                exit();
            }else{
                echo "Failed to update role ";
            }
        }catch(PDOException $e){
            echo "We weren't able to update your role. " . $e->getMessage();
        }
    }
}