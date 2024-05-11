<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Website Title</title>
    <link rel="stylesheet" href="../css/pageAdminStyle.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="aplikasi">
                <img src="" alt="logo">
                <h1>ReCity</h1>
            </div>
            <div class="search">
                <input type="text" name="search-bar" class="search-bar" placeholder="Cari Laporan">
            </div>
            <div class="user">
                <p><?php echo $_SESSION["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi">
            <div class="sidebar">
                <ul>
                    <li class="access-menu"><a href="#">Statistik Laporan</a></li>
                    <li><a href="dataMasyarakat.php">Kelola Masyarakat</a></li>
                    <li><a href="dataGovernment.php">Kelola Supervisor</a></li>
                    <li><a href="#">Kelola Laporan</a></li>
                    <li><a href="#">Kelola Report</a></li>
                    <li><a href="../loginAdminandGov.php">Logout</a></li>
                    <li><a href="#">Ubah Mode</a></li>
                </ul>
            </div>
            <div class="konten">
                <h1>INI KONTEN</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem tempora eius quasi impedit quam corrupti quos vel ipsa cum laborum repellendus, nemo quod sed iure, libero, consequuntur facilis veritatis sit! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint veniam ipsam fuga molestias! Recusandae sit quam voluptates voluptatibus ullam, eos accusantium placeat modi quisquam minus nesciunt, iste blanditiis libero excepturi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae magni nulla sed molestias hic, asperiores minus dicta praesentium repellat suscipit nobis corrupti itaque possimus aspernatur veritatis aut. Quasi, fuga accusamus? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum explicabo id eum illo! Officia odio, velit quaerat nulla ipsum dignissimos eligendi commodi minima voluptatem, est numquam porro explicabo quam ab. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti non rerum illo odit cumque nobis repudiandae adipisci maiores! Consequatur doloribus quas numquam facere obcaecati quasi ipsum, voluptates soluta consequuntur aperiam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore vel unde laboriosam voluptates quasi adipisci excepturi doloremque suscipit, voluptatibus dolorem inventore sequi optio consequuntur vero, illo explicabo quos enim possimus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione incidunt sit laboriosam sunt, qui illo dolorem mollitia dicta laudantium eveniet, saepe velit aliquam unde voluptas porro odit, quibusdam natus dolor. Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque necessitatibus harum dignissimos corporis natus tenetur quae veniam dolor soluta, provident corrupti deserunt voluptatem voluptate expedita eum quos, cupiditate iste perferendis? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, ex quam. Ex nihil dolores quam non placeat sapiente impedit quo recusandae, tempora, culpa doloremque aut quae ut explicabo est possimus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, pariatur! Beatae unde assumenda repellat a quod at vitae? Aperiam nihil nesciunt et reiciendis dolorem, cumque commodi ut libero nisi quos? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ipsam odio, libero deleniti accusamus culpa cumque totam blanditiis quam ducimus voluptatem debitis maiores consectetur repudiandae id fugiat enim? Laudantium, saepe. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio repellendus dolorem quam cupiditate exercitationem blanditiis, nam consequatur ex officia. Corporis facere eligendi placeat atque temporibus sit aspernatur dicta perferendis voluptate. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus fugiat sequi consectetur, facilis, quasi reiciendis voluptate consequuntur, libero illum iste esse! Voluptatum nihil molestias eligendi fuga pariatur quibusdam autem dolorum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni incidunt consectetur error consequatur, placeat eveniet? Et esse modi a autem, eos quibusdam iure ipsam, accusamus aliquam quae voluptatibus. Dolore, quos.</p>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright &copy; 2024</div>
            <div class="contact">Contact: contact@example.com</div>
        </div>
    </div>
</body>
</html>
