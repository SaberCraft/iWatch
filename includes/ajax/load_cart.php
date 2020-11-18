<?php
session_start();

if(isset($_POST['cart_dropdown'])) {

    $output = array();
    $cart_content = '';
    $total = number_format("0", 2);

    if(!empty($_SESSION["shopping_cart"])) {    
        foreach($_SESSION["shopping_cart"] as $keys => $values) {  
            $cart_content .= '  
                <div class="shopping-cart-item">
                    <img class="img-shopping-cart" src="data/uploads/images/items/'.$values["item_image"].'">
                    <div class="shopping-cart-item-name">
                        <a href="cart.php#IC_row_'.$values["item_id"].'" class="item-name">'.$values["item_name"].'</a>
                        <div class="cart-item-info">
                            <p class="shopping-cart-title">Prix: <span class="price">'.number_format($values["item_price"], 2).' DZD</span></p>
                            <p class="quantity text-muted">Quantité: '.$values["item_quantity"].'</p>
                        </div>
                    </div>
                    <a href="#" class="remove_item_cart" id="IC'.$values["item_id"].'" role="button"><i class="fa fa-close"></i></a>
                </div>
            ';  
            $total = $total + number_format($values["item_quantity"] * $values["item_price"], 2);  
        }            
    }else{
        $cart_content = '<div class="alert alert-warning">Votre panier est vide.</div>';
    } 

    $output = array(  
        'cart_content' => $cart_content, 
        'cart_count'   => count($_SESSION["shopping_cart"]), 
        'cart_total'   => $total 
    ); 

    echo json_encode($output);

}
?>