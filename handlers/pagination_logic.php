<?php 
$errorMessage = "";

    function  pagination_logic($conn, $recipeTable, $recipe_pagination){
    // this would be able to get cur page number (idk if using GET || POST is better( sticking with GET for now))
    $curPage = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
    $startPage = ($curPage - 1) *  $recipe_pagination;
    
    try{
    // trying to get the total of recipes in the db and using that to
    $count = " SELECT COUNT(*) as total FROM $recipeTable";
    $countStatem = $conn->prepare($count);
    $countStatem->execute();
    $totalRecipes = $countStatem->fetch((PDO::FETCH_ASSOC))['total'] ;
    $total_displayPage = ($totalRecipes / $recipe_pagination);

    return[
        'curPage' => $curPage,
        'startPage' => $startPage,
        'total_displayPage' => $total_displayPage,
        'recipe_pagination' => $recipe_pagination,

    ];
    }catch(PDOException $e){
        $errorMessage = "Database error" . $e->getMessage();
        echo $errorMessage;
    }
    }
?>