<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign up</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" action="controller.php?m=signup" method="POST">
        <h2 class="form-signin-heading">Sign up</h2>
        <p><strong>Already have an account?</strong> <a href="login.php">Login here</a></p>
        <?php
        	if (! empty($_GET['error'])) {
        		echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . '</div>';
        	}
        ?>
        <!-- <div class="alert alert-danger" role="alert">Username already exists</div> -->
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputFirstName" class="sr-only">First Name</label>
        <input type="text" id="inputFirstName" name="first_name" class="form-control" placeholder="First Name" required>
        <label for="inputLastName" class="sr-only">Last Name</label>
        <input type="text" id="inputLastName" name="last_name" class="form-control" placeholder="Last Name" required>
        <label for="inputBirthDate" class="sr-only">Birth Date</label>
        <input type="text" id="inputBirthDate" name="birth_date" class="form-control" placeholder="Birth Date" required>
        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> -->
        <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">Sign up</button>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>