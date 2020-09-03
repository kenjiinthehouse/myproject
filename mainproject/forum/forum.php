<?php
$page_title = '留言區管理';
$page_name = 'admin_forum';
require __DIR__ . './../parts/__connect_db.php';

$perPage = 10; //每頁10筆留言
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$total_sql = "SELECT COUNT(1) FROM `forum` "; //統計資料表有幾筆資料
$totalRows = $pdo->query($total_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);


$rows = [];
if ($totalRows > 0) {
    if ($page < 1) { //轉向
        header('Location: forum.php');
        exit;
    };
    if ($page > $totalPages) {
        header('Location: forum.php?page=' . $totalPages);
        exit;
    };

    $sql = sprintf("SELECT * FROM `forum` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
};


?>

<?php include __DIR__ . './../parts/__head_page.php'; ?>
<?php include __DIR__ . './../parts/__navbar_page.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-3">國家機器運作中<i class="fas fa-wrench"></i></h1>
    </div>
    <div class="row page-button">
        <div class="col d-flex justify-content-end">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i < 1) continue;
                        if ($i > $totalPages) break;
                    ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>

<!-- 內容呈現 -->
<div class="container-fluid">
    <table class="table table-striped forum-content-table">
        <thead>
            <tr scope="row">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Content</th>
                <th scope="col" class="thumb-up"><i class="far fa-thumbs-up"></i></th>
                <th scope="col" class="thumb-down"><i class="far fa-thumbs-down"></i></th>
                <th scope="col" class="accuse""><i class=" fas fa-flag"></i></th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <th scope="row"><?= $r['sid'] ?></th>
                    <td><?= $r['member_id'] ?></td>
                    <td><?= $r['content'] ?></td>
                    <td><?= $r['add_points'] ?></td>
                    <td><?= $r['lose_points'] ?></td>
                    <td><?= $r['accuse_points'] ?></td>
                    <td><?= $r['post_time'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php include __DIR__ . './../parts/__script_page.php'; ?>
<?php include __DIR__ . './../parts/__foot_page.php'; ?>