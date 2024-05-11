<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="css/signupStyle.css" />
  </head>
  <body>
    
    <div class="container">
      <form action="php/confirmMasyarakat.php" id="form" method="POST" name="input">
        <h1>Login</h1>
        <div class="input-control">
          <label for="email">Email : </label>
          <input id="email" name="email" type="email" />
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="password">Password : </label>
          <input id="password" name="password" type="password" />
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="error-message">Kombinasi email dan password salah!</div>';
        }
        ?>
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
    <script src="js/loginValidation.js"></script> 
  </body>
</html>
