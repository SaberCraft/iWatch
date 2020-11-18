<?php
	
	/* 
		Template Page
	 */
	ob_start();
	session_start();

$pageTitle = '';

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') { // 

    } elseif ($do == 'Add') {

    } elseif ($do == 'Edit') {

    } elseif ($do == 'Update') {

    } elseif ($do == 'Insert') {

    } elseif ($do == 'Delete') {

    } elseif ($do == 'Activate') {

    }else {
        echo ' Error there\'s no page WITH THIS NAME ';
    }

    include $tpl . 'footer.php';
}else{
    header('location: index.php');
    exit();
}
ob_end_flush();
?>