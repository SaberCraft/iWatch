<?php
ob_start();
$pageTitle = 'iWatch';
include 'init.php';
?>
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-md-10">
            <div class="card-deck-head head-primary">
                <h1 class="card-deck-head-text">Nos Nouvelles Montres</h1>
            </div>
            <div id="newest_items_loading" class="card-deck primary-cd">
                <?php
                $items = getAllItems();
                if(count($items) > 0) {
                    foreach ($items as $item) {
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
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
                                <div class="rating">
                                <?= rating($item['item_rating']); ?>
                                </div>
                                <?php
                                /*echo '
                                    <form action="stripeAPI.php?id='.$item['item_id'].'" method="POST">
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_6PC43xg5lp7PH1S1SUil0xuG"
                                            data-amount="'.$item['price'].'"
                                            data-name="'.$item['item_name'].'"
                                            data-description="'.$item['item_description'].'"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto">
                                        </script>
                                    </form>
                                    ';*/
                                ?>  
                            </div>
                            <div class="card-footer">
                                <div class="card-btns">
                                    <a href="item.php?item_id=<?php echo $item['item_id'] ?>" 
                                    class="view" 
                                    title="Voir" 
                                    role="button">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <input type="hidden" id="quantity<?php echo $item['item_id']; ?>" value="1" /> 
                                    <a href="#" id="ATC-btn<?php echo $item['item_id']; ?>" onclick="addToCart(event, <?php echo $item['item_id']; ?>)" title="Ajouter au panier" role="button">
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
                        id="all_filter_price" 
                        name="min_price" />
                    <span id="price_range"></span>
                </div>
                <div class="form-group filter-option">
                    <h5>filtrer selon le nom:</h5>
                    <input type="text" id="all_filter_name" class="filter-name" />
                    <span id="name_filter_result"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

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
                    $('#ATC-btn'+item_id).html('<i class="fa fa-check"></i>');
                } else {
                    $("body").addClass('confirmation');
                    bootbox.confirm({
                        message: "Connectez-vous en premier",
                        buttons: {
                            confirm: {
                                label: 'D\'accord',
                                className: 'btn-danger'
                            },
                            cancel: {
                                label: 'plus tard',
                                className: 'btn-secondary'
                            }
                        },
                        callback: function (result) {
                            if(result == true) {
                                window.location = 'login.php';
                            }
                        }
                    });
                }
                 
            }  
        }); 
        event.preventDefault();
    }
</script>