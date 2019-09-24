<?php    
    include("db.php");

    $product_title          = $_GET["product_title"];
    $product_characteristic = $_GET["product_characteristic"];
    $product_provider       = $_GET["product_provider"];
    $contact_person         = $_GET["contact_person"];
    $contact_tell_number    = $_GET["contact_tell_number"];
    $site                   = $_GET["site"];
    $product_weight         = $_GET["product_weight"];
    $product_volume         = $_GET["product_volume"];
    $product_price          = $_GET["product_price"];

    $response["status"] = false;
    $response["data"]   = null;


    if (isset($product_title)) {

        echo $product_title;


        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = 'INSERT INTO `products_table` (`product_title`, `product_characteristic`, 
                                                                `product_provider`, `contact_person`, `contact_tell_number`, 
                                                                `site`, `product_weight`, `product_volume`, `product_price`) 
                                                VALUES ('.$product_title.','.$product_characteristic.','.$product_provider.','
                                                         .$contact_person.','.$contact_tell_number.','.$site.','
                                                         .$product_weight.','.$product_volume.','.$product_price.')';

        if (mysqli_query($db, $query)) {
            $response["data"] = "Product added successfully";
            $response["status"] = true;
        } else {
            $response["data"] = "Error additing record: " . mysqli_error($db);
        }
    } 

    echo json_encode($response);


?>



