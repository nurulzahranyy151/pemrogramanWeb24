<?php
if(isset($_POST["submit"])){
  require 'php/functions.php';
  if(sign($_POST) == 1){
      echo "
          <script>
              alert('Akun berhasil dibuat, silahkan login');
              window.location.href = 'loginMasyarakat.php';
          </script>
      ";
  } else if(sign($_POST) == 0){
      $error = true;
      $errorMessage = "NIK sudah digunakan!";
  } else{
      $error = true;
      $errorMessage = "Sistem error!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Buat Akun</title>
    <link rel="stylesheet" href="css/signupStyle.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,600;0,700;0,800;1,200;1,300;1,600;1,700;1,800&display=swap"
      rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link a href="css/signupStyle.css">
  </head>
  <body>
    <div class="container">
      <div class="logo">
        <div class="blobs-vector">
          <img class="blobs-vector-layer1" src="img/layer1.png">
          <img class="blobs-vector-layer3" src="img/layer3.png">
          <img class="blobs-vector-layer2" src="img/layer2.png">
          <img class="blobs-vector-recity" src="img/recity.png">
        </div>
      </div>
      <form action="" id="form" method="POST" name="input">
        <h1>Buat Akun</h1>
        <h4>Selamat Datang!</h4>
        <div class="input-control">
          <label for="nik">NIK</label>
          <input id="nik" name="nik" type="text"/>
          <div class="error">
            <?php if(isset($error)) :?>
                <p><?php echo $errorMessage?></p>
            <?php endif ?>
          </div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="dob">Tanggal Lahir sesuai KTP</label>
          <input type="date" id="dob" name="dob" value="<?= $user["tgl_lahir_user"];?>">
        </div>
        <div class="input-control">
          <label for="nama">Username </label>
          <input id="nama" name="nama" type="text"/>
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="email">Email </label>
          <input id="email" name="email" type="email"/>
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="password">Password </label>
          <input id="password" name="password" type="password" />
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <div class="input-control">
          <label for="password2">Password Validation </label>
          <input id="password2" name="password2" type="password" />
          <div class="error"></div>
          <div class="success"></div>
        </div>
        <button type="submit" name="submit">Buat Akun</button>
        <div class="additional-text">
       <h4>Sudah memiliki Akun? <a href="loginMasyarakat.php">Masuk Disini</a></h4>
       </div>
      </form>
    </div>
    <script src="js/signupScript.js"></script>
  </body>
</html>
