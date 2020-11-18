<?php
include '../../admin/connect.php';
include '../functions/functions.php';

if (isset($_POST['item_id']) && !empty($_POST['item_id']) && is_int($_POST['item_id'])){

    $itemId = $_POST['item_id'];

    $query = "UPDATE items SET views = views + 1 WHERE item_id = $itemId";
    $statement = $db->prepare($query);
    $statement->execute();

    $views = getCFT('views', 'items', 'item_id', $itemId);
    echo $views;

}

?>