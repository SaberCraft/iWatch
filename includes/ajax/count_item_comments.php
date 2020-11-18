<?php
include '../../admin/connect.php';
include '../functions/functions.php';

if (isset($_POST['item_id'])) {

    $itemId = $_POST['item_id'];

    echo countRows('cmt_id', 'comments', 'item_id', '=', $itemId);

}