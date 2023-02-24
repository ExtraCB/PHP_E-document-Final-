<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$userid = $_SESSION['userid'];




if(isset($_POST['selected'])){
    $dept_id = $_POST['dept'];

    $data = [
        'dept_user' => $dept_id
    ];

    $db -> update("users",$data," id_user = $userid");

    if($db -> query){
        $db -> setAlert("Selected Success !","succses");
        header('location:./Homepage.php');
        return;
    }else{
        $db -> setAlert("Can't Selected","warning");
        echo "<meta http-equive='refresh' content='3;url='localhost/e-document/_page/general/login.php'>";
        return;
    }
}


if(isset($_GET['download'])){
    $location = "./../../file/".$_GET['name'];
    $id = $_GET['id'];

    $db -> update("files",['reading_status' => 'reading'],"id_file = $id");

    if($db -> query){
        if(file_exists($location)){
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding:utf-8");
            header("Content-disposition:attachment;filename=\"".basename($location)."\"");
            readfile($location);
            header('location:'.$_SERVER['REQUEST_URI']);
            return;
            }else{
                $_SESSION['error'] = "File Crashed !";
                header('location:'.$_SERVER['REQUEST_URI']);
                return;
            }
    }

    $_SESSION['error'] = "Error Update File !";
    header('location:'.$_SERVER['REQUEST_URI']);
    return;
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script defer src="./../../style/js/bootstrap.bundle.js"></script>

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
                <form action="" method="get">
                    <div class="input-group mb-2">
                        <input type="text" name="text" class="form-control" id="">
                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <h2>Incoming File (Personal)</h2>

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NameFile</th>
                                <th scope="col">Sender</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $db2 = new database();
                            if(isset($_GET['search'])){
                                $text = $_GET['text'];
                                $db2 -> select('files,users,type_files','location_file,reading_status,name_file,id_user,username_user,timestamp_file,name_ftype,id_file,fname_user,lname_user,file_user',"(to_file = $userid AND to_file != '') AND own_file = id_user AND type_file = id_ftype AND status_file != 0 AND name_file LIKE '%$text%'");
                            }else{
                                $db2 -> select('files,users,type_files','location_file,reading_status,name_file,id_user,username_user,timestamp_file,name_ftype,id_file,fname_user,lname_user,file_user',"to_file = $userid AND to_file != '' AND own_file = id_user AND type_file = id_ftype AND status_file != 0");
                            }
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
                                <td> 
                                    <a href="./Homepage.php?download=1&name=<?= $ofp -> location_file?>&id=<?= $ofp -> id_file ?>">Download</a>
                                </td>
                               
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
                                <th scope="col">Sender</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $db3 = new database();
                            if(isset($_GET['search'])){
                                $text = $_GET['text'];
                                $db3 -> select('files,users,type_files','location_file,reading_status,name_file,id_user,username_user,timestamp_file,name_ftype,id_file,fname_user,lname_user,file_user',"dept_file = $dept_myself AND dept_file != '' AND own_file = id_user AND type_file = id_ftype AND status_file != 0 AND name_file LIKE '%$text%'");
                            }else{
                                $db3 -> select('files,users,type_files','location_file,reading_status,name_file,id_user,username_user,timestamp_file,name_ftype,id_file,fname_user,lname_user,file_user',"dept_file = $dept_myself AND dept_file != '' AND own_file = id_user AND type_file = id_ftype AND status_file != 0");
                            }
                            while($ofd = $db3 -> query -> fetch_object())
                            {
                                $i = 1;
                            ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $ofd -> name_file ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="./../../file/<?= $ofd -> file_user ?>" alt=""
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?= $ofd -> username_user ?></p>
                                            <p class="text-muted mb-0"><?= $ofd -> fname_user .' '.$ofd->lname_user ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $ofd -> timestamp_file ?></td>
                                <td><?= $ofd -> name_ftype ?></td>
                                <td><?= $ofd -> reading_status ?></td>
                                <td>
                                    <a
                                        href="./Homepage.php?download=1&name=<?= $ofd -> location_file?>&id=<?= $ofd -> id_file ?>">Download</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Select Department</h1>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <select name="dept" id="" class="form-control">
                            <option value="" selected> Please Selected Department Before used!</option>
                            <?php 
                            $dbselect = new database();
                            $dbselect -> select("dept","*","");

                            while($selected = $dbselect -> query -> fetch_object()){ ?>
                            <option value="<?= $selected -> id_dept ?>"><?= $selected -> name_dept ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="selected" class="btn btn-primary">Selected</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="./../../style/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    var param = window.location.search.substr(1);
    var modalDept = new bootstrap.Modal(document.getElementById('staticBackdrop'));
    if (param == "dept=1") {
        modalDept.show();
        console.log(param);
    }
    </script>
</body>


</html>