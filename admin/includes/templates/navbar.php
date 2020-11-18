<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Iwatch</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
        <li><a href="categories.php"><?php echo translate('marks') ?></a></li>
            <li class="dropdown">
                <a href="items.php" class="dropbtn" aria-haspopup="true" aria-expanded="false"><?php echo translate('items') ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Alpina</a></li>
                        <li><a href="#">Ball Watch Co</a></li>
                        <li><a href="#">Casio</a></li>
                        <li><a href="#">Cartier</a></li>
                        <li><a href="#">Chanel</a></li>
                        <li><a href="#">Dior</a></li>
                        <li><a href="#">Diesel</a></li>
                        <li><a href="#">Omega</a></li>
                        <li><a href="#">Rolex</a></li>
                        <li><a href="#">Swatch</a></li>
                        <li><a href="#">Tissotr</a></li>
                    </ul>
             </li>
        <li><a href="members.php"><?php echo translate('users') ?></a></li>
        <li><a href="comments.php"><?php echo translate('comments') ?></a></li>
        <li><a href="#"><?php echo translate('stats') ?></a></li>
        <li><a href="#"><?php echo translate('logs') ?></a></li>
        </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropbtn" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../index.php"><span class="fa fa-shopping-cart"></span> Shop</a></li>
            <li><a href="#"><span class="fa fa-user"></span> <?php echo translate('profile') ?></a></li>
            <li><a href="#"><span class="fa fa-usd"></span> <?php echo translate('items') ?></a></li>
            <li><a href="members.php?do=Edit&userId=<?php echo $_SESSION['id'] ?>"><span class="fa fa-gear"></span> <?php echo translate('settings') ?></a></li>
            <li><a href="logout.php"><span class="fa fa-sign-out"></span> <?php echo translate('logout') ?></a></li>
          </ul>
        </li>
      </ul>
    </div>
    </div>
</nav>
