<?php 

include "../handlers/connect.php";

$erroMessage = "";
$recipes = [];

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{
        if (isset($_SESSION['user_id']) && isset($_POST['recipe_id'])) {
            $user_id = $_SESSION['user_id'];
            $recipe_id = $_POST['recipe_id'];
            var_dump($_SESSION);
            
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                // check if the recipe have already being bookmarked by user
                $cheking = "SELECT COUNT(*) FROM Bookmark WHERE user_id = :user_id AND recipe_id = :recipe_id";
                $sqlstate = $conn->prepare($cheking);
                $sqlstate->bindParam(":user_id", $user_id);
                $sqlstate->bindParam(":recipe_id", $recipe_id);
                $sqlstate->execute();

                $count = $sqlstate->fetchColumn();

                if($count > 0){
                    echo "You have already bookmarked this recipe";
                    header("Location: ../recipes/display_recipes.php");
                }else{
                    // now we stuff from the recipe
                    $booking = "SELECT r.title, r.ingredients, r.instructions, r.image_url, u.username AS chef_name
                           FROM Recipe r
                           JOIN Users u ON r.chef_id = u.id
                           WHERE r.id = :recipe_id ";

                    $bookmrecipe = $conn->prepare($booking);
                    $bookmrecipe->bindParam(':recipe_id', $recipe_id);
                    $bookmrecipe->execute();
                    $recipes = $bookmrecipe->fetch(PDO::FETCH_ASSOC);

                    if(!empty($recipes)){
                        // insert into the Bookmark table

                        $insert = "INSERT INTO Bookmark (user_id, recipe_id, title, ingredients, instructions, image_url)
                        VALUES (:user_id, :recipe_id, :title, :ingredients, :instructions, :image_url)";

                        $insertState = $conn->prepare($insert);
                        $insertState->bindParam(":user_id", $user_id);
                        $insertState->bindParam(":recipe_id", $recipe_id);
                        $insertState->bindParam(":title", $recipes['title']);
                        $insertState->bindParam(":ingredients", $recipes['ingredients']);
                        $insertState->bindParam(":instructions", $recipes['instructions']);
                        $insertState->bindParam(":image_url", $recipes['image_url']);

                        if($insertState->execute()){
                            echo "WE DID IT !!!";
                            header("Location: ../index.php");
                        }else{
                            echo "Failed to upload recipe to bookmark ";
                        }
                        var_dump($recipes['image_url']);
                    }else{
                        echo "umm.. Recipe aint in here";
                    }
                }
            }else{
                echo  "Invalid Method used ";
            }
        }
    }catch(PDOException $e){
        $erroMessage = "A database error have occured " . $e->getMessage();
        echo $erroMessage;
    }
    
}else{
    echo "Error connecting to database";
}

?>