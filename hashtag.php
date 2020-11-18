<?php
ob_start();

if(isset($_GET['tag']) && !empty($_GET['tag'])) {

    $pageTitle = '#' . $_GET['tag'] . ' - recherche iWatch';
    include 'init.php';

    ?>
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-10">
                <div class="card-deck-head head-secondary">
                    <h2 class="card-deck-head-text">Les Montres de hashtag <a href="hashtag.php?tag=<?php echo $_GET['tag'] ?>">#<?php echo $_GET['tag'] ?></a></h2>
                </div>
                <div id="hashtag_items_loading" class="card-deck secondary-cd">
                    <?php
                    $hashtagItems = getHashtagItems($_GET['tag']);
                    if(count($hashtagItems) > 0) {
                        foreach ($hashtagItems as $hashtagItem) {
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card text-center">
                                <?php if ($hashtagItem['add_date'] == date("Y-m-d")) { ?>
                                    <img class="img-responsive new" src="layout/images/new.png" alt="new item">
                                <?php } ?>
                                <div class="price"><?php echo $hashtagItem['price'] ?><span> DZD</span></div>
                                <img id="myImg" class="img-responsive card-img-top" 
                                    src="data/uploads/images/items/<?php echo $hashtagItem['item_image'] ?>" 
                                    alt="<?php echo $hashtagItem['item_name'] ?>">
                                <div class="card-body">
                                    <a href="item.php?item_id=<?php echo $hashtagItem['item_id'] ?>">
                                        <h5 class="card-title"><?php echo $hashtagItem['item_name'] ?></h5>
                                    </a>
                                    <?php echo rating($hashtagItem['item_rating']) ?> 
                                </div>
                                <div class="card-footer">
                                    <div class="card-btns">
                                        <a href="item.php?item_id=<?php echo $hashtagItem['item_id'] ?>" 
                                        class="view" 
                                        title="Voir" 
                                        role="button">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <?php
                                        if (isset($userId) && $hashtagItem['member_id'] !== $userId){
                                            echo '<input type="hidden" name="quantity" id="quantity'.$hashtagItem['item_id'].'" value="1" /> 
                                                  <a href="#" data-atc="'.$hashtagItem['item_id'].'" class="add_to_cart" title="Ajouter au panier" role="button"><i class="fa fa-cart-plus"></i></a>'; }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }else{
                        echo 'No Montres avec ce tag';
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
                            id="cat_min_price" 
                            name="min_price" />
                        <span id="price_range"></span>
                    </div>
                    <div class="form-group filter-option">
                        <h5>filtrer selon le nom:</h5>
                        <input type="text" class="filter-name" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{
    $pageTitle = 'Page non trouvée';
    include 'init.php';
    echo 'there is an error' ; 
}

include $tpl . 'footer.php';
ob_end_flush();
?>