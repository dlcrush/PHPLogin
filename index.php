<?php
	require_once 'User.php';

	session_start();

	if (empty($_SESSION['user'])) {
		header('Location: login.php');
	}

	$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Edit Profile</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" action="controller.php?m=update" method="POST">
        <h2 class="form-signin-heading">Modify Information</h2>
        <p><strong>Not <?php echo $user->getUsername() ?>?</strong> <a href="controller.php?m=logout">Logout here</a></p>
        <?php
        	if (! empty($_GET['success'])) {
        		echo '<div class="alert alert-success" role="alert">' . $_GET['success'] . '</div>';
        	}
        ?>
        <label for="inputUsername" class="">Username</label><br>
        <?php echo $user->getUsername(); ?><br>
        <label for="inputPassword" class="">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
        <label for="inputFirstName" class="">First Name</label>
        <input type="text" id="inputFirstName" name="first_name" class="form-control" value="<?php echo $user->getFirstName(); ?>" required>
        <label for="inputLastName" class="">Last Name</label>
        <input type="text" id="inputLastName" name="last_name" class="form-control" value="<?php echo $user->getLastName(); ?>" required>
        <label for="inputBirthDate" class="">Birth date:</label>
        <input type="text" id="inputBirthDate" name="birth_date" class="form-control" value="<?php echo $user->getBirthDate(); ?>" required>
        <label for="inputBirthDate" class="">Sign up date:</label><br>
        <?php echo $user->getSignUpDate(); ?><br>
        <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">Modify Information</button>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>