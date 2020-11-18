<?php
ob_start();

$pageTitle = 'Settigs';
include 'init.php';

if(isset($userId)) {

    $tab = isset($_GET['tab']) ? $_GET['tab'] : '';

    // fetch user data
    $stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute(array($userId));
    $row = $stmt->fetch();

    if($tab == '' || $tab == 'account'){
        ?>
        <div class="container-fluid">
            <div class="row" style="padding-top: 20px;">

                <div class="col-md-2 offset-md-1 settigs-side-links text-center">
                    <img src="data/uploads/images/profiles/<?php echo $row['user_image'] ?>" class="img-fluid img-thumbnail rounded-circle" alt="Image de profil">
                    <h4 class="text-center"><?php echo $row['user_name'] ?></h4>
                    <small>rejoint: <span class="text-muted"><?php echo $row['date'] ?></span></small>
                    <hr>
                    <div class="settigs-links">
                        <ul>
                            <li class="active"><a href="?tab=account"><?php echo translate('account settings') ?></a></li>
                            <li><a href="?tab=credit_card"><?php echo translate('credit card') ?></a></li>
                            <li><a href="?tab=notifications"><?php echo translate('notifications') ?></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row settigs-header">
                        <div class="col">
                            <h2><strong><?php echo translate('account settings') ?></strong></h2>
                            <p>Ajouter des informations sur vous-meme à partager sur votre profil</p>
                        </div>
                    </div>

                    <div class="row settigs-body">
                        <form class="col" action="" method="POST">
                            <input type="hidden" name="userId" value="<?php echo $userId ?>">

                            <div class="form-group">
                                <div class="col-md-8 offset-md-2">
                                    <label>Nom d'utilisateur:</label>
                                    <div id="check-s">
                                        <input 
                                            type="text"
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

                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <p>
                                        <a class="pull-right" data-toggle="collapse" href="#password" aria-expanded="true" aria-controls="password">Changer le mot de passe?</a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-8 offset-md-2">
                                    <div id="password" class="collapse">
                                        <label>Mot de passe:</label>
                                        <input type="hidden" name="oldpassword" value="<?php echo $row['user_password'] ?>">
                                        <input type="password" name="newpassword" placeholder="laissez-le vide si vous ne voulez pas le changer" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <div class="col-md-8 offset-md-2">
                                    <label>Adresse e-mail:</label>
                                    <input 
                                        type="email" 
                                        name="useremail" 
                                        value="<?php echo $row['user_email'] ?>"
                                        placeholder="Adresse e-mail"
                                        autocomplete="off" 
                                        required='required'>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-8 offset-md-2">
                                    <label>Nom et prénom:</label>
                                    <input 
                                        type="text"
                                        name="fullname" 
                                        value="<?php echo $row['full_name'] ?>"
                                        placeholder="Nom et prénom"
                                        autocomplete="off" 
                                        required='required' />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" id="submit" class="btn btn-danger">Enregistrer <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <?php
    }else if($tab == 'credit_card'){
        ?>
        <div class="container-fluid">
            <div class="row" style="padding-top: 20px;">

                <div class="col-md-2 offset-md-1 settigs-side-links text-center">
                    <img src="data/uploads/images/profiles/<?php echo $row['user_image'] ?>" class="img-fluid img-thumbnail rounded-circle" alt="Image de profil">
                    <h4 class="text-center"><?php echo $row['user_name'] ?></h4>
                    <small>rejoint: <span class="text-muted"><?php echo $row['date'] ?></span></small>
                    <hr>
                    <div class="settigs-links">
                        <ul>
                            <li><a href="?tab=account"><?php echo translate('account settings') ?></a></li>
                            <li class="active"><a href="?tab=credit_card"><?php echo translate('credit card') ?></a></li>
                            <li><a href="?tab=notifications"><?php echo translate('notifications') ?></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row settigs-header">
                        <div class="col">
                            <h2><strong><?php echo translate('credit card') ?></strong></h2>
                            <p>Ajouter des informations sur votre credit card</p>
                        </div>
                    </div>

                    <div class="row settigs-body">
                        <form class="col" action="" method="POST">
                            <input type="hidden" name="userId" value="<?php echo $userId ?>" />

                            
                            
                            <div class="form-group">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" id="submit" class="btn btn-danger">Enregistrer <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <?php
    }
}else{
	header('location: login.php');
	exit();
}
include $tpl . 'footer.php';
ob_end_flush();
?>