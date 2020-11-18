<?php
include '../../admin/connect.php';

$msg = '';
if (isset($_POST['addNewAd'])) {

	$ad_name = $_POST['ad_name'];
    $ad_desc = $_POST['ad_desc'];
    $ad_made = $_POST['ad_made'];
    $ad_price = $_POST['ad_price'];
    $ad_cat = $_POST['ad_cat'];
    $ad_status = $_POST['ad_status'];
    $ad_tags = trim($_POST['ad_tags']);
    $ad_member = $_POST['ad_member'];

    $stmt = $db->prepare("INSERT INTO items(item_name, item_description, price, country_made, item_image, item_tags, item_status, member_id, cat_id)
                          VALUES(:zitem, :zdesc, :zprice, :zmade, :zimage, :ztags, :zstatus, :zmid, :zcid)
                        ");

    $stmt->execute(array(
        'zitem'     => $ad_name,
        'zdesc'     => $ad_desc,
        'zprice'    => $ad_price,
        'zmade'     => $ad_made,
        'zimage'    => "newad.png",
        'ztags'     => $ad_tags,
        'zstatus'   => $ad_status,
        'zmid'      => $ad_member,
        'zcid'      => $ad_cat
    ));

    $msg = 'add';
}

?>