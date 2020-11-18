<?php
include '../../admin/connect.php';
include '../functions/functions.php';
 
if(isset($userId) && isset($_POST['view'])){
 
  $query = "SELECT * FROM items WHERE approve_status = 1 AND member_id = $userId";
  $statement = $db->prepare($query);
  $statement->execute();
  $userItems = $statement->fetchAll();
  $countUserItems = $statement->rowCount();

  if($countUserItems > 0){

    foreach($userItems as $userItem){

      $itemId = $userItem['item_id'];

      if($_POST["view"] != ''){
        $update_query = "UPDATE comments SET comment_status = 1 WHERE item_id = $itemId AND comment_status = 0";
        $statement = $db->prepare($update_query);
        $statement->execute();
      }

    }
 
    foreach($userItems as $userItem){
      $itemId = $userItem['item_id'];

      $query = "SELECT * FROM comments WHERE item_id = $itemId AND member_id != $userId ORDER BY cmt_id DESC LIMIT 5";
      $statement = $db->prepare($query);
      $statement->execute();
      $itemComments = $statement->fetchAll();
      $countiItemComments = $statement->rowCount();
      $output = '';

      if($countiItemComments > 0){
 
        foreach($itemComments as $itemComment){
          $output .= '
            <a class="dropdown-item" href="#">
              '.getCFT('user_name', 'users', 'user_id', $itemComment['member_id']).' a commenté votre article 
              '.getCFT('item_name', 'items', 'item_id', $itemComment['item_id']).'
            </a>
            <div class="dropdown-divider"></div>
          ';
        }

      }
    }
  
    foreach($userItems as $userItem){
      $itemId = $userItem['item_id'];

      $status_query = "SELECT * FROM comments WHERE item_id = $itemId AND member_id != $userId AND comment_status = 0";
      $statement = $db->prepare($status_query);
      $statement->execute();
      $count = $statement->rowCount();
    }
 
    $data = array(
      'comment_item_notifs' => $output,
      'unseen_comment_item_notifs'  => '5'
    );
 
    echo json_encode($data);

  }

}
?>