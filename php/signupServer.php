<html>
    <body>
    <?php
        $conn=mysqli_connect("localhost" , "root", "", "malapor");
        $nik=$_POST["nik"];
        $nama=$_POST["nama"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $query= "INSERT INTO user
        VALUES('$nik', '$nama', '$email', '$password')";
        mysqli_query($conn,$query);
    ?>

</body>
</html>