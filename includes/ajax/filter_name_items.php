<?php  
 //filter_price_items.php  
 $connect = mysqli_connect("localhost", "root", "", "shop");
 include '../functions/functions.php';  
 if(isset($_POST["name"]))  
 {  
    $output = '';
    if(isset($_POST["catId"])) {
        if(isset($userId)){
            $query = "SELECT * FROM items WHERE cat_id = ".$_POST["catId"]." AND member_id != $userId AND approve_status = 1 AND item_name LIKE '%".$_POST['name']."%' ORDER BY item_name asc";
        }else{
            $query = "SELECT * FROM items WHERE cat_id = ".$_POST["catId"]." AND approve_status = 1 AND item_name LIKE '%".$_POST['name']."%' ORDER BY item_name asc";
        }
    }elseif (isset($_POST["userId"])) {
        $query = "SELECT * FROM items WHERE member_id = ".$_POST["userId"]." AND price <= ".$_POST['price']." ORDER BY price desc";
    }elseif (isset($_POST["memberId"])) {
        $query = "SELECT * FROM items WHERE member_id = ".$_POST["memberId"]." AND approve_status = 1 AND price <= ".$_POST['price']." ORDER BY price desc";
    }else {
        if(isset($userId)){
            $query = "SELECT * FROM items WHERE approve_status = 1 AND member_id != $userId AND item_name LIKE '%".$_POST['name']."%' ORDER BY item_id ASC";
        }else{
            $query = "SELECT * FROM items WHERE approve_status = 1 AND item_name LIKE '%".$_POST['name']."%' ORDER BY item_id ASC";
        }
    } 

    $result = mysqli_query($connect, $query);  
    if(mysqli_num_rows($result) > 0)  
    {  
        while($item = mysqli_fetch_array($result))  
        { 
            $new = '';
            if ($item['add_date'] == date("Y-m-d")) {
                $new = '<img class="img-responsive new" src="layout/images/new.png" alt="new item">';
            }
            $approve_status = '';
            if ($item['approve_status'] == 0 && isset($_POST["userId"])) {
                $approve_status = '<span class="item-status animate-flicker"><i class="fa fa-eye-slash"></i></span>';
            }
            $addcart = '<input type="hidden" name="quantity" id="quantity'.$item['item_id'].'" value="1" /> 
                        <a href="#" onclick="addToCart(event, '.$item['item_id'].');" class="add_to_cart" title="Ajouter au panier" role="button">
                            <i class="fa fa-cart-plus"></i>
                        </a>';
            if (isset($_POST["userId"])) { $addcart = ''; }

            $output .= '
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        ' . $new . '
                        <div class="price">'.$item['price'].'<span> DZD</span></div>
                        ' . $approve_status . '
                        <img id="myImg" class="img-responsive card-img-top" 
                            src="data/uploads/images/items/'.$item['item_image'].'" 
                            alt="'.$item['item_name'].'">
                        <div class="card-body">
                        <a href="item.php?item_id='.$item['item_id'].'">
                            <h5 class="card-title">'.$item['item_name'].'</h5>
                        </a>
                        '.rating($item["item_rating"]).'
                        </div>
                        <div class="card-footer">
                            <div class="card-btns">
                                <a href="item.php?item_id='.$item['item_id'].'" class="view" title="Voir" role="button">
                                    <i class="fa fa-eye"></i>
                                </a>
                                ' . $addcart . '
                            </div>
                        </div>
                    </div>
                </div>      
            ';  
        }  
        $data = array(
            'items'  => $output,
            'count'  => mysqli_num_rows($result)
           );
    }  
    else  
    {  
        $output = "<div class='alert alert-warning '>Il n'y a pas de montre avec ce nom</div>";  
        $data = array(
            'items'  => $output,
            'count'  => mysqli_num_rows($result)
           );
    }  
    echo json_encode($data);  
 }  
 ?>