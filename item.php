<?php
ob_start();

$pageTitle = '';
include 'init.php';

if (isset($_GET['item_id']) && !empty($_GET['item_id'])) {
    $itemId = $_GET['item_id'];

    $chekItem = checkItem('item_id', 'items', $itemId);
    $itemApproveStatus = getCFT('approve_status', 'items', 'item_id', $itemId);
    if ($chekItem == 0 || $itemApproveStatus == 0) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }else {
            header('location: index.php');
            exit();
        }
    }else {
        $item = getItemData($itemId);

    ?>

    <div class="container">
        <div class="row item-details" style="padding-top: 20px;">
            <div class="col-md-6 item-galery">
                <img class="img-thumbnail" id="main-img" src="data/uploads/images/items/<?php echo $item['item_image']; ?>">
                <div class="row" style="padding-top: 10px;">
                    <div class="col">
                        <a class="sec-img" data-image="data/uploads/images/items/<?php echo $item['item_image']; ?>">
                            <img class="img-thumbnail active" src="data/uploads/images/items/<?php echo $item['item_image']; ?>">
                        </a>
                    </div>
                    <div class="col">
                        <a class="sec-img" data-image="https://placehold.it/350x350?text=Image+1">
                            <img class="img-thumbnail" src="https://placehold.it/350x350?text=Image+1">
                        </a>
                    </div>
                    <div class="col">
                        <a class="sec-img" data-image="https://placehold.it/350x350?text=Image+2">
                            <img class="img-thumbnail" src="https://placehold.it/350x350?text=Image+2">
                        </a>
                    </div>
                    <div class="col">
                        <a class="sec-img" data-image="https://placehold.it/350x350?text=Image+3">
                            <img class="img-thumbnail" src="https://placehold.it/350x350?text=Image+3">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <h3><?= $item['item_name'] ?> <span style="font-size: 17px;"><?php echo rating($item['item_rating']) ?><span></h3>
            <p><?= $item['item_description'] ?></p>

            <div class="info"> 
                Statut: <span><?= itemStatus($item['item_status']) ?></span>
            </div>
            <div class="info"> 
                Marque: <span>
                <a href="mark.php?markId=<?php echo $item['cat_id'] ?>"><?php echo getCFT('cat_name', 'categories', 'cat_id', $item['cat_id']); ?></a>
                </span>
            </div>
            <div class="info"> 
                Annoncé par: <span>
                <a href="member.php?mId=<?php echo $item['member_id'] ?>"><?php echo getCFT('user_name', 'users', 'user_id', $item['member_id']); ?></a>
                </span>
            </div>
            <div class="info"> 
                Tags: <span>
                <?php
                    $itemTags = explode(",", $item['item_tags']);
                    foreach($itemTags as $itemTag) {
                        $itemTag = trim($itemTag);
                        $itemTag = str_replace(' ', '_', $itemTag);
                        if (!empty($itemTag)) {
                            echo '<a href="hashtag.php?tag='.$itemTag.'" class="item-tag">#'.$itemTag.'</a>';
                        }else{ 
                            echo '<span class="text-muted">Aucun tags</span>';
                        }
                    }
                ?>
                </span>
            </div>
            <div class="info" style="margin-bottom: 10px;"> 
                Vues: <span><span id="item_views"><?= $item['views'] ?><span> vues</span>
            </div>

            <div class="item-price">
                Prix: <span><?php echo $item['price'] ?> DZD</span>
            </div>

            <form>
                
                <div class="form-group">
                    <div class="row">
                        <label for="middle-label" class="col-sm-3 col-form-label">Quantité</label>
                        <div class="col-sm-9">
                            <input type="number" id="quantity<?php echo $item["item_id"]; ?>" class="form-control" min="1" max="9" step="1" value="1" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-danger btn-lg btn-block">Acheter maintenant</a>
                        </div>
                        <div class="col-sm-6">
                            <a  href="#" 
                                onclick="addToCart(event, <?php echo $item['item_id']; ?>);" 
                                class="btn btn-lg btn-block add_to_cart" 
                                role="button">Ajouter au panier
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row lcs">
                <div class="col inf">10 j'aime</div>
                <div class="col inf"><span class="count_item_comments"></span> commentaire</div>
                <div class="col inf">2 partage</div>
            </div>

            <div class="row btn-group lcs" role="group" aria-label="Basic example">
                <div class="col">
                    <a href="#" class="btn" role="button"><i class="fa fa-thumbs-o-up"></i> J'aime</a>
                </div>
                <div class="col">
                    <a href="#" class="btn commenter" role="button"><i class="fa fa-comment-o"></i> Commenter</a>
                </div>
                <div class="col dropdown share-dropdown">
                    <a href="#" class="btn" role="button" id="sharedrdw" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-share"></i> Partager
                    </a>
                    <div class="dropdown-menu social-media" aria-labelledby="sharedrdw">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container" style="margin-top: 20px;">
        
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="true">Les commentaire</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Similaire montres</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Les montre de meme marque</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-comments" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="container item-comments">
                        <?php
                        if(isset($userId)) {
                            $avatar = getCFT('user_image', 'users', 'user_id', $userId);
                            $uId = $userId;
                        ?>
                        <div class="comment-form">
                            <img class="img-fluid img-cf" src="data/uploads/images/profiles/<?php echo $avatar ?>" alt="">
                            <form method="POST" class="comment_form" id="comment_form_0">
                                
                                <input type="text" 
                                    name="comment_content" 
                                    id="comment_content_0" 
                                    class="form-control comment_content" 
                                    placeholder="laissez un commentaire" 
                                    maxlength="2000"
                                    autocomplete="off" />
                                
                                <input type="hidden" name="comment_id" value="0" />
                                <input type="hidden" name="item_id" id="item_id" value="<?php echo $item['item_id'] ?>" />
                                <input type="hidden" name="member_id" id="member_id" value="<?php echo $uId ?>" />
                            </form>
                        </div>
                        <br />
                        <?php
                        }
                        ?>
                        <h3><i class="fa fa-comments"></i> Commentaires (<span class="count_item_comments"></span>)</h3>
                        <div id="display_item_comments"></div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">2</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">3</div>
            </div>
        </div>        
    </div>
    
    <?php
}
}else {
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
$(document).ready(function() {
  
    $(document).on('click', '.reply', function(e){
        e.preventDefault();
        var button_id = $(this).data('id');
        var avatar = $('.comment-form img').attr('src');
        var item_id = $('#item_id').val();
        var member_id = $('#member_id').val();
        var replyTo = $(this).data('member');

        $('#row'+button_id+'').children('.comment-form').remove();
        if (replyTo) {
            var pos = replyTo.length + 1;
            $('#row'+button_id+'').append('<div class="comment-form replay-comment-form"><img class="img-fluid img-rcf" src="'+avatar+'" alt=""><form method="POST" class="comment_form" id="comment_form_'+button_id+'"><input type="text" name="comment_content" id="comment_content_'+button_id+'" class="form-control comment_content" value="'+replyTo+' " placeholder="laissez un commentaire" maxlength="2000" autocomplete="off" /><input type="hidden" name="comment_id" value="'+button_id+'" /><input type="hidden" name="item_id" value="'+item_id+'" /><input type="hidden" name="member_id" value="'+member_id+'" /></form></div>');
            setCaretToPos($('#comment_content_'+button_id+'')[0], pos);
        }else {
            $('#row'+button_id+'').append('<div class="comment-form replay-comment-form"><img class="img-fluid img-rcf" src="'+avatar+'" alt=""><form method="POST" class="comment_form" id="comment_form_'+button_id+'"><input type="text" name="comment_content" id="comment_content_'+button_id+'" class="form-control comment_content" placeholder="laissez un commentaire" maxlength="2000" autocomplete="off" /><input type="hidden" name="comment_id" value="'+button_id+'" /><input type="hidden" name="item_id" value="'+item_id+'" /><input type="hidden" name="member_id" value="'+member_id+'" /></form></div>');
            $('#comment_content_'+button_id+'').focus();
        }
    });
      
    $(document).on('submit', '.comment_form', function(event){
        event.preventDefault();
        //var form_id = $(this).attr('id');
        //var parent_id = form_id.split("_").pop();
        var form_data = $(this).serialize();
        $.ajax({
            url:"includes/ajax/add_comment.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success: function(data) {
                if(data.error != '') {
                    $('.comment_form')[0].reset();
                    /*if(parent_id > 0) {
                        load_item_reply_comments(''+parent_id+'');
                    }else {
                        load_item_comments();
                    }*/
                    count_item_comments();
                    load_item_comments();
                }
            }
        });
    });

    count_item_comments();


    load_item_comments();


    $(document).on('click', '.commenter', function(e) {
        e.preventDefault();
        $('#comment_content_0').focus();
    });

    /*setInterval(function(){
        load_item_comments();;
    }, 1000);*/

    UpViews();

});

// Update Views
    function UpViews() {
        var itemId = $.urlParam('item_id');
        $.ajax({
            url:"includes/ajax/fetch_item_views.php",
            data: {item_id: itemId},
            method:"POST",
            success:function(data) {
                $('#item_views').text(data);  
            }
        });
    }

    function load_item_comments() {
        var itemId = $.urlParam('item_id');
        //var cmtsCount = $('#count_item_comments').data('count');
        $('#display_item_comments').html('<span><img src="layout/images/loader.gif" class="loader" /></span>');
        $.ajax({
            url:"includes/ajax/fetch_item_comments.php",
            data: {item_id: itemId},
            method:"POST",
            //dataType: "JSON",
            success:function(data) {
                $('#display_item_comments').html(data);  
            }
        });
    }

    function count_item_comments() {
        var itemId = $.urlParam('item_id');
        $.ajax({
            url:"includes/ajax/count_item_comments.php",
            data: {item_id: itemId},
            method:"POST",
            success:function(data) {
                //$('#count_item_comments').attr('data-count', data);
                $('.count_item_comments').text(data);
            }
        });
    }

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

    function setSelectionRange(input, selectionStart, selectionEnd) {
        if (input.setSelectionRange) {
          input.focus();
          input.setSelectionRange(selectionStart, selectionEnd);
        } else if (input.createTextRange) {
          var range = input.createTextRange();
          range.collapse(true);
          range.moveEnd('character', selectionEnd);
          range.moveStart('character', selectionStart);
          range.select();
        }
      }
      
    function setCaretToPos(input, pos) {
        setSelectionRange(input, pos, pos);
    }

</script>