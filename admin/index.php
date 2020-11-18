<?php
	ob_start();
	session_start();
	$noNavbar = '';
	$pageTitle = 'Connexion';
	if(isset($_SESSION['username'])) {
		header('location: dashboard.php'); // redirect to dashboard page
	}
	include 'init.php';

	// check if user coming from HTTP Post Request
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username =  $_POST['user'];
		$password =  $_POST['pass'];
		$hashedpassword = sha1($password);

		// check if the user exist in database
		$stmt = $db->prepare("SELECT
							  	user_id, user_name, user_password
							  FROM 
							  	users
							  WHERE
							    user_name = ?
							  AND 
							    user_password = ? 
							  AND 
							    group_id = 1
							  LIMIT 1");

		$stmt->execute(array($username, $hashedpassword));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		// if exist user in database
		if ($count > 0) {
			$_SESSION['username'] = $username; // register session name
			$_SESSION['id'] = $row['user_id']; // register session id
			header('location: dashboard.php'); // redirect to dashboard page
			exit();
		}
	}

?>
<div class="container text-center" style="margin-top: 20px;">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >

                <legend>Connexion admin</legend>

                <div class="input-group" style="margin-bottom: 0;">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="username" class="form-control" name="user" placeholder="Nom d'utilisateur" autocomplete="off">
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="pass" placeholder="Mot de passe" autocomplete="new-password">
                </div>

                    <input type="submit" class="btn btn-seccess btn-block" name="login" value="se connecter">

            </form>
        </div>
    </div>
</div>

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>