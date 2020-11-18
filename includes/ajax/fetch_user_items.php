<?php
include '../../admin/connect.php';
include '../functions/functions.php';

if(isset($userId)) {
    
    // Get User Items 
    $items = getUserItems($userId);

    if(count($items) > 0) {

        $output = '';

        foreach ($items as $item) {
            $new = '';
            if ($item['add_date'] == date("Y-m-d")) {
                $new = '<img class="img-responsive new" src="layout/images/new.png" alt="new item">';
            }
            $approve_status = '';
            if ($item['approve_status'] == 0) {
                $approve_status = '<span class="item-status animate-flicker" title="article non approuvé, contacter l\'administaration"><i class="fa fa-eye-slash"></i></span>';
            }

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
                        ' . rating($item["item_rating"]) . '
                        </div>
                        <div class="card-footer">
                            <div class="card-btns">
                                <a href="item.php?item_id='.$item['item_id'].'" class="view" title="Voir" role="button">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>      
            ';
        }

    }else {
        $output = '<div class="alert alert-warning">vous n\'avez aucun article! Vous aimeriez en additionner un ?<div>
                <a class="btn btn-success" id="newAdBtn" data-toggle="modal" href="#" role="button">Ajouter</a>';
    }
    echo $output;
} 
?>