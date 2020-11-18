<?php
ob_start();

if(isset($_GET['mId']) && !empty($_GET['mId'])) {

$mId = $_GET['mId'];

// Connect To Database
include 'admin/connect.php';
$stmt = $db->prepare("SELECT user_name FROM users WHERE user_id = $mId");
$stmt->execute();
$userName = $stmt->fetchColumn();

$pageTitle = $userName;
include 'init.php';
    
$chekUser = checkItem('user_id', 'users', $mId);
$reg_Status = getCFT('reg_status', 'users', 'user_id', $mId);
if ($chekUser == 0 || $reg_Status == 0) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }else {
        header('location: index.php');
        exit();
    }
}else {
// Get User Data From database
$user = getUserData($_GET['mId']);

// Get User Items 
$items = getUserItems($_GET['mId'], 'AND approve_status = 1');

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
					<h4><?php echo $user['user_name'] ?></h4>
					<small>rejoint : <span class="text-muted"><?php echo $user['date'] ?></span></small>
				</div>
				<hr>
				<p class="user-info">E-mail: <span class="text-muted"><?php echo $user['user_email'] ?></span></p>
				<p class="user-info">Nom: <span class="text-muted"><?php echo $user['full_name'] ?></span></p>
                
			</div>
		</div>
		<div id="UserItems" class="col-md-10 user-items">
			<div class="items-head">
				<span class="title">Les articles de <?php echo $user['user_name'] ?></span>
                <?php
                if(count($items) > 0) {
                ?>
                <div class="hover-dropdown item-settigs">
                    <a class="itemsbtn" href="#" role="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="triangle-up user-items-tri"></div>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#" id="filtrer" role="button">Filtrer</a>
                    </div>
                </div>
                <?php
                }
                ?>

			</div>
			<div id="member_items_loading" class="card-deck pink-cd">
                
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
                           id="member_filter_price" 
                           data-memberid="<?php echo $user['user_id']; ?>" />
                    <span id="price_range"></span>
                </div>
                <div class="form-group filter-option">
                    <h5>filtrer selon le nom:</h5>
                    <input type="text" id="member_filter_name" class="filter-name" data-memberid="<?php echo $user['user_id']; ?>" />
                    <span id="name_filter_result"></span>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-10 offset-md-2">
            <div class="row contact">
                <div class="col-md-6">
                    <h3>Contact Me</h3>
                    <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor.</p>
                    <ul class="menu">
                    <li><a href="#">Dribbble</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Yo</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="feild" placeholder="Name">
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="feild" placeholder="Email">
                        </div>
                        <div class="form-group">
                        <label>Message</label>
                        <textarea class="feild" placeholder="holla at a designerd"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Modals -->

<!-- Ends Modal -->
<?php
}
}else{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }else {
        header('location: index.php');
        exit();
    }
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