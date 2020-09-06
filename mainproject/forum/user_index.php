<?php
$page_title = 'user_留言區';
$page_name = 'user_forum';
require __DIR__ . './../parts/__connect_db.php';

$perPage = 10; //每頁10筆留言
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$total_sql = "SELECT COUNT(1) FROM `forum` "; //統計資料表有幾筆資料
$totalRows = $pdo->query($total_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);

$rows = [];
if ($totalRows > 0) {
    if ($page < 1) { //轉向
        header('Location: user_index.php');
        exit;
    };
    if ($page > $totalPages) {
        header('Location: user_index.php?page=' . $totalPages);
        exit;
    };

    $sql = sprintf("SELECT * FROM `forum` ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
};
?>


<?php include __DIR__ . './../parts/__head_page.php'; ?>
<?php include __DIR__ . './../parts/__navbar_page.php'; ?>




<div class="container d-flex justify-content-center">
    <form name="form1" onsubmit="sendForm(); return false;">
        <div class="card" style="width: 50rem; margin: 50px">
            <div class="card-body">
                <h5 class="card-title">留言</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" id="member_id" name="member_id">
                </div>
                <div>
                    <textarea class="form-control" id="forum-content" name="forum-content" rows="3"></textarea>
                    <small class="form-text error-msg"></small>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        發表<i class="fas fa-paper-plane" style="padding-left: 5px"></i>
                    </button>
                </div>

            </div>
        </div>
    </form>

</div>

<!-- 換頁按鈕 !-->
<div class="row page-button">
    <div class="col d-flex justify-content-center">
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

<!-- 留言內容引入 !-->
<?php foreach ($rows as $r) : ?>
<div class="container d-flex justify-content-center" style="background-color:#ccc">
    <div class="card" style="width: 50rem; margin: 20px">
        <div class="card-body">
            <h5 class="card-title"><?= $r['member_id'] ?></h5>

            <p class="card-text"><?= htmlentities($r['content']) ?></p>

            <div class="d-flex">
                <div style="margin-right: 10px">
                    <span><?= $r['post_time'] ?></span>
                </div>
                <div>
                    <span>
                        <a href="#" class="card-link accuse"><i class="fas fa-flag"></i></a>
                    </span>
                </div>
            </div>

            <!-- 右下按鈕區 -->
            <div class="d-flex justify-content-end">
                <div style="margin-right: 10px">
                    <a href="#" class="card-link thumbs-up"><i class="far fa-thumbs-up"></i>
                    </a><span><?= $r['add_points'] ?></span>
                </div>
                <div>
                    <a href="#" class="card-link thumbs-down"><i
                            class="far fa-thumbs-down"></i></a><span><?= $r['lose_points'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


</body>


<?php include __DIR__ . './../parts/__script_page.php'; ?>
<script>
const $forumContent = document.querySelector('#forum-content');
const infobar = document.querySelector('#infobar');
const submitBtn = document.querySelector('button[type=submit]');

// 刪除功能
function delete_it(sid) {
    if (confirm(`是否要刪除編號為 ${sid} 的資料???`)) {
        location.href = 'forum-data-delete-api.php?sid=' + sid;
    }
}
// 寫入留言
function sendForm() {
    let isPass = true;

    //TODO: 檢查是否有輸入留言內容
    if (!$forumContent.value.length) {
        isPass = false;
        $forumContent.style.borderColor = 'red';
        $forumContent.nextElementSibling.innerHTML = '想留言的話請輸入內容哦!';
    }


    if (isPass) {
        const fd = new FormData(document.form1);

        fetch('forum-insert-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json());
        // .then(obj => {
        //     console.log(obj);
        //     if (obj.success) {
        //         infobar.innerHTML = '新增成功';
        //         infobar.className = "alert alert-success";

        //         setTimeout(() => {
        //             location.href = 'forum.php';
        //         }, 3000)

        //     } else {
        //         infobar.innerHTML = obj.error || '新增失敗';
        //         infobar.className = "alert alert-danger";

        //         submitBtn.style.display = 'block';

        //     }
        //     infobar.style.display = 'block';
        // });

    } else {
        submitBtn.style.display = 'block';
    }

}
</script>
<?php include __DIR__ . './../parts/__foot_page.php'; ?>