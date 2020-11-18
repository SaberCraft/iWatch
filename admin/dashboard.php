<?php
    ob_start();
	session_start();
	if(isset($_SESSION['username'])) {

		$pageTitle = 'Tableau de bord';

		include 'init.php';

		$latestUsers = getLatest('*', 'users', 'user_id', 5, 'group_id', '!=', 1); // Latest Users Array To Show
		$numUsers = count($latestUsers); // Number Of Latest Items

		$latestItems = getLatest('*', 'items', 'item_id', 5); // Latest Items Array To Show
		$numItems = count($latestItems); // Number Of Latest Items

		$latestCmts = getLatest('*', 'comments', 'cmt_id', 10); // Latest Comments Array To Show
		$numCmts = count($latestCmts); // Number Of Latest comments

		?>
		<div class="home-stats">
			<div class="container-fluid" style="background-color: #fff; padding-bottom: 10px; margin-top: 55px;">
				<h1 class="text-center" style="font-weight: bold; margin: 20px 0;">Tableau de bord</h1>
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-3">
                        <a href="members.php" class="btn btn-success btn-block">
                            <div class="stat">
								<i class="fa fa-users"></i>
								<div class="info">
								Total membres
								<span><?php echo countRows('group_id', 'users', 'group_id', '!=', '1') ?></span>
								</div>
                            </div>
                        </a>
					</div>
					<div class="col-md-3">
                        <a href="members.php?do=Manage&users=Pending" class="btn btn-warning btn-block">
                            <div class="stat">
								<i class="fa fa-user-plus"></i>
								<div class="info">
								Membres en attente
								<span><?php echo countRows('reg_status', 'users', 'reg_status', '=', '0') ?></span>
								</div>
							</div>
                        </a>
					</div>
					<div class="col-md-3">
						<a href="items.php?do=Manage" class="btn btn-primary btn-block">
                            <div class="stat">
								<i class="fa fa-tags"></i>
								<div class="info">
								Total articles
								<span><?php echo countRows('item_id', 'items') ?></span>
								</div>
							</div>
                        </a>
					</div>
					<div class="col-md-3">
                        <a href="comments.php?do=Manage" class="btn btn-info btn-block">
                            <div class="stat">
								<i class="fa fa-comments"></i>
								<div class="info">
								Total commentaires
								<span><?php echo countRows('cmt_id', 'comments') ?></span>
								</div>
							</div>
                        </a>
					</div>
				</div>
			</div>
		</div>

		<div class="latest">
		<div class="container-fluid" style="background-color: #fff; padding-bottom: 10px;">
    			<div class="row">
  					<div class="col-12 col-md-6 col-lg-6">
  						<div class="panel panel-success">
  					        <div class="panel-heading">
  								<i class="fa fa-users"></i><?php if($numUsers == 0) { echo ' Pas des utilisateurs'; }elseif($numUsers == 1) { echo ' un utilisateur'; }else { echo ' Les '.$numUsers.' derniers utilisateurs inscrés'; } ?>
  								<span class="toggle-latest pull-right">
  									<i class="fa fa-minus fa-lg"></i>
  								</span>
  							</div>
  							<div class="panel-body"> <?php
  								if (countRows('user_id', 'users') == 0) {
  									echo 'Il n\'y a pas des membres à montrer';
  								}else{
  							?>
                                  <ul class="list-unstyled latest-users">
                                      <?php
                                      foreach ($latestUsers as $user) {
                                          echo '<li>';
                                              echo $user['user_name'];
                                              echo '<a href="members.php?do=Edit&userId=' . $user['user_id'] . '" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Modifier</a>';
                                              if($user['reg_status'] == 0) {
                                                  echo '<a href="members.php?do=Activate&userId=' . $user['user_id'] . '" class="btn btn-success pull-right" onclick="return confirm(\'êtes-vous sûr de vouloir activer ce membre ?\')"><i class="fa fa-check"></i> Activer</a>';
                                              }
                                          echo '</li>';
                                      }
                                      ?>
                                  </ul>
  								<?php } ?>
                              </div>
  				        </div>
  			        </div>
			        <div class="col-12 col-md-6 col-lg-6">
	              <div class="panel panel-success">
					        <div class="panel-heading">
								<i class="fa fa-tags"></i><?php if($numItems == 0) { echo ' Pas des articles'; }elseif($numItems == 1) { echo ' une article'; }else { echo ' Les '.$numItems.' derniers articles ajouté'; } ?>
								<span class="toggle-latest pull-right">
									<i class="fa fa-minus fa-lg"></i>
								</span>
							</div>
					        <div class="panel-body"> <?php
								if (countRows('item_id', 'items') == 0) {
									echo 'Il n\'y a pas des articles à montrer';
								}else{
							?>
								<ul class="list-unstyled latest-users">
									<?php
									foreach ($latestItems as $item) {
										echo '<li>';
											echo $item['item_name'];
											?> <span>(<?php getCFT('cat_name', 'categories', 'cat_id', $item['cat_id']) ?>)</span>
											<span class="text-muted" style="font-size: 12.5px;">ajouter par: <a href="#"><?php getCFT('user_name', 'users', 'user_id', $item['member_id']) ?></a></span> <?php
											echo '<a href="items.php?do=Edit&itemId=' . $item['item_id'] . '" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Modifier</a>';
											if($item['approve_status'] == 0) {
												echo '<a href="items.php?do=Approve&itemId=' . $item['item_id'] . '" class="btn btn-success pull-right" onclick="return confirm(\'êtes-vous sûr de vouloir approuver cet article ?\')"><i class="fa fa-check"></i> Approuver</a>';
											}
										echo '</li>';
									}
									?>
								</ul>
								<?php } ?>
							</div>
				        </div>
			        </div>
		        </div>

				<div class="row" style="margin-right: 0px; margin-left: 0px;">
					<div class="col-12">
						<div class="panel panel-success">
					        <div class="panel-heading">
								<i class="fa fa-comments"></i><?php if($numCmts == 0) { echo ' Pas des commentaires'; }elseif($numCmts == 1) { echo ' un commentaire'; }else { echo ' Les '.$numCmts.' derniers commentaires'; } ?>
								<span class="toggle-latest pull-right">
									<i class="fa fa-minus fa-lg"></i>
								</span>
							</div>
					        <div class="panel-body"> <?php
								if (countRows('cmt_id', 'comments') == 0) {
									echo 'Il n\'y a pas des commentaires à montrer';
								}else{
							?>

                <ul class="list-unstyled latest-cmts">
                    <?php
                    foreach ($latestCmts as $cmt) {
                      echo '<div class="col-6">';
  										echo '<li>'; ?>
  										<!-- comments -->
  										<div class="comment-section-container">
  											<div class="comment-section-author">
  												<img src="layout/images/avatar.png" alt="">
  												<div class="comment-section-name">
  												<h5><a href="#"><?php getCFT('user_name', 'users', 'user_id', $cmt['member_id']) ?></a></h5>
  												<p><?php echo $cmt['cmt_date'] ?></p>
  												</div>
  											</div>
  											<div class="comment-section-text">
  												<p><?php echo $cmt['comment'] ?></p>
  											</div>
  										</div>
  										<!--/comments-->
  										<?php
  											echo '<a href="comments.php?do=Delete&cmtId=' . $cmt['cmt_id'] . '" class="btn btn-danger pull-right"><i class="fa fa-close"></i> Retrier</a>';
                      echo '</li>';
                      echo '</div>';
                    }
                    ?>
                </ul>
								<?php } ?>
                            </div>
				        </div>
			        </div>
				</div>
			</div>
		</div>

		<?php

		include $tpl . 'footer.php';
	}else{
		header('location: index.php');
		exit();
	}

	ob_end_flush();
?>
