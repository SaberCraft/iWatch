<?php
session_start();
// Set User Id
if(isset($_SESSION['userId']))
	$userId = $_SESSION['userId'];

// Set the language of page
if(!isset($_SESSION['lang']))
	$_SESSION['lang'] = "fr";
elseif(isset($_POST['lang']) && $_SESSION['lang'] != $_POST['lang']) {
	if ($_POST['lang'] == "fr")
		$_SESSION['lang'] = "fr";
	else if ($_POST['lang'] == "ar")
		$_SESSION['lang'] = "ar";
}
require_once "languages/".$_SESSION['lang'].".php";

	/*
	** Function To Get Categories from Database
	*/
	function getItemData($id)
	{
		global $db;

		$stmt = $db->prepare("SELECT * FROM items WHERE item_id = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	/*
	** Function To Get Categories from Database
	*/
	function getCats()
	{
		global $db;

		$stmt = $db->prepare("SELECT * FROM categories WHERE cat_visibility = 1 ORDER BY cat_id ASC");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
	** Function To Get All Items from Database
	*/
	function getAllItems()
	{
		global $db;
		global $userId;

		$stmt = isset($userId) 
		? $db->prepare("SELECT * FROM items WHERE approve_status = 1 AND member_id != $userId ORDER BY item_id DESC")
		: $db->prepare("SELECT * FROM items WHERE approve_status = 1 ORDER BY item_id DESC") ;
		
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
	** Function To Get The Approve Hashtag items from Database
	** $id = Id Of Catégorie
	*/
	function getHashtagItems($hashtag)
	{
		global $db;

		$stmt = $db->prepare("SELECT * FROM items WHERE item_tags LIKE '%$hashtag%' AND approve_status = 1 ORDER BY item_id DESC");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
	** Function To Get The Approve Catégorie items from Database
	** $id = Id Of Catégorie
	*/
	function getMarkItems($id)
	{
		global $db;
		global $userId;

		$stmt = isset($userId) 
		? $db->prepare("SELECT * FROM items WHERE cat_id = $id AND member_id != $userId AND approve_status = 1 ORDER BY item_id DESC")
		: $db->prepare("SELECT * FROM items WHERE cat_id = $id AND approve_status = 1 ORDER BY item_id DESC");

		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
	** Function To Get User_name from Database
	** $id = Id Of The User
	*/
	function getUserName($id)
	{
		global $db;

		$stmt = $db->prepare("SELECT user_name FROM users WHERE user_id = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	/*
	** Function To Get The All items Of User from Database
	** $id = Id Of The User
	*/
	function getUserData($id)
	{
		global $db;

		$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	/*
	** Function To Get The All items Of User from Database
	** $id = Id Of The User
	*/
	function getUserItems($id, $cond = null)
	{
		global $db;

		$stmt = $db->prepare("SELECT * FROM items WHERE member_id = $id $cond ORDER BY item_id DESC");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
	** Title function that echo the page title in case the page
	** Has the variable $pageTitle and echo default title for other pages 
	*/
	function getTitle() {
		global $pageTitle;
		if (isset($pageTitle)) {
			echo $pageTitle;
		} else {
			echo 'Default';
		}
		
	}

	/*
	** Home Recirect Function [ This Function Accept Parameters ]
	** $Msg = Echo The Error Message
	** $url = The Link You Want To Redirect To
	** $seconds = Seconds Before Redirecting
	*/
	function redirectTo($Msg, $url = null, $seconds = 3) {

		if ($url === null) {
			$url = 'index.php';
			$link = 'la page d\'accueil';
		}else {
			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
			$url = $_SERVER['HTTP_REFERER'];
			$link = 'la page précédente';	
			}else{
			$url = 'index.php';
			$link = 'la page d\'accueil';
			}

		}

		echo $Msg;
		echo "<div class='alert alert-info'>Vous serez redirigé vers $link après $seconds secondes</div>";
		header( "refresh:$seconds;url=$url" );
		exit();
	}

	/*
	** Function To Check Items In Database 
	** $select = The Item To Select
	** $from = The Table To select From
	** $value = The Value Of Select
	*/
	function checkItem($select, $from, $value)
	{
		global $db;

		$statement = $db->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));
		$count = $statement->rowCount();
		return $count;
	}

/*
** Function To Count number of Items In Database
** $select = The Column To Select
** $from = The Table To select From
** $where = The Selector
** $op = The Opiration
** $value = The Value Of Selector
*/
function countRows($select, $from, $where = null, $op = null, $value = null)
{
	global $db;
	
	$stmt = $where === null
	? $db->prepare("SELECT COUNT($select) FROM $from")
	: $db->prepare("SELECT COUNT($select) FROM $from WHERE $where $op $value") ;
    
    $stmt->execute();
    return $stmt->fetchColumn();
}

/*
** Function To Get Latest Items from Database
** $select = The Field To Select
** $from = The Table To select From
** $where = The Selector
** $op = The Opiration
** $value = The Value Of Selector
** $order = The DESC Ordering
** $limit = Number Of Records To Get
*/
function getLatest($select, $from, $order, $limit = 5, $where = null, $op = null, $value = null)
{
    global $db;

	$stmt = $where === null
	? $db->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit") 
	: $db->prepare("SELECT $select FROM $from WHERE $where $op $value ORDER BY $order DESC LIMIT $limit");
	
    $stmt->execute();
    return $stmt->fetchAll();
}

/*
** Function To Get Colomn From Table in Database
** $select = The Colomn To Select
** $from = The Table To select From
** $id = The Id Of The Feild
*/
function getCFT($select, $from, $tblId, $id)
{
	global $db;
	
	$stmt = $db->prepare("SELECT $select FROM $from WHERE $tblId = $id");
	$stmt->execute();
	$rst = $stmt->fetchColumn();
	return $rst;
}

/*
** Function To Check If The User Is Activated Or Not
** $user = The Username Of The User from his SESSION
*/
function regStatus($id) {
	global $db;
    $stmt = $db->prepare("SELECT reg_status FROM users WHERE user_id = ?");
	$stmt->execute(array($id));
	return $stmt->fetchColumn();
}

/*
** Function Of Rating Items
** $value = Value Of Rating Item
*/
function rating($value) {
	if ($value == 0) { 
		return '<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>';
	}elseif ($value == 1) {
		return '<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>';
	}elseif ($value == 2) {
		return '<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>';
	}elseif ($value == 3) {
		return '<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>
		<span class="fa fa-star-o"></span>';
	}elseif ($value == 4) {
		return '<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star-o"></span>';
	}else {
		return '<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>';
	}
}

/*
** Function Of Items Status
** $value = Value Of Item Status
*/
function itemStatus($value) {
	if ($value == 1) { 
		return 'Nouveau';
	}elseif ($value == 2) {
		return 'Comme neuf';
	}elseif ($value == 3) {
		return 'Utilisé';
	}else {
		return 'Ancien';
	}
}
