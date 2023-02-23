<div class="modal fade" id="modalLoginForm<?= $obj -> id_dept ?>" data-bs-keyboard="false" data-bs-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit Department</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form ">
                        <input type="hidden" value="<?= $obj -> id_dept?>" name="id_dept" />
                        <input type="text" id="defaultForm-email" class="form-control validate" name="name_dept"
                            value="<?= $obj -> name_dept ?>">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Name Department</label>
                    </div>
                </div>
                <div class="modal-footer px-4 d-flex justify-content-between">
                    <button class="btn btn-warning" name="edit">Edit</button>
                    <button class="btn btn-danger" name="delete">Delete</button>
                </div>
            </div>
        </div>
</div>
</form>
</div>

<div class="">
    <a href="" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal"
        data-bs-target="#modalLoginForm<?= $obj -> id_dept ?>">Edit</a>
</div>