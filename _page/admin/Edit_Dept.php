<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$db -> checkAdmin();


if(isset($_POST['create_type'])){
    $name_dept = $_POST['name_dept'];

    $db -> insert("dept",['name_dept' => $name_dept]);

    if($db -> query){
        $_SESSION['success'] = "Type Successfully Added";
        header("location:".$_SERVER['REQUEST_URI']);
    }else{
        $_SESSION['error'] = "Type Error Added";
        header("location:".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['edit'])){
    $name_dept = $_POST['name_dept'];
    $id_dept = $_POST['id_dept'];

    $db -> update("dept",['name_dept' => $name_dept]," id_dept = $id_dept");
    if($db -> query){
        $_SESSION['success'] = "Type Successfully Edited";
        header("location:".$_SERVER['REQUEST_URI']);
    }else{
        $_SESSION['error'] = "Type Error Edited";
        header("location:".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['delete'])){
    $id_dept = $_POST['id_dept'];

    $db -> delete("dept"," id_dept = $id_dept");
    if($db -> query){
        $_SESSION['success'] = "Type Successfully Deleted";
        header("location:".$_SERVER['REQUEST_URI']);
    }else{
        $_SESSION['error'] = "Type Error Deleted";
        header("location:".$_SERVER['REQUEST_URI']);
    }
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
            <div class="row">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="name_dept" id="exampleInputEmail1" aria-describedby="emailHelp"
                            required>
                    </div>
                    <button type="submit" name="create_type" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- table -->
            <div class="row mt-3">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>รหัสแผนก</th>
                            <th>ชื่อ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $db = new database();
                                $db -> select("dept","*","");
                                while($obj =  $db -> query -> fetch_object()) { ?>
                        <tr>
                            <td>
                                <?= $obj -> id_dept ?>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?= $obj -> name_dept ?></p>
                            </td>
                            <td><?php include('./../components/modal_edit_dept.php'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!--Main layout-->
</body>

</html>