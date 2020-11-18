<?php
session_start();

if(isset($_GET['load_cart'])){

        $cart_header = isset($_SESSION["shopping_cart"])
        ? '<span class="cart-count">'.count($_SESSION["shopping_cart"]).'</span> article dans le panier'
        : '0 article dans le panier';

    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0) { 
        
        $cart_items = '';
        $total = 0;  
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
        $cart_items .= '
            <tr id="IC_row_'.$values["item_id"].'">  
                <td><img src="data/uploads/images/items/'.$values["item_image"].'" alt="" class="img-fluid"></td> 
                <td><a href="item.php?item_id='.$values["item_id"].'" class="item-title">'.$values["item_name"].'</a></td>  
                <td><input type="number" id="IC_qty_'.$values["item_id"].'" class="IC_qty" onChange="CQOIC(this.value, '.$values["item_id"].')" onKeyup="CQOIC(this.value, '.$values["item_id"].')"  value="'.$values["item_quantity"].'" min="1" /></td>  
                <td align="right">'.number_format($values["item_price"], 2).' DZD</td>  
                <td align="right"><span id="ICTP_'.$values["item_id"].'">'. number_format($values["item_quantity"] * $values["item_price"], 2) .'</span> DZD</td>  
                <td align="center"><button class="btn btn-outline-danger btn-sm rfc" onClick="RFC(event, '.$values["item_id"].')"><i class="fa fa-close"></i></button></td>  
            </tr>
        '; 
            $total = $total + ($values["item_quantity"] * $values["item_price"]);  
        }

        $cart_body = '
            <div class="table-responsive cart-centent" id="order_table">  
                <table class="table table-bordered">  
                    <tr>  
                        <th width="10%">Article image</th>
                        <th width="35%">Article Nom</th>  
                        <th width="15%">Quantity</th>  
                        <th width="10%">Prix</th>  
                        <th width="15%">Total</th>  
                        <th width="5%">Action</th>  
                    </tr> 
                    '.$cart_items.' 
                    <tr>  
                            <td colspan="4" align="right">Total</td>  
                            <td align="right"><span id="CTP">'.number_format($total, 2).'</span> DZD</td>  
                            <td align="center"> 
                                <button id="empty_cart" class="btn btn-danger btn-sm">Vider le panier</button>
                            </td>  
                    </tr>  
                    <tr>  
                            <td colspan="6" align="center">  
                                <form method="post" action="cart.php">  
                                    <input type="submit" name="place_order" class="btn btn-warning place-order" value="Passer la commande" />  
                                </form>  
                            </td>  
                    </tr>  
                </table>  
            </div>
        ';
    }else{
        $cart_body = '
        <div id="empty-cart">
            <img src="layout/images/empty%20cart.png" alt="empty cart" />
            <div class="alert alert-warning">
                Ooops! Il n’y a aucun article dans votre panier.
                <a href="index.php">Commencez vos achats maintenant !</a>
            </div>
        </div>
        ';
    }

    $cart_content = '
        <div class="row">
            <h2 class="cart-title">
                '.$cart_header.'
            </h2>
        </div>
        <div class="row">
            '.$cart_body.'
        </div>
    ';

    echo $cart_content;
}
?>