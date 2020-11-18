<?php
include '../../admin/connect.php';
include '../functions/functions.php';

$raport = array();
if(isset($userId)){
    if(isset($_POST["item_id"])) {
        if($_POST["action"] == "add") {
            $item = getItemData($_POST["item_id"]);  
            if(isset($_SESSION["shopping_cart"])) {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                    if($_SESSION["shopping_cart"][$keys]['item_id'] == $_POST["item_id"]) {  
                        $is_available++;  
                        $_SESSION["shopping_cart"][$keys]['item_quantity'] = $_SESSION["shopping_cart"][$keys]['item_quantity'] + $_POST["item_quantity"];  
                    }  
                }  
                if($is_available < 1) {  
                    $item_array = array(  
                        'item_id'         =>     $_POST["item_id"],
                        'item_image'      =>     $item['item_image'],
                        'item_name'       =>     $item['item_name'],
                        'item_price'      =>     $item['price'],  
                        'item_quantity'   =>     $_POST["item_quantity"]  
                    );  
                    $_SESSION["shopping_cart"][] = $item_array;  
                }  
            } else {  
                $item_array = array(  
                    'item_id'         =>     $_POST["item_id"],
                    'item_image'      =>     $item['item_image'],
                    'item_name'       =>     $item['item_name'],
                    'item_price'      =>     $item['price'],  
                    'item_quantity'   =>     $_POST["item_quantity"]  
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
            }  

            $raport = array(
                'status' => 'success',
                'data' => count($_SESSION["shopping_cart"])
            );
            echo json_encode($raport);
        }

        if($_POST["action"] == "quantity_change") {
            $total = 0;
            $new_price = 0;  
            foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                if($_SESSION["shopping_cart"][$keys]['item_id'] == $_POST["item_id"]) {  
                    $_SESSION["shopping_cart"][$keys]['item_quantity'] = $_POST["quantity"]; 
                    $new_price = number_format($_POST["quantity"] * $values["item_price"], 2); 
                }
            }  
            foreach($_SESSION["shopping_cart"] as $keys => $values) { 
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            $prices = array(
                'status' => 'success',
                'item_price' => $new_price,
                'total_price' => number_format($total, 2)
            );
            echo json_encode($prices);
        }  

        if($_POST["action"] == "remove") { 
            $total = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                if($values["item_id"] == $_POST["item_id"]) {  
                    unset($_SESSION["shopping_cart"][$keys]); 
                }
            }  
            foreach($_SESSION["shopping_cart"] as $keys => $values) { 
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }

            $raport = array(
                'status' => 'success',
                'data' => count($_SESSION["shopping_cart"]),
                'total_price' => number_format($total, 2)
            );
            echo json_encode($raport);
        }

        if($_POST["action"] == "get_qty") {  
            foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                if($_SESSION["shopping_cart"][$keys]['item_id'] == $_POST["item_id"]) {  
                    echo $_SESSION["shopping_cart"][$keys]['item_quantity'];  
                }  
            }  
        }
    }
    
    if(isset($_POST['empty_cart'])){
        unset($_SESSION["shopping_cart"]);
    }

}else {
    $raport = array(
        'status' => 'error'
    );
    echo json_encode($raport);
}
?>