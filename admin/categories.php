<?php

/*
	================================================
	== Manage Catecories Page
	== You Can Add | Edit | Delete Catecories From Here
	================================================
    */
    
ob_start();
session_start();

$pageTitle = 'Les marques';

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') { // Manage Category Page
        
        $sort = 'ASC';
        $sort_array = array('ASC', 'DESC');

        if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }

        $stmt = $db->prepare("SELECT * FROM categories ORDER BY cat_order $sort");
        $stmt->execute();

        $cats = $stmt->fetchAll();
        $numCats = $stmt->rowCount(); ?>
        <div class="container-fluid" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">
        <div class="categories">
            <div class="row">
                <div class="col-md-4" style="padding-top: 24px;">
                    <a href="?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-4">
                    <h1 class="text-center"><?php echo translate('manage marks') ?> <span style="font-size: 22px;" class="badge"><?php echo $numCats; ?></span></h1>
                </div>
                <div class="col-md-4 options">
                    <div class="row no-gutters">
                        <div class="col-sm-6 " style="border-right: 1px solid"> [
                            <a class="<?php if($sort == 'ASC') echo 'active'; ?>" href="?sort=ASC"><i class="fa fa-arrow-up"></i> Asc</a> |
                            <a class="<?php if($sort == 'DESC') echo 'active'; ?>" href="?sort=DESC"><i class="fa fa-arrow-down"></i> Desc</a> ]
                        </div>
                        <div class="col-sm-6 view" style="border-left: 1px solid"> [
                            <span class="active" data-view="full"><i class="fa fa-eye"></i> Full</span> |
                            <span><i class="fa fa-eye-slash"></i> Simple</span> ]
                        </div>
                    </div>           
                </div>
            </div>
                <?php
                echo '<div class="row">';
                foreach($cats as $cat) {
                    echo '<div class="col-md-4">';
                        echo '<div class="panel panel-success cat">';

                            echo '<div class="panel-heading">';
                                echo '<h3 class="list-group-item-heading">' . $cat['cat_name'] . '</h3>';

                                echo '<div class="hidden-catOpt-btns">'; ?>
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-default" type="button" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="categories.php?do=Edit&catId=<?php echo $cat['cat_id']; ?>" class="optbtn-edit"><i class="fa fa-edit"></i> Modifier</a></li>
                                            <li><a href="categories.php?do=Delete&catId=<?php echo $cat['cat_id']; ?>" onclick="return confirm('êtes-vous sûr de vouloir supprimer cette catégorie')" class="optbtn-sup"><i class="fa fa-close"></i> Retirer</a></li>
                                        </ul>
                                    </div> <?php
                                echo '</div>';
                            echo '</div>';

                            echo '<div class="panel-body">';
                            
                                echo '<div class="details">';
                                    echo '<p class="list-group-item-text'; if($cat['cat_description'] == '') { echo ' text-muted'; } echo '">';
                                                if ($cat['cat_description'] == '')
                                                { echo 'description vide'; }
                                                else{ echo $cat['cat_description']; }
                                    echo '</p>';
                                echo '</div>';

                                echo '<div class="hidden-catStat-btns">';
                                    echo '<hr>';
                                    echo '<a href="chenge_visbt_stat.php?catId=' . $cat['cat_id'] . '&visbtStat=' . $cat['cat_visibility'] . '" 
                                             id="visbtStat" 
                                             class="btn '; if ($cat['cat_visibility'] == 0) { echo 'btn-warning'; } else { echo 'btn-success'; } echo ' btn-xs">
                                             Visibilité: <strong>'; if ($cat['cat_visibility'] == 0) { echo 'Off'; } else { echo "On"; }
                                    echo '</strong></a>';

                                    echo ' <a href="chenge_comts_stat.php?catId=' . $cat['cat_id'] . '&comtsStat=' . $cat['cat_allow_comments'] . '"
                                             id="comtsStat" 
                                             class="btn '; if ($cat['cat_allow_comments'] == 0) { echo 'btn-warning'; } else { echo 'btn-success'; } echo ' btn-xs">
                                             Commentaires: <strong>'; if ($cat['cat_allow_comments'] == 0) { echo 'Off'; } else { echo "On"; }
                                    echo '</strong></a>';

                                    echo ' <a href="chenge_ads_stat.php?catId=' . $cat['cat_id'] . '&adsStat=' . $cat['cat_allow_ads'] . '"
                                             id="comtsStat" 
                                             class="btn '; if ($cat['cat_allow_ads'] == 0) { echo 'btn-warning'; } else { echo 'btn-success'; } echo ' btn-xs">
                                             Annonces: <strong>'; if ($cat['cat_allow_ads'] == 0) { echo 'Off'; } else { echo "On"; }
                                    echo '</strong></a>';
                                echo '</div>';

                            echo '</div>';

                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                ?>

        </div>
        </div>


        <?php
        
    } elseif ($do == 'Add') { ?> <!-- Add Category Page -->

        <div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;">
            
            <div class="text-center">
                <h3><strong><?php echo translate('add new categorie') ?></strong></h3>
            </div>

            <form class="form-horizontal" action="?do=Insert" method="POST">

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">Nom:</label>
                    <div id="check-s" class="col-md-6">
                        <input type="text" id="catName" class="form-control" name="cat_name" placeholder="Nom de la catégorie" autocomplete="off" required="required">
                        <div id="check-ok"></div>
                        <div id="msg"></div>
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">Description:</label>
                    <div class="col-md-6">
                        <textarea maxlength="167" class="form-control" name="cat_description" rows="3" placeholder="Description de la catégorie"></textarea>
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">L'order:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="cat_order" placeholder="sélectionnez l'ordre de la catégorie" autocomplete="off" />
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">Visible:</label>
                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" name="cat_visibility" value="1" checked>Oui</label>
                        <label class="radio-inline"><input type="radio" name="cat_visibility" value="0">No</label>
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">Commenter:</label>
                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" name="cat_allow_comments" value="1" checked>Oui</label>
                        <label class="radio-inline"><input type="radio" name="cat_allow_comments" value="0">No</label>
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-md-3 control-label">Annonce:</label>
                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" name="cat_allow_ads" value="1" checked>Oui</label>
                        <label class="radio-inline"><input type="radio" name="cat_allow_ads" value="0">No</label>
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <div class="col-md-offset-3 col-md-6">
                        <button type="submit" id="submit" disabled class="btn btn-danger">Ajouter <i class="fa fa-user-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>

    <?php
    } elseif ($do == 'Edit') { // Edit Category Pge

        $catId = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0;
        
        // check if the catId exist in database
        $stmt = $db->prepare("SELECT * FROM categories WHERE cat_id = ?");

        $stmt->execute(array($catId));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        if ($count > 0) { ?>
        
            <div class="container-fluid" style="background-color: #eaeaea; padding-bottom: 10px; margin-top: 55px;">
                <div class="row justify-center">

                    <div class="col-md-8 col-sm-offset-2 profile-header">
                        <div style="text-align: center;">
                            <h3><strong><?php echo translate('edit category settings') ?></strong></h3>
                        </div>
                    </div>
                    <br>

                    <div class="col-md-8 col-sm-offset-2 profile-body">
                        <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="catId" value="<?php echo $catId ?>">

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">Nom:</label>
                                <div id="check-s" class="col-md-10">
                                    <input 
                                        type="text" 
                                        id="newCatName" 
                                        class="form-control" 
                                        name="cat_name" 
                                        old-catname ="<?php echo $row['cat_name'] ?>" 
                                        value="<?php echo $row['cat_name'] ?>" 
                                        placeholder='Insérer un nouveau nom pour la catégorie "<?php echo $row['cat_name'] ?>"' 
                                        required="required">
                                    <div id="check-ok"></div>
                                    <div id="msg"></div>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">Description:</label>
                                <div class="col-md-10">
                                    <textarea 
                                        maxlength="167" 
                                        class="form-control" 
                                        name="cat_description" 
                                        rows="3" 
                                        placeholder="<?php if($row['cat_description'] == '') 
                                                           { echo 'Ecrire une description pour la catégorie'; 
                                                           }else
                                                           { echo 'Ecrire une nouvelle description pour la catégorie'; } 
                                                           ?>"><?php echo $row['cat_description'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">L'order:</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="cat_order" value="<?php echo $row['cat_order'] ?>" placeholder="sélectionnez l'ordre de la catégorie" />
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">Visible:</label>
                                <div class="col-md-10">
                                    <label class="radio-inline"><input type="radio" name="cat_visibility" value="1" <?php if($row['cat_visibility'] == 1) { echo 'checked'; } ?> >Oui</label>
                                    <label class="radio-inline"><input type="radio" name="cat_visibility" value="0" <?php if($row['cat_visibility'] == 0) { echo 'checked'; } ?> >No</label>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">Commenter:</label>
                                <div class="col-md-10">
                                    <label class="radio-inline"><input type="radio" name="cat_allow_comments" value="1" <?php if($row['cat_allow_comments'] == 1) { echo 'checked'; } ?> >Oui</label>
                                    <label class="radio-inline"><input type="radio" name="cat_allow_comments" value="0" <?php if($row['cat_allow_comments'] == 0) { echo 'checked'; } ?> >No</label>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-md-2 control-label">Annonce:</label>
                                <div class="col-md-10">
                                    <label class="radio-inline"><input type="radio" name="cat_allow_ads" value="1" <?php if($row['cat_allow_ads'] == 1) { echo 'checked'; } ?> >Oui</label>
                                    <label class="radio-inline"><input type="radio" name="cat_allow_ads" value="0" <?php if($row['cat_allow_ads'] == 0) { echo 'checked'; } ?> >No</label>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" id="submit" class="btn btn-danger">Enregistrer <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <?php
        
        } else {

            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            $Msg = '<div class="alert alert-danger">Wrong CatId</div>';
            redirectTo($Msg);
            echo '</div>';
        }
        
    } elseif ($do == 'Update') { // Update Categorie Page
    
        echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            echo "<h1 class='text-center'>Mettre à jour un catégorie</h1> ";

            // Get Variables From The Form

            $id 		= $_POST['catId'];
            $catname 	= $_POST['cat_name'];
            $desc 		= $_POST['cat_description'];
            $order 	    = $_POST['cat_order'];
            $vis 	    = $_POST['cat_visibility'];
            $comts 	    = $_POST['cat_allow_comments'];
            $ads 	    = $_POST['cat_allow_ads'];            


            // Update Database With wThis Infos
        
            $stmt = $db->prepare("UPDATE
                                     categories 
                                  SET 
                                     cat_name = ?,
                                     cat_description = ?, 
                                     cat_order = ?, 
                                     cat_visibility = ?, 
                                     cat_allow_comments = ?, 
                                     cat_allow_ads = ? 
                                  WHERE 
                                     cat_id = ?");

            $stmt->execute(array($catname, $desc, $order, $vis, $comts, $ads, $id));
            $numRecord = $stmt->rowCount();

            // Seccess message
            $Msg = "<div class='alert alert-success'>" . $numRecord . ' Record Updated</div>';
            redirectTo($Msg, 'back', 2);

            } else {

            echo "<h1 class='text-center'>Mettre à jour un catégorie</h1> ";

            $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
            redirectTo($Msg, 'back', 3);
            echo "</div>";

            }
        echo '</div>';

    } elseif ($do == 'Insert') { // Insert Categorie Page

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            echo "<h1 class='text-center'>Ajouter un categorie</h1> ";

            // Get Variables From The Form

            $cat_name 	= $_POST['cat_name'];
            $cat_description 	= $_POST['cat_description'];
            $cat_order 	= $_POST['cat_order'];
            $cat_visibility = $_POST['cat_visibility'];
            $cat_allow_comments = $_POST['cat_allow_comments'];
            $cat_allow_ads = $_POST['cat_allow_ads'];

            // Check If User Exist In Database
            $check = checkItem("cat_name", "categories", $cat_name);
            
                if ($check == 1) {

                    $numRecord = 0;
                    $Msg = '<div class="alert alert-danger">Désolé, ce nom d\'utilisateur existe déjà!</div>';
                    redirectTo($Msg, 'back');
                }elseif ($check == 0 && !empty($cat_name)) {

            $stmt = $db->prepare("INSERT INTO categories(cat_name, cat_description, cat_order, cat_visibility, cat_allow_comments, cat_allow_ads)
                                    VALUES(:zcat, :zdesc, :zorder, :zvis, :zcmts, :zads)
                                    ");

            $stmt->execute(array(

                'zcat' => $cat_name,
                'zdesc' => $cat_description,
                'zorder' => $cat_order,
                'zvis' => $cat_visibility,
                'zcmts' => $cat_allow_comments,
                'zads' => $cat_allow_ads
                
                    ));
            $numRecord = $stmt->rowCount();
            }

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $numRecord . ' Record Inserted</div>';
            redirectTo($Msg, 'back');

        } else {

            echo '<div class="container" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">';
            $Msg = '<div class="alert alert-danger">Désolé, vous ne pouvez pas parcourir cette page directement</div>';
            redirectTo($Msg, 'back');
            echo '</div>';

        }

    } elseif ($do == 'Delete') { // Delete Category Page

        echo "<h1 class='text-center'>Retirer une catégorie</h1> ";

        $catId = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0;

        // check if the catId exist in database
        $check = checkItem('cat_id', 'categories', $catId);

        if ($check > 0) {

            $stmt = $db->prepare("DELETE FROM categories WHERE cat_id = :zid");
            $stmt->bindParam(":zid", $catId);
            $stmt->execute();

            // Echo Seccess message
            $Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Deleted</div>";
            redirectTo($Msg, 'back', 2);
            echo '</div>';

        } else {

            $Msg = '<div class="alert alert-danger">Wrong UserId</div>';
            redirectTo($Msg, 'back');
            echo '</div>';
        }

    }else {
        echo ' Error there\'s no page WITH THIS NAME ';
    }

    include $tpl . 'footer.php';
    echo '</div>';
}else{
    header('location: index.php');
    exit();
}
ob_end_flush();
?>