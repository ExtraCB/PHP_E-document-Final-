<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();


if(isset($_POST['edit_file'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $type_create = $_POST['type_create'];
    $file = $_FILES['file'];
    $fileold = $_POST['fileold'];
    $id_file = $_POST['idf'];

    if($file['name'] != ""){
        $fileNew = $db->uploadFile($file);
    }else{
        $fileNew = $fileold;
    }

    if($type_create == 1){
        $sendto = $_POST['user'];

        $data = [
            'name_file' => $name,
            'location_file' => $fileNew,
            'to_file' => $sendto,
            'type_file' => $type
        ];
    }else{
        $dept = $_POST['dept'];
        $data = [
            'name_file' => $name,
            'location_file' => $fileNew,
            'dept_file' => $dept,
            'type_file' => $type
        ];
    }

    $db -> update('files',$data,"id_file = $id_file");
    if($db -> query){
        $_SESSION['success'] = "Edit Successfully";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Error For Edit File";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;

    }
}

if(isset($_POST['active_file'])){
    $idf = $_POST['idf'];
    $db -> update('files',['status_file' => '1']," id_file = $idf");
    if($db->query){
        $_SESSION['success'] = "Active File Successfully";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;

    }else{
        $_SESSION['error'] = "Error File";
        header('location:'.$_SERVER['REQUEST_URI']); 
        return;

    }
}

if(isset($_POST['cancle_file'])){
    $idf = $_POST['idf'];
    $db -> update('files',['status_file' => '0']," id_file = $idf");
    if($db->query){
        $_SESSION['success'] = "Cancle File Successfully";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;

    }else{
        $_SESSION['error'] = "Error File";
        header('location:'.$_SERVER['REQUEST_URI']); 
        return;

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
            <div class="row mb-5">
                <?php include('./../components/error.php') ?>
                <h2>Owner File (Personal)</h2>

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NameFile</th>
                                <th scope="col">Send to </th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db2 = new database();
                            $db2 -> select('files,type_files,users','reading_status,id_file,name_file,location_file,name_ftype,username_user,file_user,fname_user,lname_user,timestamp_file,to_file,type_file,status_file',"own_file = $userid AND to_file != '' AND type_file = id_ftype AND to_file = id_user");
                           
                            while($ofp = $db2 -> query -> fetch_object())
                            {
                                $i = 1;
                            ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $ofp -> name_file ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./../../file/<?= $ofp -> file_user ?>" alt=""
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?= $ofp -> username_user ?></p>
                                            <p class="text-muted mb-0"><?= $ofp -> fname_user .' '.$ofp->lname_user ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $ofp -> timestamp_file ?></td>
                                <td><?= $ofp -> name_ftype ?></td>
                                <td><?= $ofp -> reading_status ?></td>
                                <td><?php include('./../components/modal_edit_file.php') ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-5">
                <h2>Incoming File (Department)</h2>

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NameFile</th>
                                <th scope="col">Sendto (Department)</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>

                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db3 = new database();
                            $db3 -> select('files,type_files,dept','reading_status,id_file,name_file,location_file,name_dept,timestamp_file,to_file,type_file,status_file,name_ftype,dept_file',"own_file = $userid AND dept_file != '' AND type_file = id_ftype AND dept_file = id_dept");
                           
                            while($ofd = $db3 -> query -> fetch_object())
                            {
                                $i = 1;
                            ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $ofd -> name_file ?></td>
                                <td>
                                    <?= $ofd -> name_dept ?>
                                </td>
                                <td><?= $ofd -> timestamp_file ?></td>
                                <td><?= $ofd -> name_ftype ?></td>
                                <td><?= $ofd -> reading_status ?></td>

                                <td><?php include('./../components/modal_edit_file_dept.php') ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
</body>


</html>