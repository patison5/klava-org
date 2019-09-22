<?php
    
    include("db.php");

    $response["status"] = false;
    $response["data"]   = null;

    $data = array();
    $resarr = array();

    if (isset($_POST['search_value'])) {

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = mysqli_query($db,"SELECT * FROM `products_table`
                                            WHERE `product_title`           LIKE '%".$_POST["search_value"]."%'
                                               OR `product_characteristic`  LIKE '%".$_POST["search_value"]."%'
                                               OR `product_provider`        LIKE '%".$_POST["search_value"]."%'
                                               OR `contact_person`          LIKE '%".$_POST["search_value"]."%'
                                               OR `contact_tell_number`     LIKE '%".$_POST["search_value"]."%'
                                               OR `site`                    LIKE '%".$_POST["search_value"]."%'
                                               OR `product_weight`          LIKE '%".$_POST["search_value"]."%'
                                               OR `product_volume`          LIKE '%".$_POST["search_value"]."%'
                                               OR `product_price`           LIKE '%".$_POST["search_value"]."%'");





        

        if ($query->num_rows > 0) {
            while($row = $query->fetch_assoc()) {
                array_push($resarr, $row);
            }

            $response["data"]   = $resarr;
        }
    } 

    

    echo json_encode($response);
?>