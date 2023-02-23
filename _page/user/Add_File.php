<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();


if(isset($_POST['create_file'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $type_create = $_POST['type_create'];
    $userid = $_SESSION['userid'];
    $file = $_FILES['file'];

    $fileNew = $db -> uploadFile($file);

    if($type_create == 1){
        $sendto = $_POST['user'];

        $data = [
            'name_file' => $name,
            'location_file' => $fileNew,
            'own_file' => $userid,
            'to_file' => $sendto,
            'type_file' => $type
        ];
    }else{
        $dept = $_POST['dept'];
        $data = [
            'name_file' => $name,
            'location_file' => $fileNew,
            'own_file' => $userid,
            'dept_file' => $dept,
            'type_file' => $type
        ];
    }

    $db -> insert("files",$data);

    if($db -> query){
        $_SESSION['success']  = 'Insert Success';
        header("locaiton:".$_SERVER['REQUEST_URI']);
    }else{
        $_SESSION['error']  = 'Error Insert';
        header("locaiton:".$_SERVER['REQUEST_URI']);
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script defer src="./../../style/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../../style/css/bootstrap.css">

</head>

<body>
    <!--Main Navigation-->
    <header>
        <?php  include('./../components/navbar_user.php'); ?>
    </header>
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row">
                <?php include('./../components/error.php') ?>
                <div class="col-4"></div>
                <div class="col-4">
                    <!-- Pills navs -->
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login"
                                role="tab" aria-controls="pills-login" aria-selected="true">Create File To Personal</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register"
                                role="tab" aria-controls="pills-register" aria-selected="false">Create File to
                                Depart</a>
                        </li>
                    </ul>
                    <!-- Pills navs -->

                    <!-- Pills content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                            aria-labelledby="tab-login">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="type_create" value="1">
                                <div class="text-center mb-3">
                                    <p>Create File</p>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-3">
                                    <input type="text" id="loginName" name="name" class="form-control" required />
                                    <label class="form-label" for="loginName">Name File</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <select name="type" id="" class="form-control">
                                        <option value="" selected>Please Selected</option>
                                        <?php 
                                            $db -> select("type_files","*","");

                                            while($objf = $db -> query -> fetch_object()){ ?>
                                        <option value="<?= $objf -> id_ftype ?>">
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
                                        <option value="<?= $obju -> id_user ?>">
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

                                <!-- Submit button -->
                                <button type="submit" name="create_file" class="btn btn-primary btn-block mb-4">Send
                                    File</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="type_create" value="2">
                                <div class="text-center mb-3">
                                    <p>Create File</p>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-3">
                                    <input type="text" id="loginName" name="name" class="form-control" required />
                                    <label class="form-label" for="loginName">Name File</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <select name="type" id="" class="form-control">
                                        <option value="" selected>Please Selected</option>
                                        <?php 
                                            $db -> select("type_files","*","");

                                            while($objf = $db -> query -> fetch_object()){ ?>
                                        <option value="<?= $objf -> id_ftype ?>">
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
                                        <option value="<?= $obj -> id_dept ?>">
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

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary  btn-block mb-4" name="create_file">Send
                                    File</button>

                            </form>
                        </div>
                    </div>
                    <!-- Pills content -->
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </main>
    <!--Main layout-->
</body>

</html>