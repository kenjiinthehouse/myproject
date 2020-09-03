<?php
$page_title = 'Podcast頻道編輯';
$page_name = 'podcast_channel_info';
require __DIR__ . '/parts/__connect_db.php';

$perPage = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$t_sql = "SELECT COUNT(1) FROM `podcast_channel_info`";
$totalRows =  $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//die('~~~'); //exit; // 結束程式
$totalPage = ceil($totalRows / $perPage);

$data = [];
if ($totalRows > 0) {
    if ($page < 1) $page = 1;
    if ($page > $totalPage) $page = $totalPage;


    $sql = sprintf("SELECT * FROM `podcast_channel_info` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $statement = $pdo->query($sql);
    $data = $statement->fetchAll();
};

?>

<style>
    img {
        margin: 0 auto;
        width: 100%;
        object-fit: contain;
    }

    .imgbox {
        max-width: 120px;
    }

    .modal-body {
        text-align: center;
    }

    th {
        text-align: center;
    }

    .buttonBar {
        text-align: center;
        margin-bottom: 1rem;
    }

    .pagination {
        margin-top: 1rem;
    }

    td {
        text-align: center;
    }
</style>

<?php include __DIR__ . '/parts/__head_page.php'; ?>
<?php include __DIR__ . '/parts/__navbar_page.php'; ?>
<div class="content">
    <div class="container">
        <div class="buttonBar">
            <button type="button" class="btn btn-info">新增頻道資料</button>
        </div>
        <table class="table table-striped">

            <thead>
                <tr>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <th scope="col"></th>
                    <?php endif; ?>
                    <th scope="col">序號</th>
                    <th scope="col">播客會員ID</th>
                    <th scope="col">頻道名稱</th>
                    <th scope="col">頻道封面</th>
                    <th scope="col">頻道簡介</th>
                    <th scope="col">頻道類別</th>
                    <th scope="col">頻道創建日期</th>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <th scope="col">編輯</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>
                    <tr class="dataTr">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <td><a href="dataDelete.php?id=<?= $row['sid'] ?>" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt trashcan" data-id="<?= $row['sid'] ?>"></a></td>
                        <?php endif; ?>
                        <td scope="col"><?= $row['sid'] ?></td>
                        <td scope="col"><?= $row['podcaster_id'] ?></td>
                        <td scope="col"><?= $row['channel_name'] ?></td>
                        <td scope="col">
                            <div class="imgbox">
                                <img src="<?= './../podcast_channel_img/' . $row['podcaster_img'] ?>" alt="<?= $row['channel_name'] ?>封面">
                            </div>
                        </td>
                        <td scope="col" style="max-width:400px;"><?= $row['podcaster_intro'] ?></td>
                        <td scope="col"><?= $row['channel_catagory'] ?></td>
                        <td scope="col"><?= $row['created_date'] ?></td>
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <td><a href="data-edit.php?id=<?= $row['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <div class="container">
        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center">
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?>">上一頁</a></li>

                <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                    if ($i < 1) continue;
                    if ($i > $totalPage) break;
                ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>

                <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">下一頁</a></li>
            </ul>

        </nav>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">警告</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger confirmDelete">確定</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>



<script>
    const deleteBtn = document.querySelectorAll('.trashcan');
    const confirmDelete = document.querySelector('.confirmDelete');
    const modalBody = document.querySelector('.modal-body');
    console.log(confirmDelete);
    deleteBtn.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            const id = event.target.dataset.id;
            console.log(event);
            modalBody.innerHTML = `確定要刪除排序第${id}號的頻道資料?`;
            confirmDelete.setAttribute('data-id', `${id}`);
            event.preventDefault();
        });
    });
    confirmDelete.addEventListener('click', (event) => {
        const id = event.target.dataset.id;
        location.href = `podcast_channel_info_delete.php?id=${id}`;
    });
</script>

<?php include __DIR__ . '/parts/__script_page.php'; ?>
<?php include __DIR__ . '/parts/__foot_page.php'; ?>