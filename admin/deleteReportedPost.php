<?php
require '../php/functions.php';

if (!isset($_SESSION["id_admin"])) {
    header("Location: ../loginAdmin.php");
    exit();
}

if (isset($_POST['idpost'])) {
    $deleted = deletePostingan($_POST['idpost']);

    if ($deleted) {
        $reports = findReported();
        $perpage = 5;
        $dataReport = [];
        
        while ($row = mysqli_fetch_assoc($reports)) {
            $dataReport[] = $row;
        }
        
        $sumReport = count($dataReport);
        $sumPage = ceil($sumReport / $perpage);
        $activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $startPage = ($perpage * $activePage) - $perpage;

        if (mysqli_num_rows($reports) > 0) {
            $count = $startPage + 1;
            $result = paginationReport($startPage, $perpage);
            ?>
            <table>
                <tr>
                    <th>No</th>
                    <th>Media</th>
                    <th>NIK</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="isi-data">
                    <td><?= $count; ?></td>
                    <td>
                        <img src="<?= $row['media']; ?>" alt="Media" class="media-report" onclick="showPopupReport(<?= $row['id_postingan']; ?>)" width="75px">
                    </td>
                    <td><?= $row['NIK']; ?></td>
                    <td><?= $row["kategori"]; ?></td>
                    <td>
                        <div class="button-container">
                            <button type="button" class="btn del-btn" onclick="showDelete(<?= $row['id_postingan']; ?>)">
                                <i class='bx bx-trash icon'></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php 
                    $count++;
                    endwhile; 
                ?>
            </table>
            <div class="pagination">
                <ul>
                    <?php if ($activePage > 1): ?>
                        <li><a href="?page=1"><<</a></li>
                        <li><a href="?page=<?= $activePage - 1; ?>"><</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $sumPage; $i++): ?>
                        <?php if ($i == $activePage): ?>
                            <li><a href="?page=<?= $i; ?>" class="active"><?= $i; ?></a></li>
                        <?php else: ?>
                            <li><a href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($activePage < $sumPage): ?>
                        <li><a href="?page=<?= $activePage + 1; ?>">></a></li>
                        <li><a href="?page=<?= $sumPage; ?>">>></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php 
        } else {
            echo "<p>Tidak ada laporan.</p>";
        }
    }
}
?>
