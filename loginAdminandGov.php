<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="css/signupStyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,600;0,700;0,800;1,200;1,300;1,600;1,700;1,800&display=swap"
      rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    
    <div class="container">
      <form action="php/confirmAdminandGov.php" id="form" method="POST" name="input">
        <h1>Login</h1>
        <h4>Welcome Back!</h4>
        <div class="input-control">
          <label for="email">Email </label>
          <input id="email" name="email" type="email" />
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="password">Password </label>
          <input id="password" name="password" type="password" />
          <div class="error"></div>
          <div class="success"></div>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="error-message">Kombinasi email dan password salah!</div>';
        }
        ?>
        <button type="submit" name="submit">Login</button>
        <p>OR</p>
        <h4><a href="loginMasyarakat.php">Login</a> as Masyarakat</h4>
      </form>
    </div>
    <script src="js/loginValidation.js"></script> 
  </body>
</html>
