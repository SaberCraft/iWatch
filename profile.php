<?php
ob_start();

$pageTitle = 'Profil';
include 'init.php';

if(isset($userId)) {

// Get User Data From database
$user = getUserData($userId);

// Get User Items 
$items = getUserItems($userId);

?>

<div class="container-fluid">
    <div id="dialog"></div>
	<div class="row">
		<div class="col-md-2">
			<div class="user-card">
				<div class="text-center">
					<a href="#" role="button">
                        <?php
                        if ($user['trust_status'] == 1) {
                            echo '<div class="trust">';
                                echo '<i class="fa fa-check-circle"></i>';
                            echo '</div>';
                        }
                        ?>
                        <img src="data/uploads/images/profiles/<?php echo $user['user_image'] ?>" class="img-fluid img-thumbnail rounded-circle" alt="Image de profil">
                    </a>
					<h4><?php echo $_SESSION['user'] ?></h4>
					<small>rejoint : <span class="text-muted"><?php echo $user['date'] ?></span></small>
				</div>
				<hr>
				<div class="user-info">E-mail: <span class="text-muted "><?php echo $user['user_email'] ?></span></div>
				<div class="user-info">Nom: <span class="text-muted"><?php echo $user['full_name'] ?></span></div>
                
			</div>
		</div>
		<div id="UserItems" class="col-md-10 user-items">
			<div class="items-head">
				<span class="title">Vos articles</span>
                <?php
                if(count($items) > 0) {
                ?>
                <div class="hover-dropdown item-settigs">
                    <a class="itemsbtn" href="#" role="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="triangle-up user-items-tri"></div>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" id="newAdBtn" data-toggle="modal" href="#" role="button">Ajouter</a>
                        <a class="dropdown-item" href="#" id="filtrer" role="button">Filtrer</a>
                        <a class="dropdown-item" href="#">Supprimer tout</a>
                    </div>
                </div>
                <?php
                }
                ?>

			</div>
			<div id="user_items_loading" class="card-deck pink-cd">
                
            </div>
		</div>
		<div id="userItems">
			<div id="userFiltration" class="filtration hide" style="margin-left: -15px;">
                <span id="closeFilter"><i class="fa fa-close"></i></span>
                <h1 class="text-center">Filtration</h1>
                <div class="filter-option">
                    <h5>filtrer selon le prix:</h5>
                    <input type="range" 
                           min="5000" 
                           max="100000" 
                           value="50000" 
                           step="500" 
                           class="price-slider" 
                           id="user_filter_price" 
                           data-userid="<?php echo $userId; ?>" />
                    <span id="price_range"></span>
                </div>
                <div class="form-group filter-option">
                    <h5>filtrer selon le nom:</h5>
                    <input type="text" id="user_filter_name" class="filter-name" data-userid="<?php echo $userId; ?>" />
                    <span id="name_filter_result"></span>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row" style="margin-top: 15px;">
        
    </div>
</div>

<!-- Start Modals -->

<!-- Start New Aricle Modal -->
<div class="modal fade" id="newAd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 850px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter nouvelle Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="newAdMessage" class="row">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p>les champs avec (<i class="fa fa-asterisk"></i>) sont obligatoires</p>
                            <form id="newad-form" role="form">

                                <input type="hidden" name="ad_member" value="<?php echo $userId ?>">

                                <div class="form-group form-group-lg">
                                    <label class="col-md-3 control-label">Nom: <i class="fa fa-asterisk"></i></label>
                                    <div class="col-md-12">
                                        <input
                                            type="text"
                                            class="form-control live-name"
                                            id="ad_name"
                                            name="ad_name"
                                            placeholder="Nom de l'article">
                                    </div>
                                </div>

                                <div class="form-group form-group-lg">
                                    <label class="col-md-3 control-label">Description:</label>
                                    <div class="col-md-12">
                                        <textarea
                                            class="form-control"
                                            name="ad_desc"
                                            rows="3"
                                            placeholder="Description de l'article"></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-group-lg">
                                    <label class="col-md-3 control-label">Fabriqué en:</label>
                                    <div class="col-md-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="ad_made"
                                            placeholder="Pays de fabrication">
                                    </div>
                                </div>

                                <div class="form-group form-group-lg">
                                    <label class="col-md-3 control-label">Prix: <i class="fa fa-asterisk"></i></label>
                                    <div class="col-md-12">
                                        <input
                                            type="text"
                                            class="form-control live-price"
                                            id="ad_price"
                                            name="ad_price"
                                            placeholder="Le prix doit être en DA">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Catégorie: <i class="fa fa-asterisk"></i></label>
                                            <div class="col-md-12">
                                                <select class="form-control" id="ad_cat" name="ad_cat">
                                                    <option value="0">...</option>
                                                    <?php
                                                        $stmt = $db->prepare("SELECT cat_id, cat_name FROM categories ORDER BY cat_id DESC");
                                                        $stmt->execute();
                                                        $cats = $stmt->fetchAll();

                                                        foreach($cats as $cat) {
                                                            echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">L'état: <i class="fa fa-asterisk"></i> </label>
                                            <div class="col-md-12">
                                                <select class="form-control" id="ad_status" name="ad_status">
                                                    <option value="0">...</option>
                                                    <option value="1" >Nouveau</option>
                                                    <option value="2" >Comme neuf</option>
                                                    <option value="3" >Utilisé</option>
                                                    <option value="4" >Ancien</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group form-group-lg">
                                    <label class="col-md-3 control-label">Tags: </label>
                                    <div class="col-md-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="ad_tags"
                                            data-role="tagsinput"
                                            placeholder="Ajouter tag">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4" style="margin-top: 65px;">
                            <div class="card live-preview">
                                <img class="img-responsive new" 
                                    src="layout/images/new.png" 
                                    alt="new item">
                                <div class="price">0000<span> DZD</span></div>
                                <img id="myImg" class="img-responsive card-img-top" 
                                     src="layout/images/newad.png">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Titre</h5>
                                    <span class="fa fa-star-o"></span>
                                    <span class="fa fa-star-o"></span>
                                    <span class="fa fa-star-o"></span>
                                    <span class="fa fa-star-o"></span>
                                    <span class="fa fa-star-o"></span>
                                </div>
                                <div class="card-footer">
                                    <div class="card-btns">
                                        <a href="#" class="view"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="add_to_cart"><i class="fa fa-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button id="addNewAd" name="addNewAd" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</button>
            </div>
        </div>
    </div>
</div>
<!-- Ends New Aricle Modal -->

<!-- Ends Modal -->
<?php
}else{
	header('location: login.php');
	exit();
}
include $tpl . 'footer.php';
ob_end_flush();
?>