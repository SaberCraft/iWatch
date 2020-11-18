<?php

	/*
		Items Page
	 */
	ob_start();
	session_start();

$pageTitle = 'Les articles';

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') { // Manage Items Page ?>

        <?php

			// Select All Items
			$stmt = $db->prepare("SELECT
                                items.*,
                                categories.cat_name AS marque,
                                users.user_name AS member
                            FROM
                                items
                            INNER JOIN 
                                categories ON categories.cat_id = items.cat_id
                            INNER JOIN
                                users ON users.user_id = items.member_id");
			$stmt->execute();

			$items = $stmt->fetchAll();
			$numItems = $stmt->rowCount();

		 ?>

<div class="container-fluid" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">
<?php
            if($numItems == 0) {
                echo '<h1 class="text-center">'.translate('manage items').'<span style="font-size: 22px;" class="badge"><?php echo $numItems; ?></span></h1>';
                echo '<div class="text-center alert alert-secondary">Il n\'y a pas des articles à montrer</div>'; 
                echo '<div class="text-center">';
                    echo '<a href="?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Nouvel article</a>';
                echo '</div>';
            }else{ ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="text-center"><?php echo translate('manage items'); ?><span style="font-size: 22px;" class="badge"><?php echo $numItems; ?></span></h1>
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
				        <th>Nom</th>
				        <th>Description</th>
				        <th>Prix</th>
                        <th>Origin de</th>
				        <th>Date d'ajouter</th>
                        <th>Marque</th>
                        <th>Membre</th>
				        <th>Contrôle</th>
				      </tr>
				    </thead>
				    <tbody>
				    <tbody>

				         <?php

				    foreach ($items as $item) {

				    	echo '<tr>';
				    		echo '<td>' . $item['item_id'] . '</td>';
				    		echo '<td>' . $item['item_name'] . '</td>';
				    		echo '<td>' . $item['item_description'] . '</td>';
				    		echo '<td>' . $item['price'] . '</td>';
                            echo '<td>' . $item['country_made'] . '</td>';
                            echo '<td>' . $item['add_date'] . '</td>';
                            echo '<td>' . $item['marque'] . '</td>';
                            echo '<td>' . $item['member'] . '</td>';
                            echo '<td>';
                                if($item['approve_status'] == 0) {
                                    echo '<a href="items.php?do=Approve&itemId=' . $item['item_id'] . '" class="btn btn-sm btn-success " onclick="return confirm(\'êtes-vous sûr de vouloir approuver cet article\')"><i class="fa fa-check"></i> Approuver</a>';
                                }
                                echo ' <a href="items.php?do=Edit&itemId=' . $item['item_id'] . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Modifier</a>';
                                echo ' <a href="items.php?do=Delete&itemId=' . $item['item_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'êtes-vous sûr de vouloir supprimer cet article ?\')"><i class="fa fa-close"></i> Retirer</a>';
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

    } elseif ($do == 'Add') { ?>

<div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;">

            <div class="row">
                <div class="col-12 text-center">
                    <h3><strong><?php echo translate('add new item') ?></strong></h3>
                </div>
            </div>

            <div class="row">
                <form class="col-12 form-horizontal" action="?do=Insert" method="POST">

                    <div class="form-group form-group-lg">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                name="item_name"
                                placeholder="Nom de l'article"
                                required="required">
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <label class="col-md-3 control-label">Description:</label>
                        <div class="col-md-6">
                            <textarea
                                class="form-control"
                                name="item_description"
                                rows="3"
                                placeholder="Description de l'article"
                                required="required"></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <label class="col-md-3 control-label">Fabriqué en:</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                name="country_made"
                                placeholder="Pays de fabrication"
                                required="required">
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <label class="col-md-3 control-label">Prix:</label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                name="price"
                                placeholder="Le prix doit être en DA"
                                required="required">
                        </div>
                    </div>

                    <div class="form-group group-select">
                        <label class="col-md-2 col-md-offset-1 control-label">L'état:</label>
                        <div class="col-md-2">
                            <select name="item_status" required="required">
                                <option value="0">...</option>
                                <option value="1" >Nouveau</option>
                                <option value="2" >Comme neuf</option>
                                <option value="3" >Utilisé</option>
                                <option value="4" >Ancien</option>
                            </select>
                        </div>

                        <label class="col-md-2 control-label">L'évaluation:</label>
                        <div class="col-md-2">
                            <select name="item_rating" required="required">
                                <option value="0">...</option>
                                <option value="1" >&#9733;</option>
                                <option value="2" >&#9733;&#9733;</option>
                                <option value="3" >&#9733;&#9733;&#9733;</option>
                                <option value="4" >&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="5" >&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group group-select">
                        <label class="col-md-2 col-md-offset-1 control-label">Membre:</label>
                        <div class="col-md-2">
                            <select  name="member_id" required="required">
                                <option value="0">...</option>
                                <?php
                                    $stmt = $db->prepare("SELECT user_id, user_name FROM users WHERE reg_status = 1");
                                    $stmt->execute();
                                    $members = $stmt->fetchAll();

                                    foreach($members as $member) {
                                        echo '<option value="'.$member['user_id'].'">'.$member['user_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <label class="col-md-2 control-label">Catégorie:</label>
                        <div class="col-md-2">
                            <select  name="cat_id" required="required">
                                <option value="0">...</option>
                                <?php
                                    $stmt = $db->prepare("SELECT cat_id, cat_name FROM categories");
                                    $stmt->execute();
                                    $cats = $stmt->fetchAll();

                                    foreach($cats as $cat) {
                                        echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-6">
                            <button
                                type="submit"
                                id="submit"
                                class="btn btn-danger">Ajouter <i class="fa fa-user-plus"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div> <?php
    } elseif ($do == 'Edit') {

        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;

        // check if the itemId exist in database
        $stmt = $db->prepare("SELECT * FROM items WHERE item_id = ?");

        $stmt->execute(array($itemId));
        $item = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) { ?>

<div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;">

                <div class="row">
                    <div class="col-12 text-center">
                        <h3><strong><?php echo translate('edit item settings') ?></strong></h3>
                    </div>
                </div>

                <div class="row">
                    <form class="col-12 form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="itemId" value="<?php echo $itemId ?>">

                        <div class="form-group form-group-lg">
                            <label class="col-md-3 control-label">Nom:</label>
                            <div class="col-md-6">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="item_name"
                                    placeholder="Nom de l'article"
                                    required="required"
                                    value="<?php echo $item['item_name'] ?>">
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <label class="col-md-3 control-label">Description:</label>
                            <div class="col-md-6">
                                <textarea
                                    class="form-control"
                                    name="item_description"
                                    rows="3"
                                    placeholder="Description de l'article"
                                    required="required"><?php echo $item['item_description'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <label class="col-md-3 control-label">Fabriqué en:</label>
                            <div class="col-md-6">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="country_made"
                                    placeholder="Pays de fabrication"
                                    required="required"
                                    value="<?php echo $item['country_made'] ?>">
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <label class="col-md-3 control-label">Prix:</label>
                            <div class="col-md-6">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="price"
                                    placeholder="Le prix doit être en DA"
                                    required="required"
                                    value="<?php echo $item['price'] ?>">
                            </div>
                        </div>

                        <div class="form-group group-select">
                            <label class="col-md-2 col-md-offset-1 control-label">L'état:</label>
                            <div class="col-md-2">
                                <select name="item_status" required="required">
                                    <option value="1" <?php if ($item['item_status'] == 1 ) { echo 'selected'; } ?> >Nouveau</option>
                                    <option value="2" <?php if ($item['item_status'] == 2 ) { echo 'selected'; } ?> >Comme neuf</option>
                                    <option value="3" <?php if ($item['item_status'] == 3 ) { echo 'selected'; } ?> >Utilisé</option>
                                    <option value="4" <?php if ($item['item_status'] == 4 ) { echo 'selected'; } ?> >Ancien</option>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">L'évaluation:</label>
                            <div class="col-md-2">
                                <select name="item_rating" required="required">
                                    <option value="1" <?php if ($item['item_rating'] == 1 ) { echo 'selected'; } ?> >&#9733;</option>
                                    <option value="2" <?php if ($item['item_rating'] == 2 ) { echo 'selected'; } ?> >&#9733;&#9733;</option>
                                    <option value="3" <?php if ($item['item_rating'] == 3 ) { echo 'selected'; } ?> >&#9733;&#9733;&#9733;</option>
                                    <option value="4" <?php if ($item['item_rating'] == 4 ) { echo 'selected'; } ?> >&#9733;&#9733;&#9733;&#9733;</option>
                                    <option value="5" <?php if ($item['item_rating'] == 5 ) { echo 'selected'; } ?> >&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group group-select">
                            <label class="col-md-2 col-md-offset-1 control-label">Membre:</label>
                            <div class="col-md-2">
                                <select  name="member_id" required="required">
                                    <?php
                                        $stmt = $db->prepare("SELECT user_id, user_name FROM users WHERE reg_status = 1");
                                        $stmt->execute();
                                        $members = $stmt->fetchAll();

                                        foreach($members as $member) {
                                            echo '<option value="'.$member['user_id'].'"';
                                            if ($item['member_id'] == $member['user_id'] ) { echo 'selected'; }
                                            echo '>'.$member['user_name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <label class="col-md-2 control-label">Catégorie:</label>
                            <div class="col-md-2">
                                <select  name="cat_id" required="required">
                                    <?php
                                        $stmt = $db->prepare("SELECT cat_id, cat_name FROM categories");
                                        $stmt->execute();
                                        $cats = $stmt->fetchAll();

                                        foreach($cats as $cat) {
                                            echo '<option value="'.$cat['cat_id'].'"';
                                            if ($item['cat_id'] == $cat['cat_id'] ) { echo 'selected'; }
                                            echo '>'.$cat['cat_name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <div class="col-md-offset-3 col-md-6">
                                <button
                                    type="submit"
                                    id="submit"
                                    class="btn btn-danger">Enregistrer <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        <?php
        } else {

            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            $Msg = '<div class="alert alert-danger">Wrong itemId</div>';
            redirectTo($Msg);
            echo '</div>';
        }
    } elseif ($do == 'Update') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            echo "<h1 class='text-center'>Mettre à jour une article</h1> ";

            // Get Variables From The Form
            $id      = $_POST['itemId'];
            $name     = $_POST['item_name'];
            $desc     = $_POST['item_description'];
            $made     = $_POST['country_made'];
            $price    = $_POST['price'];
            $status   = $_POST['item_status'];
            $rating   = $_POST['item_rating'];
            $member_id = $_POST['member_id'];
            $cat_id    = $_POST['cat_id'];

            function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

            // Validation Form
            $formErrors = array();

            if (empty($name)) {
            $formErrors[] = 'Le nom de l\'article ne peut pas être <strong>vide!</strong>';
            }

            if (empty($desc)) {
                $formErrors[] = 'Le description ne peut pas être <strong>vide!</strong>';
            }

            if (empty($made)) {
                $formErrors[] = 'Pays de fabrication ne peut pas être <strong>vide!</strong>';
            }else {
                $nom = test_input($made);
                if(!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,75})$/", $nom)) {
                array_push($formErrors, "Seules les lettres et les espaces autorisés dans le pays de fabrication!");
                }
            }

            if (empty($price)) {
                $formErrors[] = 'Le Prix ne peut pas être <strong>vide!</strong>';
            }elseif (!is_numeric($price)) {
                $formErrors[] = 'Le prix doit être <strong>numérique!</strong>';
            }

            foreach ($formErrors as $error) {

                echo '<div class="alert alert-danger">' . $error . '</div>';

            }
            $numRecord = 0;

            // Check If There's No Error Proceed The Update Operation
            if (empty($formErrors)) {

            $stmt = $db->prepare("  UPDATE
                                        items
                                    SET
                                        item_name = ?,
                                        item_description = ?,
                                        country_made = ?,
                                        price = ?,
                                        item_status = ?,
                                        item_rating = ?,
                                        member_id = ?,
                                        cat_id = ?
                                    WHERE
                                        item_id = ?");

            $stmt->execute(array($name, $desc, $made, $price, $status, $rating, $member_id, $cat_id, $id));
            $numRecord = $stmt->rowCount();
            }

            // Seccess message
            $Msg = "<div class='alert alert-success'>" . $numRecord . ' Record Updated</div>';
            redirectTo($Msg, 'back', 2);

        } else {

        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
        echo "<h1 class='text-center'>Mettre à jour un membre</h1> ";

        $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
        redirectTo($Msg);
        echo "</div>";

        }

    } elseif ($do == 'Insert') { // Insert Items Page

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            echo "<h1 class='text-center'>Ajouter des articles</h1> ";

            // Get Variables From The Form

            $name   	= $_POST['item_name'];
            $desc       = $_POST['item_description'];
            $price      = $_POST['price'];
            $made 		= $_POST['country_made'];
            $status 	= $_POST['item_status'];
            $rating 	= $_POST['item_rating'];
            $member_id 	= $_POST['member_id'];
            $cat_id 	= $_POST['cat_id'];

            function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

            // Validation Form
            $formErrors = array();

            if (empty($name)) {
            $formErrors[] = 'Le nom de l\'article ne peut pas être <strong>vide!</strong>';
            }

            if (empty($desc)) {
                $formErrors[] = 'Le description ne peut pas être <strong>vide!</strong>';
            }

            if (empty($made)) {
                $formErrors[] = 'Pays de fabrication ne peut pas être <strong>vide!</strong>';
            }else {
                $nom = test_input($made);
                if(!preg_match("/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,75})$/", $nom)) {
                array_push($formErrors, "Seules les lettres et les espaces autorisés dans le pays de fabrication!");
                }
            }

            if (empty($price)) {
                $formErrors[] = 'Le Prix ne peut pas être <strong>vide!</strong>';
            }elseif (!is_numeric($price)) {
                $formErrors[] = 'Le prix doit être <strong>numérique!</strong>';
            }

            if ($status == 0) {
                $formErrors[] = 'Tu dois choisir <strong>l\'état</strong> de l\'article!';
            }

            if ($member_id == 0) {
                $formErrors[] = 'Cet article devrait être <strong>attribué</strong> à un membre!';
            }

            if ($cat_id == 0) {
                $formErrors[] = 'Tu dois choisir <strong>le catégorie</strong> de l\'article!';
            }

            foreach ($formErrors as $error) {

                echo '<div class="alert alert-danger">' . $error . '</div>';

            }
            $numRecord = 0;
            // Check If There's No Error Proceed The Insert Operation
            if (empty($formErrors)) {

            $stmt = $db->prepare("INSERT INTO items(item_name, item_description, price, add_date, country_made, item_status, item_rating, approve_status, member_id, cat_id)
                                    VALUES(:zitem, :zdesc, :zprice, now(), :zmade, :zstatus, :zrating, 1, :zmid, :zcid)
                                    ");

            $stmt->execute(array(

                'zitem'     => $name,
                'zdesc'     => $desc,
                'zprice'    => $price,
                'zmade'     => $made,
                'zstatus'   => $status,
                'zrating'   => $rating,
                'zmid'      => $member_id,
                'zcid'      => $cat_id

                    ));
            $numRecord = $stmt->rowCount();
            }

            // Echo Seccess message
            if($numRecord == 1) {
            $Msg = "<div class='alert alert-success'>" . $numRecord . " Record Inserted</div>";
            redirectTo($Msg, 'back', 2);
            }

        } else {

        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
        $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
        redirectTo($Msg);
        echo '</div>';

        }

    } elseif ($do == 'Delete') {

        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
        echo "<h1 class='text-center'>Retirer une article</h1> ";

        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;

        // check if the userId exist in database
        $check = checkItem('item_id', 'items', $itemId);

        if ($check > 0) {

            $stmt = $db->prepare("DELETE FROM items WHERE item_id = :zid");
            $stmt->bindParam(":zid", $itemId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Deleted</div>";
            redirectTo($Msg, 'back', 2);
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong itemId</div>';
            redirectTo($Msg);
            echo '</div>';
        }

    } elseif ($do == 'Approve') {

        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            echo "<h1 class='text-center'>Approuver une article</h1> ";

        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;

        // check if the itemId exist in database
        $check = checkItem('item_id', 'items', $itemId);

        if ($check > 0) {

            $stmt = $db->prepare("UPDATE items SET approve_status = 1 WHERE item_id = :zid");
            $stmt->bindParam(":zid", $itemId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Approved</div>";
            redirectTo($Msg, 'back', 2);
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong UserId</div>';
            redirectTo($Msg);
            echo '</div>';
        }
    }else {
        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            $Msg = '<div class="alert alert-danger">Error there\'s no page WITH THIS NAME</div>';
            redirectTo($Msg);
        echo '</div>';
    }

    include $tpl . 'footer.php';
}else{
    header('location: index.php');
    exit();
}
ob_end_flush();
?>
