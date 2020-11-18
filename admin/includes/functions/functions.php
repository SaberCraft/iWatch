<?php

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
    if ($where === null ) {
        $stmt = $db->prepare("SELECT COUNT($select) FROM $from");
    }else{
    $stmt = $db->prepare("SELECT COUNT($select) FROM $from WHERE $where $op $value");
    }
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

	if ($where === null ) {
		$stmt = $db->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit");
	}else{
		$stmt = $db->prepare("SELECT $select FROM $from WHERE $where $op $value ORDER BY $order DESC LIMIT $limit");
	}
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
	$rst = $stmt->fetch();
	echo $rst[$select];
}
