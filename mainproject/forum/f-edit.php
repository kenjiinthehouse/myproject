<?php
$page_title = 'user_edit';
$page_name = 'user_edit';
require __DIR__ . './../parts/__connect_db.php';

?>


<?php include __DIR__ . './../parts/__head_page.php'; ?>
<?php include __DIR__ . './../parts/__navbar_page.php'; ?>
<!-- <a href="f-edit.php" class="card-link bottom-btn"><i class="far fa-edit"></i>
                            </a> -->

<!-- Button trigger modal -->
<a type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-edit"></i>
</a>
<!-- 
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter">Link</button> -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . './../parts/__script_page.php'; ?>
<script>

</script>
<?php include __DIR__ . './../parts/__foot_page.php'; ?>