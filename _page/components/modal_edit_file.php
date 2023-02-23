<div class="">
    <a href="" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal"
        data-bs-target="#modalLoginForm<?= $ofp -> id_file ?>">Edit
        File</a>
</div>
<div class="modal fade" id="modalLoginForm<?= $ofp -> id_file ?>" data-bs-keyboard="false" data-bs-backdrop="static"
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
                    <input type="hidden" name="type_create" value="1">
                    <input type="hidden" name="fileold" value="<?= $ofp -> location_file ?>">
                    <input type="hidden" name="idf" value="<?= $ofp -> id_file ?>">
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="loginName" name="name" class="form-control"
                            value="<?= $ofp -> name_file ?>" required />
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
                                <?= ($objf -> id_ftype == $ofp -> type_file) ? "selected" : ""?>>
                                <?= $objf -> name_ftype ?>
                            </option>
                            <?php } ?>
                        </select>
                        <label class="form-label" for="loginPassword">Select Type File</label>
                    </div>

                    <div class="form-outline mb-3">
                        <select name="user" id="" class="form-control">
                            <option value="" selected>Please Selected</option>
                            <?php 
                                            $db -> select("users","*"," id_user != $userid AND status_user = 1 AND type_user = 1");

                                            while($obju = $db -> query -> fetch_object()){ ?>
                            <option value="<?= $obju -> id_user ?>"
                                <?= ($obju -> id_user == $ofp -> to_file) ? "selected" : ""?>>
                                <?= $obju -> username_user ?>
                            </option>
                            <?php } ?>
                        </select>
                        <label class="form-label" for="loginPassword">Select Receiver</label>
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
                        <?php if($ofp -> status_file == 1){ ?>
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