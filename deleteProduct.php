<?php    
    include("db.php");
    
    $response["status"] = false;
    $response["data"]   = null;

    if (isset($_POST['products_id'])) {

        $id = $_POST["products_id"];

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = 'DELETE FROM `products_table` WHERE `products_table`.`id` = '.$id;

        if (mysqli_query($db, $query)) {
            $response["data"] = "Record deleted successfully";
            $response["status"] = true;
        } else {
            $response["data"] = "Error deleting record: " . mysqli_error($db);
        }
    } 
    

    echo json_encode($response);
?>