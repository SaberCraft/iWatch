<?php
ob_start();
$pageTitle = 'Connexion/Inscription';
include 'init.php';

if(isset($userId)) {
    header('location: index.php'); // redirect to index page
}

// check if user coming from HTTP Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['login'])) {

    $user_name =  $_POST['username'];
    $pass =  $_POST['password'];
    $hashedpass = sha1($pass);

    // check if the user exist in database
    $stmt = $db->prepare("SELECT
                              user_id, user_name, user_password
                          FROM 
                              users
                          WHERE
                            user_name = ?
                          AND 
                            user_password = ?");

    $stmt->execute(array($user_name, $hashedpass));
    $count = $stmt->rowCount();
    $user = $stmt->fetch();

    // if exist user in database
    if ($count > 0) {
      $_SESSION['userId'] = $user['user_id']; // register session Id
      $_SESSION['user'] = $user_name; // register session name
      header('location: index.php'); // redirect to dashboard page
      exit();
    }

  }else {
    $errors = array();

    // Validate Username
    if (isset($_POST['username']) && !empty($_POST['username'])) {
      $filterUserName = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $user = $filterUserName;
    }else {
      $errors[] = '<span class="text-danger">*Nom d\'utilisateur est obligatoire!</span>';
    }
    
    // Validate Email
    if (isset($_POST['email']) && !empty($_POST['email'])) {
      $filterEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
        $errors[] = '<span class="text-danger">*L\'email n\'est pas valide!</span>';
      }else {
        $email = $filterEmail;
      }
    }else {
      $errors[] = '<span class="text-danger">*L\'email est obligatoire!</span>';
    }

    // Validate Password
    if (isset($_POST['password']) && !empty($_POST['password'])) {
      $pass = sha1($_POST['password']);
    }else{
      $errors[] = '<span class="text-danger">*Le mot de passe est obligatoire!</span>';
    }

    if(empty($errors)) {

      $stmt = $db->prepare("INSERT INTO users(user_name, user_password, user_email, date)
                            VALUES(:zuser, :zpass, :zemail, now())
                           ");

      $stmt->execute(array( 'zuser' => $user,
                            'zpass' => $pass,
                            'zemail' => $email
                          ));

      $success = '<div class="success"><span class="text-success"><i class="fa fa-check"></i> Merci de votre inscription, maintenant vous pouvez vous connecter</span></div>';

    }

    
  }
}
?>

<div class="container-fluid login-page">
    <h1 class="text-center">
      <span data-class="login">Connecter</span> | 
      <span class="sign" data-class="signup">S'inscrir</span>
    </h1>
<!-- Start Login Form-->
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <div class="form-group">
    <label for="username">Nom d'utilisateur: <i class="fa fa-asterisk"></i></label>
    <input type="text" class="form-control" name="username" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe: <i class="fa fa-asterisk"></i></label>
    <input type="password" class="form-control" name="password" autocomplete="new-password">
    <i class="show-pass fa fa-eye"></i>
  </div>
  <input type="submit" name="login" class="btn btn-primary btn-block" value="Se connecter">
</form>
<!-- Ends Login Form-->

<!-- Start Signup Form-->
<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<?php
if(!empty($errors)) {
  echo '<div class="errors">';
  foreach($errors as $error) {
    echo $error . '<br>';
  }
  echo '</div>';
}

if(isset($success)) {
  echo $success;
}
?>
  <div class="form-group">
    <label for="username">Nom d'utilisateur: <i class="fa fa-asterisk"></i></label>
    <div id="check-s">
      <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
      <div id="msg"></div>
    </div>
  </div>
  <div class="form-group">
    <label for="email">Email addresse: <i class="fa fa-asterisk"></i></label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="password">Mot de passe: <i class="fa fa-asterisk"></i></label>
    <input type="password" minlength="6" class="form-control" name="password" autocomplete="new-password" required>
    <i class="show-pass fa fa-eye"></i>
  </div>
  <input type="submit" id="submit" name="signup" class="btn btn-success btn-block" value="S'inscrir">
</form>
<!-- Ends Signup Form-->
</div>

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>