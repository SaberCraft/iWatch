<?php
include '../../admin/connect.php';
include '../functions/functions.php';

if (isset($_POST['item_id']) && !empty($_POST['item_id']) && is_int($_POST['item_id'])){

    $itemId = $_POST['item_id'];

    $query = "SELECT * FROM comments WHERE parent_cmt_id = '0' AND item_id = $itemId ORDER BY cmt_id DESC";
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll();
    $count = $statement->rowCount();
    $output = '';

    if ($count > 0){
        foreach($result as $cmt){

            if (isset($userId)) { 

                $likeAndReplyBtns = '<a href="#" class="like" data-id="'.$cmt["cmt_id"].'" role="button">J\'aime</a>
                                     <span role="presentation" aria-hidden="true"> · </span>
                                     <a href="#" class="reply" data-id="'.$cmt["cmt_id"].'" role="button">Répondre</a>
                                     <span role="presentation" aria-hidden="true"> · </span>';

                if ($cmt['member_id'] == $userId) {
                    $cmtOptions = '<div class="cmt-options">
                                    <div class="dropdown show">
                                        <a class="cmt-opts-btn" href="#" role="button" id="cmt_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="cmt_options">
                                            <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                    </div>';
                }else{
                    $cmtOptions = '<div class="cmt-options">
                    <div class="dropdown show">
                        <a class="cmt-opts-btn" href="#" role="button" id="cmt_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="cmt_options">
                        <a class="dropdown-item" href="#"><i class="fa fa-times-circle"></i> Masquer</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-exclamation-triangle"></i> Signaler</a>
                        </div>
                    </div>
                    </div>';
                }
                
            }else {
                $likeAndReplyBtns = '';
                $cmtOptions = '';
            }

            $output .= '
                <div class="comment-section-container" id="row'.$cmt["cmt_id"].'">
                    <div class="comment-section-author">
                        <img class="img-fluid avatar" src="data/uploads/images/profiles/'.getCFT('user_image', 'users', 'user_id', $cmt['member_id']).'" alt="">
                        <div class="comment-section-name">
                            <p class="comment-author"><a href="member.php?mId='.$cmt['member_id'].'">'.getCFT('user_name', 'users', 'user_id', $cmt['member_id']).'</a></p>
                            <div class="comment-section-text">
                                <p>'.$cmt['comment'].'</p>
                            </div>
                        </div>
                        ' . $cmtOptions . '
                    </div>
                    <div class="comment-section-option">
                        ' . $likeAndReplyBtns . '
                        <span class="comment-time">
                            <a href="#">
                                <abbr class="livetimestamp" title="'.$cmt['cmt_date'].'" data-minimize="true" data-shorten="true">
                                    <span class="text-muted timestampContent">'.$cmt['cmt_date'].'</span>
                                </abbr>
                            </a>
                        </span>
                    </div>
                    '.get_reply_comment($db, $cmt["cmt_id"]).'
                </div>
            ';
        }
    }else {
        $output = '<div class="alert alert-light" role="alert">Pas de commentaires<div>';
    }
    echo $output;
}

function get_reply_comment($db, $parent_id){

    global $db;
    global $userId;

    $query = "SELECT * FROM comments WHERE parent_cmt_id = $parent_id ORDER BY cmt_id ASC";
    $statement = $db->prepare($query);
    $statement->execute();
    
    $result = $statement->fetchAll();
    $count = $statement->rowCount();

    $output = '';
    $style = 'margin-left: 80px; padding-top: 10px;';
    $avatar = 'img-fluid reply-avatar';

    if($count > 0){
        foreach($result as $cmt){

            if (isset($userId)) {

                $likeAndReplyBtns ='<a href="#" class="like" data-id="'.$cmt["cmt_id"].'" role="button">J\'aime</a>
                                    <span role="presentation" aria-hidden="true"> · </span>
                                    <a href="#" class="reply" data-id="'.$parent_id.'" data-member="'.getCFT('user_name', 'users', 'user_id', $cmt['member_id']).'" role="button">Répondre</a>
                                    <span role="presentation" aria-hidden="true"> · </span>';

                if ($cmt['member_id'] == $userId) {
                    $cmtOptions = '<div class="cmt-options">
                                    <div class="dropdown show">
                                        <a class="cmt-opts-btn" href="#" role="button" id="cmt_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="cmt_options">
                                            <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Modifier</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                    </div>';
                }else{
                    $cmtOptions = '<div class="cmt-options">
                    <div class="dropdown show">
                        <a class="cmt-opts-btn" href="#" role="button" id="cmt_options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="cmt_options">
                        <a class="dropdown-item" href="#"><i class="fa fa-times-circle"></i> Masquer</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-exclamation-triangle"></i> Signaler</a>
                        </div>
                    </div>
                    </div>';
                }
                
            }else {
                $likeAndReplyBtns = '';
                $cmtOptions = '';
            }

            $output .= '
                <div class="comment-section-container" style="'.$style.'">
                    <div class="comment-section-author">
                        <img class="'.$avatar.'" src="data/uploads/images/profiles/'.getCFT('user_image', 'users', 'user_id', $cmt['member_id']).'" alt="">
                        <div class="comment-section-name">
                            <p class="comment-author"><a href="member.php?mId='.$cmt['member_id'].'">'.getCFT('user_name', 'users', 'user_id', $cmt['member_id']).'</a></p>
                            <div class="comment-section-text">
                                <p>'.$cmt['comment'].'</p>
                            </div>
                        </div>
                        ' . $cmtOptions . '
                    </div>
                    <div class="comment-section-option reply-cso">
                        ' . $likeAndReplyBtns . '
                        <span class="comment-time">
                            <a href="#">
                                <abbr class="livetimestamp" title="'.$cmt['cmt_date'].'" data-minimize="true" data-shorten="true">
                                    <span class="text-muted timestampContent">'.$cmt['cmt_date'].'</span>
                                </abbr>
                            </a>
                        </span>
                    </div>
                </div>
            ';
        }
    }
    return $output;
}

?>