<?php
$page_title = '留言區管理';
$page_name = 'admin_forum';
require __DIR__ . './../parts/__connect_db.php';
?>

<?php include __DIR__ . './../parts/__head_page.php'; ?>
<?php include __DIR__ . './../parts/__navbar_page.php'; ?>
<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-3">國家機器運作中<i class="fas fa-wrench"></i></h1>
    </div>
</div>
<div class="container-fluid">
    <table class="table table-striped forum-content-table">
        <thead>
            <tr scope="row">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Content</th>
                <th scope="col" class="thumb-up"><i class="far fa-thumbs-up"></i></th>
                <th scope="col" class="thumb-down"><i class="far fa-thumbs-down"></i></th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
            <tr class="table-danger">
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>


<?php include __DIR__ . './../parts/__script_page.php'; ?>
<?php include __DIR__ . './../parts/__foot_page.php'; ?>