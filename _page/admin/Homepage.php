<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$db -> checkAdmin();
$userid = $_SESSION['userid'];


$countall = new database();
$countall -> select("files","COUNT(id_file) as sum","");
$sum = $countall -> query -> fetch_assoc();

$countperson = new database();
$countperson -> select("files","COUNT(id_file) as sum","to_file != ''");
$sumperson = $countperson -> query -> fetch_assoc();


$countdept = new database();
$countdept -> select("files","COUNT(id_file) as sum","dept_file != ''");
$sumdept = $countdept -> query -> fetch_assoc();

$db2 = new database();
$db3 = new database();


if(isset($_POST['search'])){
    $text = $_POST['text'];

    $db2 -> select("files,users own, users send","timestamp_file,name_file,status_file,location_file,own.username_user as own_username,own.file_user as own_file,own.fname_user as own_fname,own.lname_user as own_lname,send.file_user as send_file, send.username_user as send_username,send.fname_user as send_fname,send.lname_user as send_lname","own_file = own.id_user AND to_file = send.id_user AND to_file != '' AND name_file LIKE '%$text%'  GROUP BY id_file");
    $db3 -> select("files,users own,dept","timestamp_file,status_file,name_file,location_file,own.username_user as own_username,own.file_user as own_file,own.fname_user as own_fname,own.lname_user as own_lname,name_dept","own_file = own.id_user AND dept_file = id_dept AND dept_file != '' AND name_file LIKE '%$text%'  GROUP BY id_file");
}else{
    $db2 -> select("files,users own, users send","timestamp_file,name_file,status_file,location_file,own.username_user as own_username,own.file_user as own_file,own.fname_user as own_fname,own.lname_user as own_lname,send.file_user as send_file, send.username_user as send_username,send.fname_user as send_fname,send.lname_user as send_lname","own_file = own.id_user AND to_file = send.id_user AND to_file != ''  GROUP BY id_file");
    $db3 -> select("files,users own,dept","timestamp_file,status_file,name_file,location_file,own.username_user as own_username,own.file_user as own_file,own.fname_user as own_fname,own.lname_user as own_lname,name_dept","own_file = own.id_user AND dept_file = id_dept AND dept_file != ''  GROUP BY id_file");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="./../../style/css/admin_hp.css">
    <script defer src="./../../style/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../../style/css/bootstrap.css">


</head>

<body>
    <!--Main Navigation-->
    <header>
        <?php include('./../components/sidebar.php');?>
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">

            <!-- card show stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        ไฟล์ในระบบทั้งหมด </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum['sum'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        ไฟล์ระหว่างผู้ใช้งาน</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sumperson['sum'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        ไฟล์ระหว่างแผนก</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sumdept['sum'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 mb-4">
                    <form action="" method="post">
                        <div class="input-group">

                            <input type="text" name="text" class="form-control" id="">
                            <button type="submit" name="search" class="btn btn-primary">Search</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#tabs1" role="tab"
                            aria-controls="pills-login" aria-selected="true">File Personal</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#tabs2" role="tab"
                            aria-controls="pills-register" aria-selected="false">File
                            Depart</a>
                    </li>
                </ul>

                <div class="tab-content" id="tab-content">
                    <div class="tab-pane fade show active" id="tabs1" role="tabpanel" aria-labelledby="tab1">
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>ผู้ส่ง</th>
                                    <th>ชื่อเอกสาร</th>
                                    <th>สถานะการส่ง</th>
                                    <th>ผู้รับ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                        while($fetch = $db2 -> query -> fetch_object()){?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="./../../file/<?= $fetch -> own_file ?>" alt=""
                                                style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $fetch -> own_username ?></p>
                                                <p class="text-muted mb-0">
                                                    <?= $fetch -> own_fname.'  '.$fetch -> own_lname ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $fetch -> name_file ?></p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge <?= ($fetch -> status_file == 1) ? "bg-success" : "bg-secondary" ?> rounded-pill d-inline"><?= ($fetch -> status_file == 1) ? "Active" : "Deactive" ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="./../../file/<?= $fetch -> send_file ?>" alt=""
                                                style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $fetch -> send_username ?></p>
                                                <p class="text-muted mb-0">
                                                    <?= $fetch -> send_fname.'  '.$fetch -> send_lname ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $fetch -> timestamp_file ?>
                                    </td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade  " id="tabs2" role="tabpanel" aria-labelledby="tab2">
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>ผู้ส่ง</th>
                                    <th>ชื่อเอกสาร</th>
                                    <th>สถานะการส่ง</th>
                                    <th>แผนกที่รับ</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        
                        
                        while($fetch = $db3 -> query -> fetch_object()){?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="./../../file/<?= $fetch -> own_file ?>" alt=""
                                                style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $fetch -> own_username ?></p>
                                                <p class="text-muted mb-0">
                                                    <?= $fetch -> own_fname.'  '.$fetch -> own_lname ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $fetch -> name_file ?></p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge <?= ($fetch -> status_file == 1) ? "bg-success" : "bg-secondary" ?> rounded-pill d-inline"><?= ($fetch -> status_file == 1) ? "Active" : "Deactive" ?></span>
                                    </td>
                                    <td>
                                        <?= $fetch -> name_dept ?>
                                    </td>
                                    <td>
                                        <?= $fetch -> timestamp_file ?>
                                    </td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>




            </div>
        </div>
    </main>
    <!--Main layout-->
</body>


</html>