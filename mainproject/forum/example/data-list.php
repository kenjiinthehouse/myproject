<?php
$page_title = '資料列表';
$page_name = 'data-list';

require __DIR__ . '/parts/__connect_db.php';

$perPage = 5; // 每頁有幾筆資料

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM `address_book`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
/*
echo $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//die(' ~~~做完了~~~ '); // exit;  //結束程式  */

$rows = [];
if ($totalRows > 0) {
    if ($page < 1) { //轉向
        header('Location: data-list.php');
        exit;
    };
    if ($page > $totalPages) {
        header('Location: data-list.php?page=' . $totalPages);
        exit;
    };

    $sql = sprintf("SELECT * FROM `address_book` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
};


/*
$stmt = $pdo->query("SELECT * FROM `address_book` LIMIT 5");

$rows = $stmt->fetchAll();    */

?>

<?php include __DIR__ . '/parts/__html_head.php'; ?>

<?php include __DIR__ . '/parts/__navbar.php'; ?>
<div class="container">

    <div class="row">
        <div class="col d-flex justify-content-end">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fas fa-arrow-alt-circle-left"></i>
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




                    <?php /*
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor ?>    */ ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- `sid`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at` -->
    <table class="table table-dark">
        <thead>
            <tr>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    <th scope="col"><i class="fas fa-user-times"></i></th>
                <?php endif; ?>
                <th scope="col">#</th>
                <th scope="col">姓名</th>
                <th scope="col">Email</th>
                <th scope="col">手機</th>
                <th scope="col">生日</th>
                <th scope="col">地址</th>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <td><a href="data-delete.php?sid=<?= $r['sid'] ?>" onclick="ifDel(event)" data-sid="<?= $r['sid'] ?>"><i class="fas fa-trash-alt"></i></a></td>
                        <td><a href="javascript:delete_it(<?= $r['sid'] ?>)"><i class="fas fa-user-times"></i></a></td>
                    <?php endif; ?>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= $r['mobile'] ?></td>
                    <td><?= $r['birthday'] ?></td>
                    <td><?= $r['address'] ?></td>



                    <?php if (isset($_SESSION['admin'])) : ?>
                        <td><a href="data-edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                    <?php endif; ?>

                    <!-- project-forum驗證編輯機制試做 -->
                    <?php /*
                    <?php if (($_SESSION['loginok']['nickname'])==()) : ?>
                        <td><a href="data-edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                    <?php endif; ?>
   */   ?>




                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/parts/__script.php'; ?>
<script>
    function ifDel(event) {
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const sid = a.getAttribute('data-sid');
        if (!confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
            event.preventDefault(); // 取消連往 href 的設定
        }
    }

    function delete_it(sid) {
        if (confirm(`是否要刪除編號為 ${sid} 的資料???`)) {
            location.href = 'data-delete.php?sid=' + sid;
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php'; ?>