<?php 
include "../components/connect.php";
session_start();

ob_start();

$errorMessage = " ";

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{
        $conn->exec("USE $db");

    }catch(PDOException $e){
        $errorMessage =  "Couldn't connect to Database " . $e->getMessage();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $instructions = isset($_POST['instructions']) ? trim($_POST['instructions']) : '';
        $chef_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $image = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';

        var_dump($title, $description, $chef_id, $image);

        echo "SOmething work here";

        if (empty($chef_id)) {
            echo "user ID is missing.";
            exit();
        }

         // checking to see if the image is uploaded
        //var_dump($_FILES['image']);
        if(!empty($image)){
        echo "image detected";
        $target_dir = "../imagerecipes/";
        $imageName = uniqid() . "_" . basename($_FILES['image']['name']); // the uniqid() generate a unique identifier to reduce risk of overwriting if more than one user upload image with same name.
        $target_file = $target_dir . $imageName;
        $image_entry = "../imagerecipes/" . $imageName;
        
        echo "still work here";

        // allowed specific type of extension pic
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        //validating image size
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['image']['tmp_name']);
        if($check === false){
            $errorMessage = "file is not an image";
            echo "Okay nice";
            exit();
        }

        if ($_FILES['image']['size'] > 5000000) {
            $errorMessage = "image size is too big";
            echo "guccie";
            exit();
        }
        if (!in_array($imageFileType, $allowed_types)) {
            echo "We done something";
            $errorMessage = "Only JPG, JPEG, PNG, and GIF files are allowed";
            header("Location: .././index.php");
            exit();
        }
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $sqlstmt = "INSERT INTO Recipe (title, instructions, chef_id) VALUES (:title, :instructions, :chef_id)";
            $stmt = $conn->prepare($sqlstmt);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':instructions', $instructions);
            $stmt->bindParam(':chef_id', $chef_id);
            echo "We getting close";

            try{
                if($stmt->execute()){
                    echo" We added to the recipe db"; 

                    // get the last saved and created id
                    $recipe_id = $conn->lastInsertId();
                    //upload the images to the recipeimages
                    echo "Yurp";

                    $sqlImages = "INSERT INTO RecipeImages(recipe_id, image_url, description) VALUES (:recipe_id, :image_url, :instructions)";
                    $stmtImg = $conn->prepare($sqlImages);
                    $stmtImg->bindParam(":recipe_id", $recipe_id );
                    $stmtImg->bindParam(":image_url", $image_entry );
                    $stmtImg->bindParam(":instructions", $instructions );
                    echo "whatcha doing";

                    if($stmtImg->execute()){
                        echo "Successful image upload";
                    }else{
                        $errorMessage = "Failed to load image into database";
                    }
                }else{
                    echo "we screwed up again !";
                }
            }catch(PDOException $e){
                $errorMessage = "Failed to load recipe into databse";
            }
        }else{
            echo "failed to move uploaded file";
        }
    }else{
        $errorMessage = "Something went wrong";
    }
    }
}

?>