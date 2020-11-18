<?php
	ob_start();
	
	$pageTitle = 'Les marques';
    include 'init.php';
    
    $getId = $_GET['markId'];
    if (!isset($getId)) {
        header('location: index.php');
        exit();
    }

    $chekCat = checkItem('cat_id', 'categories', $getId);
    $markVisibility = getCFT('cat_visibility', 'categories', 'cat_id', $getId);
    if ($chekCat == 0 || $markVisibility == 0) {
        header('location: marks.php');
        exit();
    }else {
        $cat_name = getCFT('cat_name', 'categories', 'cat_id', $getId);
        $items = getMarkItems($getId);
    
?>
<div class="container-fluid items">
    <div class="row no-gutters">
        <div class="col-md-10">
            <div class="mark-name">
                <img src="data/uploads/images/categories/<?php echo $cat_name ?>.png" 
                     class="img-responsive" 
                     alt="<?php echo $cat_name ?> logo">
            </div>
            <div id="items_loading" class="card-deck secondary-cd">
                <?php
                if(count($items) > 0) {
                    foreach ($items as $item) {
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card text-center">
                            <?php if ($item['add_date'] == date("Y-m-d")) { ?>
                                <img class="img-responsive new" src="layout/images/new.png" alt="new item">
                            <?php } ?>
                            <div class="price"><?php echo $item['price'] ?><span> DZD</span></div>
                            <img id="myImg" class="img-responsive card-img-top" 
                                src="data/uploads/images/items/<?php echo $item['item_image'] ?>" 
                                alt="<?php echo $item['item_name'] ?>">
                            <div class="card-body">
                                <a href="item.php?item_id=<?php echo $item['item_id'] ?>">
                                    <h5 class="card-title"><?php echo $item['item_name'] ?></h5>
                                </a>  
                                <?php echo rating($item['item_rating']) ?>
                            </div>
                            <div class="card-footer">
                                <div class="card-btns">
                                    <a href="item.php?item_id=<?php echo $item['item_id'] ?>" 
                                    class="view" 
                                    title="Voir" 
                                    role="button">
                                    <i class="fa fa-eye"></i>
                                    </a> 
                                    <input type="hidden" name="quantity" id="quantity<?php echo $item['item_id']; ?>" value="1" />
                                    <a href="#" onclick="addToCart(event, <?php echo $item['item_id'] ?>);" class="add_to_cart" title="Ajouter au panier" role="button">
                                        <i class="fa fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-2" style="padding-left: 15px;">
            <div class="filtration fixed">
                <h1 class="text-center">Filtration</h1>
                <div class="filter-option">
                    <h5>filtrer selon le prix:</h5>
                    <input type="range" 
                        min="5000" 
                        max="100000" 
                        value="50000" 
                        step="500" 
                        class="price-slider" 
                        id="cat_filter_price" 
                        name="min_price" />
                    <span id="price_range"></span>
                </div>
                <div class="form-group filter-option">
                    <h5>filtrer selon le nom:</h5>
                    <input type="text" id="cat_filter_name" class="filter-name">
                    <span id="name_filter_result"></span>
                </div>
            </div>
        </div>
    </div>
</div>
	
    
<?php
}
include $tpl . 'footer.php';
ob_end_flush();
?>
<script>
    // Add to cart
    function addToCart(event, id) {
        var item_id = id;
        var item_quantity = $('#quantity'+id).val();
        var action = "add"; 
        $.ajax({  
            url:"includes/ajax/cart_actions.php",  
            method:"POST",
            dataType:"JSON", 
            data:{  
                item_id:item_id,
                item_quantity:item_quantity,  
                action:action  
            },  
            success:function(raport) { 
                if(raport.status == 'success') {
                    $('.cart-count').text(raport.data);
                } else {
                    if(confirm('You Must Login First')) {
                        window.location = 'login.php';
                    }
                }
                 
            }  
        }); 
        event.preventDefault();
    }
</script>