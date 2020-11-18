<?php

	/*
	================================================
	== Manage Comments Page
	== You Can Edit | Delete | Approve Comments From Here
	================================================
	*/
    ob_start();
	session_start();

	if(isset($_SESSION['username'])) {
		$pageTitle = 'Comments';
		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page
        if ($do == 'Manage') { // Manage Members Page
            
			// Select All Comments
			$stmt = $db->prepare("SELECT * FROM comments");
			$stmt->execute();

			$rows = $stmt->fetchAll();
			$numCmts = $stmt->rowCount();

		    ?>

<div class="container-fluid" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">               
<h1 class="text-center"><?php echo translate('manage comments'); ?><span style="font-size: 22px;" class="badge"><?php echo $numCmts; ?></span></h1>
                <?php 
                if($numCmts > 0) { ?>
                <div class="table-responsive">          
                    <table class="main-table table text-center table-striped table-bordered table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Commentaire</th>
                            <th>Article</th>
                            <th>Membre</th>
                            <th>Date d'ajout</th>
                            <th>Contrôle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody> <?php
                        foreach ($rows as $data) {	
                            echo '<tr>';
                                echo '<td>' . $data['cmt_id'] . '</td>';
                                echo '<td>' . $data['comment'] . '</td>'; ?>
                                <td><?php getCFT('item_name', 'items', 'item_id', $data['item_id']) ?></td>
                                <td><?php getCFT('user_name', 'users', 'user_id', $data['member_id']) ?></td> <?php
                                echo '<td>' . $data['cmt_date'] . '</td>';
                                echo '<td>';
                                echo '<a href="comments.php?do=Edit&cmtId=' . $data['cmt_id'] . '" class="btn btn-info"><i class="fa fa-edit"></i> Modifier</a>  ';
                                echo '<a href="comments.php?do=Delete&cmtId=' . $data['cmt_id'] . '" class="btn btn-danger" onclick="return confirm(\'êtes-vous sûr de vouloir supprimer ce commentaire ?\')"><i class="fa fa-close"></i> Retirer</a>';
                                echo '</td>';
                            echo '</tr>';
                        } ?>
                        </tbody>
                    </table>
                </div> <?php
                }else {
                    echo '<div class="text-center alert alert-secondary">Il n\'y a pas des commentaires à montrer</div>'; 
                } ?>
            </div>
            <?php
		} elseif ($do == 'Edit') { // Edit Page

				$cmtId = isset($_GET['cmtId']) && is_numeric($_GET['cmtId']) ? intval($_GET['cmtId']) : 0;

				// check if the userId exist in database
				$stmt = $db->prepare("SELECT * FROM comments WHERE cmt_id = ?");

				$stmt->execute(array($cmtId));
				$cmt = $stmt->fetch();
				$count = $stmt->rowCount();

				if ($count > 0) { ?>
                
                    <div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;"> 
					    <div class="row">

		 	                <div class="col-12">
                                <h2 class="text-center"><?php echo translate('edit comment') ?></h2>
		 	                </div>

		 	                <div class="col-12">
                                <form class="form-horizontal" action="?do=Update" method="POST">
                                    <input type="hidden" name="cmtId" value="<?php echo $cmtId ?>">

                                    <div class="form-group form-group-lg">
                                        <label class="col-md-3 control-label">Commentaire:</label>
                                        <div class="col-md-6">
                                            <textarea
                                                class="form-control"
                                                name="comment"
                                                maxlength="600"
                                                rows="5"
                                                placeholder="Le commentaire"
                                                required="required"><?php echo $cmt['comment'] ?></textarea>
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
		            </div> <?php

                } else {

                
                    echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
                    $Msg = '<div class="alert alert-danger">Wrong cmtId</div>';
                    redirectTo($Msg);
                    echo '</div>';
                }

        }elseif ($do == 'Update') { // Update Page

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
                echo "<h1 class='text-center'>Mettre à jour un commentaire</h1> ";

                // Get Variables From The Form
                $id 	 = $_POST['cmtId'];
                $comment = $_POST['comment'];

                $stmt = $db->prepare("UPDATE comments SET comment = ? WHERE cmt_id = ?");
                $stmt->execute(array($comment, $id));
                $numRecord = $stmt->rowCount();

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

        }elseif ($do == 'Delete') { // Delete Comments Page

        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
        echo "<h1 class='text-center'>Retirer un commentaire</h1> ";

        $cmtId = isset($_GET['cmtId']) && is_numeric($_GET['cmtId']) ? intval($_GET['cmtId']) : 0;

        // check if the userId exist in database
        $check = checkItem('cmt_id', 'comments', $cmtId);

        if ($check > 0) {

            $stmt = $db->prepare("DELETE FROM comments WHERE cmt_id = :zid");
            $stmt->bindParam(":zid", $cmtId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Deleted</div>";
            redirectTo($Msg, 'back', 2);
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong cmtId</div>';
            redirectTo($Msg);
            echo '</div>';
        }

        }else {
            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';

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