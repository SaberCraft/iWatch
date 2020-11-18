<?php
include '../../admin/connect.php';

$error = '';
if(isset($_POST["comment_content"])) {

    $mId = $_POST['member_id'];

    $error = 'ok';
    $comment_content = filter_var($_POST["comment_content"], FILTER_SANITIZE_STRING);

    $query = "
    INSERT INTO comments 
    (parent_cmt_id, comment, item_id, member_id) 
    VALUES (:parent_cmt_id, :comment, :Iid, :Mid)
    ";
    $statement = $db->prepare($query);
    $statement->execute(
    array(
    ':parent_cmt_id' => $_POST["comment_id"],
    ':comment'    => $comment_content,
    ':Iid'    => $_POST["item_id"],
    ':Mid'    => $_POST["member_id"]
    )
    );
}

$data = array(
    'error'  => $error
   );
   
echo json_encode($data);
?>