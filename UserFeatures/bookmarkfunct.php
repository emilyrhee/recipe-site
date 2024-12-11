<?php 

session_start();
include "../handlers/connect.php";
$erroMessage = "";

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{
        if (isset($_SESSION['user_id']) && isset($_POST['recipe_id'])) {
            $user_id = $_SESSION['user_id'];
            $recipe_id = $_POST['recipe_id'];

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                // Check if the recipe is already bookmarked by the user
                $checking = "SELECT COUNT(*) FROM Bookmark WHERE user_id = :user_id AND recipe_id = :recipe_id";
                $sqlstate = $conn->prepare($checking);
                $sqlstate->bindParam(":user_id", $user_id);
                $sqlstate->bindParam(":recipe_id", $recipe_id);
                $sqlstate->execute();

                $count = $sqlstate->fetchColumn();

                if($count > 0){
                    // If already bookmarked, remove it from the Bookmark table
                    $delete = "DELETE FROM Bookmark WHERE user_id = :user_id AND recipe_id = :recipe_id";
                    $deleteState = $conn->prepare($delete);
                    $deleteState->bindParam(":user_id", $user_id);
                    $deleteState->bindParam(":recipe_id", $recipe_id);

                    if($deleteState->execute()){
                        echo "Bookmark removed successfully.";
                    } else {
                        echo "Failed to remove bookmark.";
                    }
                } else {
                    // If not bookmarked, add it to the Bookmark table
                    $booking = "SELECT r.title, r.ingredients, r.instructions, r.image_url, u.username AS chef_name
                                FROM Recipe r
                                JOIN Users u ON r.chef_id = u.id
                                WHERE r.id = :recipe_id";

                    $bookmrecipe = $conn->prepare($booking);
                    $bookmrecipe->bindParam(':recipe_id', $recipe_id);
                    $bookmrecipe->execute();
                    $recipe = $bookmrecipe->fetch(PDO::FETCH_ASSOC);

                    if(!empty($recipe)){
                        $insert = "INSERT INTO Bookmark (user_id, recipe_id, title, ingredients, instructions, image_url)
                                   VALUES (:user_id, :recipe_id, :title, :ingredients, :instructions, :image_url)";
                        
                        $insertState = $conn->prepare($insert);
                        $insertState->bindParam(":user_id", $user_id);
                        $insertState->bindParam(":recipe_id", $recipe_id);
                        $insertState->bindParam(":title", $recipe['title']);
                        $insertState->bindParam(":ingredients", $recipe['ingredients']);
                        $insertState->bindParam(":instructions", $recipe['instructions']);
                        $insertState->bindParam(":image_url", $recipe['image_url']);

                        if($insertState->execute()){
                            echo "Recipe bookmarked successfully.";
                        } else {
                            echo "Failed to bookmark recipe.";
                        }
                    } else {
                        echo "Recipe not found.";
                    }
                }
            } else {
                echo "Invalid method used.";
            }
        }
    } catch(PDOException $e){
        $erroMessage = "A database error occurred: " . $e->getMessage();
        echo $erroMessage;
    }
    
} else {
    echo "Error connecting to database.";
}
?>