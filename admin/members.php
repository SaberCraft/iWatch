<?php

	/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/
    ob_start();
	session_start();

	if(isset($_SESSION['username'])) {
		$pageTitle = 'Paramètres';
		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page
		if ($do == 'Manage') { // Manage Members Page

            $pending = '';
            $order = 'users.user_id DESC';
            if(isset($_GET['users']) && $_GET['users'] == 'Pending') {
                $pending = 'And reg_status = 0';
                $order = 'users.user_id ASC';
            }

			// Select All users Except Admins
			$stmt = $db->prepare("SELECT * FROM users WHERE group_id != 1 $pending ORDER BY $order");
			$stmt->execute();

			$rows = $stmt->fetchAll();
			$numUsers = $stmt->rowCount();

		 ?>

        <div class="container-fluid" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">
        <?php
            if($numUsers == 0) { ?>
                <h1 class="text-center"><?php if(!empty($pending)) { echo translate('pending members'); }else{ echo translate('manage members'); } ?> <span style="font-size: 22px;" class="badge"><?php echo $numUsers; ?></span></h1>
                <?php
                echo '<div class="text-center alert alert-secondary">Il n\'y a pas des membres à montrer</div>'; 
                echo '<div class="text-center">';
                    echo '<a href="?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Nouveau membre</a>';
                echo '</div>';
            }else{ ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2"> 
                    <h1 class="text-center"><?php if(!empty($pending)) { echo translate('pending members'); }else{ echo translate('manage members'); } ?> <span style="font-size: 22px;" class="badge"><?php echo $numUsers; ?></span></h1>
                </div>
                <div class="col-md-2">
                    <a href="?do=Add" class="btn btn-primary pull-right" style="margin-top: 30px;"><i class="fa fa-plus"></i></a>
                </div>
            </div>
			<div class="table-responsive">          
				<table class="main-table table text-center table-striped table-bordered table-hover table-condensed">
					<thead>
				      <tr>
				        <th>#ID</th>
				        <th>Nom d'utilisateur</th>
				        <th>Nom complet</th>
				        <th>E-mail</th>
				        <th>Date d'enregistrement</th>
				        <th>Contrôle</th>
				      </tr>
				    </thead>
				    <tbody>
				    <tbody>
				        
				         <?php

				    foreach ($rows as $data) {
				    	
				    	echo '<tr>';
				    		echo '<td>' . $data['user_id'] . '</td>';
				    		echo '<td>' . $data['user_name'] . '</td>';
				    		echo '<td>' . $data['full_name'] . '</td>';
				    		echo '<td>' . $data['user_email'] . '</td>';
				    		echo '<td>' . $data['date'] . '</td>';
                            echo '<td>';
                            
                                if($data['reg_status'] == 0) {
                                    echo '<a href="members.php?do=Activate&userId=' . $data['user_id'] . '" class="btn btn-success " onclick="return confirm(\'êtes-vous sûr de vouloir activer ce membre\')"><i class="fa fa-check"></i> Activer</a>  ';
                                }
                                echo '<a href="members.php?do=Edit&userId=' . $data['user_id'] . '" class="btn btn-info"><i class="fa fa-edit"></i> Modifier</a>  ';
                                echo '<a href="members.php?do=Delete&userId=' . $data['user_id'] . '" class="btn btn-danger" onclick="return confirm(\'êtes-vous sûr de vouloir supprimer ce membre\')"><i class="fa fa-close"></i> Retirer</a>';

                            echo '</td>';
				    	echo '</tr>';

				    }

				    ?>
				    </tbody>
				</table>
			</div>
            <?php
            } ?>
		</div>

		<?php
		} elseif ($do == 'Edit') { // Edit Page

				$userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;

				// check if the userId exist in database
				$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ? LIMIT 1");

				$stmt->execute(array($userId));
				$row = $stmt->fetch();
				$count = $stmt->rowCount();

				if ($count > 0) { ?>

					<div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px; padding: 25px;">
					    <div class="row no-gutters">

					        <div class="col-md-2 col-md-offset-1 profile-side-links text-center">
					            <div class="profile-image">
					                <a href="#"><img src="layout/images/avatar.png" class="img-responsive img-circle" alt="Image de profil"></a>
					            </div>
					            <h4 align="center"><b><?php echo $row['user_name'] ?></b></h4>
					            <hr>
					            <div class="p-links">
                                    <ul>
                                        <li class="active"><a href="?do=Edit&userId=<?php echo $_SESSION['id'] ?>"><?php echo translate('settings') ?></a></li>
                                        <li><a href="#"><?php echo translate('credit card') ?></a></li>
                                        <li><a href="#"><?php echo translate('notifications') ?></a></li>
                                    </ul>
		 		                </div>
		 	                </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-12 edit-profile-header">
                                        <h2><strong><?php echo translate('settings') ?></strong></h2>
                                        <p>Ajouter des informations sur vous-meme à partager sur votre profil</p>
                                    </div>
                                </div>

                                <div class="row edit-profile-body">
                                <form class="col-12" action="?do=Update" method="POST">
                                    <input type="hidden" name="userId" value="<?php echo $userId ?>">

                                    <div class="form-group form-group-lg">
                                        <div class="col-md-8 col-md-offset-2">
                                            <label>Nom d'utilisateur:</label>
                                            <div id="check-s">
                                                <input 
                                                    type="text" 
                                                    class="form-control"
                                                    id="newUserName"
                                                    name="username"
                                                    old-username ="<?php echo $row['user_name'] ?>"
                                                    value="<?php echo $row['user_name'] ?>"
                                                    placeholder="Nom d'utilisateur"
                                                    autocomplete="off"
                                                    required='required'>
                                                <div id="msg"></div>
                                            </div>
                                                </div>
                                            <div class="col-md-2" id="check-ok"></div>
                                        </div>
                                    
                                     <div class="col-md-4 col-md-offset-6">
                                     <a href="#" class="pull-right collapsed" data-toggle="collapse" data-target="#password">Changer le mot de passe?</a>
                                    </div>
                                    
                                    
                                    <div class="col-md-8 col-md-offset-2">
                                     <div id="password" class="form-group form-group-lg collapse">
                                         <label>Mot de passe:</label>
                                         <input type="hidden" name="oldpassword" value="<?php echo $row['user_password'] ?>">
                                         <input type="password" class="form-control" name="newpassword" placeholder="laissez-le vide si vous ne voulez pas le changer" autocomplete="new-password">
                                     </div>
                                    </div>
                                    
                                    <div class="col-md-8 col-md-offset-2">
                                     <div class="form-group form-group-lg">
                                        <label>Adresse e-mail:</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            name="useremail" 
                                            value="<?php echo $row['user_email'] ?>"
                                            placeholder="Adresse e-mail"
                                            autocomplete="off" 
                                            required='required'>
                                     </div>
                                    </div>
                                    
                                    <div class="col-md-8 col-md-offset-2">
                                     <div class="form-group form-group-lg">
                                        <label>Nom et prénom:</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            name="fullname" 
                                            value="<?php echo $row['full_name'] ?>"
                                            placeholder="Nom et prénom"
                                            autocomplete="off" />
                                     </div>
                                    </div>
                                    
                                    <div class="col-md-10 col-md-offset-2">
                                     <div class="form-group form-group-lg">
                                        <button type="submit" id="submit" class="col-xs-offset-1 btn btn-danger">Enregistrer <i class="fa fa-save"></i></button>
                                    </div>
                                    </div>
                                    
                                </form>
                                    </div>
                                </div>
		                </div>
		            </div> <?php

                } else {

                    echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
                    $Msg = '<div class="alert alert-danger">Wrong UserId</div>';
                    redirectTo($Msg);
                    echo '</div>';
                }

        }elseif ($do == 'Update') { // Update Page

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
                echo "<h1 class='text-center'>Mettre à jour un membre</h1> ";

                // Get Variables From The Form

                $id 		= $_POST['userId'];
                $username 	= $_POST['username'];
                $email 		= $_POST['useremail'];
                $fullname 	= $_POST['fullname'];

                function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }

                // Password Trick
                $password = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']) ;

                // Validation Form
                $formErrors = array();

                if (empty($email)) {
                    $formErrors[] = 'L\'email ne peut pas être <strong>vide!</strong>';
                }else {
                    $mail = test_input($email);
                    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    array_push($formErrors, "Format d'email invalide!");
                    }
                }

                if (!empty($fullname)) {
                    $nom = test_input($fullname);
                    if(!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,75})$/", $nom)) {
                    array_push($formErrors, "Seules les lettres et les espaces autorisés!");
                    }
                }

                foreach ($formErrors as $error) {

                    echo '<div class="alert alert-danger">' . $error . '</div>';

                }

                $numRecord = 0;
                // Check If There's No Error Proceed The Update Operation
                if (empty($formErrors)) {

                $stmt = $db->prepare("UPDATE users SET user_name = ?, user_email = ?, full_name = ?, user_password = ? WHERE user_id = ?");
                $stmt->execute(array($username, $email, $fullname, $password, $id));
                $numRecord = $stmt->rowCount();
                }

                // Seccess message
                $Msg = "<div class='alert alert-success'>" . $numRecord . ' Record Updated</div>';
                redirectTo($Msg, 'back', 2);

            } else {

            echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
            echo "<h1 class='text-center'>Mettre à jour un membre</h1> ";

            $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
            redirectTo($Msg);
            echo "</div>";

            }

        }elseif ($do == 'Add') { // Add New Member ?>

            <div class="container-fluid text-center" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;">
                <div class="row justify-center">

                    <div class="col-xs-8 col-xs-offset-2">
                        <div>
                            <h3><strong><?php echo translate('add new member') ?></strong></h3>
                        </div>
                    </div>

                    <div class="col-xs-8 col-xs-offset-2">
                        <form action="?do=Insert" method="POST">

                            <div class="col-xs-8 col-xs-offset-2">
                                <div id="check-s" class="form-group form-group-lg">
                                    <input 
                                        type="text" 
                                        id="username" 
                                        class="form-control" 
                                        name="username" 
                                        placeholder="Nom d'utilisateur" 
                                        autocomplete="off" 
                                        required />
                                    <span id="check-ok"></span>
                                    <div id="msg"></div>
                                </div>
                            </div>

                            <div class="col-xs-8 col-xs-offset-2 form-group form-group-lg">
                                <input type="password" class="password form-control" name="password_1" placeholder="Mot de passe" autocomplete="new-password" required />
                                <i class="show-pass fa fa-eye"></i>
                            </div>

                            <div class="col-xs-8 col-xs-offset-2 form-group form-group-lg">
                                <input type="password" class="form-control" name="password_2" placeholder="Confirmez votre mot de passe" autocomplete="new-password" required />
                            </div>

                            <div class="col-xs-8 col-xs-offset-2 form-group form-group-lg">
                                <input type="email" class="form-control" name="email" placeholder="Adresse e-mail"  autocomplete="off" required />
                            </div>

                             <div class="col-xs-8 col-xs-offset-2 form-group form-group-lg">
                                <input type="text" class="form-control" name="fullname" placeholder="Nom et prénom" autocomplete="off" required />
                             </div>

                             <div class="col-xs-8 col-xs-offset-2 form-group form-group-lg">
                             <button type="submit" id="submit" disabled class="btn btn-danger">Ajouter <i class="fa fa-user-plus"></i></button>
                             </div>
                        </form>
                    </div>
                </div>
            </div> <?php

        }elseif ($do == 'Insert') { // Insert Member Page

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
                echo "<h1 class='text-center'>Add Member</h1> ";

                // Get Variables From The Form

                $username 	= $_POST['username'];
                $password_1 = $_POST['password_1'];
                $password_2 = $_POST['password_2'];
                $email 		= $_POST['email'];
                $fullname 	= $_POST['fullname'];

                function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }

                // Validation Form
                $formErrors = array();

                if (strlen($username) > 20) {
                    $formErrors[] = 'Le nom d\'utilisateur ne peut pas être plus de <strong>20 caractères!</strong>';
                }

                if (empty($username)) {
                $formErrors[] = 'Le nom d\'utilisateur ne peut pas être <strong>vide</strong>';
                    }elseif (strlen($username) < 3) {
                    $formErrors[] = 'Le nom d\'utilisateur ne peut pas être inférieur à <strong> 3 caractères!</strong>';
                }

                if (empty($password_1)) {
                    $formErrors[] = 'Le mot de passe ne peut pas être <strong>vide!</strong>';
                }

                if($password_1 != $password_2){
                array_push($formErrors, "Les deux mot de passe ne correspondent pas!");
                }

                if (empty($email)) {
                    $formErrors[] = 'L\'email ne peut pas être <strong>vide!</strong>';
                }else {
                    $mail = test_input($email);
                    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    array_push($formErrors, "Format d'email invalide!");
                    }
                }

                if (empty($fullname)) {
                    $formErrors[] = 'Nom et prénom ne peut pas être <strong>vide!</strong>';
                }else {
                    $nom = test_input($fullname);
                    if(!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,75})$/", $nom)) {
                    array_push($formErrors, "Seules les lettres et les espaces autorisés!");
                    }
                }

                // Check If User Exist In Database
                    $check = checkItem("user_name", "users", $username);

                    if ($check == 1) {

                        $numRecord = 0;
                        array_push($formErrors, "Désolé, ce nom d'utilisateur existe déjà");
                    }

                foreach ($formErrors as $error) {

                    echo '<div class="alert alert-danger">' . $error . '</div>';

                }

                // Check If There's No Error Proceed The Insert Operation
                if (empty($formErrors)) {

                $password = sha1($_POST['password_1']);

                $stmt = $db->prepare("INSERT INTO users(user_name, user_password, user_email, full_name, date, reg_status)
                                      VALUES(:zuser, :zpass, :zemail, :zname, now(), 1)
                                      ");

                $stmt->execute(array(

                    'zuser' => $username,
                    'zpass' => $password,
                    'zemail' => $email,
                    'zname' => $fullname

                     ));
                $numRecord = $stmt->rowCount();
                }

                // Echo Seccess message
                $Msg = "<div class='alert alert-success'>" . $numRecord . ' Record Inserted</div>';
                redirectTo($Msg, 'back', 5);

            } else {

            echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
            $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
            redirectTo($Msg);
            echo '</div>';

            }

        }elseif ($do == 'Delete') { // Delete Members Page

        echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
        echo "<h1 class='text-center'>Retirer un membre</h1> ";

        $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;

        // check if the userId exist in database
        $check = checkItem('user_id', 'users', $userId);

        if ($check > 0) {

            $stmt = $db->prepare("DELETE FROM users WHERE user_id = :zid");
            $stmt->bindParam(":zid", $userId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Deleted</div>";
            redirectTo($Msg, 'back');
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong UserId</div>';
            redirectTo($Msg);
            echo '</div>';
        }
        }elseif ($do == 'Activate') { // Activate Members Page

        echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';
        echo "<h1 class='text-center'>Activer un membre</h1> ";

        $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;

        // check if the userId exist in database
        $check = checkItem('user_id', 'users', $userId);

        if ($check > 0) {

            $stmt = $db->prepare("UPDATE users SET reg_status = 1 WHERE user_id = :zid");
            $stmt->bindParam(":zid", $userId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Activated</div>";
            redirectTo($Msg, 'back', 2);
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong UserId</div>';
            redirectTo($Msg);
            echo '</div>';
        }

        }else {
            echo '<div class="container" style="background-color: #fafafa; padding-bottom: 10px; margin-top: 55px;">';

            $Msg = '<div class="alert alert-danger">Wrong page</div>';
            redirectTo($Msg, 'back', 2);

            echo '</div>';

        }

		include $tpl . 'footer.php';
	}else{
	header('location: index.php');
	exit();
}
ob_end_flush();
?>