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
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $chef_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $image = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
        echo "SOmething work here";

         // checking to see if the image is uploaded
        if(!empty($image)){
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

            $errorMessage = "Only JPG, JPEG, PNG, and GIF files are allowed";
            header("Location: .././index.php");
            exit();
        }
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $sqlstmt = ("INSERT INTO Recipes (title, description, chef_id) VALUES (:title, :description, :chef_id");
            $smtmt = $conn->prepare($sqlstmt);
            $smtmt ->bindParam(':title', $title);
            $smtmt ->bindParam(':description', $description);
            $smtmt ->bindParam(':chef_id', $chef_id);
            echo "We getting close";

            try{
                if($smtmt->execute()){
                    echo" We added to the recipe db"; 
                    // get the last saved and created id
                    $recipe_id = $conn->lastInsertId();
                    //upload the images to the recipeimages

                    $sqlImages = ( "INSERT INTO RecipeImages(repice_id, image_url, description) VALUES (:recipe_id, :image_url, :description");
                    $stmt = $conn->prepare($sqlImages);
                    $smtmt->bindParam(":recipe_id", $recipe_id );
                    $smtmt->bindParam(":image_url", $image_entry );
                    $smtmt->bindParam(":description", $description );

                    if($stmt->execute()){
                        echo "Successful image upload";
                        exit();
                    }else{
                        $errorMessage = "Failed to load image into database";
                    }
                }
            }catch(PDOException $e){
                $errorMessage = "Failed to load recipe into databse";
            }
        }
    }else{
        $errorMessage = "Something went wrong";
    }
    }
}

?>