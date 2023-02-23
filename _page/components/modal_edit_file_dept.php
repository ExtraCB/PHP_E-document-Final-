<div class="">
    <a href="" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal"
        data-bs-target="#modalLoginForm<?= $ofd -> id_file ?>">Edit
        File</a>
</div>
<div class="modal fade" id="modalLoginForm<?= $ofd -> id_file ?>" data-bs-keyboard="false" data-bs-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit File (Personal)</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <input type="hidden" name="type_create" value="2">
                    <input type="hidden" name="fileold" value="<?= $ofd -> location_file ?>">
                    <input type="hidden" name="idf" value="<?= $ofd -> id_file ?>">
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="loginName" name="name" class="form-control"
                            value="<?= $ofd -> name_file ?>" required />
                        <label class="form-label" for="loginName">Name File</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <select name="type" id="" class="form-control">
                            <option value="" selected>Please Selected</option>
                            <?php 
                                            $db -> select("type_files","*","");

                                            while($objf = $db -> query -> fetch_object()){ ?>
                            <option value="<?= $objf -> id_ftype ?>"
                                <?= ($objf -> id_ftype == $ofd -> type_file) ? "selected" : ""?>>
                                <?= $objf -> name_ftype ?>
                            </option>
                            <?php } ?>
                        </select>
                        <label class="form-label" for="loginPassword">Select Type File</label>
                    </div>

                    <div class="form-outline mb-3">
                        <select name="dept" id="" class="form-control">
                            <option value="" selected>Please Selected</option>
                            <?php 
                                            $db -> select("dept","*","");

                                            while($obj = $db -> query -> fetch_object()){ ?>
                            <option value="<?= $obj -> id_dept ?>"
                                <?= ($obj -> id_dept == $ofd -> dept_file) ? "selected" : ""  ?>>
                                <?= $obj -> name_dept ?>
                            </option>
                            <?php } ?>
                        </select>
                        <label class="form-label" for="loginPassword">Select Department</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="file" name="file" class="form-control" id="">
                        <label class="form-label" for="loginPassword">File</label>
                    </div>



                </div>
                <div class="modal-footer px-4 d-flex justify-content-between">
                    <!-- Submit button -->
                    <button type="submit" name="edit_file" class="btn btn-primary btn-block mb-4">Edit
                        File</button>
                    <?php if($ofd -> status_file == 1){ ?>
                    <button class="btn btn-secondary" type="submit" name="cancle_file">Cancle File</button>
                    <?php }else { ?>
                    <button class="btn btn-secondary" type="submit" name="active_file">Active File</button>
                    <?php } ?>

                </div>
            </div>
        </div>
    </form>
</div>
</div>