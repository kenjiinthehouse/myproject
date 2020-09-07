<?php
$page_title = '編輯資料';
$page_name = 'data-edit';
require __DIR__ . '/parts/__connect_db.php';
require __DIR__ . '/parts/__admin_required.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($sid)) {
    header('Location: data-list.php');
    exit;
}

$sql = " SELECT * FROM address_book WHERE sid=$sid";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: data-list.php');
    exit;
}


?>

<?php include __DIR__ . '/parts/__html_head.php'; ?>
<style>
    span.red-stars {
        color: red;
    }

    small.error-msg {
        color: red;
    }
</style>
<?php include __DIR__ . '/parts/__navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card"">
            <div class=" card-body">
                <h5 class="card-title">編輯資料</h5>
                <!-- form+ novalidate 不使用HTML5的驗證機制 -->
                <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                    <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                    <div class="form-group">
                        <label for="name"><span class="red-stars">**</span>姓名</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                        <small class="form-text error-msg"></small>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="red-stars">**</span>email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= htmlentities($row['email']) ?>">
                        <small class="form-text error-msg"></small>
                    </div>
                    <div class="form-group">
                        <label for="mobile"><span class="red-stars">**</span>手機 前端驗證off 後端on</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" pattern="09\d{2}-?\d{3}-?\d{3}" value="<?= htmlentities($row['mobile']) ?>">
                        <small class="form-text error-msg"></small>
                    </div>
                    <div class=" form-group">
                        <label for="birthday">生日</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= htmlentities($row['birthday']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <textarea class="form-control" name="address" id="address" rows="3"><?= htmlentities($row['address']) ?></textarea>
                    </div>
                    <div id="infobar" class="alert alert-success" role="alert" style="display: none;">
                        A simple success alert—check it out!
                    </div>
                    <button type="submit" class="btn btn-primary">送出</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php include __DIR__ . '/parts/__script.php'; ?>
<script>
    const email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    const mobile_pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
    const $name = document.querySelector('#name');
    const $email = document.querySelector('#email');
    const $mobile = document.querySelector('#mobile');
    const r_fields = [$name, $email, $mobile];
    const infobar = document.querySelector('#infobar');
    const submitBtn = document.querySelector('button[type=submit]');

    function checkForm() {
        let isPass = true;

        r_fields.forEach(el => {
            el.style.borderColor = '#CCCCCC';
            el.nextElementSibling.innerHTML = '';
        });

        // TODO: 檢查資料格式
        if ($name.value.length < 2) {
            isPass = false;
            $name.style.borderColor = 'red';
            $name.nextElementSibling.innerHTML = '請填寫正確的姓名';
        }


        if (!email_pattern.test($email.value)) {
            isPass = false;
            $email.style.borderColor = 'red';
            $email.nextElementSibling.innerHTML = '請填寫正確格式的電子郵箱';
        }

        // if (!mobile_pattern.test($mobile.value)) {
        //     isPass = false;
        //     $mobile.style.borderColor = 'red';
        //     $mobile.nextElementSibling.innerHTML = '請填寫正確的手機號碼';
        // }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('data-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infobar.innerHTML = '修改成功';
                        infobar.className = "alert alert-success";
                        // if (infobar.classList.contains('alert-danger')) {
                        //     infobar.classList.replace('alert-danger', 'alert-success')}
                        setTimeout(() => {
                            location.href = '<?= $_SERVER['HTTP_REFERER'] ?? "data-list.php" ?>';
                        }, 3000)

                    } else {
                        infobar.innerHTML = obj.error || '資料沒有修改';
                        infobar.className = "alert alert-danger";
                        // if (infobar.classList.contains('alert-success')) {
                        //     infobar.classList.replace('alert-success', 'alert-danger')}
                        submitBtn.style.display = 'block';

                    }
                    infobar.style.display = 'block';
                });

        } else {
            submitBtn.style.display = 'block';
        }
    }




    // function checkForm() {
    //     const fd = new FormData(document.form1);

    //     fetch('data-insert-api.php', {
    //             method: 'POST',
    //             body: fd
    //         })
    //         .then(r => r.text())
    //         .then(str => {
    //             console.log(str);
    //         });

    //     return false;
    // };
</script>
<?php include __DIR__ . '/parts/__html_foot.php'; ?>